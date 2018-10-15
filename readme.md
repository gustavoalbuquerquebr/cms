# CMS Project

Basic Content Management System for blogs written in vanilla PHP using procedural style. Works with MySQL and MariaDB through the mysqli extension. Styled with Bootstrap 4. Require PHP 7+.

### FEATURES

- Posts
- Pages
- Comments (one level deep)
- Category page
- Author page
- Contact page
- Admin area to manage posts, pages, comments, categories and users

---

### INSTALLATION

1. Create a database and a user with read and write privileges.
2. Copy files to your server.
3. Open "includes/init.php" and edit the constants DB_HOST, DB_USER, DB_PASS, DB_NAME, filling in your database info.
4. If you copied the files to the root of your webserver, leave PROJECT_PATH blank, otherwise specify the path.
5. Optionally, modify other configurations like PROJECT_NAME and PROJECT_EMAIL. Save and close "includes/init.php".
6. Open in a browser and insert the username and password that will be used to access the admin are of your site and click on the install button.

---

### TODO

- Add email column user
- Archive pages (posts by date)
- post/user/user/category pages to show name at url instead of id number
- Manage pages navigation and bulk delete
- Generate lorem ipsum posts/comments/users
- Enable javascript form validation
- Custom pages page
- Post draft and recycle bin
- Nested comments
- Approve comments
- Tags
- 404 page and redirect when page isn't solicited with rigth request
- Reset and unnistall
- Post images
- Contact send email
- HTML/text editor
- Advanced navigation ("prev 1 2 3 next" instead of "prev next")
- Search
- Stats
- Account levels (admin, user...);

---

### DOCS

- Basic structure of HTML pages:

```php
  <?php
    require_once $_SERVER["DOCUMENT_ROOT"] . $_SERVER["HTTP_MY_ROOT"] . "includes/init.php";
  ?>

  <?php includes_header("page title", "custom stylesheet"); ?>

    <main class="container mb-5">

    </main>

  <?php includes_footer(); ?>
```

```php
  <body>
    <header class="mb-5">
      <nav>
        <div class="container">
          ...
        </div>
      </nav>
    </header>
    <main class="container mb-5">
      ...
    </main>
    <footer>
      ...
    </footer>
  </body>
```

- Function naming convention: `action_what_where`, example: `delete_post_db`;
- Use mysqli_real_escape_string() before all database insertions and updates;
- Use htmlspecialchars() to render user input at HTML;
- Use urlencode() to make sure paremeters don't break urls;
