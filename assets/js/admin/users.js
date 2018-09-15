"use strict";

let tbody = document.querySelector("tbody");

tbody.addEventListener("click", function(e) {
  if (e.target.classList.contains("delete")) {
    let row = e.target.parentElement;
    let id = e.target.dataset.id;

    let data = new FormData();

    data.append("id", id);

    let xhr = new XMLHttpRequest();

    xhr.open("POST", self, true);

    xhr.onload = function() {
      if (this.responseText) {
        row.parentElement.removeChild(row);
      } else {
        console.log("cannot delete users that have published posts");
      }
    };

    xhr.send(data);
  }
});
