<?php

namespace App\Blocks;

class ShineShowcaseBlock
{
    public static function make(array $block): array
    {
        $images = get_field('shine_images');
        $imageIds = [];

        if (is_array($images)) {
            foreach ($images as $image) {
                $imageId = is_array($image) && isset($image['ID']) ? (int) $image['ID'] : (int) $image;

                if ($imageId > 0) {
                    $imageIds[] = $imageId;
                }
            }
        }

        $showActions = get_field('shine_show_actions');

        return [
            'uid' => 'shine-showcase-' . (isset($block['id']) ? sanitize_html_class($block['id']) : wp_unique_id()),
            'headingTop' => get_field('shine_heading_top') ?: __('Jouw auto', 'test'),
            'headingBottom' => get_field('shine_heading_bottom') ?: __('blinkend', 'test'),
            'description' => get_field('shine_description') ?: '',
            'ctaText' => get_field('shine_cta_text') ?: __('Snelsparen bij Snella', 'test'),
            'ctaUrl' => get_field('shine_cta_url') ?: '#',
            'badgeText' => get_field('shine_badge_text') ?: __('Ontdek Snella Unlimited', 'test'),
            'showActions' => $showActions === null ? true : (bool) $showActions,
            'imageIds' => $imageIds,
            'bgColor' => get_field('shine_section_bg') ?: '',
        ];
    }
}
