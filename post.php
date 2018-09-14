<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/functions/init.php";

if(!empty($_POST)) {
  $post = $_POST["current_post"];
  $user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_SPECIAL_CHARS);
  $comment = filter_input(INPUT_POST, "comment", FILTER_SANITIZE_SPECIAL_CHARS);

  // open database connection
  $db_connection = new_db_connection();

  // insert comment into the database
  $query = "INSERT INTO comments (post, user, comment) VALUES (\"$post\", \"$user\", \"$comment\")";
  $result = mysqli_query($db_connection, $query);

  mysqli_close($db_connection);

  echo "success";

  exit();
}

// head variables
// page_title is defined below, after fetch post
$stylesheet = "front";

// fetch post
$current_post = $_GET["id"];
// open database connection
$db_connection = new_db_connection();
// get post
$query = "SELECT * FROM posts WHERE id = \"$current_post\"";
$result = mysqli_query($db_connection, $query);
$post = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];
mysqli_free_result($result);

$page_title = $post["title"];

// fetch comments
// fetch all comments of the current posts
$query = "SELECT * FROM comments WHERE post = \"$current_post\" ORDER BY `date` DESC";
$result = mysqli_query($db_connection, $query);
$comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

// close db
mysqli_close($db_connection);

?>

<?php require make_url("includes/templates/header.php"); ?>

  <main>
    <h1><?php echo $post["title"] ?></h1>
    <h6><?php echo $post["date"] ?></h6>
    <p><?php echo $post["post"] ?></p>
  </main>

  <form id="form" method="post">
    <input type="text" name="user" id="user">
    <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
    <input type="submit" id="submit">
  </form>

  <section id="comments">
    <h2>Comments</h2>
    <div class="output">
      <?php if(!empty($comments)): ?>
        <?php foreach($comments as $comment): ?>
          <h6><?php echo $comment["user"] . " - " . $comment["date"] ?></h6>
          <p><?php echo $comment["comment"] ?></p>
        <?php endforeach; ?>
      <?php else: ?>
        <p id="noComments"><?php echo "no comments" ?></p>
      <?php endif; ?>
    </div>
  </section>

  <script>

  let current_post = <?php echo $current_post; ?>;

  // UI variables
  let form = document.querySelector("#form");
  let userInput = document.querySelector("#user");
  let commentInput = document.querySelector("#comment");
  let submit = document.querySelector("#submit");
  let commentsOutput = document.querySelector("#comments .output");
  let noComments = document.querySelector("#noComments");


  submit.addEventListener("click", function(e) {
    e.preventDefault();
    
    let data = new FormData(form);
    
    data.append("current_post", current_post);
    
    let xhr = new XMLHttpRequest();
    
    xhr.open("POST", "<?php echo $_SERVER["PHP_SELF"]?>", true);
    
    xhr.onload = function() {

      if(commentsOutput.contains(noComments)) {
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

  </script>

<?php require make_url("includes/templates/footer.php"); ?>