"use strict";

// UI variables
let form = document.querySelector("#form");
let submit = document.querySelector("#submit");
let commentsOutput = document.querySelector("#comments .output");
let noComments = document.querySelector("#noComments");

// submit comment button
submit.addEventListener("click", function(e) {
  e.preventDefault();

  let data = new FormData(form);

  data.append("current_post", current_post);

  let xhr = new XMLHttpRequest();

  xhr.open("POST", self, true);

  xhr.onload = function() {
    if (commentsOutput.contains(noComments)) {
      commentsOutput.innerHTML = "";
    }

    let newComment =
      "<h6>" +
      data.get("user") +
      " - now </h6> <p>" +
      data.get("comment") +
      "</p>";

    commentsOutput.insertAdjacentHTML("afterbegin", newComment);
  };

  xhr.send(data);
});
