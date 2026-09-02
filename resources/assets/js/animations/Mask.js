import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

export class Mask {
  constructor() {
    this._elements = document.querySelectorAll('[animation-mask]')

    if (!this._elements.length) {
      return;
    }

    this.init();
  }

  init() {
    gsap.registerPlugin(ScrollTrigger)

    this._elements.forEach(el => {
      gsap.timeline({
        scrollTrigger: {
          trigger: el,
          start: 'top 90%',
          end: 'bottom 10%',
          scrub: true,
          onEnter:
            (e) => {
              this.enterAnimation(e)
            }
        }
      })
    })
  }

  enterAnimation(e) {
    let target = e.trigger
    target.classList.add('animation-mask--active')
  }
}
