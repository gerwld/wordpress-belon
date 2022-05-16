const def_clickable = document.getElementById("def_clickable");
const def_dt = def_clickable.querySelectorAll("dt");


// **** Toggle def_clickable **** //

def_clickable.addEventListener("click", (val) => {
  def_dt.forEach((e) => {
   if(val.target.classList.contains('tt')) {
    if (e === val.target) {
      e.classList.add("opened");
    } else {
      e.classList.remove("opened");
    }
   }});
}, {passive: true});


// **** Rb slider **** //

const THREE_BL_WIDTH = 800;
const ONE_BL_WIDTH = 550;
const IS_AUTOSCROLL = true;
const AUTOSCROLL_TIMEOUT = 4000;

const rb_slider = document.getElementById('rb_slider');
const rb_viewbox = rb_slider.querySelector('.rb_viewbox');
const rb_content = rb_slider.querySelector('.rb_content');
const rb_block = rb_slider.querySelector('.rb_block');

let elemWidth;
let offsetLeft = 0;
let paddingSize = 15;

rb_slider.addEventListener("click", (e) => {
 let btn_back = rb_slider.querySelector('.btn_back');
 let btn_fw = rb_slider.querySelector('.btn_fw');
  if (e.target === btn_back) {
   offsetLeft += rb_block.offsetWidth + paddingSize;
  } else if (e.target === btn_fw) {
    offsetLeft -= rb_block.offsetWidth + paddingSize;
  }
  ajustRbSlider();
});

const ajustRbSlider = () => {
 let viewboxWidth = rb_viewbox.offsetWidth;
 let contentWidth = rb_content.offsetWidth;
 if(contentWidth < viewboxWidth) {
  offsetLeft = 0;
 }
  else if (offsetLeft > paddingSize) {
    offsetLeft = viewboxWidth - contentWidth;
  } 
  else if (Math.abs(contentWidth - viewboxWidth) < Math.abs(offsetLeft + elemWidth)) {
   offsetLeft = 0;
 }
 rb_content.style.left = `${offsetLeft}px`;
}

if (IS_AUTOSCROLL) {
  var autoScroll = setInterval(autoScrollTm, AUTOSCROLL_TIMEOUT);
  function toggleScroll(isScroll) {
    if (isScroll) {
      autoScroll = setInterval(autoScrollTm, AUTOSCROLL_TIMEOUT);
    } 
    else clearInterval(autoScroll);
  }
  function autoScrollTm() {
    offsetLeft -= elemWidth + paddingSize;
    ajustRbSlider();
    rb_content.style.left = `${offsetLeft}px`;
  }

  rb_slider.addEventListener('mouseover', () => toggleScroll(false));
  rb_slider.addEventListener('mouseleave', () => toggleScroll(true));
  rb_slider.addEventListener('touchstart', () => toggleScroll(false));
  rb_slider.addEventListener('touchend', () => toggleScroll(true));
}

const resizeRbBlock = () => {
 let blocks = rb_content.querySelectorAll(".rb_block");
 if (rb_viewbox.offsetWidth >= THREE_BL_WIDTH) {
  blocks.forEach((e) => {
     let size = rb_viewbox.offsetWidth / 3 - paddingSize;
     e.style = `max-width: ${size}px; width: ${size}px; flex: 0 0 ${size}px`;
   });
 }
 if (rb_viewbox.offsetWidth >= ONE_BL_WIDTH && rb_viewbox.offsetWidth < THREE_BL_WIDTH) {
  blocks.forEach((e) => {
     let size = rb_viewbox.offsetWidth / 2 - paddingSize;
     e.style = `max-width: ${size}px; width: ${size}px; flex: 0 0 ${size}px`;
   });
 }
 if (rb_viewbox.offsetWidth < ONE_BL_WIDTH) {
  blocks.forEach((e) => {
     let size = rb_viewbox.offsetWidth - paddingSize;
     e.style = `max-width: ${size}px; width: ${size}px; flex: 0 0 ${size}px`;
   });
 }
 offsetLeft = 0;
 elemWidth = rb_block ? rb_block.offsetWidth : 360;
 rb_content.style.left = `${offsetLeft}px`;
 rb_viewbox.style.height = `${rb_content.offsetHeight + 30}px`;
}

window.addEventListener("onlaod", resizeRbBlock, {passive: true});
window.addEventListener("resize", resizeRbBlock, {passive: true});
resizeRbBlock();


//**** Navbar ****//

const mn_hd = document.getElementById('mn_header');
const mn_nav = mn_hd.querySelector('.hd-navbar');

const handleScroll = () => {
  let navHeight = mn_nav.offsetHeight;
  let wOffset = window.pageYOffset;
  let gap = 10;

  if(navHeight + gap < wOffset) {
    mn_hd.style.paddingTop = `${navHeight}px`;
    mn_hd.classList.add('mn_fixed');
  } 
  else if(gap > wOffset) {
    mn_hd.style.paddingTop = `0px`;
    mn_hd.classList.remove('mn_fixed');
  }
}

window.addEventListener("scroll", handleScroll, {passive: true});