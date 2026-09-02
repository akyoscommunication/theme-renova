import Swiper from 'swiper'
import {Pagination, Autoplay, Navigation} from 'swiper/modules'

export class Slider {
  constructor() {

    document.querySelectorAll('*[slider]').forEach(slider => {
      this.registerSlider(slider)
    })
  }

  slidesPerView(value, peekMobile) {
    const parsed = parseFloat(value)
    if (peekMobile && parsed === 1) {
      return 1.18
    }
    return parsed || value
  }

  registerSlider(slider) {

    /** default config **/
    let config = {
      loop: false,
      modules: [],
      centeredSlides: false,
    }

    /** variables from view **/
    let name = slider.getAttribute('data-slider')
    let per_view = slider.getAttribute('per-view')
    let per_view_sm = slider.getAttribute('per-view-sm')
    let per_view_md = slider.getAttribute('per-view-md')
    let per_view_xs = slider.getAttribute('per-view-xs')
    let modules = slider.getAttribute('modules')
    const peekMobile = slider.hasAttribute('data-peek-mobile')

    /** extra config **/
    const extraConfig = JSON.parse(slider.getAttribute('extra'))

    if (JSON.parse(modules).includes('navigation')) {
      config.modules.push(Navigation)
      config.navigation = {
        prevEl: slider.querySelector('.swiper-button-prev'),
        nextEl: slider.querySelector('.swiper-button-next'),
      }
    }

    if (JSON.parse(modules).includes('pagination')) {
      config.modules.push(Pagination)
      config.pagination = {
        el: slider.querySelector('.swiper-pagination'),
        type: 'bullets',
        clickable: true,
        renderBullet: function (index, className) {
          return '<span class="swiper-pagination-bullet"></span>'
        }
      }
    }

    if (JSON.parse(modules).autoplay) {
      config.modules.push(Autoplay)
      config.autoplay = {
        delay: 5000,
        disableOnInteraction: false
      }
    }

    new Swiper(slider, {
      ...config,
      ...extraConfig,
      wrapperClass: name + '-wrapper',
      centeredSlides: false,
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
    })
  }
}
