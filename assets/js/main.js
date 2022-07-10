const def_clickable = document.getElementById("def_clickable");

// *** Global listeners *** //
function onClickEverywhere(ev) {
  mobileMenuToggle(ev);
}

function onScrollWindow(ev) {
  handleScroll(ev);
}


window.addEventListener("click", onClickEverywhere, {passive: true});
window.addEventListener("scroll", onScrollWindow, {passive: true})

window.onload = () => {
  handleScroll();
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





//**** Show anim only when visible ****/
function onVisibilityChange(el, callback, old_visible) {
  return function () {
    var visible = isAnyPartOfElementInViewport(el);
    if (visible != old_visible) {
      if (typeof callback == "function") {
        callback(visible);
      }
    }
  };
}

function isAnyPartOfElementInViewport(el) {
  const rect = el.getBoundingClientRect();
  const windowHeight = window.innerHeight || document.documentElement.clientHeight;
  const windowWidth = window.innerWidth || document.documentElement.clientWidth;

  const vertInView = rect.top <= windowHeight && rect.top + rect.height >= 0;
  const horInView = rect.left <= windowWidth && rect.left + rect.width >= 0;

  return vertInView && horInView;
}

function isElementInViewport (el) {
  if (typeof jQuery === "function" && el instanceof jQuery) {
      el = el[0];
  }
  var rect = el.getBoundingClientRect();
  return (
      rect.top >= 0 &&
      rect.left >= 0 &&
      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && /* or $(window).height() */
      rect.right <= (window.innerWidth || document.documentElement.clientWidth) /* or $(window).width() */
  );
}