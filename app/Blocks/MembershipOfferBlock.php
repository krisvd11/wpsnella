<?php

namespace App\Blocks;

class MembershipOfferBlock
{
    public static function make(array $block): array
    {
        $topImage = get_field('membership_top_image');
        $cardsRaw = get_field('membership_cards');
        $cards = [];

        if (is_array($cardsRaw)) {
            foreach ($cardsRaw as $card) {
                $icon = $card['icon'] ?? null;
                $iconId = is_array($icon) && isset($icon['ID']) ? (int) $icon['ID'] : 0;

                $cards[] = [
                    'type' => $card['type'] ?? 'feature',
                    'iconId' => $iconId,
                    'title' => $card['title'] ?? '',
                    'priceMain' => $card['price_main'] ?? '€39',
                    'priceSub' => $card['price_sub'] ?? __('per maand', 'test'),
                    'ctaText' => $card['cta_text'] ?? '',
                    'ctaLabel' => $card['cta_label'] ?? '',
                    'ctaUrl' => $card['cta_url'] ?? '#',
                    'bg' => $card['bg'] ?? '#f1f1f1',
                    'textColor' => $card['text_color'] ?? '#17338f',
                ];
            }
        }

        return [
            'uid' => 'membership-offer-' . (isset($block['id']) ? sanitize_html_class($block['id']) : wp_unique_id()),
            'sectionBg' => get_field('membership_section_bg') ?: '#ececec',
            'topImageId' => is_array($topImage) && isset($topImage['ID']) ? (int) $topImage['ID'] : 0,
            'offerTitle' => get_field('membership_offer_title') ?: __('Onbeperkt je auto wassen voor maar', 'test'),
            'offerPanelBg' => get_field('membership_offer_panel_bg') ?: '#f5bb14',
            'offerTitleColor' => get_field('membership_offer_title_color') ?: '#17338f',
            'offerPrice' => get_field('membership_offer_price') ?: '39*',
            'offerPriceBg' => get_field('membership_offer_price_bg') ?: '#17338f',
            'offerPriceColor' => get_field('membership_offer_price_color') ?: '#ffffff',
            'cards' => $cards,
            'footnote' => get_field('membership_footnote') ?: '',
        ];
    }
}
