"use strict";

// UI variables
let form = document.querySelector("#contact");
let nameInput = document.querySelector("#name");
let emailInput = document.querySelector("#email");
let messageInput = document.querySelector("#message");
let submit = document.querySelector("#submit");
let messageOutput = document.querySelector("#messageOutput");
let messageOutputSpinner = document.querySelector("#messageOutput img");
let messageOutputAlert = document.querySelector(".alert");
let messageOutputAlertClose = document.querySelector(".alert button");
let messageOutputAlertText = document.querySelector(".alert span");

// form submit on this very page
submit.addEventListener("click", function(e) {
  // display spinner.gif
  // make sure that the alert is hidden while spinner is showing
  messageOutputAlert.classList.add("d-none");
  // d-block is needed to centered the image with mx-auto
  messageOutputSpinner.classList.replace("d-none", "d-block");
  // remove is-invalid class of email input
  emailInput.classList.remove("is-invalid");

  e.preventDefault();

  let data = new FormData(form);

  let xhr = new XMLHttpRequest();

  xhr.open("POST", self, true);

  xhr.onload = function() {
    let message;
    let error;

    switch (this.responseText) {
    case "invalid_email":
      error = 1;
      message = "Invalid email! Try again.";
      break;
    case "request_error":
      error = 2;
      message = "Something went wrong! Send a email to " + emailContact + ".";
      break;
    case "success":
      error = 0;
      message = "Message sent!";
      break;
    }

    // replace spinner.gif with output message
    emailInput.classList.add(error === 1 && "is-invalid");
    messageOutputAlertText.textContent = message;
    messageOutputAlert.classList.remove("alert-danger", "alert-success");
    messageOutputAlert.classList.add(error ? "alert-danger" : "alert-success");
    messageOutputSpinner.classList.replace("d-block", "d-none");
    messageOutputAlert.classList.remove("d-none");

    // if successful, form inputs will be cleared
    if (this.responseText === "success") {
      nameInput.value = "";
      emailInput.value = "";
      messageInput.value = "";
    }
  };

  xhr.send(data);
});
