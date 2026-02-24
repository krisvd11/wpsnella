<section id="{{ esc_attr($uid) }}" class="membership-offer" style="background: {{ esc_attr($sectionBg) }};">
    <div class="membership-offer__wrap">
        <div class="membership-offer__top">
            <div class="membership-offer__image">
                @if ($topImageId)
                    {!! wp_get_attachment_image($topImageId, 'large') !!}
                @endif
            </div>

            <div class="membership-offer__banner" style="background: {{ esc_attr($offerPanelBg) }};">
                <h2 style="color: {{ esc_attr($offerTitleColor) }};">{!! nl2br(esc_html($offerTitle)) !!}</h2>
                <div class="membership-offer__price" style="background: {{ esc_attr($offerPriceBg) }}; color: {{ esc_attr($offerPriceColor) }};">
                    {{ esc_html($offerPrice) }}
                </div>
            </div>
        </div>

        @if (is_array($cards) && count($cards))
            <div class="membership-offer__cards">
                @foreach ($cards as $card)
                    @if ($card['type'] === 'feature')
                        <article class="membership-card membership-card--feature" style="background: {{ esc_attr($card['bg']) }};">
                            @if ($card['iconId'])
                                <div class="membership-card__icon">
                                    {!! wp_get_attachment_image($card['iconId'], 'medium') !!}
                                </div>
                            @endif
                            <p style="color: {{ esc_attr($card['textColor']) }};">{!! nl2br(esc_html($card['title'])) !!}</p>
                        </article>
                    @elseif ($card['type'] === 'price')
                        <article class="membership-card membership-card--price" style="background: {{ esc_attr($card['bg']) }}; color: {{ esc_attr($card['textColor']) }};">
                            <h3>{{ esc_html($card['priceMain']) }}</h3>
                            <p>{{ esc_html($card['priceSub']) }}</p>
                        </article>
                    @else
                        <article class="membership-card membership-card--cta" style="background: {{ esc_attr($card['bg']) }}; color: {{ esc_attr($card['textColor']) }};">
                            <p>{!! nl2br(esc_html($card['ctaText'])) !!}</p>
                            <a href="{{ esc_url($card['ctaUrl'] ?: '#') }}">
                                <span>{{ esc_html($card['ctaLabel']) }}</span>
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                        </article>
                    @endif
                @endforeach
            </div>
        @endif

        @if (!empty($footnote))
            <p class="membership-offer__footnote">{{ esc_html($footnote) }}</p>
        @endif
    </div>
</section>

<style>
#{{ esc_html($uid) }} {
    padding: 52px 18px 12px;
    max-width: 1000px;
    margin: auto;
}

#{{ esc_html($uid) }} .membership-offer__wrap {
    max-width: 1320px;
    margin: 0 auto;
}

#{{ esc_html($uid) }} .membership-offer__top {
    display: flex;
    flex-direction: row;
    gap: 20px;
    align-items: center;
    justify-content: center;
    padding: 24px 0px;
}

#{{ esc_html($uid) }} .membership-offer__image {
    border-radius: 38px;
    overflow: hidden;
    max-height: 150px;
    width: 45%;
}

#{{ esc_html($uid) }} .membership-offer__image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

#{{ esc_html($uid) }} .membership-offer__banner {
    border-radius: 38px;
    padding: 24px 34px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
    height: 104px;
    width: 55%;
}

#{{ esc_html($uid) }} .membership-offer__banner h2 {
    margin: 0;
    font-family: "Causten", sans-serif;
    font-size: clamp(36px, 3vw, 66px);
    line-height: 0.95;
    font-weight: 700;
    max-width: 680px;
}

#{{ esc_html($uid) }} .membership-offer__price {
    border-radius: 44px;
    text-align: center;
    font-family: "Causten", sans-serif;
    font-size: clamp(62px, 5vw, 98px);
    font-weight: 700;
    line-height: 1;
    padding: 22px 18px;
}

#{{ esc_html($uid) }} .membership-offer__cards {
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 22px;
}

#{{ esc_html($uid) }} .membership-card {
    border-radius: 34px;
    padding: 22px 16px;
}

#{{ esc_html($uid) }} .membership-card--feature {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

#{{ esc_html($uid) }} .membership-card__icon {
    width: 60px;
    height: 60px;
    margin-bottom: 16px;
}

#{{ esc_html($uid) }} .membership-card__icon img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
}

#{{ esc_html($uid) }} .membership-card--feature p {
    margin: 0;
    font-family: "Causten", sans-serif;
    font-size: clamp(18px, 1.5vw, 38px);
    line-height: 1.25;
    font-weight: 700;
}

#{{ esc_html($uid) }} .membership-card--price {
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
}

#{{ esc_html($uid) }} .membership-card--price h3 {
    margin: 5px;
    font-family: "Causten", sans-serif;
    font-size: clamp(72px, 5.2vw, 92px);
    line-height: 0.95;
    font-weight: 700;
    padding: 5px 0px !important;
}

#{{ esc_html($uid) }} .membership-card--price p {
    margin: 8px 0 0;
    font-family: "Causten regular", sans-serif;
    font-size: clamp(18px, 1.6vw, 36px);
    color: white;
}

#{{ esc_html($uid) }} .membership-card--cta {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 16px;
    width: 194%;
}

#{{ esc_html($uid) }} .membership-card--cta p {
    margin: 0;
    font-family: "Causten regular", sans-serif;
    font-size: clamp(20px, 1.6vw, 34px);
    line-height: 1.45;
}

#{{ esc_html($uid) }} .membership-card--cta a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    text-decoration: none;
    background: #17338f;
    color: #fff;
    border-radius: 999px;
    padding: 12px 18px;
    font-family: "Causten", sans-serif;
    font-size: clamp(24px, 1.8vw, 34px);
    font-weight: 700;
    width: fit-content;
}

#{{ esc_html($uid) }} .membership-offer__footnote {
    padding: 34px !important;
    text-align: center;
    color: #b2b8c8;
    font-family: "Causten regular", sans-serif;
    font-size: clamp(20px, 1.6vw, 34px);
}

@media (max-width: 1150px) {


    #{{ esc_html($uid) }} .membership-offer__cards {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 760px) {
    #{{ esc_html($uid) }} .membership-offer__banner {
        flex-direction: column;
        align-items: flex-start;
    }

    #{{ esc_html($uid) }} .membership-offer__cards {
        grid-template-columns: 1fr;
    }
}
</style>
