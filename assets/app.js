import './stimulus_bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/normalize.css'
import './styles/app.css';
// import './styles/baptiste.css';
import './styles/thomas.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

// Filter series
// Create search input
const searchInput = document.createElement('input');
searchInput.type = 'text';
searchInput.placeholder = 'Search series...';
searchInput.style.cssText = 'position: fixed; width: 200px; padding: 8px; margin: 10px; border: 1px solid #ccc; border-radius: 4px;';
document.body.insertBefore(searchInput, document.body.firstChild);

// Filter function - uses img.alt only
function filterSeries() {
  const query = searchInput.value.trim().toLowerCase();
  
  document.querySelectorAll('article img').forEach(img => {
    const article = img.closest('article');
    if (article) {
      if (query === '' || img.alt.toLowerCase().includes(query)) {
        article.style.display = '';
      } else {
        article.style.display = 'none';
      }
    }
  });
}
// Real-time search
searchInput.addEventListener('keyup', filterSeries); 
