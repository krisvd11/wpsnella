<?php

namespace App\Blocks;

class PricingPlansBlock
{
    public static function make(array $block): array
    {
        $cardsRaw = get_field('pricing_plans_cards');
        $cards = [];

        if (is_array($cardsRaw)) {
            foreach ($cardsRaw as $card) {
                $features = [];
                $featuresRaw = $card['features'] ?? [];

                if (is_array($featuresRaw)) {
                    foreach ($featuresRaw as $feature) {
                        $text = $feature['text'] ?? '';
                        if ($text !== '') {
                            $features[] = $text;
                        }
                    }
                }

                $cards[] = [
                    'titleColor' => $card['title-color'] ?? '',
                    'name' => $card['name'] ?? '',
                    'price' => $card['price'] ?? '',
                    'pointsBadge' => $card['points_badge'] ?? '',
                    'pointsSub' => $card['points_sub'] ?? '',
                    'cardBg' => $card['card_bg'] ?? '#f5bb14',
                    'textColor' => $card['text_color'] ?? '#17338f',
                    'badgeBg' => $card['badge_bg'] ?? '#ffffff',
                    'badgeColor' => $card['badge_color'] ?? '#17338f',
                    'checkColor' => $card['check_color'] ?? '#f5bb14',
                    'features' => $features,
                ];
            }
        }

        return [
            'uid' => 'pricing-plans-' . (isset($block['id']) ? sanitize_html_class($block['id']) : wp_unique_id()),
            'sectionBg' => get_field('pricing_plans_section_bg') ?: '#ececec',
            'heading' => get_field('pricing_plans_heading') ?: '',
            'description' => get_field('pricing_plans_description') ?: '',
            'cards' => $cards,
        ];
    }
}
