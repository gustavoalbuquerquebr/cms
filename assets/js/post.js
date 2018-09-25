"use strict";

// UI variables
let form = document.querySelector("#form");
let submit = document.querySelector("#submit");
let comments = document.querySelector("#comments");

// submit comment button
submit.addEventListener("click", function(e) {
  e.preventDefault();

  let data = new FormData(form);

  data.append("current_post", current_post);

  let xhr = new XMLHttpRequest();

  xhr.open("POST", self, true);

  xhr.onload = function() {
    let newComment =
      "<div class='comment mb-4 border-left border-primary pl-2'><h6><strong>" +
      data.get("user") +
      "</strong> - just now </h6> <p>" +
      data.get("comment") +
      "</p></div>";

    comments.insertAdjacentHTML("afterbegin", newComment);
  };

  xhr.send(data);
});
