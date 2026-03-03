<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>

    <header class="site-header">
        <div class="left-header">
        <div class="site-branding">
        <?php
$custom_logo_id = get_theme_mod( 'custom_logo' );
$logo_image     = $custom_logo_id ? wp_get_attachment_image_src( $custom_logo_id , 'full' ) : false;

if ( $logo_image ) : ?>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
    <img class="logo" src="<?php echo esc_url( $logo_image[0] ); ?>"
        alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
</a>
<?php else : ?>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <?php bloginfo( 'name' ); ?>
    </a>
<?php endif; ?>
        </div>
<div id="menu-wrapper" class="menuwrap">
        <?php
        wp_nav_menu( [
            'theme_location' => 'primary',
            'container'      => 'nav',
            'container_class'=> 'site-nav',
            'menu_class'     => 'menu',
            'fallback_cb'    => false,
        ] );
        ?>
        </div>
</div>
<div class="menu-button">
<a href="#"> 
<button>
Inloggen
</button>
</a>

<div id="hamburger" class="hamburger">

<span class="menu-text">Menu</span>

<svg id="toggle-btn" class="toggle" width="28px" height="28px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
    <path d="M1920 1468.412v112.94H0v-112.94h1920Zm0-564.706v112.941H0V903.706h1920ZM1920 339v112.941H0V339h1920Z" fill-rule="evenodd"/>
</svg>

<svg id="cross" class="cross" width="28px" height="28px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M19 5L4.99998 19M5.00001 5L19 19" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>


</div>
        </div>
    </header>

    <!-- <div id="page-loader">
        <div class="loader-inner">
            <div class="loader-bar">


            <img src="http://localhost:8000/wp-content/uploads/2026/02/logo.svg">
            </div>
        </div>
    </div>  -->
