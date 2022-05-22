const def_clickable = document.getElementById("def_clickable");
const mn_header = document.getElementById("mn_header");
const mn_nav = mn_header.querySelector('.hd-navbar');

// *** Global listeners *** //
function onClickEverywhere(ev) {
  mobileMenuToggle(ev);
  // onTermTitleBlClick(ev);
}

function onResizeWindow(ev) {
  resizeRbBlock(ev);
}

function onScrollWindow(ev) {
  handleScroll(ev);
  // IS_AUTOSCROLL && animOnlyWhenVisible();
}

window.addEventListener("click", onClickEverywhere, {passive: true});
window.addEventListener("resize", onResizeWindow, {passive: true});
window.addEventListener("scroll", onScrollWindow, {passive: true})

window.onload = () => {
  handleScroll();
  // resizeRbBlock();
};

// **** Toggle def_clickable **** //

function onTermTitleBlClick(val) {
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

function mobileMenuToggle(e) {
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


//**** Navbar fixed / static ****//

function handleScroll() {
  let navHeight = mn_nav.offsetHeight;
  let wOffset = window.pageYOffset;
  let gap = 10;
  if (window.innerWidth > 820) {
    if (navHeight + gap < wOffset) {
      mn_header.style.paddingTop = `${navHeight}px`;
      mn_header.classList.add("mn_fixed");
    } else if (gap > wOffset) {
      mn_header.style.paddingTop = `0px`;
      mn_header.classList.remove("mn_fixed");
    }
  }
}


//**** Header parallax ****/

(function () {
  let anim_bg = document.getElementById('anim_bg');
  if(anim_bg) {
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
    parallax(e, ills, 10, 30, 85);
  }
}
})();

//**** Show anim only when visible ****/

// function onVisibilityChange(el, callback, old_visible) {
//   return function () {
//     var visible = isAnyPartOfElementInViewport(el);
//     if (visible != old_visible) {
//       if (typeof callback == "function") {
//         callback(visible);
//       }
//     }
//   };
// }

// function isAnyPartOfElementInViewport(el) {
//   const rect = el.getBoundingClientRect();
//   const windowHeight = window.innerHeight || document.documentElement.clientHeight;
//   const windowWidth = window.innerWidth || document.documentElement.clientWidth;

//   const vertInView = rect.top <= windowHeight && rect.top + rect.height >= 0;
//   const horInView = rect.left <= windowWidth && rect.left + rect.width >= 0;

//   return vertInView && horInView;
// }

// function isElementInViewport (el) {
//   if (typeof jQuery === "function" && el instanceof jQuery) {
//       el = el[0];
//   }
//   var rect = el.getBoundingClientRect();
//   return (
//       rect.top >= 0 &&
//       rect.left >= 0 &&
//       rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && /* or $(window).height() */
//       rect.right <= (window.innerWidth || document.documentElement.clientWidth) /* or $(window).width() */
//   );
// }