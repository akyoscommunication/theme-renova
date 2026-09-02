export class Listener {
  constructor() {
    window.addEventListener('message', (event) => {
      if (event.origin !== 'https://access.akyos.com') {
        console.warn('Message rejected, invalid origin:', event.origin);
        return;
      }

      const data = event.data;
      if (data.type === 'updateCSSVariables' && data.cssVariables) {
        const cssVariables = data.cssVariables;

        Object.entries(cssVariables).forEach(([key, value]) => {

          const rgb = this.hexToRgb(value);


          document.documentElement.style.setProperty(key, value);
          document.documentElement.style.setProperty(`${key}--rgb`, `${rgb.r}, ${rgb.g}, ${rgb.b}`);

          console.log(`Variable CSS mise à jour : ${key} = HEX: ${value}, RGB: (${rgb.r}, ${rgb.g}, ${rgb.b})`);

        });

        console.log('CSS variables updated:', cssVariables);
      }
    });
  }


  hexToRgb(hex) {
    // Vérifie si le format est bien valide
    const validHex = hex.replace("#", "");
    if (validHex.length !== 6) {
      throw new Error(`Invalid HEX color: ${hex}`);
    }

    const r = parseInt(validHex.substring(0, 2), 16);
    const g = parseInt(validHex.substring(2, 4), 16);
    const b = parseInt(validHex.substring(4, 6), 16);

    return {r, g, b};
  }
}
