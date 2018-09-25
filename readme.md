# CMS Project

### TODO

- Edit comment/user
- Author page
- Manage categories page
- Don't accept duplicate categorie names
- Category page
- Pages page
- Add email column user
- DB errors alerts
- Archive pages (posts by date)
- Manage pages navigation and bulk delete
- Generate lorem ipsum posts/comments/users
- Enable javascript form validation
- Installation process
- Post images
- Contact send email
- HTML/text editor
- Advanced navigation ("prev 1 2 3 next" instead of "prev next")
- Search

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
