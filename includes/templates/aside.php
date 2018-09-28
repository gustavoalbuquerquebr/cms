<?php

// HTML output
$about_image = "https://picsum.photos/100/100/?random";
$contact_page_link = make_url("contact.php", true);

?>

<aside class="col-md-4">

  <section class="ml-auto border p-3">  
    <figure>
      <img class="rounded-circle d-block mx-auto" src="<?= $about_image; ?>" width=100 height=100>
    </figure>
      <h3 class="card-title font-weight-bold">About</h3>
      <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, laudantium quae provident voluptas aliquam consequuntur distinctio quibusdam.</p>
      <a href="<?= $contact_page_link ?>">Contact &raquo;</a>
  </section>

</aside>
