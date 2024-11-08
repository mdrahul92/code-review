<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- font-family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Oswald:wght@200..700&display=swap" rel="stylesheet">

    <!-- fontawesome  -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- cutom css -->
     <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/style.css">
     <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/custom.css">
  </head>
  <body <?php body_class(); ?>>
<?php wp_body_open(); ?>
    <!-- header -->
    <nav class="navbar navbar-expand-md py-3">
        <div class="container">
          <a class="navbar-brand me-md-5" href="<?php if ( is_user_logged_in() ) { echo '/?s='; }else{ echo '/'; } ?>">
            <img class="brand-logo" src="<?php echo get_stylesheet_directory_uri() ?>/images/relish-black.png" alt="logo" />
          </a>
          <?php if(is_user_logged_in()){ ?>

              <a class="nav-link ms-auto nav-signup-btn mobile mb-cart" href="/cart">
                  <?php
                  $cart_count = WC()->cart->get_cart_contents_count();
                  $cart_total = WC()->cart->get_cart_subtotal();
                  ?>
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M11.0833 11.375C11.0833 11.8586 10.6913 12.25 10.2083 12.25C9.72529 12.25 9.33329 11.8586 9.33329 11.375C9.33329 10.8914 9.72529 10.5 10.2083 10.5C10.6913 10.5 11.0833 10.8914 11.0833 11.375ZM5.24996 11.375C5.24996 11.8586 4.85796 12.25 4.37496 12.25C3.89196 12.25 3.49996 11.8586 3.49996 11.375C3.49996 10.8914 3.89196 10.5 4.37496 10.5C4.85796 10.5 5.24996 10.8914 5.24996 11.375ZM9.55613 8.16667H5.11229L4.15738 4.66667H11.3061L9.55613 8.16667ZM12.2984 4.053C12.0843 3.7065 11.7133 3.5 11.3061 3.5H3.83946L3.47954 2.17992C3.41013 1.92617 3.17971 1.75 2.91663 1.75H1.74996C1.42738 1.75 1.16663 2.01133 1.16663 2.33333C1.16663 2.65533 1.42738 2.91667 1.74996 2.91667H2.47096L4.10371 8.90342C4.17313 9.15717 4.40354 9.33333 4.66663 9.33333H9.91663C10.1377 9.33333 10.3395 9.2085 10.4387 9.01075L12.3497 5.18817C12.5317 4.82358 12.5125 4.3995 12.2984 4.053Z" fill="white"/></svg><span class="mb-cart-count"><?php echo esc_html($cart_count); ?></span>
              </a>
          <?php }else{ ?>
            <a class="nav-link ms-auto nav-signup-btn mobile mb-cart" href="/sign-up" >Sign Up</a>
          <?php } ?>
       
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <a href="/" class="navbar-brand me-md-5" href="#">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/relish-black.png" width="100" alt="logo">
              </a>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <?php
              /*wp_nav_menu( array(
                 'theme_location' => 'menu-1',
                 'menu_class' => 'navbar-nav justify-content-end align-items-md-center flex-grow-1 gap-4',
                 'add_li_class' => 'nav-item',
                 'link_class' => 'active'
              ));*/
              ?>
                <?php 
                if(is_user_logged_in()){ 
                  wp_nav_menu( array(
                    'theme_location' => 'menu-3',
                    'menu_class' => 'navbar-nav justify-content-end align-items-md-center flex-grow-1  gap-4',
                    'add_li_class' => 'nav-item',
                    'link_class' => 'active'
                  ));
                }else{ ?>
                  <ul class="navbar-nav justify-content-end align-items-md-center flex-grow-1  gap-4">
                    <li class="nav-item">
                      <a class="nav-link" href="/login">Log In</a>
                    </li>
                    <li class="nav-item desktop">
                        <a class="nav-link nav-signup-btn" href="/sign-up">Sign Up</a>
                    </li>
                  </ul>
                <?php } ?>
              <!-- <form class="d-flex mt-3" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form> -->
            </div>
          </div>
        </div>
      </nav>
      <!-- header end -->
