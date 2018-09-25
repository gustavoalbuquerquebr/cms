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
      if (this.responseText) {
        console.log(id);
        row.parentElement.removeChild(row);
        $("#deleteModal").modal("hide");
      } else {
        console.log("cannot delete users that have published posts");
      }
    };
    xhr.send(data);
  }
});
