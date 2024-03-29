function rgbToHsl(color) {
    const r = color >> 16 & 255;
    const g = color >> 8 & 255;
    const b = color & 255;
  
    const max = Math.max(r, g, b) / 255;
    const min = Math.min(r, g, b) / 255;
    const delta = max - min;
  
    let h, s, l;
  
    if (delta === 0) {
      h = 0;
    } else if (max === r / 255) {
      h = ((g / 255 - b / 255) / delta) % 6;
    } else if (max === g / 255) {
      h = (b / 255 - r / 255) / delta + 2;
    } else {
      h = (r / 255 - g / 255) / delta + 4;
    }
  
    h = Math.round(h * 60);
    if (h < 0) {
      h += 360;
    }
  
    l = (max + min) / 2;
    s = delta === 0 ? 0 : delta / (1 - Math.abs(2 * l - 1));
  
    return { h, s, l };
  }
  
function hslToRgb(h, s, l) {
    const c = (1 - Math.abs(2 * l - 1)) * s;
    const x = c * (1 - Math.abs((h / 60) % 2 - 1));
    const m = l - c / 2;
  
    let r, g, b;
  
    if (h >= 0 && h < 60) {
      r = c;
      g = x;
      b = 0;
    } else if (h >= 60 && h < 120) {
      r = x;
      g = c;
      b = 0;
    } else if (h >= 120 && h < 180) {
      r = 0;
      g = c;
      b = x;
    } else if (h >= 180 && h < 240) {
      r = 0;
      g = x;
      b = c;
    } else if (h >= 240 && h < 300) {
      r = x;
      g = 0;
      b = c;
    } else {
      r = c;
      g = 0;
      b = x;
    }
  
    r = Math.round((r + m) * 255);
    g = Math.round((g + m) * 255);
    b = Math.round((b + m) * 255);
  
    return (r << 16) | (g << 8) | b;
  }

  function rgbToHex(color) {
    const r = (color >> 16) & 255;
    const g = (color >> 8) & 255;
    const b = color & 255;

    const hex = ((r << 16) | (g << 8) | b).toString(16).padStart(6, '0');

    return `#${hex}`;
  }

function generateHarmoniousColors(baseColor, numberOfColors) {
  const baseHSL = rgbToHsl(baseColor);
  const hueIncrement = 360 / numberOfColors;
  const harmoniousColors = [];

  for (let i = 0; i < numberOfColors; i++) {
    const hue = (baseHSL.h + hueIncrement * i) % 360;
    const color = hslToRgb(hue, baseHSL.s, baseHSL.l);
    harmoniousColors.push(rgbToHex(color));
  }

  

  return harmoniousColors;
}

function nHarmoniousColors(baseColor, numberOfColors){
    switch(baseColor){
        case 'red':
            return generateHarmoniousColors(0xff6384, numberOfColors);
        case 'blue':
            return generateHarmoniousColors(0x36a2eb, numberOfColors);
        case 'yellow':
            return generateHarmoniousColors(0xffcd56, numberOfColors);
        case 'cyan':
            return generateHarmoniousColors(0x00ffff, numberOfColors);
        default:
            return generateHarmoniousColors(baseColor, numberOfColors);
        }
}

export { nHarmoniousColors };