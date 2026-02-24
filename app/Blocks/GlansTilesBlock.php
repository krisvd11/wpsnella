<?php

namespace App\Blocks;

class GlansTilesBlock
{
    public static function make(array $block): array
    {
        $items = get_field('glans_tiles_items');
        $tiles = [];

        if (is_array($items)) {
            foreach ($items as $item) {
                $tileType = $item['tile_type'] ?? 'text';
                $tileImage = $item['image'] ?? null;
                $imageId = is_array($tileImage) && isset($tileImage['ID']) ? (int) $tileImage['ID'] : 0;

                $tiles[] = [
                    'type' => $tileType,
                    'text' => $item['text'] ?? '',
                    'overlayText' => $item['overlay_text'] ?? '',
                    'imageId' => $imageId,
                    'tileBg' => $item['tile_bg'] ?? '#17338f',
                    'textColor' => $item['text_color'] ?? '#ffffff',
                ];
            }
        }

        return [
            'uid' => 'glans-tiles-' . (isset($block['id']) ? sanitize_html_class($block['id']) : wp_unique_id()),
            'sectionBg' => get_field('glans_tiles_section_bg') ?: '#ececec',
            'tiles' => $tiles,
        ];
    }
}
