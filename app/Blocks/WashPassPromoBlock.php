<?php

namespace App\Blocks;

class WashPassPromoBlock
{
    public static function make(array $block): array
    {
        $leftImagesRaw = get_field('washpass_left_images');
        $leftImageIds = [];

        if (is_array($leftImagesRaw)) {
            foreach ($leftImagesRaw as $image) {
                $imageId = is_array($image) && isset($image['ID']) ? (int) $image['ID'] : (int) $image;
                if ($imageId > 0) {
                    $leftImageIds[] = $imageId;
                }
            }
        }

        $benefitsRaw = get_field('washpass_benefits');
        $benefits = [];

        if (is_array($benefitsRaw)) {
            foreach ($benefitsRaw as $benefit) {
                $text = $benefit['text'] ?? '';
                if ($text !== '') {
                    $benefits[] = $text;
                }
            }
        }

        $cardImage = get_field('washpass_card_image');

        return [
            'uid' => 'washpass-promo-' . (isset($block['id']) ? sanitize_html_class($block['id']) : wp_unique_id()),
            'sectionBg' => get_field('washpass_section_bg') ?: '#ececec',
            'headingHtml' => get_field('washpass_heading_html') ?: '',
            'headingColor' => get_field('washpass_heading_color') ?: '#17338f',
            'leftImageIds' => $leftImageIds,
            'panelBg' => get_field('washpass_panel_bg') ?: '#f1f1f1',
            'cardImageId' => is_array($cardImage) && isset($cardImage['ID']) ? (int) $cardImage['ID'] : 0,
            'panelTitleHtml' => get_field('washpass_panel_title_html') ?: '',
            'panelText' => get_field('washpass_panel_text') ?: '',
            'benefits' => $benefits,
            'checkColor' => get_field('washpass_check_color') ?: '#f5bb14',
            'ctaLabel' => get_field('washpass_cta_label') ?: __('Waspas aanvragen', 'test'),
            'ctaUrl' => get_field('washpass_cta_url') ?: '#',
            'allowedHeadingHtml' => [
                'span' => ['style' => []],
                'br' => [],
            ],
        ];
    }
}
