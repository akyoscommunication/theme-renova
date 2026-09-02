import Lenis from "lenis";
import 'lenis/dist/lenis.css'
import {gsap} from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

export class Scroll {
  constructor() {
    const lenis = new Lenis({
      lerp: 0.1,
      duration: 0.7,
      wheelMultiplier: 0.7
    });

    lenis.on('scroll', ScrollTrigger.update);

    gsap.ticker.add((time) => {
      lenis.raf(time * 1000);
    });

    gsap.ticker.lagSmoothing(0);
  }
}
