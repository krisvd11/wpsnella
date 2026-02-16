<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>

    <header class="site-header">
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

        <?php
        wp_nav_menu( [
            'theme_location' => 'primary',
            'container'      => 'nav',
            'container_class'=> 'site-nav',
            'menu_class'     => 'menu',
            'fallback_cb'    => false,
        ] );
        ?>
    </header>
<!--
    <div id="page-loader">
        <div class="loader-inner">
            <div class="loader-bar"></div>
        </div>
    </div> 
-->



