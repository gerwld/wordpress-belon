//**** Blog MaxLength ****/
const articles = document.querySelectorAll('.apt_block');

articles.forEach(e => {
  let entry_content = e.querySelector('.entry_content');
  let cn = entry_content.textContent.slice(0, 600) + '...';
  entry_content.textContent = cn;
})