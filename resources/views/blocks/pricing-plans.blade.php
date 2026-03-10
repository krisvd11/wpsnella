<section id="{{ esc_attr($uid) }}" class="pricing-plans" style="background: {{ esc_attr($sectionBg) }};">
    <div class="pricing-plans__wrap">
        @if (!empty($heading))
            <h2 class="pricing-plans__heading">{!! nl2br ($heading) !!}</h2>
        @endif

        @if (!empty($description))
            <p class="pricing-plans__description">{!! nl2br(esc_html($description)) !!}</p>
        @endif

        @if (is_array($cards) && count($cards))
            <div class="pricing-plans__cards">
                @foreach ($cards as $card)
                    <article class="pricing-plan-card" style="background: {{ esc_attr($card['cardBg']) }}; color: {{ esc_attr($card['textColor']) }};">
                        <h3 style="color: {{ esc_attr($card['titleColor']) }};">{{ esc_html($card['name']) }}</h3>

                        <div class="pricing-plan-card__price-row">
                            <span class="pricing-plan-card__price">{{ esc_html($card['price']) }}</span>

                            <div class="pricinginfo">
                            @if (!empty($card['pointsBadge']))
                                <span class="pricing-plan-card__badge" style="background: {{ esc_attr($card['badgeBg']) }}; color: {{ esc_attr($card['badgeColor']) }};">
                                    {{ esc_html($card['pointsBadge']) }}
                                </span>
                            @endif
                            @if (!empty($card['pointsSub']))
                            <p class="pricing-plan-card__points-sub" style="color: {{ esc_attr($card['textColor']) }};">{{ esc_html($card['pointsSub']) }}</p>

                            </div>
                        @endif
                        </div>



                        @if (is_array($card['features']) && count($card['features']))
                            <ul class="pricing-plan-card__features">
                                @foreach ($card['features'] as $feature)
                                    <li>
                                        <span class="pricing-plan-card__check">
                                            <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="{{ esc_attr($card['checkColor']) }}" version="1.1" id="Capa_1" width="20px" height="20px" viewBox="0 0 78.369 78.369" xml:space="preserve"> <g> <path d="M78.049,19.015L29.458,67.606c-0.428,0.428-1.121,0.428-1.548,0L0.32,40.015c-0.427-0.426-0.427-1.119,0-1.547l6.704-6.704   c0.428-0.427,1.121-0.427,1.548,0l20.113,20.112l41.113-41.113c0.429-0.427,1.12-0.427,1.548,0l6.703,6.704   C78.477,17.894,78.477,18.586,78.049,19.015z" /> </g> </svg>
   
                                            
                                        </span>
                                        <span>{{ esc_html($feature) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>

<style>
.pricinginfo {
    display: flex;
    flex-direction: column;
    gap: 6px;
}
#{{ esc_html($uid) }} {
    padding: 34px 18px 38px;
    width: 100%;
}

#{{ esc_html($uid) }} .pricing-plans__wrap {
    max-width: 1320px;
    margin: 0 auto;
}

#{{ esc_html($uid) }} .pricing-plans__heading {
    margin: 0;
    text-align: center;
    color: #17338f;
    font-family: "Causten", sans-serif;
    line-height: 0.95;
    font-weight: 700;
}

#{{ esc_html($uid) }} .pricing-plans__description {
    margin: 14px auto 24px !important;
    text-align: center;
    max-width: 700px;
}

#{{ esc_html($uid) }} .pricing-plans__cards {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 34px;
}

#{{ esc_html($uid) }} .pricing-plan-card {
    border-radius: 44px;
    padding: 16px 0px 80px 22px;
}

#{{ esc_html($uid) }} .pricing-plan-card h3 {
    margin: 0 0 8px;
    font-family: "Causten", sans-serif;
    font-size: 58px !important;
    line-height: 0.95;
    font-weight: 700;
}

#{{ esc_html($uid) }} .pricing-plan-card__price-row {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
}

#{{ esc_html($uid) }} .pricing-plan-card__price {
    font-size: 61px;
    font-weight
: 700;
    line-height: 1;
    letter-spacing: -.025em;
}

#{{ esc_html($uid) }} .pricing-plan-card__badge {
    display: inline-block;
    border-radius: 999px;
    padding: 7px 16px;
    font-family: "Causten", sans-serif;
    font-size: 14px;
    line-height: 1;
    font-weight: 700;
}

#{{ esc_html($uid) }} .pricing-plan-card__points-sub {
    margin: 8px 0 0;
    font-family: "Causten regular", sans-serif;
    font-size: 14px;
    line-height: 1.2;
}

#{{ esc_html($uid) }} .pricing-plan-card__features {
    margin: 34px 0 0;
    padding: 0;
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 14px;
}

#{{ esc_html($uid) }} .pricing-plan-card__features li {
    display: grid;
    grid-template-columns: 34px 1fr;
    align-items: start;
    column-gap: 10px;
    font-family: "Causten regular", sans-serif;
    font-size: 18px;
    line-height: 1.3;
}

#{{ esc_html($uid) }} .pricing-plan-card__check {
    font-family: "Causten", sans-serif;
    font-size: 18px;
    line-height: 1;
    margin-top: 3px;
}

@media (max-width: 1080px) {
    #{{ esc_html($uid) }} .pricing-plans__cards {
        grid-template-columns: 1fr;
    }

    #{{ esc_html($uid) }} .pricing-plan-card {
        min-height: 0;
    }
}

@media (max-width: 600px) {
    .pricing-plans {
      padding-left: 16px;
      padding-right: 16px;
    }
    .pricing-plans img,
    .pricing-plans video {
      max-width: 100%;
      height: auto;
    }
    .pricing-plans [class*="grid"],
    .pricing-plans [class*="cards"],
    .pricing-plans [class*="columns"],
    .pricing-plans [class*="row"] {
      grid-template-columns: 1fr;
    }
}
</style>
