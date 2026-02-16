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
        'faq',
        get_template_directory_uri() . '/js/faq.js',
        array(),
        '1.0',
        true
    );

    wp_enqueue_script(
        'animatie',
        get_template_directory_uri() . '/js/animatie.js',
        array(),
        '1.0',
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
        'footer'  => __( 'Footer Menu', 'test' ),
    ] );
}
add_action( 'after_setup_theme', 'my_starter_theme_setup' );

if ( ! defined( 'TEST_FOOTER_SETTINGS_OPTION' ) ) {
    define( 'TEST_FOOTER_SETTINGS_OPTION', 'test_footer_settings' );
}

if ( ! function_exists( 'test_footer_settings_defaults' ) ) {
    function test_footer_settings_defaults() {
        return [
            'footer_logo'              => 0,
            'footer_open_badge_text'   => __( 'Yes! Wij zijn open tot 18:00 uur', 'test' ),
            'footer_hours_title'       => __( 'Openingstijden', 'test' ),
            'footer_opening_hours'     => "Maandag|08:00 - 18:00\nDinsdag|08:00 - 18:00\nWoensdag|08:00 - 18:00\nDonderdag|08:00 - 18:00\nVrijdag|08:00 - 18:00\nZaterdag|08:00 - 18:00\nZondag|Gesloten",
            'footer_nav_title'         => __( 'Snel naar', 'test' ),
            'footer_company_name'      => 'Snella Autowas',
            'footer_location1_title'   => 'Snella Autowas N206',
            'footer_location1_address' => "Lageweg 44\n2222 AG Katwijk aan Zee",
            'footer_location2_title'   => 'Snella Autowas Katwijkerbroek',
            'footer_location2_address' => "Valkenburgseweg 101\n2223 KC Katwijk",
            'footer_phone'             => '(071) 407 79 99',
            'footer_email'             => 'info@snella.nl',
            'footer_social_label'      => __( 'Volg Snella op', 'test' ),
            'footer_instagram_url'     => '',
            'footer_facebook_url'      => '',
        ];
    }
}

if ( ! function_exists( 'test_footer_settings_get_all' ) ) {
    function test_footer_settings_get_all() {
        $opts = get_option( TEST_FOOTER_SETTINGS_OPTION, [] );
        if ( ! is_array( $opts ) ) {
            $opts = [];
        }
        return wp_parse_args( $opts, test_footer_settings_defaults() );
    }
}

if ( ! function_exists( 'test_footer_settings_get' ) ) {
    function test_footer_settings_get( $key, $default = '' ) {
        $opts = test_footer_settings_get_all();
        return array_key_exists( $key, $opts ) ? $opts[ $key ] : $default;
    }
}

add_action(
    'after_switch_theme',
    function () {
        if ( false === get_option( TEST_FOOTER_SETTINGS_OPTION, false ) ) {
            add_option( TEST_FOOTER_SETTINGS_OPTION, test_footer_settings_defaults() );
        }
    }
);

function test_footer_settings_sanitize( $input ) {
    $defaults = test_footer_settings_defaults();
    $output   = [];

    if ( ! is_array( $input ) ) {
        $input = [];
    }

    $output['footer_logo']              = absint( $input['footer_logo'] ?? 0 );
    $output['footer_open_badge_text']   = sanitize_text_field( $input['footer_open_badge_text'] ?? $defaults['footer_open_badge_text'] );
    $output['footer_hours_title']       = sanitize_text_field( $input['footer_hours_title'] ?? $defaults['footer_hours_title'] );
    $output['footer_opening_hours']     = wp_kses_post( $input['footer_opening_hours'] ?? $defaults['footer_opening_hours'] );
    $output['footer_nav_title']         = sanitize_text_field( $input['footer_nav_title'] ?? $defaults['footer_nav_title'] );
    $output['footer_company_name']      = sanitize_text_field( $input['footer_company_name'] ?? $defaults['footer_company_name'] );
    $output['footer_location1_title']   = sanitize_text_field( $input['footer_location1_title'] ?? $defaults['footer_location1_title'] );
    $output['footer_location1_address'] = wp_kses_post( $input['footer_location1_address'] ?? $defaults['footer_location1_address'] );
    $output['footer_location2_title']   = sanitize_text_field( $input['footer_location2_title'] ?? $defaults['footer_location2_title'] );
    $output['footer_location2_address'] = wp_kses_post( $input['footer_location2_address'] ?? $defaults['footer_location2_address'] );
    $output['footer_phone']             = sanitize_text_field( $input['footer_phone'] ?? $defaults['footer_phone'] );
    $output['footer_email']             = sanitize_email( $input['footer_email'] ?? $defaults['footer_email'] );
    $output['footer_social_label']      = sanitize_text_field( $input['footer_social_label'] ?? $defaults['footer_social_label'] );
    $output['footer_instagram_url']     = esc_url_raw( $input['footer_instagram_url'] ?? $defaults['footer_instagram_url'] );
    $output['footer_facebook_url']      = esc_url_raw( $input['footer_facebook_url'] ?? $defaults['footer_facebook_url'] );

    return $output;
}

add_action(
    'admin_init',
    function () {
        register_setting(
            'test_footer_settings_group',
            TEST_FOOTER_SETTINGS_OPTION,
            [
                'sanitize_callback' => 'test_footer_settings_sanitize',
                'default'           => test_footer_settings_defaults(),
            ]
        );
    }
);

add_action(
    'admin_menu',
    function () {
        add_theme_page(
            __( 'Footer Sections', 'test' ),
            __( 'Footer Sections', 'test' ),
            'manage_options',
            'test-footer-sections',
            'test_footer_settings_render_page'
        );
    }
);

add_action(
    'admin_enqueue_scripts',
    function ( $hook ) {
        if ( 'appearance_page_test-footer-sections' !== $hook ) {
            return;
        }
        wp_enqueue_media();
        wp_enqueue_script(
            'test-footer-sections-admin',
            get_template_directory_uri() . '/js/footer-sections-admin.js',
            [ 'jquery' ],
            '1.0.0',
            true
        );
    }
);

function test_footer_settings_render_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $opts = test_footer_settings_get_all();
    ?>
    <div class="wrap">
        <h1><?php echo esc_html__( 'Footer Sections', 'test' ); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'test_footer_settings_group' ); ?>

            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><?php esc_html_e( 'Footer logo', 'test' ); ?></th>
                    <td>
                        <input type="hidden" id="tfs_footer_logo" name="<?php echo esc_attr( TEST_FOOTER_SETTINGS_OPTION ); ?>[footer_logo]" value="<?php echo esc_attr( (int) $opts['footer_logo'] ); ?>">
                        <div id="tfs_footer_logo_preview" style="margin: 8px 0;">
                            <?php
                            if ( ! empty( $opts['footer_logo'] ) ) {
                                echo wp_get_attachment_image( (int) $opts['footer_logo'], 'medium', false, [ 'style' => 'max-height:60px;width:auto;' ] );
                            }
                            ?>
                        </div>
                        <button type="button" class="button" id="tfs_footer_logo_select"><?php esc_html_e( 'Select image', 'test' ); ?></button>
                        <button type="button" class="button" id="tfs_footer_logo_remove"><?php esc_html_e( 'Remove', 'test' ); ?></button>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><?php esc_html_e( 'Open melding', 'test' ); ?></th>
                    <td><input type="text" class="regular-text" name="<?php echo esc_attr( TEST_FOOTER_SETTINGS_OPTION ); ?>[footer_open_badge_text]" value="<?php echo esc_attr( $opts['footer_open_badge_text'] ); ?>"></td>
                </tr>

                <tr>
                    <th scope="row"><?php esc_html_e( 'Titel openingstijden', 'test' ); ?></th>
                    <td><input type="text" class="regular-text" name="<?php echo esc_attr( TEST_FOOTER_SETTINGS_OPTION ); ?>[footer_hours_title]" value="<?php echo esc_attr( $opts['footer_hours_title'] ); ?>"></td>
                </tr>

                <tr>
                    <th scope="row"><?php esc_html_e( 'Openingstijden', 'test' ); ?></th>
                    <td>
                        <textarea class="large-text code" rows="8" name="<?php echo esc_attr( TEST_FOOTER_SETTINGS_OPTION ); ?>[footer_opening_hours]"><?php echo esc_textarea( $opts['footer_opening_hours'] ); ?></textarea>
                        <p class="description"><?php esc_html_e( 'Per regel: Dag|Tijd (bijv. Maandag|08:00 - 18:00)', 'test' ); ?></p>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><?php esc_html_e( 'Titel navigatiekolom', 'test' ); ?></th>
                    <td><input type="text" class="regular-text" name="<?php echo esc_attr( TEST_FOOTER_SETTINGS_OPTION ); ?>[footer_nav_title]" value="<?php echo esc_attr( $opts['footer_nav_title'] ); ?>"></td>
                </tr>

                <tr>
                    <th scope="row"><?php esc_html_e( 'Bedrijfsnaam', 'test' ); ?></th>
                    <td><input type="text" class="regular-text" name="<?php echo esc_attr( TEST_FOOTER_SETTINGS_OPTION ); ?>[footer_company_name]" value="<?php echo esc_attr( $opts['footer_company_name'] ); ?>"></td>
                </tr>

                <tr>
                    <th scope="row"><?php esc_html_e( 'Locatie 1 – titel', 'test' ); ?></th>
                    <td><input type="text" class="regular-text" name="<?php echo esc_attr( TEST_FOOTER_SETTINGS_OPTION ); ?>[footer_location1_title]" value="<?php echo esc_attr( $opts['footer_location1_title'] ); ?>"></td>
                </tr>
                <tr>
                    <th scope="row"><?php esc_html_e( 'Locatie 1 – adres', 'test' ); ?></th>
                    <td><textarea class="large-text" rows="3" name="<?php echo esc_attr( TEST_FOOTER_SETTINGS_OPTION ); ?>[footer_location1_address]"><?php echo esc_textarea( $opts['footer_location1_address'] ); ?></textarea></td>
                </tr>

                <tr>
                    <th scope="row"><?php esc_html_e( 'Locatie 2 – titel', 'test' ); ?></th>
                    <td><input type="text" class="regular-text" name="<?php echo esc_attr( TEST_FOOTER_SETTINGS_OPTION ); ?>[footer_location2_title]" value="<?php echo esc_attr( $opts['footer_location2_title'] ); ?>"></td>
                </tr>
                <tr>
                    <th scope="row"><?php esc_html_e( 'Locatie 2 – adres', 'test' ); ?></th>
                    <td><textarea class="large-text" rows="3" name="<?php echo esc_attr( TEST_FOOTER_SETTINGS_OPTION ); ?>[footer_location2_address]"><?php echo esc_textarea( $opts['footer_location2_address'] ); ?></textarea></td>
                </tr>

                <tr>
                    <th scope="row"><?php esc_html_e( 'Telefoonnummer', 'test' ); ?></th>
                    <td><input type="text" class="regular-text" name="<?php echo esc_attr( TEST_FOOTER_SETTINGS_OPTION ); ?>[footer_phone]" value="<?php echo esc_attr( $opts['footer_phone'] ); ?>"></td>
                </tr>

                <tr>
                    <th scope="row"><?php esc_html_e( 'E-mailadres', 'test' ); ?></th>
                    <td><input type="email" class="regular-text" name="<?php echo esc_attr( TEST_FOOTER_SETTINGS_OPTION ); ?>[footer_email]" value="<?php echo esc_attr( $opts['footer_email'] ); ?>"></td>
                </tr>

                <tr>
                    <th scope="row"><?php esc_html_e( 'Social label', 'test' ); ?></th>
                    <td><input type="text" class="regular-text" name="<?php echo esc_attr( TEST_FOOTER_SETTINGS_OPTION ); ?>[footer_social_label]" value="<?php echo esc_attr( $opts['footer_social_label'] ); ?>"></td>
                </tr>

                <tr>
                    <th scope="row"><?php esc_html_e( 'Instagram URL', 'test' ); ?></th>
                    <td><input type="url" class="regular-text" name="<?php echo esc_attr( TEST_FOOTER_SETTINGS_OPTION ); ?>[footer_instagram_url]" value="<?php echo esc_attr( $opts['footer_instagram_url'] ); ?>"></td>
                </tr>

                <tr>
                    <th scope="row"><?php esc_html_e( 'Facebook URL', 'test' ); ?></th>
                    <td><input type="url" class="regular-text" name="<?php echo esc_attr( TEST_FOOTER_SETTINGS_OPTION ); ?>[footer_facebook_url]" value="<?php echo esc_attr( $opts['footer_facebook_url'] ); ?>"></td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}


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
        acf_register_block_type([
            'name'              => 'faq-accordion',
            'title'             => __('FAQ Accordion'),
            'description'       => __('Simple FAQ accordion block.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/faq-accordion.php',
            'category'          => 'formatting',
            'icon'              => 'editor-help',
            'keywords'          => ['faq', 'accordion'],
            'mode'              => 'edit',
            'supports'          => [
                'align' => true,
                'jsx'   => true
            ]
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





function register_faq_cpt() {
    $labels = [
        'name'                  => __( 'faq', 'test' ),
        'singular_name'         => __( 'FAQ', 'test' ),
        'menu_name'             => __( 'Faq', 'test' ),
        'name_admin_bar'        => __( 'Faq', 'test' ),
        'add_new'               => __( 'Nieuw faq', 'test' ),
        'add_new_item'          => __( 'Nieuw Faq toevoegen', 'test' ),
        'edit_item'             => __( 'Faq bewerken', 'test' ),
        'new_item'              => __( 'Nieuw Faq', 'test' ),
        'view_item'             => __( 'Bekijk Faq', 'test' ),
        'search_items'          => __( 'Zoek Faq', 'test' ),
        'not_found'             => __( 'Geen Faq gevonden', 'test' ),
        'not_found_in_trash'    => __( 'Geen Faq gevonden in prullenbak', 'test' ),
        'all_items'             => __( 'Alle Faq', 'test' ),
        'archives'              => __( 'Faq archief', 'test' ),
        'insert_into_item'      => __( 'Invoegen in Faq', 'test' ),
        'uploaded_to_this_item' => __( 'Geüpload naar dit Faq', 'test' ),
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => [ 'slug' => 'faq' ],
        'show_in_rest'       => true, 
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-edit-page',
        'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
        'hierarchical'       => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_admin_bar'  => true,
        'show_in_nav_menus'  => true,
        'publicly_queryable' => true,
        'exclude_from_search'=> false,
        'capability_type'    => 'post',
        'taxonomies' => array('category'),

    ];

    register_post_type( 'faq', $args );
}
add_action( 'init', 'register_faq_cpt' );



function theme_allow_svg_uploads( $mimes ) {
    $mimes['svg']  = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';

    return $mimes;
}
add_filter( 'upload_mimes', 'theme_allow_svg_uploads' );


