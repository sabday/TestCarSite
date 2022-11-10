<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Car">
    <meta name="keywords" content="car">
    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style.css">
</head>

<body>
<header class="header">
    <div class="container header__container">
        <?php
        //get link logo
        $custom_logo__url = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
        // output
        if ($custom_logo__url) { ?>
        <a class="logo header__logo" href="<?php  echo home_url(); ?>" aria-label="Car Logotype" title="Link to main page">
            <a href="<?php  echo home_url(); ?>"><img src="<?php echo $custom_logo__url[0]; ?>" alt="logo"/></a>
            <?php
            }
            ?>
            <nav class="nav header__main-nav">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a class="nav__link" href="#">
                            Home
                        </a>
                    </li>
                    <li class="nav__item">
                        <a class="nav__link" href="#">
                            Services
                        </a>
                    </li>
                    <li class="nav__item">
                        <a class="nav__link" href="#">
                            Blog
                        </a>
                    </li>
                    <li class="nav__item">
                        <a class="nav__link" href="#">
                            Contact
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="user-nav header__user-nav">
                <?php echo get_theme_mod( 'header_phone' ); ?>
            </div>
    </div>
</header>
<div class="mobile-menu">
    <div class="mobile-menu__wrapper">
        <nav class="nav mobile-menu__main-nav">
            <ul class="nav__list">
                <li class="nav__item">
                    <a class="nav__link" href="#">
                        Home
                    </a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="#">
                        Services
                    </a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="#">
                        Blog
                    </a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="#">
                        Contact
                    </a>
                </li>
            </ul>
        </nav>
        <nav class="user-nav mobile-menu__user-nav">
            <div><?php echo get_theme_mod( 'header_phone' ); ?></div>
        </nav>
    </div>
</div>

