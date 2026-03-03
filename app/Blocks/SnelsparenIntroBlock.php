<?php

namespace App\Blocks;

class SnelsparenIntroBlock
{
    public static function make(array $block): array
    {
        $leftImagesRaw = get_field('snelsparen_left_images');
        $rightImagesRaw = get_field('snelsparen_right_images');

        $extractImageIds = static function ($images): array {
            $imageIds = [];

            if (! is_array($images)) {
                return $imageIds;
            }

            foreach ($images as $image) {
                $imageId = is_array($image) && isset($image['ID']) ? (int) $image['ID'] : (int) $image;
                if ($imageId > 0) {
                    $imageIds[] = $imageId;
                }
            }

            return $imageIds;
        };

        return [
            'uid' => 'snelsparen-intro-' . (isset($block['id']) ? sanitize_html_class($block['id']) : wp_unique_id()),
            'sectionBg' => get_field('snelsparen_section_bg') ?: '#ececec',
            'headingLineOneAccent' => get_field('snelsparen_heading_line_one_accent') ?: __('Zo werkt sparen', 'test'),
            'headingLineOneBase' => get_field('snelsparen_heading_line_one_base') ?: __('met', 'test'),
            'headingLineTwo' => get_field('snelsparen_heading_line_two') ?: __('Snella Snelsparen', 'test'),
            'headingAccentColor' => get_field('snelsparen_heading_accent_color') ?: '#f5bb14',
            'headingBaseColor' => get_field('snelsparen_heading_base_color') ?: '#17338f',
            'description' => get_field('snelsparen_description') ?: __('Jij wast je auto regelmatig? Dan is sparen bij Snella Autowas echt wat voor jou! Met een gratis account spaar jij automatisch bij elke keer dat je komt wassen voor een gratis wasbeurt voor jouw auto. Maar er is nog meer. Zo krijg je 50% korting voor je verjaardag en ontvang je regelmatig leuke acties en kortingen in je mailbox.', 'test'),
            'descriptionColor' => get_field('snelsparen_description_color') ?: '#17338f',
            'leftImageIds' => $extractImageIds($leftImagesRaw),
            'rightImageIds' => $extractImageIds($rightImagesRaw),
        ];
    }
}
