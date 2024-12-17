var borrowItemsEl = document.getElementById("borrowItems");
var setDateEl = document.getElementById("setDate");
var menu2El = document.getElementById("menu2");
var borrowEl = document.getElementById("borrow");

var displayUserEl = document.getElementById("displayUser");
var logoutEl = document.getElementById("logout");
var hrefLinkEl = document.getElementById("hrefLink");
var homeLinkEl = document.getElementById("homeLink");
var redirectHomeEl = document.getElementById("redirectHome");
var bgImgEl = document.getElementById("bgImg");
var bodyEl = document.getElementById("body");

window.onload = setLogout;

function show(className){
  var el = document.getElementById(className);

  el.classList.toggle("show");
}

function setCurrentDate(){
  const date = new Date();
  var month = date.getMonth() + 1;
  var day = date.getDate();

  setDateEl.value = date.getFullYear() + "-" + month + "-" + day + " " + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
}

function setLogout(){
  displayUserEl.setAttribute('href', hrefLinkEl.innerHTML);
  displayUserEl.removeAttribute('hidden');
  displayUserEl.innerHTML = logoutEl.innerHTML;
  bodyEl.style.backgroundImage = bgImgEl.innerHTML;

}

function setHome(){
  redirectHomeEl.setAttribute('href', homeLinkEl.innerHTML);
}