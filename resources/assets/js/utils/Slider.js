import Swiper from 'swiper'
import {Pagination, Autoplay, Navigation, EffectCards} from 'swiper/modules'
import ScrollTrigger from 'gsap/ScrollTrigger'

export class Slider {
  constructor() {
    document.querySelectorAll('*[slider]').forEach(slider => {
      try {
        this.registerSlider(slider)
      } catch (e) {
        console.warn('Slider init failed', e)
      }
    })

    // ponytail: Stagger runs first and measures collapsed swipers
    ScrollTrigger.refresh()
  }

  slidesPerView(value, peekMobile) {
    const parsed = parseFloat(value)
    if (peekMobile && parsed === 1) {
      return 1.18
    }
    return parsed || value
  }

  parseJson(raw, fallback) {
    try {
      return raw ? JSON.parse(raw) : fallback
    } catch {
      return fallback
    }
  }

  registerSlider(slider) {
    const config = {
      loop: false,
      modules: [],
      centeredSlides: false,
    }

    const name = slider.getAttribute('data-slider')
    const per_view = slider.getAttribute('per-view')
    const per_view_sm = slider.getAttribute('per-view-sm')
    const per_view_md = slider.getAttribute('per-view-md')
    const per_view_xs = slider.getAttribute('per-view-xs')
    const modules = this.parseJson(slider.getAttribute('modules'), [])
    const extraConfig = this.parseJson(slider.getAttribute('extra'), {})
    const peekMobile = slider.hasAttribute('data-peek-mobile')
    const effect = slider.getAttribute('effect')

    if (modules.includes('navigation')) {
      config.modules.push(Navigation)
      config.navigation = {
        prevEl: slider.querySelector('.swiper-button-prev'),
        nextEl: slider.querySelector('.swiper-button-next'),
      }
    }

    if (modules.includes('pagination')) {
      config.modules.push(Pagination)
      config.pagination = {
        el: slider.querySelector('.swiper-pagination'),
        type: 'bullets',
        clickable: true,
        renderBullet: function () {
          return '<span class="swiper-pagination-bullet"></span>'
        }
      }
    }

    if (modules.includes('autoplay') || extraConfig.autoplay) {
      config.modules.push(Autoplay)
      config.autoplay = extraConfig.autoplay || {
        delay: 5000,
        disableOnInteraction: false
      }
    }

    if (effect === 'cards') {
      config.modules.push(EffectCards)
      config.effect = 'cards'
    }

    new Swiper(slider, {
      ...config,
      wrapperClass: name + '-wrapper',
      slidesPerView: this.slidesPerView(per_view, peekMobile),
      breakpoints: {
        300: {
          slidesPerView: this.slidesPerView(per_view_xs, peekMobile),
          centeredSlides: false,
        },
        480: {
          slidesPerView: this.slidesPerView(per_view_sm, peekMobile),
          centeredSlides: false,
        },
        768: {
          slidesPerView: this.slidesPerView(per_view_md, false),
        },
        1024: {
          slidesPerView: this.slidesPerView(per_view, false),
        },
      },
      ...extraConfig,
    })
  }
}
