<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="site-header">
    <div class="container">
        <div class="header-inner">
            <!-- <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="site-logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <h1 class="site-title"><?php bloginfo('name'); ?></h1>
                <?php endif; ?>
            </a> -->
            <nav class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="menu-icon">&#9776;</span>
                </button>
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_class' => 'nav-menu',
                    'container_class' => 'menu-container',
                ]);
                ?>
            </nav>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.querySelector('.menu-toggle');
        const menu = document.querySelector('.nav-menu');

        menuToggle.addEventListener('click', function() {
            const expanded = menuToggle.getAttribute('aria-expanded') === 'true' || false;
            menuToggle.setAttribute('aria-expanded', !expanded);
            menu.classList.toggle('active', !expanded);
        });
    });
</script>
