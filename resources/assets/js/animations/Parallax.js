import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

export class Parallax {
  constructor() {
    this._elements = document.querySelectorAll('[animation-parallax]')

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
          start: 'top 100%',
          end: 'bottom 0%',
          scrub: true,
          onUpdate:
            (e) => {
              this.updateAnimation(e)
            }
        }
      })
    })
  }

  updateAnimation(e) {
    let target = e.trigger
    let img = target.querySelector('img')

    //vitesse de défilement 0 = pas de défilement, 1 = défilement normal
    let speed = 0.6;

    //calcul de la position de l'image
    let position = 100 - (e.progress * 100) * speed

    img.style.objectPosition = `center ${position}%`
  }
}
