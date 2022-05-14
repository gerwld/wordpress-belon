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
