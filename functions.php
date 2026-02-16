<?php



function theme_enqueue_gsap_loader() {

    wp_deregister_script('gsap');

    wp_enqueue_script(
        'custom-gsap',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
        array(),
        '3.12.5',
        true
    );

    wp_enqueue_script(
        'gsap-scrolltrigger',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
        array('custom-gsap'),
        '3.12.5',
        true
    );

    wp_enqueue_script(
        'lenis',
        'https://unpkg.com/@studio-freight/lenis@1.1.14/dist/lenis.min.js',
        array(),
        '1.1.14',
        true
    );

    wp_enqueue_script(
        'theme-loader',
        get_template_directory_uri() . '/js/loader.js',
        array('custom-gsap', 'gsap-scrolltrigger', 'lenis'),
        '1.0',
        true
    );

    wp_enqueue_style(
        'theme-loader-style',
        get_template_directory_uri() . '/css/loader.css',
        array(),
        '1.0'
    );
}
add_action('wp_enqueue_scripts', 'theme_enqueue_gsap_loader', 999);



function my_starter_theme_assets() {
    wp_enqueue_style(
        'my-style',
        get_stylesheet_uri(),
        [],
        '1.0'
    );
}
add_action('wp_enqueue_scripts', 'my_starter_theme_assets');


function my_starter_theme_setup() {
    add_theme_support( 'post-thumbnails', [ 'post', 'page', 'personeel' ] );

    add_theme_support( 'align-wide' );

    add_theme_support( 'editor-styles' );

    add_editor_style( [ 'style.css', 'css/editor.css' ] );

    add_theme_support( 'custom-logo', [
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ] );

    register_nav_menus( [
        'primary' => __( 'Primary Menu', 'test' ),
    ] );
}
add_action( 'after_setup_theme', 'my_starter_theme_setup' );



add_action('acf/init', 'register_acf_blocks');
function register_acf_blocks() {

    if ( function_exists('acf_register_block_type') ) {

        acf_register_block_type([
            'name'            => 'hero',
            'title'           => __('Hero Block'),
            'description'     => __('A custom hero section'),
            'render_template' => 'template-parts/blocks/hero.php',
            'category'        => 'layout',
            'icon'            => 'cover-image',
            'keywords'        => ['hero', 'banner'],
            'supports'        => [
                'align' => true,
            ],
        ]);
        acf_register_block_type([
            'name'            => 'cta',
            'title'           => __('CTA Block'),
            'description'     => __('A custom CTA section'),
            'render_template' => 'template-parts/blocks/cta.php',
            'category'        => 'layout',
            'icon'            => 'button',
            'keywords'        => ['cta', 'button'],
            'supports'        => [
                'align' => true,
            ],
        ]);
        acf_register_block_type([
            'name'            => 'personeel',
            'title'           => __('Personeel Block'),
            'description'     => __('Overzicht van personeelsleden', 'test'),
            'render_template' => 'template-parts/blocks/personeel.php',
            'category'        => 'layout',
            'icon'            => 'groups',
            'keywords'        => ['personeel', 'team', 'medewerkers'],
            'supports'        => [
                'align' => true,
            ],
        ]);
        acf_register_block_type([
            'name'            => 'animatie',
            'title'           => __('Animatie Block'),
            'description'     => __('Animatie', 'test'),
            'render_template' => 'template-parts/blocks/intro.php',
            'category'        => 'layout',
            'icon'            => 'groups',
            'keywords'        => ['personeel', 'team', 'medewerkers'],
            'supports'        => [
                'align' => true,
            ],
        ]);
        acf_register_block_type([
            'name'            => 'vacature',
            'title'           => __('Vacature Block'),
            'description'     => __('Vacature', 'test'),
            'render_template' => 'template-parts/blocks/vacature.php',
            'category'        => 'layout',
            'icon'            => 'groups',
            'keywords'        => ['personeel', 'team', 'medewerkers'],
            'supports'        => [
                'align' => true,
            ],
        ]);

        acf_register_block_type([
            'name'            => 'benefits',
            'title'           => __('Benefit Block'),
            'description'     => __('Benefit', 'test'),
            'render_template' => 'template-parts/blocks/benefits.php',
            'category'        => 'layout',
            'icon'            => 'groups',
            'keywords'        => ['personeel', 'team', 'medewerkers'],
            'supports'        => [
                'align' => true,
            ],
        ]);

        acf_register_block_type([
            'name'            => 'herov2',
            'title'           => __('Hero v2 Block'),
            'description'     => __('herov2', 'test'),
            'render_template' => 'template-parts/blocks/herov2.php',
            'category'        => 'layout',
            'icon'            => 'groups',
            'keywords'        => ['personeel', 'team', 'medewerkers'],
            'supports'        => [
                'align' => true,
            ],
        ]);
    }
}


function register_personeel_cpt() {
    $labels = [
        'name'                  => __( 'Personeel', 'test' ),
        'singular_name'         => __( 'Personeelslid', 'test' ),
        'menu_name'             => __( 'Personeel', 'test' ),
        'name_admin_bar'        => __( 'Personeelslid', 'test' ),
        'add_new'               => __( 'Nieuw toevoegen', 'test' ),
        'add_new_item'          => __( 'Nieuw personeelslid toevoegen', 'test' ),
        'edit_item'             => __( 'Personeelslid bewerken', 'test' ),
        'new_item'              => __( 'Nieuw personeelslid', 'test' ),
        'view_item'             => __( 'Bekijk personeelslid', 'test' ),
        'search_items'          => __( 'Zoek personeel', 'test' ),
        'not_found'             => __( 'Geen personeel gevonden', 'test' ),
        'not_found_in_trash'    => __( 'Geen personeel gevonden in prullenbak', 'test' ),
        'all_items'             => __( 'Alle personeel', 'test' ),
        'archives'              => __( 'Personeel archief', 'test' ),
        'insert_into_item'      => __( 'Invoegen in personeelslid', 'test' ),
        'uploaded_to_this_item' => __( 'Geüpload naar dit personeelslid', 'test' ),
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => [ 'slug' => 'personeel' ],
        'show_in_rest'       => true, // Gutenberg / API
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
        'hierarchical'       => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_admin_bar'  => true,
        'show_in_nav_menus'  => true,
        'publicly_queryable' => true,
        'exclude_from_search'=> false,
        'capability_type'    => 'post',
    ];

    register_post_type( 'personeel', $args );
}
add_action( 'init', 'register_personeel_cpt' );




function register_vacature_cpt() {
    $labels = [
        'name'                  => __( 'Vacature', 'test' ),
        'singular_name'         => __( 'Vacature', 'test' ),
        'menu_name'             => __( 'Vacature', 'test' ),
        'name_admin_bar'        => __( 'Vacature', 'test' ),
        'add_new'               => __( 'Nieuw toevoegen', 'test' ),
        'add_new_item'          => __( 'Nieuw Vacature toevoegen', 'test' ),
        'edit_item'             => __( 'Vacature bewerken', 'test' ),
        'new_item'              => __( 'Nieuw Vacature', 'test' ),
        'view_item'             => __( 'Bekijk Vacature', 'test' ),
        'search_items'          => __( 'Zoek Vacature', 'test' ),
        'not_found'             => __( 'Geen Vacature gevonden', 'test' ),
        'not_found_in_trash'    => __( 'Geen Vacature gevonden in prullenbak', 'test' ),
        'all_items'             => __( 'Alle Vacature', 'test' ),
        'archives'              => __( 'Vacature archief', 'test' ),
        'insert_into_item'      => __( 'Invoegen in Vacature', 'test' ),
        'uploaded_to_this_item' => __( 'Geüpload naar dit Vacature', 'test' ),
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => [ 'slug' => 'vacature' ],
        'show_in_rest'       => true, 
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
        'hierarchical'       => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_admin_bar'  => true,
        'show_in_nav_menus'  => true,
        'publicly_queryable' => true,
        'exclude_from_search'=> false,
        'capability_type'    => 'post',
    ];

    register_post_type( 'vacature', $args );
}
add_action( 'init', 'register_vacature_cpt' );



function theme_allow_svg_uploads( $mimes ) {
    $mimes['svg']  = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';

    return $mimes;
}
add_filter( 'upload_mimes', 'theme_allow_svg_uploads' );


