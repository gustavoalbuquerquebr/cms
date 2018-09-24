"use strict";

let tbody = document.querySelector("tbody");

tbody.addEventListener("click", function(e) {
  if (e.target.classList.contains("delete")) {
    let row = e.target.parentElement.parentElement;
    let id = e.target.parentElement.dataset.id;

    let data = new FormData();

    data.append("id", id);

    let xhr = new XMLHttpRequest();

    xhr.open("POST", self, true);

    xhr.onload = function() {
      row.parentElement.removeChild(row);
    };

    xhr.send(data);
  }
});
