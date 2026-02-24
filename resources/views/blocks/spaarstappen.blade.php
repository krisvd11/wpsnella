@php
    $sectionBg = get_field('spaarstappen_section_bg') ?: '#ececec';
    $cards = get_field('spaarstappen_cards');
@endphp

<section class="spaarstappen-block" style="background: {{ esc_attr($sectionBg) }};">
    <div class="spaarstappen-grid">
        @if (is_array($cards) && count($cards))
            @foreach ($cards as $card)
                @php
                    $title = $card['title'] ?? '';
                    $description = $card['description'] ?? '';
                    $linkLabel = $card['link_label'] ?? '';
                    $linkUrl = $card['link_url'] ?? '';
                    $cardBg = $card['card_bg'] ?? '#f1f1f1';
                    $iconBg = $card['icon_bg'] ?? '#17338f';
                    $textColor = $card['text_color'] ?? '#17338f';
                    $iconImage = $card['icon_image'] ?? null;
                @endphp

                <article class="spaarstappen-card" style="background: {{ esc_attr($cardBg) }};">
                    <div class="spaarstappen-icon" style="background: {{ esc_attr($iconBg) }};">
                        @if (is_array($iconImage) && !empty($iconImage['ID']))
                            {!! wp_get_attachment_image((int) $iconImage['ID'], 'medium') !!}
                        @endif
                    </div>

                    <div class="spaarstappen-content">
                        @if (!empty($title))
                            <h3 style="color: {{ esc_attr($textColor) }};">{{ esc_html($title) }}</h3>
                        @endif

                        @if (!empty($description))
                            <p style="color: {{ esc_attr($textColor) }};">{!! wp_kses_post($description) !!}</p>
                        @endif

                        @if (!empty($linkLabel))
                            <a href="{{ esc_url($linkUrl ?: '#') }}" style="color: {{ esc_attr($textColor) }};">
                                {{ esc_html($linkLabel) }}
                            </a>
                        @endif
                    </div>
                </article>
            @endforeach
        @elseif (is_admin())
            <p>{{ esc_html__('Add 4 cards to the Spaarstappen block.', 'test') }}</p>
        @endif
    </div>
</section>

<style>
.spaarstappen-block {
    padding: 30px 22px 38px;
}

.spaarstappen-grid {
    max-width: 1180px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 34px;
}

.spaarstappen-card {
    border-radius: 32px;
    padding: 40px 32px;
    display: grid;
    grid-template-columns: 170px 1fr;
    align-items: start;
    gap: 32px;
}

.spaarstappen-icon {
    width: 170px;
    height: 170px;
    border-radius: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.spaarstappen-icon img {
    width: 76%;
    height: 76%;
    object-fit: contain;
}

.spaarstappen-content h3 {
    margin: 0 0 12px;
    font-size: clamp(34px, 4.1vw, 57px);
    line-height: 1.05;
    font-family: "Causten", sans-serif;
    font-weight: 700;
}

.spaarstappen-content p {
    margin: 0;
    font-size: clamp(17px, 2vw, 39px);
    line-height: 1.55;
    font-family: "Causten regular", sans-serif;
}

.spaarstappen-content a {
    display: inline-block;
    margin-top: 16px;
    text-decoration: underline;
    font-size: clamp(18px, 1.6vw, 34px);
    font-family: "Causten", sans-serif;
    font-weight: 700;
}

@media (max-width: 980px) {
    .spaarstappen-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 680px) {
    .spaarstappen-card {
        grid-template-columns: 1fr;
        gap: 20px;
        padding: 26px 22px;
    }

    .spaarstappen-icon {
        width: 120px;
        height: 120px;
    }
}
</style>
