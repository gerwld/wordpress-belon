//**** Blog MaxLength ****/
const articles = document.querySelectorAll('.apt_block');

articles.forEach(e => {
  let entry_content = e.querySelector('.entry_content');
  let cn = entry_content.textContent;
  if(cn.length > 600) {
   cn = entry_content.textContent.slice(0, 600) + '...';

   let btn_more = document.createElement("a");
   btn_more.setAttribute('href', '/');
   btn_more.classList.add('btn', 'btn_more');
   btn_more.innerText = 'Read more';
   entry_content.appendChild(btn_more);
  }
  entry_content.querySelector('p').textContent = cn;
})