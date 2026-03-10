<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Sections Library Blocks
 *
 * Registers simple ACF blocks used by the editor section inserter popup.
 *
 * @package BreinPlugin
 */

if (!defined('ABSPATH')) {
    exit;
}

class SectionsLibraryBlocksProvider extends ServiceProvider
{
    private static $registered = false;
    private static $styles_printed = false;

    public function boot(): void
    {
        add_action('acf/init', array($this, 'register'));
    }

    public function register()
    {
        if (!function_exists('acf_register_block_type') || !function_exists('acf_add_local_field_group')) {
            return;
        }

        // Prevent duplicate registration when provider is booted more than once.
        if (self::$registered) {
            return;
        }
        self::$registered = true;

        $blocks = array(
            array(
                'slug'        => 'brein-section-hero',
                'title'       => __('Section Hero', 'brein-plugin'),
                'description' => __('Simple hero section with title, text and button.', 'brein-plugin'),
                'keywords'    => array('section', 'hero', 'banner'),
                'icon'        => 'cover-image',
                'template'    => 'hero.blade.php',
            ),
            array(
                'slug'        => 'brein-section-split',
                'title'       => __('Section Split Content', 'brein-plugin'),
                'description' => __('Simple two-column text section.', 'brein-plugin'),
                'keywords'    => array('section', 'split', 'columns'),
                'icon'        => 'columns',
                'template'    => 'split.blade.php',
            ),
            array(
                'slug'        => 'brein-section-cta',
                'title'       => __('Section CTA', 'brein-plugin'),
                'description' => __('Simple call-to-action section.', 'brein-plugin'),
                'keywords'    => array('section', 'cta', 'button'),
                'icon'        => 'megaphone',
                'template'    => 'cta.blade.php',
            ),            array(
                'slug'        => 'wash-program-section',
                'title'       => __('Wash Program Section', 'brein-plugin'),
                'description' => __('Two-column feature layout with image, text, icon, and price cards.', 'brein-plugin'),
                'keywords'    => array('section', 'wash', 'cards'),
                'icon'        => 'screenoptions',
                'template'    => 'wash-program-section.blade.php',
            ),
            array(
                'slug'        => 'unlimited-benefits-section',
                'title'       => __('Unlimited Benefits Section', 'brein-plugin'),
                'description' => __('Centered benefits grid with CTA and highlighted price card.', 'brein-plugin'),
                'keywords'    => array('section', 'benefits', 'pricing'),
                'icon'        => 'awards',
                'template'    => 'unlimited-benefits-section.blade.php',
            ),
            array(
                'slug'        => 'simple-icon-content-section',
                'title'       => __('Simple Icon Content Section', 'brein-plugin'),
                'description' => __('Simple two-column section with icon artwork and text.', 'brein-plugin'),
                'keywords'    => array('section', 'icon', 'content'),
                'icon'        => 'align-pull-left',
                'template'    => 'simple-icon-content-section.blade.php',
            ),
            array(
                'slug'        => 'team-section',
                'title'       => __('Team Section', 'brein-plugin'),
                'description' => __('Centered intro with team member grid.', 'brein-plugin'),
                'keywords'    => array('section', 'team', 'members'),
                'icon'        => 'groups',
                'template'    => 'team-section.blade.php',
            ),
            array(
                'slug'        => 'location-n206-section',
                'title'       => __('Location N206 Section', 'brein-plugin'),
                'description' => __('Two-column location info with features, opening hours and image gallery.', 'brein-plugin'),
                'keywords'    => array('section', 'location', 'hours'),
                'icon'        => 'location-alt',
                'template'    => 'location-n206-section.blade.php',
            ),
        );

        foreach ($blocks as $block) {
            $block_name = 'acf/' . $block['slug'];
            if (class_exists('WP_Block_Type_Registry') && \WP_Block_Type_Registry::get_instance()->is_registered($block_name)) {
                continue;
            }

            acf_register_block_type(array(
                'name'            => $block['slug'],
                'title'           => $block['title'],
                'description'     => $block['description'],
                'render_callback' => array($this, 'render'),
                'category'        => 'layout',
                'icon'            => $block['icon'],
                'keywords'        => $block['keywords'],
                'mode'            => 'preview',
                'supports'        => array(
                    'align'  => array('wide', 'full'),
                    'anchor' => true,
                    'jsx'    => false,
                ),
            ));
        }

        $this->register_field_groups();
    }

    public function render($block, $content = '', $is_preview = false)
    {
        $block_name = isset($block['name']) ? (string) $block['name'] : '';
        $slug       = str_replace('acf/', '', $block_name);
        $map        = array(
            'brein-section-hero'  => 'brein-section-hero.blade.php',
            'brein-section-split' => 'brein-section-split.blade.php',
            'brein-section-cta'   => 'brein-section-cta.blade.php',
            'wash-program-section' => 'wash-program-section.blade.php',
            'unlimited-benefits-section' => 'unlimited-benefits-section.blade.php',
            'simple-icon-content-section' => 'simple-icon-content-section.blade.php',
            'team-section' => 'team-section.blade.php',
            'location-n206-section' => 'location-n206-section.blade.php',

        );

        if (!isset($map[$slug])) {
            return;
        }

        $anchor     = !empty($block['anchor']) ? sanitize_title((string) $block['anchor']) : '';
        $id         = $anchor ?: $slug . '-' . sanitize_html_class((string) $block['id']);
        $class_name = 'brein-section ' . sanitize_html_class($slug);

        if (!empty($block['className'])) {
            $extra_classes = array_filter(array_map('sanitize_html_class', preg_split('/\s+/', (string) $block['className'])));
            if (!empty($extra_classes)) {
                $class_name .= ' ' . implode(' ', $extra_classes);
            }
        }

        $tiles      = array();
        $section_bg = '#ececec';


        $template = get_template_directory() . '/resources/views/blocks/' . $map[$slug];
        if (!file_exists($template)) {
            return;
        }

        $this->render_shared_styles();
        include $template;
    }

    private function render_shared_styles()
    {
        if (self::$styles_printed) {
            return;
        }

        self::$styles_printed = true;
        ?>
        <style>
            .brein-section {
                padding: 48px 20px;
            }
            .brein-section-inner {
                width: 100%;
                margin: 0 auto;
            }

            .brein-section h2 {
                margin: 0 0 12px;
            }
            .brein-section p {
                margin: 0 0 16px;
            }
            .brein-section-button {
                display: inline-block;
                padding: 10px 18px;
                border-radius: 8px;
                background: #0f172a;
                color: #fff;
                text-decoration: none;
            }
            .brein-section-button:hover {
                color: #fff;
                opacity: 0.9;
            }
            .brein-section-hero {
                background: #f8fafc;
            }
            .brein-section-split .brein-split-grid {
                display: grid;
                gap: 20px;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
            .brein-section-cta {
                background: #e2e8f0;
                text-align: center;
            }
            @media (max-width: 782px) {
                .brein-section-split .brein-split-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
        <?php
    }

    private function register_field_groups()
    {
        acf_add_local_field_group(array(
            'key'    => 'group_brein_section_hero',
            'title'  => 'Section Hero',
            'fields' => array(
                array(
                    'key'           => 'field_brein_hero_title',
                    'label'         => 'Title',
                    'name'          => 'title',
                    'type'          => 'text',
                    'default_value' => 'Hero title',
                ),
                array(
                    'key'           => 'field_brein_hero_text',
                    'label'         => 'Text',
                    'name'          => 'text',
                    'type'          => 'textarea',
                    'rows'          => 3,
                    'default_value' => 'Short intro text for this hero section.',
                ),
                array(
                    'key'           => 'field_brein_hero_image',
                    'label'         => 'Hero Image',
                    'name'          => 'hero_image',
                    'type'          => 'image',
                    'return_format' => 'array',
                    'preview_size'  => 'medium',
                    'library'       => 'all',
                ),
                array(
                    'key'          => 'field_brein_hero_checks',
                    'label'        => 'Checklist',
                    'name'         => 'hero_checks',
                    'type'         => 'repeater',
                    'layout'       => 'block',
                    'button_label' => 'Add Check Item',
                    'sub_fields'   => array(
                        array(
                            'key'           => 'field_brein_hero_check_text',
                            'label'         => 'Check Text',
                            'name'          => 'check_text',
                            'type'          => 'text',
                            'default_value' => '',
                        ),
                    ),
                ),
                array(
                    'key'   => 'field_brein_hero_button',
                    'label' => 'Button',
                    'name'  => 'button',
                    'type'  => 'link',
                ),
                array(
                    'key'           => 'field_brein_hero_section_bg',
                    'label'         => 'Section Background',
                    'name'          => 'hero_section_bg',
                    'type'          => 'color_picker',
                    'default_value' => '#d9d9d9',
                ),
                array(
                    'key'           => 'field_brein_hero_title_color',
                    'label'         => 'Title Color',
                    'name'          => 'hero_title_color',
                    'type'          => 'color_picker',
                    'default_value' => '#f2bb13',
                ),
                array(
                    'key'           => 'field_brein_hero_text_color',
                    'label'         => 'Text Color',
                    'name'          => 'hero_text_color',
                    'type'          => 'color_picker',
                    'default_value' => '#18328b',
                ),
                array(
                    'key'           => 'field_brein_hero_check_color',
                    'label'         => 'Check Color',
                    'name'          => 'hero_check_color',
                    'type'          => 'color_picker',
                    'default_value' => '#f2bb13',
                ),
                array(
                    'key'           => 'field_brein_hero_button_bg',
                    'label'         => 'Button Background',
                    'name'          => 'hero_button_bg',
                    'type'          => 'color_picker',
                    'default_value' => '#f2bb13',
                ),
                array(
                    'key'           => 'field_brein_hero_button_text_color',
                    'label'         => 'Button Text Color',
                    'name'          => 'hero_button_text_color',
                    'type'          => 'color_picker',
                    'default_value' => '#ffffff',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param'    => 'block',
                        'operator' => '==',
                        'value'    => 'acf/brein-section-hero',
                    ),
                ),
            ),
        ));

        acf_add_local_field_group(array(
            'key'    => 'group_brein_section_split',
            'title'  => 'Section Split Content',
            'fields' => array(
                array(
                    'key'           => 'field_brein_split_title',
                    'label'         => 'Title',
                    'name'          => 'title',
                    'type'          => 'text',
                    'default_value' => 'Split content title',
                ),
                array(
                    'key'           => 'field_brein_split_left',
                    'label'         => 'Left text',
                    'name'          => 'left_text',
                    'type'          => 'textarea',
                    'rows'          => 5,
                    'default_value' => 'Left column content.',
                ),
                array(
                    'key'           => 'field_brein_split_right',
                    'label'         => 'Right text',
                    'name'          => 'right_text',
                    'type'          => 'textarea',
                    'rows'          => 5,
                    'default_value' => 'Right column content.',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param'    => 'block',
                        'operator' => '==',
                        'value'    => 'acf/brein-section-split',
                    ),
                ),
            ),
        ));

        acf_add_local_field_group(array(
            'key'    => 'group_wash_program_section',
            'title'  => 'Wash Program Section',
            'fields' => array(
                array(
                    'key'           => 'field_wash_program_section_bg',
                    'label'         => 'Section Background',
                    'name'          => 'wash_program_section_bg',
                    'type'          => 'color_picker',
                    'default_value' => '#d9d9d9',
                ),
                array(
                    'key'           => 'field_wash_program_gap',
                    'label'         => 'Column Gap',
                    'name'          => 'wash_program_gap',
                    'type'          => 'number',
                    'default_value' => 20,
                    'min'           => 0,
                    'max'           => 80,
                    'step'          => 1,
                    'append'        => 'px',
                ),
                array(
                    'key'          => 'field_wash_program_cards',
                    'label'        => 'Cards',
                    'name'         => 'wash_program_cards',
                    'type'         => 'repeater',
                    'layout'       => 'block',
                    'button_label' => 'Add Card',
                    'sub_fields'   => array(
                        array(
                            'key'           => 'field_wash_program_card_column',
                            'label'         => 'Column',
                            'name'          => 'column',
                            'type'          => 'select',
                            'choices'       => array(
                                'left'  => 'Left',
                                'right' => 'Right',
                            ),
                            'default_value' => 'left',
                            'ui'            => 1,
                            'return_format' => 'value',
                        ),
                        array(
                            'key'           => 'field_wash_program_card_type',
                            'label'         => 'Card Type',
                            'name'          => 'card_type',
                            'type'          => 'select',
                            'choices'       => array(
                                'text'    => 'Text Card',
                                'image'   => 'Image Card',
                                'feature' => 'Feature Card',
                                'price'   => 'Price Card',
                                'vacancies' => 'Vacancies Card',
                            ),
                            'default_value' => 'text',
                            'ui'            => 1,
                            'return_format' => 'value',
                        ),
                        array(
                            'key'           => 'field_wash_program_card_title',
                            'label'         => 'Title',
                            'name'          => 'title',
                            'type'          => 'text',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field'    => 'field_wash_program_card_type',
                                        'operator' => '!=',
                                        'value'    => 'image',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key'               => 'field_wash_program_card_text',
                            'label'             => 'Text',
                            'name'              => 'text',
                            'type'              => 'textarea',
                            'rows'              => 4,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field'    => 'field_wash_program_card_type',
                                        'operator' => '==',
                                        'value'    => 'text',
                                    ),
                                ),
                                array(
                                    array(
                                        'field'    => 'field_wash_program_card_type',
                                        'operator' => '==',
                                        'value'    => 'feature',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key'               => 'field_wash_program_card_link',
                            'label'             => 'Link',
                            'name'              => 'link',
                            'type'              => 'link',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field'    => 'field_wash_program_card_type',
                                        'operator' => '==',
                                        'value'    => 'text',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key'               => 'field_wash_program_card_image',
                            'label'             => 'Image',
                            'name'              => 'image',
                            'type'              => 'image',
                            'return_format'     => 'array',
                            'preview_size'      => 'medium',
                            'library'           => 'all',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field'    => 'field_wash_program_card_type',
                                        'operator' => '==',
                                        'value'    => 'image',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key'               => 'field_wash_program_card_icon',
                            'label'             => 'Feature Icon',
                            'name'              => 'icon',
                            'type'              => 'image',
                            'return_format'     => 'array',
                            'preview_size'      => 'thumbnail',
                            'library'           => 'all',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field'    => 'field_wash_program_card_type',
                                        'operator' => '==',
                                        'value'    => 'feature',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key'               => 'field_wash_program_card_price',
                            'label'             => 'Price',
                            'name'              => 'price',
                            'type'              => 'text',
                            'default_value'     => '€39',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field'    => 'field_wash_program_card_type',
                                        'operator' => '==',
                                        'value'    => 'price',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key'               => 'field_wash_program_card_price_sub',
                            'label'             => 'Price Subtext',
                            'name'              => 'price_subtext',
                            'type'              => 'text',
                            'default_value'     => 'Per maand',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field'    => 'field_wash_program_card_type',
                                        'operator' => '==',
                                        'value'    => 'price',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key'               => 'field_wash_program_card_vacancies_rows',
                            'label'             => 'Vacancy Rows',
                            'name'              => 'vacancy_rows',
                            'type'              => 'repeater',
                            'layout'            => 'block',
                            'button_label'      => 'Add Vacancy Row',
                            'min'               => 1,
                            'sub_fields'        => array(
                                array(
                                    'key'   => 'field_wash_program_card_vacancy_label',
                                    'label' => 'Label',
                                    'name'  => 'label',
                                    'type'  => 'text',
                                ),
                                array(
                                    'key'   => 'field_wash_program_card_vacancy_link',
                                    'label' => 'Link',
                                    'name'  => 'link',
                                    'type'  => 'link',
                                ),
                            ),
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field'    => 'field_wash_program_card_type',
                                        'operator' => '==',
                                        'value'    => 'vacancies',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key'           => 'field_wash_program_card_bg',
                            'label'         => 'Card Background',
                            'name'          => 'card_bg',
                            'type'          => 'color_picker',
                            'default_value' => '#f4f4f4',
                        ),
                        array(
                            'key'           => 'field_wash_program_card_accent_bg',
                            'label'         => 'Accent Background',
                            'name'          => 'accent_bg',
                            'type'          => 'color_picker',
                            'default_value' => '#f7c30f',
                        ),
                        array(
                            'key'           => 'field_wash_program_card_text_color',
                            'label'         => 'Text Color',
                            'name'          => 'text_color',
                            'type'          => 'color_picker',
                            'default_value' => '#143487',
                        ),
                        array(
                            'key'           => 'field_wash_program_card_min_height',
                            'label'         => 'Min Height',
                            'name'          => 'min_height',
                            'type'          => 'number',
                            'default_value' => 0,
                            'min'           => 0,
                            'max'           => 1200,
                            'append'        => 'px',
                        ),
                        array(
                            'key'           => 'field_wash_program_card_top_offset',
                            'label'         => 'Top Offset',
                            'name'          => 'top_offset',
                            'type'          => 'number',
                            'default_value' => 0,
                            'min'           => 0,
                            'max'           => 250,
                            'append'        => 'px',
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param'    => 'block',
                        'operator' => '==',
                        'value'    => 'acf/wash-program-section',
                    ),
                ),
            ),
        ));

        acf_add_local_field_group(array(
            'key'    => 'group_unlimited_benefits_section',
            'title'  => 'Unlimited Benefits Section',
            'fields' => array(
                array(
                    'key'           => 'field_unlimited_bg',
                    'label'         => 'Section Background',
                    'name'          => 'unlimited_bg',
                    'type'          => 'color_picker',
                    'default_value' => '#d9d9d9',
                ),
                array(
                    'key'           => 'field_unlimited_inner_bg',
                    'label'         => 'Inner Container Background',
                    'name'          => 'unlimited_inner_bg',
                    'type'          => 'color_picker',
                    'default_value' => '#efefef',
                ),
                array(
                    'key'           => 'field_unlimited_title',
                    'label'         => 'Title',
                    'name'          => 'unlimited_title',
                    'type'          => 'text',
                    'default_value' => 'Waarom Snella Unlimited',
                ),
                array(
                    'key'           => 'field_unlimited_text_color',
                    'label'         => 'Text Color',
                    'name'          => 'unlimited_text_color',
                    'type'          => 'color_picker',
                    'default_value' => '#18328b',
                ),
                array(
                    'key'           => 'field_unlimited_tile_bg',
                    'label'         => 'Feature Tile Background',
                    'name'          => 'unlimited_tile_bg',
                    'type'          => 'color_picker',
                    'default_value' => '#e7e7e7',
                ),
                array(
                    'key'           => 'field_unlimited_accent_color',
                    'label'         => 'Accent Color',
                    'name'          => 'unlimited_accent_color',
                    'type'          => 'color_picker',
                    'default_value' => '#f2b90f',
                ),
                array(
                    'key'           => 'field_unlimited_price_bg',
                    'label'         => 'Price Tile Background',
                    'name'          => 'unlimited_price_bg',
                    'type'          => 'color_picker',
                    'default_value' => '#f2bd13',
                ),
                array(
                    'key'           => 'field_unlimited_price_text_color',
                    'label'         => 'Price Tile Text Color',
                    'name'          => 'unlimited_price_text_color',
                    'type'          => 'color_picker',
                    'default_value' => '#18328b',
                ),
                array(
                    'key'           => 'field_unlimited_button_bg',
                    'label'         => 'Button Background',
                    'name'          => 'unlimited_button_bg',
                    'type'          => 'color_picker',
                    'default_value' => '#1a3592',
                ),
                array(
                    'key'           => 'field_unlimited_button_text_color',
                    'label'         => 'Button Text Color',
                    'name'          => 'unlimited_button_text_color',
                    'type'          => 'color_picker',
                    'default_value' => '#ffffff',
                ),
                array(
                    'key'          => 'field_unlimited_items',
                    'label'        => 'Grid Items',
                    'name'         => 'unlimited_items',
                    'type'         => 'repeater',
                    'layout'       => 'block',
                    'button_label' => 'Add Grid Item',
                    'sub_fields'   => array(
                        array(
                            'key'           => 'field_unlimited_item_type',
                            'label'         => 'Item Type',
                            'name'          => 'item_type',
                            'type'          => 'select',
                            'choices'       => array(
                                'feature' => 'Feature',
                                'price'   => 'Price',
                            ),
                            'default_value' => 'feature',
                            'ui'            => 1,
                            'return_format' => 'value',
                        ),
                        array(
                            'key'               => 'field_unlimited_item_icon',
                            'label'             => 'Icon',
                            'name'              => 'icon',
                            'type'              => 'image',
                            'return_format'     => 'array',
                            'preview_size'      => 'thumbnail',
                            'library'           => 'all',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field'    => 'field_unlimited_item_type',
                                        'operator' => '==',
                                        'value'    => 'feature',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key'               => 'field_unlimited_item_text',
                            'label'             => 'Text',
                            'name'              => 'text',
                            'type'              => 'text',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field'    => 'field_unlimited_item_type',
                                        'operator' => '==',
                                        'value'    => 'feature',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key'               => 'field_unlimited_item_price',
                            'label'             => 'Price',
                            'name'              => 'price',
                            'type'              => 'text',
                            'default_value'     => '€39',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field'    => 'field_unlimited_item_type',
                                        'operator' => '==',
                                        'value'    => 'price',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key'               => 'field_unlimited_item_price_subtext',
                            'label'             => 'Price Subtext',
                            'name'              => 'price_subtext',
                            'type'              => 'text',
                            'default_value'     => 'per maand',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field'    => 'field_unlimited_item_type',
                                        'operator' => '==',
                                        'value'    => 'price',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
                array(
                    'key'   => 'field_unlimited_button',
                    'label' => 'Button',
                    'name'  => 'unlimited_button',
                    'type'  => 'link',
                ),
                array(
                    'key'           => 'field_unlimited_note',
                    'label'         => 'Bottom Note',
                    'name'          => 'unlimited_note',
                    'type'          => 'text',
                    'default_value' => 'Dit abonnement is niet toegankelijk voor taxi’s en taxibedrijven',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param'    => 'block',
                        'operator' => '==',
                        'value'    => 'acf/unlimited-benefits-section',
                    ),
                ),
            ),
        ));

        acf_add_local_field_group(array(
            'key'    => 'group_simple_icon_content_section',
            'title'  => 'Simple Icon Content Section',
            'fields' => array(
                array(
                    'key'           => 'field_simple_icon_content_bg',
                    'label'         => 'Section Background',
                    'name'          => 'simple_icon_content_bg',
                    'type'          => 'color_picker',
                    'default_value' => '#d9d9d9',
                ),
                array(
                    'key'           => 'field_simple_icon_content_inner_bg',
                    'label'         => 'Inner Background',
                    'name'          => 'simple_icon_content_inner_bg',
                    'type'          => 'color_picker',
                    'default_value' => '#efefef',
                ),
                array(
                    'key'           => 'field_simple_icon_content_title',
                    'label'         => 'Title',
                    'name'          => 'simple_icon_content_title',
                    'type'          => 'text',
                    'default_value' => 'Helemaal onbeperkt',
                ),
                array(
                    'key'           => 'field_simple_icon_content_text',
                    'label'         => 'Text',
                    'name'          => 'simple_icon_content_text',
                    'type'          => 'textarea',
                    'rows'          => 5,
                    'default_value' => '',
                ),
                array(
                    'key'           => 'field_simple_icon_content_title_color',
                    'label'         => 'Title Color',
                    'name'          => 'simple_icon_content_title_color',
                    'type'          => 'color_picker',
                    'default_value' => '#18328b',
                ),
                array(
                    'key'           => 'field_simple_icon_content_text_color',
                    'label'         => 'Text Color',
                    'name'          => 'simple_icon_content_text_color',
                    'type'          => 'color_picker',
                    'default_value' => '#18328b',
                ),
                array(
                    'key'           => 'field_simple_icon_content_icon',
                    'label'         => 'Main Icon',
                    'name'          => 'simple_icon_content_icon',
                    'type'          => 'image',
                    'return_format' => 'array',
                    'preview_size'  => 'medium',
                    'library'       => 'all',
                ),
                array(
                    'key'           => 'field_simple_icon_content_show_side_icons',
                    'label'         => 'Show Faded Side Icons',
                    'name'          => 'simple_icon_content_show_side_icons',
                    'type'          => 'true_false',
                    'default_value' => 1,
                    'ui'            => 1,
                ),
                array(
                    'key'           => 'field_simple_icon_content_side_icon_opacity',
                    'label'         => 'Side Icon Opacity',
                    'name'          => 'simple_icon_content_side_icon_opacity',
                    'type'          => 'number',
                    'default_value' => 0.2,
                    'min'           => 0,
                    'max'           => 1,
                    'step'          => 0.05,
                ),
                array(
                    'key'           => 'field_simple_icon_content_reverse_layout',
                    'label'         => 'Reverse Layout',
                    'name'          => 'simple_icon_content_reverse_layout',
                    'type'          => 'true_false',
                    'default_value' => 0,
                    'ui'            => 1,
                ),
                array(
                    'key'   => 'field_simple_icon_content_button',
                    'label' => 'Button',
                    'name'  => 'simple_icon_content_button',
                    'type'  => 'link',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param'    => 'block',
                        'operator' => '==',
                        'value'    => 'acf/simple-icon-content-section',
                    ),
                ),
            ),
        ));

        acf_add_local_field_group(array(
            'key'    => 'group_brein_section_cta',
            'title'  => 'Section CTA',
            'fields' => array(
                array(
                    'key'           => 'field_brein_cta_title',
                    'label'         => 'Title',
                    'name'          => 'title',
                    'type'          => 'text',
                    'default_value' => 'Call to action title',
                ),
                array(
                    'key'           => 'field_brein_cta_text',
                    'label'         => 'Text',
                    'name'          => 'text',
                    'type'          => 'textarea',
                    'rows'          => 3,
                    'default_value' => 'Add a short call to action message.',
                ),
                array(
                    'key'   => 'field_brein_cta_button',
                    'label' => 'Button',
                    'name'  => 'button',
                    'type'  => 'link',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param'    => 'block',
                        'operator' => '==',
                        'value'    => 'acf/brein-section-cta',
                    ),
                ),
            ),
        ));

        acf_add_local_field_group(array(
            'key'    => 'group_team_section',
            'title'  => 'Team Section',
            'fields' => array(
                array(
                    'key'           => 'field_team_section_bg',
                    'label'         => 'Section Background',
                    'name'          => 'team_section_bg',
                    'type'          => 'color_picker',
                    'default_value' => '#ececec',
                ),
                array(
                    'key'           => 'field_team_title_line_1',
                    'label'         => 'Title Line 1',
                    'name'          => 'team_title_line_1',
                    'type'          => 'text',
                    'default_value' => 'Het team van',
                ),
                array(
                    'key'           => 'field_team_title_line_2',
                    'label'         => 'Title Line 2 (Accent)',
                    'name'          => 'team_title_line_2',
                    'type'          => 'text',
                    'default_value' => 'Snella Autowas',
                ),
                array(
                    'key'           => 'field_team_intro_text',
                    'label'         => 'Intro Text',
                    'name'          => 'team_intro_text',
                    'type'          => 'textarea',
                    'rows'          => 4,
                    'default_value' => '',
                ),
                array(
                    'key'           => 'field_team_title_color',
                    'label'         => 'Title Color',
                    'name'          => 'team_title_color',
                    'type'          => 'color_picker',
                    'default_value' => '#17338f',
                ),
                array(
                    'key'           => 'field_team_accent_color',
                    'label'         => 'Accent Title Color',
                    'name'          => 'team_accent_color',
                    'type'          => 'color_picker',
                    'default_value' => '#f2bb13',
                ),
                array(
                    'key'           => 'field_team_text_color',
                    'label'         => 'Text Color',
                    'name'          => 'team_text_color',
                    'type'          => 'color_picker',
                    'default_value' => '#17338f',
                ),
                array(
                    'key'          => 'field_team_members',
                    'label'        => 'Team Members',
                    'name'         => 'team_members',
                    'type'         => 'repeater',
                    'layout'       => 'block',
                    'button_label' => 'Add Team Member',
                    'min'          => 1,
                    'sub_fields'   => array(
                        array(
                            'key'           => 'field_team_member_image',
                            'label'         => 'Photo',
                            'name'          => 'image',
                            'type'          => 'image',
                            'return_format' => 'array',
                            'preview_size'  => 'medium',
                            'library'       => 'all',
                        ),
                        array(
                            'key'           => 'field_team_member_name',
                            'label'         => 'Name',
                            'name'          => 'name',
                            'type'          => 'text',
                            'default_value' => '',
                        ),
                        array(
                            'key'           => 'field_team_member_role',
                            'label'         => 'Role',
                            'name'          => 'role',
                            'type'          => 'text',
                            'default_value' => '',
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param'    => 'block',
                        'operator' => '==',
                        'value'    => 'acf/team-section',
                    ),
                ),
            ),
        ));

        acf_add_local_field_group(array(
            'key'    => 'group_location_n206_section',
            'title'  => 'Location N206 Section',
            'fields' => array(
                array(
                    'key'           => 'field_location_n206_section_bg',
                    'label'         => 'Section Background',
                    'name'          => 'location_n206_section_bg',
                    'type'          => 'color_picker',
                    'default_value' => '#ececec',
                ),
                array(
                    'key'           => 'field_location_n206_inner_bg',
                    'label'         => 'Inner Background',
                    'name'          => 'location_n206_inner_bg',
                    'type'          => 'color_picker',
                    'default_value' => '#f0f0f0',
                ),
                array(
                    'key'           => 'field_location_n206_card_bg',
                    'label'         => 'Right Card Background',
                    'name'          => 'location_n206_card_bg',
                    'type'          => 'color_picker',
                    'default_value' => '#e9e9e9',
                ),
                array(
                    'key'           => 'field_location_n206_title_line_1',
                    'label'         => 'Title Line 1',
                    'name'          => 'location_n206_title_line_1',
                    'type'          => 'text',
                    'default_value' => 'Snella Autowas',
                ),
                array(
                    'key'           => 'field_location_n206_title_line_2',
                    'label'         => 'Title Line 2 (Accent)',
                    'name'          => 'location_n206_title_line_2',
                    'type'          => 'text',
                    'default_value' => 'Aan de N206',
                ),
                array(
                    'key'           => 'field_location_n206_intro',
                    'label'         => 'Intro Text',
                    'name'          => 'location_n206_intro',
                    'type'          => 'textarea',
                    'rows'          => 5,
                    'default_value' => '',
                ),
                array(
                    'key'           => 'field_location_n206_features_title',
                    'label'         => 'Features Title',
                    'name'          => 'location_n206_features_title',
                    'type'          => 'text',
                    'default_value' => 'Hier vind je:',
                ),
                array(
                    'key'          => 'field_location_n206_features',
                    'label'        => 'Features',
                    'name'         => 'location_n206_features',
                    'type'         => 'repeater',
                    'layout'       => 'table',
                    'button_label' => 'Add Feature',
                    'min'          => 1,
                    'sub_fields'   => array(
                        array(
                            'key'           => 'field_location_n206_feature_text',
                            'label'         => 'Text',
                            'name'          => 'text',
                            'type'          => 'text',
                            'default_value' => '',
                        ),
                    ),
                ),
                array(
                    'key'           => 'field_location_n206_contact_title',
                    'label'         => 'Contact Title',
                    'name'          => 'location_n206_contact_title',
                    'type'          => 'text',
                    'default_value' => 'Snella Autowas N206',
                ),
                array(
                    'key'           => 'field_location_n206_address',
                    'label'         => 'Address Lines',
                    'name'          => 'location_n206_address',
                    'type'          => 'textarea',
                    'rows'          => 3,
                    'default_value' => '',
                ),
                array(
                    'key'           => 'field_location_n206_phone',
                    'label'         => 'Phone',
                    'name'          => 'location_n206_phone',
                    'type'          => 'text',
                    'default_value' => '',
                ),
                array(
                    'key'           => 'field_location_n206_email',
                    'label'         => 'Email',
                    'name'          => 'location_n206_email',
                    'type'          => 'text',
                    'default_value' => '',
                ),
                array(
                    'key'           => 'field_location_n206_hours_title',
                    'label'         => 'Opening Hours Title',
                    'name'          => 'location_n206_hours_title',
                    'type'          => 'text',
                    'default_value' => 'Openingstijden',
                ),
                array(
                    'key'          => 'field_location_n206_hours',
                    'label'        => 'Opening Hours',
                    'name'         => 'location_n206_hours',
                    'type'         => 'repeater',
                    'layout'       => 'table',
                    'button_label' => 'Add Opening Hour',
                    'min'          => 1,
                    'sub_fields'   => array(
                        array(
                            'key'           => 'field_location_n206_hours_day',
                            'label'         => 'Day',
                            'name'          => 'day',
                            'type'          => 'text',
                            'default_value' => '',
                        ),
                        array(
                            'key'           => 'field_location_n206_hours_time',
                            'label'         => 'Time',
                            'name'          => 'time',
                            'type'          => 'text',
                            'default_value' => '',
                        ),
                    ),
                ),
                array(
                    'key'          => 'field_location_n206_gallery',
                    'label'        => 'Bottom Gallery',
                    'name'         => 'location_n206_gallery',
                    'type'         => 'repeater',
                    'layout'       => 'block',
                    'button_label' => 'Add Gallery Image',
                    'min'          => 1,
                    'max'          => 3,
                    'sub_fields'   => array(
                        array(
                            'key'           => 'field_location_n206_gallery_image',
                            'label'         => 'Image',
                            'name'          => 'image',
                            'type'          => 'image',
                            'return_format' => 'array',
                            'preview_size'  => 'medium',
                            'library'       => 'all',
                        ),
                    ),
                ),
                array(
                    'key'           => 'field_location_n206_title_color',
                    'label'         => 'Title Color',
                    'name'          => 'location_n206_title_color',
                    'type'          => 'color_picker',
                    'default_value' => '#17338f',
                ),
                array(
                    'key'           => 'field_location_n206_accent_color',
                    'label'         => 'Accent Color',
                    'name'          => 'location_n206_accent_color',
                    'type'          => 'color_picker',
                    'default_value' => '#f2bb13',
                ),
                array(
                    'key'           => 'field_location_n206_text_color',
                    'label'         => 'Text Color',
                    'name'          => 'location_n206_text_color',
                    'type'          => 'color_picker',
                    'default_value' => '#17338f',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param'    => 'block',
                        'operator' => '==',
                        'value'    => 'acf/location-n206-section',
                    ),
                ),
            ),
        ));

    
    }
}
