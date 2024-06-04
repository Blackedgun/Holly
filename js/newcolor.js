document.addEventListener('DOMContentLoaded', (event) => {
    const colorPicker = document.getElementById('colorPicker');
    const savedColor = localStorage.getItem('themeColor');
  
    if (savedColor) {
      document.documentElement.style.setProperty('--theme-color', savedColor);
      document.documentElement.style.setProperty('--text-color', getContrastingColor(savedColor));
      colorPicker.value = savedColor;
    }
  
    colorPicker.addEventListener('input', (event) => {
      const newColor = event.target.value;
      document.documentElement.style.setProperty('--theme-color', newColor);
      document.documentElement.style.setProperty('--text-color', getContrastingColor(newColor));
      localStorage.setItem('themeColor', newColor);
    });
  });
  
  function getContrastingColor(color) {
    const r = parseInt(color.substr(1, 2), 16);
    const g = parseInt(color.substr(3, 2), 16);
    const b = parseInt(color.substr(5, 2), 16);
    const brightness = (r * 299 + g * 587 + b * 114) / 1000;
    return brightness > 128 ? 'black' : 'white';
  }