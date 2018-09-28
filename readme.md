# CMS Project

### TODO

- Handle db errors
- Manage categories page
- Don't accept duplicate categorie names
- Category page
- Pages page
- Add email column user
- Archive pages (posts by date)
- Manage pages navigation and bulk delete
- Generate lorem ipsum posts/comments/users
- Enable javascript form validation
- Post draft
- Approve comments
- 404 page and redirect when page isn't solicited with rigth request
- Font Awesome
- Installation process
- Post images
- Contact send email
- HTML/text editor
- Advanced navigation ("prev 1 2 3 next" instead of "prev next")
- Search
- Stats

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
- Use h() to render user input at HTML;
- Use urlencode() to make sure paremeters don't break urls;
