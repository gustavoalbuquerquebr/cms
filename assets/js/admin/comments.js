"use strict";

let tbody = document.querySelector("tbody");
let modal = document.querySelector("#deleteModal");

let row;
let id;

tbody.addEventListener("click", function(e) {
  if (e.target.classList.contains("delete")) {
    $("#deleteModal").modal("show");
    row = e.target.parentElement.parentElement;
    id = e.target.parentElement.dataset.id;
  }
});

modal.addEventListener("click", function(e) {
  if (e.target.classList.contains("confirmDelete")) {
    let data = new FormData();
    data.append("action", "delete");
    data.append("id", id);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", self, true);
    xhr.onload = function() {
      $("#deleteModal").modal("hide");

      row.style.transition = "all 1s";
      row.style.opacity = 0;

      setTimeout(function() {
        row.parentElement.removeChild(row);
      }, 1000);
    };
    xhr.send(data);
  }
});
