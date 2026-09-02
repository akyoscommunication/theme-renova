export class FormButton {
  constructor() {
    this._btn = document.querySelector('.forminator-button')
    this._btnOther = document.querySelector('a.btn--secondary')
    if (!this._btn) return

    this.init()
  }

  init() {
    let content = this._btn.innerHTML
    let parent = document.createElement('div')
    let child = document.createElement('div')
    let child2 = document.createElement('div')
    let picture = document.createElement('picture')
    let icon = document.createElement('img')
    parent.classList.add('btn-title')
    child.classList.add('btn-title__item')
    child2.classList.add('btn-title__item')
    picture.classList.add('c-image')

    child.innerHTML = content
    child2.innerHTML = content

    icon.src = this._btnOther.querySelector('img').src

    parent.appendChild(child)
    parent.appendChild(child2)
    picture.appendChild(icon)

    this._btn.innerHTML = ''
    this._btn.appendChild(picture)
    this._btn.appendChild(parent)
  }
}
