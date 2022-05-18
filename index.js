const def_clickable = document.getElementById("def_clickable");
const mn_header = document.getElementById("mn_header");

// *** Global event listeners *** //

function onClickEverywhere(ev) {
  mobileMenuToggle(ev);
  onTermTitleBlClick(ev);
}

window.addEventListener("click", onClickEverywhere, {passive: true});

// **** Toggle def_clickable **** //

const onTermTitleBlClick = (val) => {
  let def_dt = def_clickable.querySelectorAll("dt");
  def_dt.forEach((e) => {
    if(val.target.classList.contains('def_tt')) {
     if (e === val.target) {
       e.classList.add("opened", "opened_line");
     } else {
       e.classList.remove("opened", "opened_line");
     }
    }});
}

// *** Mobile menu *** //

const mobileMenuToggle = (e) => {
  let btn_mob = mn_header.querySelector(".btn_mobmenu");
  let mobNav = mn_header.querySelector(".main-mob-nav");
  let navBar = mn_header.querySelector(".hd-navbar");
  let mobLinks = mobNav.querySelectorAll("a");

  if (e.target === btn_mob) {
    if (mn_header.classList.contains("mob_mn_opened")) {
      closeMobMenu();
    } else {
      mn_header.classList.remove("mob_mn_closed");
      document.body.classList.add("no-scroll");
      mn_header.classList.add("mob_mn_opened");
    }
  } else if (!mobNav.contains(e.target) && !navBar.contains(e.target)) {
    closeMobMenu();
  }
  //Close when click on link
  mobLinks.forEach((mobL) => {
    if (e.target === mobL) {
      closeMobMenu();
    }
  });
  function closeMobMenu() {
    document.body.classList.remove("no-scroll");
    mn_header.classList.remove("mob_mn_opened");
    mn_header.classList.add("mob_mn_closed");
  }
}


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

if(rb_block) {
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
  elemWidth = rb_block.offsetWidth;
  rb_content.style.left = `${offsetLeft}px`;
  console.log(rb_content.offsetHeight, rb_content, rb_block.offsetHeight);
  rb_viewbox.style.height = `${Math.floor(rb_content.offsetHeight) + 30}px`;
  }

  window.addEventListener("onlaod", resizeRbBlock, {passive: true});
  window.addEventListener("resize", resizeRbBlock, {passive: true});
  resizeRbBlock();
}


//**** Navbar fixed / static ****//

const mn_nav = mn_header.querySelector('.hd-navbar');

const handleScroll = () => {
  let navHeight = mn_nav.offsetHeight;
  let wOffset = window.pageYOffset;
  let gap = 10;

  if(navHeight + gap < wOffset) {
    mn_header.style.paddingTop = `${navHeight}px`;
    mn_header.classList.add('mn_fixed');
  } 
  else if(gap > wOffset) {
    mn_header.style.paddingTop = `0px`;
    mn_header.classList.remove('mn_fixed');
  }
}

window.addEventListener("scroll", handleScroll, {passive: true});

//**** Header parallax ****/

(function () {
  mn_header.addEventListener("mousemove", parallaxGrab);

  function parallax(e, elem, delay = 10, _posY = 100, _posX = 100) {
    let _w = window.innerWidth / 2;
    let _h = window.innerHeight / 2;
    let _mouseX = e.clientX;
    let _mouseY = e.clientY;
    let _depth1 = `${_posY - ((_mouseX - _w) * 0.01) / delay}% ${_posX - ((_mouseY - _h) * 0.01) / delay}%`;
    let _depth2 = `${_posY - ((_mouseX - _w) * 0.02) / delay}% ${_posX - ((_mouseY - _h) * 0.02) / delay}%`;
    let _depth3 = `${_posY - ((_mouseX - _w) * 0.06) / delay}% ${_posX - ((_mouseY - _h) * 0.06) / delay}%`;
    let x = `${_depth3}, ${_depth2}, ${_depth1}`;

    elem.style.backgroundPosition = x;
  }

  function parallaxGrab(e) {
    let b_1 = mn_header.querySelector(".block_1");
    let b_2 = mn_header.querySelector(".block_2");
    let b_3 = mn_header.querySelector(".block_3");
    let b_4 = mn_header.querySelector(".block_4");
    let ills = document.getElementById('hd_img');

    parallax(e, b_1, 50, 82, 30);
    parallax(e, b_2, 20, 98, 20);
    parallax(e, b_3, 50, 20, 105);
    parallax(e, b_4, 105, 105, 108);
    parallax(e, ills, 10, 90, 85);
  }
})();