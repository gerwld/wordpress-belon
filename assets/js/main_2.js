const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
const vh = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0);
//**** Fix header when menu overflow ****/

(function () {
  window.onload = () => {
    let hf_blocks = document.querySelectorAll(".h3-height-hotfix");
    let hd_block = document.querySelector(".hd-blocks");
    let hd_navbar = document.querySelector(".hd-navbar");
    let height = Math.floor(hd_navbar.getBoundingClientRect().height);
    if (height > 70) {
      hf_blocks.forEach((el) => {
        el.style.height = `calc(100vh - ${height + 60}px)`;
      });
      hd_block && (hd_block.style.minHeight = `calc(100vh - ${height + 30}px)`);
    }
  };
})();