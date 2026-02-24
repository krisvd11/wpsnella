<?php

namespace App\Blocks;

class GalleryBlock
{
    public static function make(array $block): array
    {
        $images = get_field('gallery_images');
        $imageIds = [];

        if (is_array($images)) {
            foreach ($images as $image) {
                $imageId = is_array($image) && isset($image['ID']) ? (int) $image['ID'] : (int) $image;

                if ($imageId > 0) {
                    $imageIds[] = $imageId;
                }
            }
        }

        return [
            'uid' => 'gallery-showcase-' . (isset($block['id']) ? sanitize_html_class($block['id']) : wp_unique_id()),
            'headingTop' => get_field('gallery_heading_top') ?: __('Jouw auto', 'test'),
            'headingBottom' => get_field('gallery_heading_bottom') ?: __('blinkend', 'test'),
            'description' => get_field('gallery_description'),
            'ctaText' => get_field('gallery_cta_text') ?: __('Snelsparen bij Snella', 'test'),
            'ctaUrl' => get_field('gallery_cta_url') ?: '#',
            'badgeText' => get_field('gallery_badge_text') ?: __('Ontdek Snella Unlimited', 'test'),
            'imageIds' => $imageIds,
        ];
    }
}
