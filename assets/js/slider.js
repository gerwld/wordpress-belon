// **** Rb slider **** //

(function() {
const THREE_BL_WIDTH = 800;
const ONE_BL_WIDTH = 550;
const IS_AUTOSCROLL = false;
const AUTOSCROLL_TIMEOUT = 2000;
const ACTION_INTERVAL = 200;

const rb_slider = document.getElementById('rb_slider');
const rb_viewbox = rb_slider.querySelector('.rb_viewbox');
const rb_content = rb_slider.querySelector('.rb_content');
const rb_block = rb_slider.querySelector('.rb_block');

let elemWidth;
let isActionDelay;
let offsetLeft = 0;
let paddingSize = 15;

if(rb_block) {
  rb_slider.addEventListener("click", (e) => {
  let btn_back = rb_slider.querySelector('.btn_back');
  let btn_fw = rb_slider.querySelector('.btn_fw');

  if(isActionDelay !== true) {
    if (e.target === btn_back) {
    offsetLeft += rb_block.offsetWidth + paddingSize;
    } else if (e.target === btn_fw) {
      offsetLeft -= rb_block.offsetWidth + paddingSize;
    }
    if(e.target === btn_back || e.target === btn_fw) {
      isActionDelay = true;
      setTimeout(() => isActionDelay = false, ACTION_INTERVAL);
    }
  } ajustRbSlider();
  });

  function ajustRbSlider() {
    let viewboxWidth = rb_viewbox.offsetWidth;
    let contentWidth = rb_content.offsetWidth;
    if (contentWidth < viewboxWidth) {
      offsetLeft = 0;
    } else if (offsetLeft > paddingSize) {
      offsetLeft = viewboxWidth - contentWidth;
    } else if (Math.abs(contentWidth - viewboxWidth) < Math.abs(offsetLeft + elemWidth)) {
      offsetLeft = 0;
    }
    rb_content.style.left = `${offsetLeft}px`;
  };

  /* Autoscroll */
  if (IS_AUTOSCROLL) {
    let slider_old_visible;
    var autoScroll;

    //scroll event arg func
    function animOnlyWhenVisible() {
      let scroll_block = document.querySelector(".reviews_block");
      onVisibilityChange(scroll_block, toggleScroll, slider_old_visible)();
    }

    //toggle interval
    function toggleScroll(isScroll) {
      if (slider_old_visible != isScroll) {
        slider_old_visible = isScroll;
        if (isScroll) {
          autoScroll = setInterval(autoScrollTm, AUTOSCROLL_TIMEOUT);
        } else clearInterval(autoScroll);
      }
    }

    //interval arg func
    function autoScrollTm() {
      offsetLeft -= elemWidth + paddingSize;
      ajustRbSlider();
      rb_content.style.left = `${offsetLeft}px`;
    }

    rb_slider.addEventListener("mouseover", () => toggleScroll(false), {passive: true});
    rb_slider.addEventListener("mouseleave", () => toggleScroll(true), {passive: true});
    rb_slider.addEventListener("touchstart", () => toggleScroll(false), {passive: true});
    rb_slider.addEventListener("touchend", () => toggleScroll(true), {passive: true});

    //show scroll anim only when block is visible
    window.addEventListener("scroll", animOnlyWhenVisible, {passive: true})
  }

  /* Blocks resizing when parent wd changes */
  function resizeRbBlock() {
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
  elemWidth = rb_block.offsetWidth;
  rb_content.style.left = `${offsetLeft}px`;
  rb_viewbox.style.height = `${Math.floor(rb_content.offsetHeight) + 30}px`;
  }
}

window.addEventListener("resize", resizeRbBlock, {passive: true});
resizeRbBlock();
}());