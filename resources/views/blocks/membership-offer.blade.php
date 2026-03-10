<section id="{{ esc_attr($uid) }}" class="membership-offer" style="background: {{ esc_attr($sectionBg) }};">
    <div class="membership-offer__wrap">
        <div class="membership-offer__top">
            <div class="membership-offer__image">
                @if ($topImageId)
                    {!! wp_get_attachment_image($topImageId, 'large') !!}
                @endif
            </div>

            <div class="membership-offer__banner" style="background: {{ esc_attr($offerPanelBg) }};">
                <h3 style="color: {{ esc_attr($offerTitleColor) }};">{!! nl2br(esc_html($offerTitle)) !!}</h3>
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
                                <span class="arrow-svg"><svg xmlns="http://www.w3.org/2000/svg" width="32.611" height="19.338" viewBox="0 0 32.611 19.338">
                                    <g id="Group_459" data-name="Group 459" transform="translate(-251.811 -660.331)">
                                      <path id="Path_214" data-name="Path 214" d="M-3441.939-7041h29.205" transform="translate(3695 7711)" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-width="2.5"></path>
                                      <path id="Path_215" data-name="Path 215" d="M-3405.73-7048.316l7.9,7.9-7.9,7.9" transform="translate(3681 7710.415)" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
                                    </g>
                                  </svg></span>
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

#{{ esc_html($uid) }} .membership-offer__banner h3 {
    margin: 0;
    font-family: "Causten", sans-serif;
    font-size: 38px !important;
    line-height: 0.95;
    font-weight: 700;
    max-width: 680px;
}

#{{ esc_html($uid) }} .membership-offer__price {
    border-radius: 44px;
    text-align: center;
    font-family: "Causten", sans-serif;
    font-size: 90px;
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
    font-size: 18px;
    line-height: 1.25;
    font-weight: 700;
}

#{{ esc_html($uid) }} .membership-card--price {
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
}


#{{ esc_html($uid) }} .membership-card--price p {
    margin: 8px 0 0;
    font-family: "Causten regular", sans-serif;
    color: white;
}

#{{ esc_html($uid) }} .membership-card--cta {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 16px;
    width: 194%;
}



#{{ esc_html($uid) }} .membership-card--cta a {
    font-family: 'Causten';
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    text-decoration: none;
    background: #17338f;
    color: #fff;
    border-radius: 999px;
    font-size: 18px;
    font-weight: 700;
    width: fit-content;
    padding: 15px;
}

#{{ esc_html($uid) }} .membership-offer__footnote {
    padding: 34px !important;
    text-align: center;
    color: #b2b8c8;
    font-family: "Causten regular", sans-serif;
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

@media (max-width: 600px) {

  .membership-card {
    padding: 0px !important;
  }
  .membership-card--price {
    display: none !important;
  }

  .membership-card--cta {
    width: auto !important;
  }

  .membership-card--cta a {
    width: 100% !important;
  }

  .membership-card--cta p {
    display: none !important;
  }
  .info-container {
    display: flex;
    flex-direction: column;
  }
  .membership-offer__image {
    display: none;
  }

    .membership-card--cta {
        max-width: 100% !important;
   }

   .membership-offer__banner h3 {
        text-align: center !important;
   }

    .membership-offer__banner {
        height: auto !important;
        width: 100% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

  .membership-card.membership-card--feature {
    display: none !important;
  }
    .info {
      padding-left: 16px;
      padding-right: 16px;
    }
    .info img,
    .info video {
      max-width: 100%;
      height: auto;
    }
    .info [class*="grid"],
    .info [class*="cards"],
    .info [class*="columns"],
    .info [class*="row"] {
      grid-template-columns: 1fr;
    }
}
</style>
