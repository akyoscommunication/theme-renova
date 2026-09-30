import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

export class Stagger {
  constructor() {
    this.stagger();
    this.stagger_single();
  }

  stagger() {
    gsap.registerPlugin(ScrollTrigger)

    const targets = gsap.utils.toArray("[animation-stagger]").filter((el) => {
      return !el.hasAttribute("slider") && !el.closest("[slider]") && !el.querySelector("[slider]")
    })
    gsap.set(targets, {y: 60, autoAlpha: 0})

    ScrollTrigger.batch(targets, {
      onEnter: elements => {
        gsap.to(elements, {
          autoAlpha: 1,
          y: 0,
          opacity: 1,
          stagger: 0.2,
          duration: 0.7
        });
      },
      once: true,
      start: "top 90%",
    })
  }

  stagger_single() {
    this._elements = document.querySelectorAll('[animation-stagger-single]')

    gsap.registerPlugin(ScrollTrigger)

    if (!this._elements) return;

    this._elements.forEach(element => {
      let delay = element.getAttribute('animation-stagger-single') || 0;

      gsap.set(element, {y: 20, autoAlpha: 0})

      gsap.to(element, {
        autoAlpha: 1,
        y: 0,
        opacity: 1,
        stagger: 0.2,
        duration: 0.7,
        delay: delay,
        onComplete: () => {
          element.style.transform = 'none';
        }
      });
    })
  }
}
