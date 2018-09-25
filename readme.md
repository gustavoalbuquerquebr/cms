# CMS Project

### TODO

- Posts per page at index constant
- Create post/user/comment
- Preview button on create post page
- Edit comment/user
- Author page
- Category page
- Create/edit/delete aside sections
- Add email column user
- display name of logged user
- DB errors alerts
- Archive pages (posts by date)
- Manage pages navigation and bulk delete
- Pages page
- Generate lorem ipsum posts/comments/users
- Don't accept duplicate usernames and categorie names
- Enable javascript form validation
- Animate row on delete
- Installation process
- Post images
- Contact send email
- HTML/text editor
- Advanced navigation ("prev 1 2 3 next" instead of "prev next")

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
