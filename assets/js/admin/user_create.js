"use strict";

let pwToggler = document.querySelector("#pw-toggler");
let pwInput = document.querySelector("#password-input");

pwToggler.addEventListener("click", function() {
  if (pwToggler.getAttribute("src") === eye) {
    pwToggler.setAttribute("src", eyeSlash);
  } else {
    pwToggler.setAttribute("src", eye);
  }

  if (pwInput.getAttribute("type") === "password") {
    pwInput.setAttribute("type", "text");
  } else {
    pwInput.setAttribute("type", "password");
  }
});
