import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

export class Background {
  constructor() {
    this._elements = document.querySelectorAll('[animation-background]')
    this._app = document.getElementById('app')

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
          duration: 0.5,
          start: 'top 80%',
          end: 'center-=200 top',
          onEnter: (e) => {
            this.enterAnimation(e)
          },
          onLeave: (e) => {
            this.leaveAnimation(e)
          },
          onEnterBack: (e) => {
            this.enterAnimation(e)
          },
          onLeaveBack: (e) => {
            this.leaveAnimation(e)
          }
        }
      })
    })
  }

  leaveAnimation(e) {
    let target = e.trigger
    const background = target.getAttribute('animation-background')
    if (background) {
      this._app.classList.remove(background)
    }
  }

  enterAnimation(e) {
    let target = e.trigger
    const background = target.getAttribute('animation-background')
    if (background) {
      this._app.classList.add(background)
    }
  }
}
