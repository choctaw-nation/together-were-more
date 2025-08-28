import '../../styles/pages/home.scss';
import PostPreviewHandler from './PostPreviewHandler';
import AOS from 'aos';

AOS.init({ easing: 'ease-in-out', offset: 20, duration: 550 });
new PostPreviewHandler('category-spotlight');
