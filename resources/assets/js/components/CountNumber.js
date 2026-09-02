import {gsap} from 'gsap'
import ScrollTrigger from 'gsap/ScrollTrigger'
import {CountUp} from "countup.js";

export class CountNumber {
  constructor() {
    this._numbers = document.querySelectorAll('[animation-number]')

    if (!this._numbers.length) return;

    this.init()
  }

  init() {
    gsap.registerPlugin(ScrollTrigger)

    this._numbers.forEach(number => {
      gsap.to(number, {
        scrollTrigger: {
          trigger: number,
          start: 'top 100%',
          scrub: true,
          onEnter: (e) => {
            this.countNumber(e)
          },
          once: true
        }
      })
    })
  }

  countNumber(el) {
    let target = el.trigger
    let number = target.getAttribute('animation-number')

    const count = new CountUp(target, number, {
      duration: 4,
      useGrouping: false,
    })
    count.start()
  }
}
