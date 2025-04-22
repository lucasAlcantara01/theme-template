import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

// init Swiper:
const swiper = new Swiper('.swiper', {
  // Optional parameters
  slidesPerView: 2,
  spaceBetween: 50,
  direction: 'horizontal',
  loop: true,
  autoplay:true,
});