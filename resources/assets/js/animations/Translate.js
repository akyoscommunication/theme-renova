import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

export class Translate {
  constructor () {
    this._elements = document.querySelectorAll('[animation-translate]')

    if (!this._elements) {
      return
    }

    this.init()
  }

  init () {
    gsap.registerPlugin(ScrollTrigger)

    this._elements.forEach((el) => {
      this._direction = el.getAttribute('animation-translate')
      gsap.to(el, {
        scrollTrigger: {
          trigger: el,
          start: 'top 95%',
          scrub: true,
          onEnter: (e) => {
            this.enterAnimation(e)
          }
        }
      })
    })
  }

  enterAnimation (e) {
    let target = e.trigger
    target.classList.add('animation-translate-' + this._direction + '--active')
  }
}
