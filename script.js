var borrowItemsEl = document.getElementById("borrowItems");
var setDateEl = document.getElementById("setDate");
var menu2El = document.getElementById("menu2");
var borrowEl = document.getElementById("borrow");

var displayUserEl = document.getElementById("displayUser");
var logoutEl = document.getElementById("logout");
var hrefLinkEl = document.getElementById("hrefLink");

window.onload = setLogout;

function show(){
  borrowItemsEl.classList.toggle("show");
}

function setCurrentTime(){
  const date = new Date();
  var month = date.getMonth() + 1;
  var day = date.getDate();

  setDateEl.value = date.getFullYear() + "-" + month + "-" + day + " " + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
}

function setLogout(){
  displayUserEl.setAttribute('href', hrefLinkEl.innerHTML);
  displayUserEl.removeAttribute('hidden');
  displayUserEl.innerHTML = logoutEl.innerHTML;
}