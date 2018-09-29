"use strict";

let tbody = document.querySelector("tbody");
let modal = document.querySelector("#deleteModal");
let alertSection = document.querySelector("#alerts");

function generateAlert(status) {
  let message;
  let style;

  if (status) {
    message = `<strong>Success:</strong> Category <span class="font-italic"> ${category_name} </span> was deleted.`;
    style = "alert-success";
  } else {
    message = `<strong>Error:</strong> Category <span class="font-italic"> ${category_name} </span> wasn't deleted. Try again!`;
    style = "alert-danger";
  }

  let alert = document.createElement("DIV");
  alert.classList.add("alert", "alert-dismissible", "fade", "show", style);
  alert.setAttribute("role", "alert");
  let alertMessage = document.createElement("SPAN");
  alertMessage.innerHTML = message;
  alert.insertAdjacentElement("beforeend", alertMessage);
  let close = document.createElement("button");
  close.setAttribute("type", "button");
  close.setAttribute("data-dismiss", "alert");
  close.classList.add("close");
  close.innerHTML = "&times;";
  alert.insertAdjacentElement("beforeend", close);

  return alert;
}

// Variables below are updated every single time that a "delete" link is clicked
let row;
let category_id;
let category_name;

tbody.addEventListener("click", function(e) {
  if (e.target.classList.contains("delete-link")) {
    $("#deleteModal").modal("show");
    row = e.target.parentElement.parentElement;
    category_id = e.target.parentElement.dataset.id;
    category_name = row.querySelectorAll("td")[1].textContent;
  }
});

modal.addEventListener("click", function(e) {
  if (e.target.classList.contains("confirmDelete")) {
    let data = new FormData();
    data.append("action", "delete");
    data.append("id", category_id);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", self, true);
    xhr.onload = function() {
      $("#deleteModal").modal("hide");

      // if delete successful, row fade
      if (this.responseText) {
        row.style.transition = "all 1s";
        row.style.opacity = 0;

        setTimeout(function() {
          row.parentElement.removeChild(row);
        }, 1000);
      }

      // generate alert
      let alert = generateAlert(this.responseText);
      // insert alert
      alert = alertSection.insertAdjacentElement("beforeend", alert);
      // if the close button in the alert is clicked, close alert
      let alertCloseButton = alert.querySelector(".close");

      // otherwise, alert is closed automaticaly 5 seconds later
      let automaticClose = setTimeout(() => {
        alert.parentElement.removeChild(alert);
      }, 10000);

      alertCloseButton.addEventListener("click", function() {
        clearTimeout(automaticClose);
      });
    };
    xhr.send(data);
  }
});
