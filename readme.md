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
- Allow custom database name and project name on installation
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
    require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
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
