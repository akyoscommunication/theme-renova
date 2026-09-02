import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

export class TextOverflow {
  constructor() {
    this._elements = document.querySelectorAll('[animation-overflow]')

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
          start: 'top 70%',
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
    target.classList.add('animation-overflow--active')
  }
}

