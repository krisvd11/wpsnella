<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FieldServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        add_action('acf/init', function (): void {
            if (! function_exists('acf_add_local_field_group')) {
                return;
            }

            $this->registerGalleryFields();
            $this->registerMembershipOfferFields();
            $this->registerPricingPlansFields();
            $this->registerWashPassPromoFields();
            $this->registerSpaarstappenFields();
            $this->registerGlansTilesFields();
            $this->registerVideoIntroFields();
            $this->registerCtaBlockIntroFields();
            $this->registerInfoBlock();
        });
    }

    protected function registerGalleryFields(): void
    {
        acf_add_local_field_group([
            'key' => 'group_gallery_block_fields',
            'title' => __('Gallery Block Fields', 'test'),
            'fields' => [
                [
                    'key' => 'field_gallery_heading_top',
                    'label' => __('Heading Top', 'test'),
                    'name' => 'gallery_heading_top',
                    'type' => 'text',
                    'default_value' => __('Jouw auto', 'test'),
                ],
                [
                    'key' => 'field_gallery_heading_bottom',
                    'label' => __('Heading Bottom', 'test'),
                    'name' => 'gallery_heading_bottom',
                    'type' => 'text',
                    'default_value' => __('blinkend', 'test'),
                ],
                [
                    'key' => 'field_gallery_description',
                    'label' => __('Description', 'test'),
                    'name' => 'gallery_description',
                    'type' => 'textarea',
                    'rows' => 5,
                    'new_lines' => 'br',
                    'default_value' => __('Bij Snella Autowas streven we naar topkwaliteit! Onze geavanceerde textiel wasborstels zorgen voor een vlekkeloze reiniging van je auto’s lak en een verbluffende glans. Met osmose-water wordt je auto keer op keer vlekvrij droog. Bij ons krijgt jouw auto de zorg die het verdient. Ervaar de ultieme glans en bescherming bij Snella Autowas!', 'test'),
                ],
                [
                    'key' => 'field_gallery_cta_text',
                    'label' => __('CTA Text', 'test'),
                    'name' => 'gallery_cta_text',
                    'type' => 'text',
                    'default_value' => __('Snelsparen bij Snella', 'test'),
                ],
                [
                    'key' => 'field_gallery_cta_url',
                    'label' => __('CTA URL', 'test'),
                    'name' => 'gallery_cta_url',
                    'type' => 'url',
                ],
                [
                    'key' => 'field_gallery_badge_text',
                    'label' => __('Badge Text', 'test'),
                    'name' => 'gallery_badge_text',
                    'type' => 'text',
                    'default_value' => __('Ontdek Snella Unlimited', 'test'),
                ],
                [
                    'key' => 'field_gallery_images',
                    'label' => __('Images', 'test'),
                    'name' => 'gallery_images',
                    'type' => 'gallery',
                    'preview_size' => 'medium',
                    'library' => 'all',
                    'mime_types' => 'jpg,jpeg,png,webp,gif',
                    'min' => 0,
                    'return_format' => 'array',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/gallery',
                    ],
                ],
            ],
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ]);
    }

   
    protected function registerMembershipOfferFields(): void
    {
        acf_add_local_field_group([
            'key' => 'group_membership_offer_block_fields',
            'title' => __('Membership Offer Block Fields', 'test'),
            'fields' => [
                [
                    'key' => 'field_membership_section_bg',
                    'label' => __('Section Background', 'test'),
                    'name' => 'membership_section_bg',
                    'type' => 'color_picker',
                    'default_value' => '#ececec',
                ],
                [
                    'key' => 'field_membership_top_image',
                    'label' => __('Top Left Image', 'test'),
                    'name' => 'membership_top_image',
                    'type' => 'image',
                    'return_format' => 'array',
                    'preview_size' => 'large',
                    'library' => 'all',
                ],
                [
                    'key' => 'field_membership_offer_title',
                    'label' => __('Offer Title', 'test'),
                    'name' => 'membership_offer_title',
                    'type' => 'textarea',
                    'rows' => 3,
                    'new_lines' => 'br',
                    'default_value' => __('Onbeperkt je auto wassen voor maar', 'test'),
                ],
                [
                    'key' => 'field_membership_offer_panel_bg',
                    'label' => __('Offer Panel Background', 'test'),
                    'name' => 'membership_offer_panel_bg',
                    'type' => 'color_picker',
                    'default_value' => '#f5bb14',
                ],
                [
                    'key' => 'field_membership_offer_title_color',
                    'label' => __('Offer Title Color', 'test'),
                    'name' => 'membership_offer_title_color',
                    'type' => 'color_picker',
                    'default_value' => '#17338f',
                ],
                [
                    'key' => 'field_membership_offer_price',
                    'label' => __('Offer Price Label', 'test'),
                    'name' => 'membership_offer_price',
                    'type' => 'text',
                    'default_value' => '39*',
                ],
                [
                    'key' => 'field_membership_offer_price_bg',
                    'label' => __('Offer Price Badge Background', 'test'),
                    'name' => 'membership_offer_price_bg',
                    'type' => 'color_picker',
                    'default_value' => '#17338f',
                ],
                [
                    'key' => 'field_membership_offer_price_color',
                    'label' => __('Offer Price Badge Color', 'test'),
                    'name' => 'membership_offer_price_color',
                    'type' => 'color_picker',
                    'default_value' => '#ffffff',
                ],
                [
                    'key' => 'field_membership_cards',
                    'label' => __('Cards', 'test'),
                    'name' => 'membership_cards',
                    'type' => 'repeater',
                    'layout' => 'block',
                    'button_label' => __('Add Card', 'test'),
                    'min' => 1,
                    'sub_fields' => [
                        [
                            'key' => 'field_membership_card_type',
                            'label' => __('Card Type', 'test'),
                            'name' => 'type',
                            'type' => 'select',
                            'choices' => [
                                'feature' => __('Feature Card', 'test'),
                                'price' => __('Price Card', 'test'),
                                'cta' => __('CTA Card', 'test'),
                            ],
                            'default_value' => 'feature',
                            'ui' => 1,
                            'return_format' => 'value',
                        ],
                        [
                            'key' => 'field_membership_card_icon',
                            'label' => __('Icon', 'test'),
                            'name' => 'icon',
                            'type' => 'image',
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all',
                            'conditional_logic' => [
                                [
                                    [
                                        'field' => 'field_membership_card_type',
                                        'operator' => '==',
                                        'value' => 'feature',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'key' => 'field_membership_card_title',
                            'label' => __('Title', 'test'),
                            'name' => 'title',
                            'type' => 'text',
                            'conditional_logic' => [
                                [
                                    [
                                        'field' => 'field_membership_card_type',
                                        'operator' => '==',
                                        'value' => 'feature',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'key' => 'field_membership_card_price_main',
                            'label' => __('Price Main', 'test'),
                            'name' => 'price_main',
                            'type' => 'text',
                            'default_value' => '€39',
                            'conditional_logic' => [
                                [
                                    [
                                        'field' => 'field_membership_card_type',
                                        'operator' => '==',
                                        'value' => 'price',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'key' => 'field_membership_card_price_sub',
                            'label' => __('Price Subtext', 'test'),
                            'name' => 'price_sub',
                            'type' => 'text',
                            'default_value' => __('per maand', 'test'),
                            'conditional_logic' => [
                                [
                                    [
                                        'field' => 'field_membership_card_type',
                                        'operator' => '==',
                                        'value' => 'price',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'key' => 'field_membership_card_cta_text',
                            'label' => __('CTA Text', 'test'),
                            'name' => 'cta_text',
                            'type' => 'textarea',
                            'rows' => 3,
                            'new_lines' => 'br',
                            'default_value' => __('Vraag nu je wasabonnement aan en ontvang speciale handdoek', 'test'),
                            'conditional_logic' => [
                                [
                                    [
                                        'field' => 'field_membership_card_type',
                                        'operator' => '==',
                                        'value' => 'cta',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'key' => 'field_membership_card_cta_label',
                            'label' => __('CTA Button Label', 'test'),
                            'name' => 'cta_label',
                            'type' => 'text',
                            'default_value' => __('Meer informatie', 'test'),
                            'conditional_logic' => [
                                [
                                    [
                                        'field' => 'field_membership_card_type',
                                        'operator' => '==',
                                        'value' => 'cta',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'key' => 'field_membership_card_cta_url',
                            'label' => __('CTA Button URL', 'test'),
                            'name' => 'cta_url',
                            'type' => 'url',
                            'conditional_logic' => [
                                [
                                    [
                                        'field' => 'field_membership_card_type',
                                        'operator' => '==',
                                        'value' => 'cta',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'key' => 'field_membership_card_bg',
                            'label' => __('Card Background', 'test'),
                            'name' => 'bg',
                            'type' => 'color_picker',
                            'default_value' => '#f1f1f1',
                        ],
                        [
                            'key' => 'field_membership_card_text_color',
                            'label' => __('Card Text Color', 'test'),
                            'name' => 'text_color',
                            'type' => 'color_picker',
                            'default_value' => '#17338f',
                        ],
                    ],
                ],
                [
                    'key' => 'field_membership_footnote',
                    'label' => __('Footnote', 'test'),
                    'name' => 'membership_footnote',
                    'type' => 'text',
                    'default_value' => __('* bij een abonnement van minimaal 1 jaar', 'test'),
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/membership-offer',
                    ],
                ],
            ],
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ]);
    }

    protected function registerPricingPlansFields(): void
    {
        acf_add_local_field_group([
            'key' => 'group_pricing_plans_block_fields',
            'title' => __('Pricing Plans Block Fields', 'test'),
            'fields' => [
                [
                    'key' => 'field_pricing_plans_section_bg',
                    'label' => __('Section Background', 'test'),
                    'name' => 'pricing_plans_section_bg',
                    'type' => 'color_picker',
                    'default_value' => '#ececec',
                ],
                [
                    'key' => 'field_pricing_plans_heading',
                    'label' => __('Heading', 'test'),
                    'name' => 'pricing_plans_heading',
                    'type' => 'textarea',
                    'rows' => 3,
                    'new_lines' => 'br',
                    'default_value' => __('Onze glanzende wasprogramma’s', 'test'),
                ],
                [
                    'key' => 'field_pricing_plans_description',
                    'label' => __('Description', 'test'),
                    'name' => 'pricing_plans_description',
                    'type' => 'textarea',
                    'rows' => 5,
                    'new_lines' => 'br',
                    'default_value' => __('Ontdek ons aanbod, afgestemd op jouw behoeften. Of je nu gaat voor een grondige reiniging of een snelle opfrisbeurt van je auto, onze wasprogramma’s houden hem altijd stralend schoon. Met onze waspas spaar je niet alleen voor gratis wasbeurten, maar profiteer je ook van exclusieve extra’s.', 'test'),
                ],
                [
                    'key' => 'field_pricing_plans_cards',
                    'label' => __('Pricing Cards', 'test'),
                    'name' => 'pricing_plans_cards',
                    'type' => 'repeater',
                    'layout' => 'block',
                    'button_label' => __('Add Plan', 'test'),
                    'min' => 1,
                    'max' => 3,
                    'sub_fields' => [
                        [
                            'key' => 'field_pricing_plan_name',
                            'label' => __('Plan Name', 'test'),
                            'name' => 'name',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_title-color',
                            'label' => __('Title Color', 'test'),
                            'name' => 'title-color',
                            'type' => 'color_picker',
                            'default_value' => '#17338f',
                        ],
                        [
                            'key' => 'field_pricing_plan_price',
                            'label' => __('Price', 'test'),
                            'name' => 'price',
                            'type' => 'text',
                            'default_value' => '17,-',
                        ],
                        [
                            'key' => 'field_pricing_plan_points_badge',
                            'label' => __('Points Badge', 'test'),
                            'name' => 'points_badge',
                            'type' => 'text',
                            'default_value' => '+ 4 SPAARPUNTEN',
                        ],
                        [
                            'key' => 'field_pricing_plan_points_sub',
                            'label' => __('Points Subtext', 'test'),
                            'name' => 'points_sub',
                            'type' => 'text',
                            'default_value' => 'OF 40 PUNTEN',
                        ],
                        [
                            'key' => 'field_pricing_plan_card_bg',
                            'label' => __('Card Background', 'test'),
                            'name' => 'card_bg',
                            'type' => 'color_picker',
                            'default_value' => '#f5bb14',
                        ],
                        [
                            'key' => 'field_pricing_plan_text_color',
                            'label' => __('Text Color', 'test'),
                            'name' => 'text_color',
                            'type' => 'color_picker',
                            'default_value' => '#17338f',
                        ],
                        [
                            'key' => 'field_pricing_plan_badge_bg',
                            'label' => __('Points Badge Background', 'test'),
                            'name' => 'badge_bg',
                            'type' => 'color_picker',
                            'default_value' => '#ffffff',
                        ],
                        [
                            'key' => 'field_pricing_plan_badge_color',
                            'label' => __('Points Badge Text Color', 'test'),
                            'name' => 'badge_color',
                            'type' => 'color_picker',
                            'default_value' => '#17338f',
                        ],
                        [
                            'key' => 'field_pricing_plan_check_color',
                            'label' => __('Checkmark Color', 'test'),
                            'name' => 'check_color',
                            'type' => 'color_picker',
                            'default_value' => '#f5bb14',
                        ],
                        [
                            'key' => 'field_pricing_plan_features',
                            'label' => __('Features', 'test'),
                            'name' => 'features',
                            'type' => 'repeater',
                            'layout' => 'table',
                            'button_label' => __('Add Feature', 'test'),
                            'min' => 1,
                            'sub_fields' => [
                                [
                                    'key' => 'field_pricing_plan_feature_text',
                                    'label' => __('Feature Text', 'test'),
                                    'name' => 'text',
                                    'type' => 'text',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/pricing-plans',
                    ],
                ],
            ],
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ]);
    }

    protected function registerWashPassPromoFields(): void
    {
        acf_add_local_field_group([
            'key' => 'group_washpass_promo_block_fields',
            'title' => __('Washpass Promo Block Fields', 'test'),
            'fields' => [
                [
                    'key' => 'field_washpass_section_bg',
                    'label' => __('Section Background', 'test'),
                    'name' => 'washpass_section_bg',
                    'type' => 'color_picker',
                    'default_value' => '#ececec',
                ],
                [
                    'key' => 'field_washpass_heading_html',
                    'label' => __('Heading (HTML allowed)', 'test'),
                    'name' => 'washpass_heading_html',
                    'type' => 'textarea',
                    'rows' => 3,
                    'new_lines' => 'br',
                    'instructions' => __('Use span for colored text, e.g. <span style="color:#f5bb14;">gratis waspas</span>.', 'test'),
                    'default_value' => __('Bespaar en geniet van extra’s met onze <span style="color:#f5bb14;">gratis waspas</span>', 'test'),
                ],
                [
                    'key' => 'field_washpass_heading_color',
                    'label' => __('Heading Base Color', 'test'),
                    'name' => 'washpass_heading_color',
                    'type' => 'color_picker',
                    'default_value' => '#17338f',
                ],
                [
                    'key' => 'field_washpass_left_images',
                    'label' => __('Left Images', 'test'),
                    'name' => 'washpass_left_images',
                    'type' => 'gallery',
                    'preview_size' => 'medium',
                    'library' => 'all',
                    'mime_types' => 'jpg,jpeg,png,webp',
                    'min' => 0,
                    'max' => 2,
                    'return_format' => 'array',
                ],
                [
                    'key' => 'field_washpass_panel_bg',
                    'label' => __('Panel Background', 'test'),
                    'name' => 'washpass_panel_bg',
                    'type' => 'color_picker',
                    'default_value' => '#f1f1f1',
                ],
                [
                    'key' => 'field_washpass_card_image',
                    'label' => __('Card Image', 'test'),
                    'name' => 'washpass_card_image',
                    'type' => 'image',
                    'return_format' => 'array',
                    'preview_size' => 'large',
                    'library' => 'all',
                ],
                [
                    'key' => 'field_washpass_panel_title_html',
                    'label' => __('Panel Title (HTML allowed)', 'test'),
                    'name' => 'washpass_panel_title_html',
                    'type' => 'textarea',
                    'rows' => 3,
                    'new_lines' => 'br',
                    'instructions' => __('Use span for colored text in title.', 'test'),
                    'default_value' => __('De <span style="color:#f5bb14;">gratis</span> Snella waspas', 'test'),
                ],
                [
                    'key' => 'field_washpass_panel_text',
                    'label' => __('Panel Description', 'test'),
                    'name' => 'washpass_panel_text',
                    'type' => 'textarea',
                    'rows' => 4,
                    'new_lines' => 'br',
                    'default_value' => __('Met onze gratis waspas ontvang je altijd extra wastegoed, maar ook andere leuke extra’s. 50% korting op je verjaardag bijvoorbeeld.', 'test'),
                ],
                [
                    'key' => 'field_washpass_benefits',
                    'label' => __('Benefits', 'test'),
                    'name' => 'washpass_benefits',
                    'type' => 'repeater',
                    'layout' => 'table',
                    'button_label' => __('Add Benefit', 'test'),
                    'min' => 1,
                    'sub_fields' => [
                        [
                            'key' => 'field_washpass_benefit_text',
                            'label' => __('Benefit Text', 'test'),
                            'name' => 'text',
                            'type' => 'text',
                        ],
                    ],
                ],
                [
                    'key' => 'field_washpass_cta_label',
                    'label' => __('CTA Label', 'test'),
                    'name' => 'washpass_cta_label',
                    'type' => 'text',
                    'default_value' => __('Waspas aanvragen', 'test'),
                ],
                [
                    'key' => 'field_washpass_cta_url',
                    'label' => __('CTA URL', 'test'),
                    'name' => 'washpass_cta_url',
                    'type' => 'url',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/washpass-promo',
                    ],
                ],
            ],
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ]);
    }



    protected function registerInfoBlock(): void
    {
        acf_add_local_field_group([
            'key' => 'group_info_block_fields',
            'title' => __('Info Block Fields', 'test'),
            'fields' => [
                [
                    'key' => 'field_info_section_bg',
                    'label' => __('Section Background', 'test'),
                    'name' => 'info_section_bg',
                    'type' => 'color_picker',
                    'default_value' => '#ececec',
                ],
                [
                    'key' => 'field_info_text',
                    'label' => __('Heading', 'test'),
                    'name' => 'info_text',
                    'type' => 'textarea',
                    'rows' => 3,
                    'new_lines' => 'br',
                ],
                [
                    'key' => 'field_info_paragraph',
                    'label' => __('Text', 'test'),
                    'name' => 'info_paragraph',
                    'type' => 'textarea',
                    'rows' => 3,
                    'new_lines' => 'br',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/info-block',
                    ],
                ],
            ],
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ]);
    }

    protected function registerSpaarstappenFields(): void
    {
        acf_add_local_field_group([
            'key' => 'group_spaarstappen_block_fields',
            'title' => __('Spaarstappen Block Fields', 'test'),
            'fields' => [
                [
                    'key' => 'field_spaarstappen_section_bg',
                    'label' => __('Section Background', 'test'),
                    'name' => 'spaarstappen_section_bg',
                    'type' => 'color_picker',
                    'default_value' => '#ececec',
                ],
                [
                    'key' => 'field_spaarstappen_cards',
                    'label' => __('Cards', 'test'),
                    'name' => 'spaarstappen_cards',
                    'type' => 'repeater',
                    'layout' => 'block',
                    'button_label' => __('Add Card', 'test'),
                    'min' => 1,
                    'max' => 4,
                    'sub_fields' => [
                        [
                            'key' => 'field_spaarstappen_card_icon',
                            'label' => __('Icon / QR Image', 'test'),
                            'name' => 'icon_image',
                            'type' => 'image',
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all',
                        ],
                        [
                            'key' => 'field_spaarstappen_card_title',
                            'label' => __('Title', 'test'),
                            'name' => 'title',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_spaarstappen_card_text',
                            'label' => __('Description', 'test'),
                            'name' => 'description',
                            'type' => 'textarea',
                            'rows' => 4,
                            'new_lines' => 'br',
                        ],
                        [
                            'key' => 'field_spaarstappen_card_link_label',
                            'label' => __('Link Label', 'test'),
                            'name' => 'link_label',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_spaarstappen_card_link_url',
                            'label' => __('Link URL', 'test'),
                            'name' => 'link_url',
                            'type' => 'url',
                        ],
                        [
                            'key' => 'field_spaarstappen_card_bg',
                            'label' => __('Card Background', 'test'),
                            'name' => 'card_bg',
                            'type' => 'color_picker',
                            'default_value' => '#f1f1f1',
                        ],
                        [
                            'key' => 'field_spaarstappen_icon_bg',
                            'label' => __('Icon Background', 'test'),
                            'name' => 'icon_bg',
                            'type' => 'color_picker',
                            'default_value' => '#17338f',
                        ],
                        [
                            'key' => 'field_spaarstappen_text_color',
                            'label' => __('Text Color', 'test'),
                            'name' => 'text_color',
                            'type' => 'color_picker',
                            'default_value' => '#17338f',
                        ],
                    ],
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/spaarstappen',
                    ],
                ],
            ],
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ]);
    }

    protected function registerGlansTilesFields(): void
    {
        acf_add_local_field_group([
            'key' => 'group_glans_tiles_block_fields',
            'title' => __('Glans Tiles Block Fields', 'test'),
            'fields' => [
                [
                    'key' => 'field_glans_tiles_section_bg',
                    'label' => __('Section Background', 'test'),
                    'name' => 'glans_tiles_section_bg',
                    'type' => 'color_picker',
                    'default_value' => '#ececec',
                ],
                [
                    'key' => 'field_glans_tiles_items',
                    'label' => __('Tiles', 'test'),
                    'name' => 'glans_tiles_items',
                    'type' => 'repeater',
                    'layout' => 'block',
                    'button_label' => __('Add Tile', 'test'),
                    'min' => 1,
                    'max' => 4,
                    'sub_fields' => [
                        [
                            'key' => 'field_glans_tile_type',
                            'label' => __('Tile Type', 'test'),
                            'name' => 'tile_type',
                            'type' => 'select',
                            'choices' => [
                                'text' => __('Text Tile', 'test'),
                                'image' => __('Image Tile', 'test'),
                            ],
                            'default_value' => 'text',
                            'ui' => 1,
                            'return_format' => 'value',
                        ],
                        [
                            'key' => 'field_glans_tile_text',
                            'label' => __('Text', 'test'),
                            'name' => 'text',
                            'type' => 'text',
                            'conditional_logic' => [
                                [
                                    [
                                        'field' => 'field_glans_tile_type',
                                        'operator' => '==',
                                        'value' => 'text',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'key' => 'field_glans_tile_image',
                            'label' => __('Image', 'test'),
                            'name' => 'image',
                            'type' => 'image',
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all',
                            'conditional_logic' => [
                                [
                                    [
                                        'field' => 'field_glans_tile_type',
                                        'operator' => '==',
                                        'value' => 'image',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'key' => 'field_glans_tile_overlay_text',
                            'label' => __('Overlay Text', 'test'),
                            'name' => 'overlay_text',
                            'type' => 'text',
                            'conditional_logic' => [
                                [
                                    [
                                        'field' => 'field_glans_tile_type',
                                        'operator' => '==',
                                        'value' => 'image',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'key' => 'field_glans_tile_bg',
                            'label' => __('Tile Background', 'test'),
                            'name' => 'tile_bg',
                            'type' => 'color_picker',
                            'default_value' => '#17338f',
                        ],
                        [
                            'key' => 'field_glans_tile_text_color',
                            'label' => __('Text Color', 'test'),
                            'name' => 'text_color',
                            'type' => 'color_picker',
                            'default_value' => '#ffffff',
                        ],
                    ],
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/glans-tiles',
                    ],
                ],
            ],
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ]);
    }

    protected function registerVideoIntroFields(): void
    {
        acf_add_local_field_group([
            'key' => 'group_video_intro_block_fields',
            'title' => __('Video Intro Block Fields', 'test'),
            'fields' => [
                [
                    'key' => 'field_video_intro_section_bg',
                    'label' => __('Section Background', 'test'),
                    'name' => 'video_intro_section_bg',
                    'type' => 'color_picker',
                    'default_value' => '#ececec',
                ],
                [
                    'key' => 'field_video_intro_badge_text',
                    'label' => __('Badge Text', 'test'),
                    'name' => 'video_intro_badge_text',
                    'type' => 'text',
                    'default_value' => __('Yes! Wij zijn open tot 18:00 uur', 'test'),
                ],
                [
                    'key' => 'field_video_intro_heading_html',
                    'label' => __('Heading (HTML allowed)', 'test'),
                    'name' => 'video_intro_heading_html',
                    'type' => 'textarea',
                    'rows' => 4,
                    'new_lines' => 'br',
                    'instructions' => __('You can use span tags like <span style="color:#f5bb14;">jouw auto</span>.', 'test'),
                    'default_value' => __('Bij Snella draait alles om <span style="color:#f5bb14;">jouw auto</span>', 'test'),
                ],
                [
                    'key' => 'field_video_intro_description',
                    'label' => __('Description', 'test'),
                    'name' => 'video_intro_description',
                    'type' => 'textarea',
                    'rows' => 5,
                    'new_lines' => 'br',
                    'default_value' => __('Bij Snella Autowas gaan we verder dan alleen een schone auto. Stap binnen in onze ultramoderne wasstraat voor een uitstekend resultaat en een langere levensduur van je auto!', 'test'),
                ],
                [
                    'key' => 'field_video_intro_video',
                    'label' => __('Left Video', 'test'),
                    'name' => 'video_intro_video',
                    'type' => 'file',
                    'return_format' => 'array',
                    'library' => 'all',
                    'mime_types' => 'mp4,webm',
                ],
                [
                    'key' => 'field_video_intro_heading_color',
                    'label' => __('Heading Color', 'test'),
                    'name' => 'video_intro_heading_color',
                    'type' => 'color_picker',
                    'default_value' => '#17338f',
                ],
                [
                    'key' => 'field_video_intro_text_color',
                    'label' => __('Description Color', 'test'),
                    'name' => 'video_intro_text_color',
                    'type' => 'color_picker',
                    'default_value' => '#17338f',
                ],
                [
                    'key' => 'field_video_intro_badge_bg',
                    'label' => __('Badge Background', 'test'),
                    'name' => 'video_intro_badge_bg',
                    'type' => 'color_picker',
                    'default_value' => '#f1f1f1',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/video-intro',
                    ],
                ],
            ],
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ]);
    }


    protected function registerCtaBlockIntroFields(): void
    {
        acf_add_local_field_group([
            'key' => 'group_cta_block_block_fields',
            'title' => __('Cta Block Fields', 'test'),
            'fields' => [
                [
                    'key' => 'cta_heading',
                    'label' => __('Badge Text', 'test'),
                    'name' => 'cta_heading',
                    'type' => 'text',
                    'default_value' => __('Test', 'test'),
                ],
                [
                    'key' => 'cta_description',
                    'label' => __('Cta description', 'test'),
                    'name' => 'cta_description',
                    'type' => 'text',
                    'default_value' => __('Test', 'test'),
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/call-to-action',
                    ],
                ],
            ],
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ]);
    }
}
