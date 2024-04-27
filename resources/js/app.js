import './bootstrap';
import ClipboardJS from 'clipboard'; 'clipboard';
import 'viewerjs/dist/viewer.css';
import Viewer from 'viewerjs'; 'viewerjs'; 'viewerjs';
import { HSTabs } from 'preline';
import Swiper from 'swiper';
import 'swiper/css';
import { Autoplay } from 'swiper/modules';

Swiper.use([Autoplay]);

window.ClipboardJS = ClipboardJS;
window.Viewer = Viewer;


window.Swiper = Swiper;

// import Swiper styles


window.selectText = (selector) => {
    const element = typeof selector == 'object' ? selector : document.querySelector(selector);
    if (window.getSelection && document.createRange) {
      const selection = window.getSelection();
      const range = document.createRange();
      range.selectNodeContents(element);
      selection.removeAllRanges();
      selection.addRange(range);
    } else {
      console.warn("Your browser does not support this feature.");
    }
  }

//   alert('what');
  
