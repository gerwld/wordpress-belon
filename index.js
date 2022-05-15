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
   }
  });
}, {passive: true});


// *** Rb slider *** //

const THREE_BL_WIDTH = 800;
const ONE_BL_WIDTH = 550;
const IS_AUTOSCROLL = false;
const AUTOSCROLL_TIMEOUT = 1000;

const rb_slider = document.getElementById('rb_slider');
const rb_viewbox = rb_slider.querySelector('.rb_viewbox');
const rb_content = rb_slider.querySelector('.rb_content');
const rb_block = rb_slider.querySelector('.rb_block');

const btn_back = rb_slider.querySelector('.btn_back');
const btn_fw = rb_slider.querySelector('.btn_fw');

let elemWidth;
let offsetLeft = 0;
let paddingSize = 15;

rb_slider.addEventListener("click", (e) => {
  if (e.target === btn_back) {
   offsetLeft += rb_block.offsetWidth + paddingSize;
  } else if (e.target === btn_fw) {
    offsetLeft -= rb_block.offsetWidth + paddingSize;
  }
  ajustRbSlider();
  rb_content.style.left = `${offsetLeft}px`;
});

const ajustRbSlider = () => {
 var slider_r = rb_viewbox.getBoundingClientRect();
 let cards_r = rb_content.getBoundingClientRect();
  if (offsetLeft > 0) {
    offsetLeft = rb_viewbox.offsetWidth - rb_content.offsetWidth;
  } else if (cards_r.right - 2 < slider_r.right && Math.abs(offsetLeft - elemWidth - slider_r.width) > cards_r.width) {
   offsetLeft = 0;
}}

if(IS_AUTOSCROLL) {
var autoScroll = setInterval(autoScrollTm, AUTOSCROLL_TIMEOUT);
function autoScrollTm() {
  offsetLeft -= elemWidth + paddingSize;
  ajustRbSlider();
  rb_content.style.left = `${offsetLeft}px`;
}
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
 rb_viewbox.style.height = `${rb_content.offsetHeight + 20}px`;
}

window.addEventListener("onlaod", resizeRbBlock);
window.addEventListener("resize", resizeRbBlock);
resizeRbBlock();