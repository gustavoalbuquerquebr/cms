"use strict";

// UI variables
let form = document.querySelector("#contact");
let nameInput = document.querySelector("#name");
let emailInput = document.querySelector("#email");
let messageInput = document.querySelector("#message");
let submit = document.querySelector("#submit");
let messageOutput = document.querySelector("#messageOutput");

// form submit on this very page
submit.addEventListener("click", function(e) {
  // display spinner.gif
  messageOutput.innerHTML =
    "<img src=\"" + loading + "\"width='50' height='50'>";

  e.preventDefault();

  let data = new FormData(form);

  let xhr = new XMLHttpRequest();

  xhr.open("POST", self, true);

  xhr.onload = function() {
    // output message
    let message;
    switch (this.responseText) {
    case "invalid_email":
      message = "Invalid email!";
      break;
    case "request_error":
      message = "Something went wrong!";
      break;
    case "success":
      message = "Message sent!";
      break;
    }

    // replace spinner.gif with output message
    messageOutput.innerHTML = "<p>" + message + "</p>";

    // if successful, form inputs will be cleared
    if (this.responseText === "success") {
      nameInput.value = "";
      emailInput.value = "";
      messageInput.value = "";
    }
  };

  xhr.send(data);
});
