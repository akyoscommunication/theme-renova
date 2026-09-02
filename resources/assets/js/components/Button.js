import gsap from 'gsap'
export class Button {
  constructor () {
    this._buttons = document.querySelectorAll('.btn')

    this._buttons.forEach(button => {
      button.addEventListener('mouseenter', this.handleMouseEnter)
      button.addEventListener('mouseleave', this.handleMouseLeave)
    })
  }

  handleMouseEnter = (e) => {
    const rect = e.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    const percentX = (x / rect.width) * 100;
    const percentY = (y / rect.height) * 100;
  }

  handleMouseLeave = (e) => {
    gsap.to(e.target, {
      duration: 0.3,
      scale: 1,
      ease: 'power2.out'
    })
  }
}

