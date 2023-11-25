import { rgbToHsl, hslToRgb } from './colorUtils.js';

function generateHarmoniousColors(baseColor, numberOfColors) {
  const baseHSL = rgbToHsl(baseColor);
  const hueIncrement = 360 / numberOfColors;
  const harmoniousColors = [];

  for (let i = 0; i < numberOfColors; i++) {
    const hue = (baseHSL.h + hueIncrement * i) % 360;
    const color = hslToRgb(hue, baseHSL.s, baseHSL.l);
    harmoniousColors.push(color);
  }

  return harmoniousColors;
}

export function nHarmoniousColors(baseColor, numberOfColors){
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