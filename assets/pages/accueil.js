import '../styles/navigation.css';
import '../styles/accueil.css';
import bgImage from '../images/bgimage.png';

// On vérifie si le JS est bien chargé
console.log('accueil.js chargé ✅');
console.log('Image Webpack :', bgImage);

// Appliquer dynamiquement le fond sur .imageDeFond
document.addEventListener('DOMContentLoaded', () => {
  const el = document.querySelector('.imageDeFond');
  if (el) {
    el.style.backgroundImage = `url(${bgImage})`;
    el.style.backgroundRepeat = 'no-repeat';
    el.style.backgroundPosition = 'center';
  } else {
    console.warn("Élément .imageDeFond non trouvé !");
  }
});
