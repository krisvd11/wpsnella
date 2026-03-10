<section id="{{ esc_attr($uid) }}" class="washpass-promo" style="background: {{ esc_attr($sectionBg) }};">
    <div class="washpass-promo__wrap">
        @if (!empty($headingHtml))
            <h2 class="washpass-promo__heading" style="color: {{ esc_attr($headingColor) }};">
                {!! wp_kses($headingHtml, $allowedHeadingHtml) !!}
            </h2>
        @endif

        <div class="washpass-promo__grid">
            <div class="washpass-promo__left">
                @foreach ($leftImageIds as $imageId)
                    <div class="washpass-promo__left-image">
                        {!! wp_get_attachment_image($imageId, 'large') !!}
                    </div>
                @endforeach
            </div>

            <div class="washpass-promo__panel" style="background: {{ esc_attr($panelBg) }};">
                <div class="washpass-promo__panel-media">
                    @if ($cardImageId)
                        {!! wp_get_attachment_image($cardImageId, 'large') !!}
                    @endif
                </div>

                <div class="washpass-promo__panel-content">
                    @if (!empty($panelTitleHtml))
                        <h3>{!! wp_kses($panelTitleHtml, $allowedHeadingHtml) !!}</h3>
                    @endif

                    @if (!empty($panelText))
                        <p class="washpass-promo__text">{!! nl2br(esc_html($panelText)) !!}</p>
                    @endif

                    @if (is_array($benefits) && count($benefits))
                        <ul class="washpass-promo__benefits">
                            @foreach ($benefits as $benefit)
                                <li>
                                    <span class="washpass-promo__check">
                                        <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="{{ esc_attr($checkColor) }}" version="1.1" id="Capa_1" width="20px" height="20px" viewBox="0 0 78.369 78.369" xml:space="preserve"> <g> <path d="M78.049,19.015L29.458,67.606c-0.428,0.428-1.121,0.428-1.548,0L0.32,40.015c-0.427-0.426-0.427-1.119,0-1.547l6.704-6.704   c0.428-0.427,1.121-0.427,1.548,0l20.113,20.112l41.113-41.113c0.429-0.427,1.12-0.427,1.548,0l6.703,6.704   C78.477,17.894,78.477,18.586,78.049,19.015z" /> </g> </svg>
                                        </span>
                                    <span>{{ esc_html($benefit) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <a class="washpass-promo__cta" href="{{ esc_url($ctaUrl) }}">
                        <span>{{ esc_html($ctaLabel) }}</span>
                        <span class="arrow-svg"><svg xmlns="http://www.w3.org/2000/svg" width="32.611" height="19.338" viewBox="0 0 32.611 19.338">
                            <g id="Group_459" data-name="Group 459" transform="translate(-251.811 -660.331)">
                              <path id="Path_214" data-name="Path 214" d="M-3441.939-7041h29.205" transform="translate(3695 7711)" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-width="2.5"></path>
                              <path id="Path_215" data-name="Path 215" d="M-3405.73-7048.316l7.9,7.9-7.9,7.9" transform="translate(3681 7710.415)" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
                            </g>
                          </svg></span>                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
#{{ esc_html($uid) }} {
    padding: 54px 18px 46px;
}

#{{ esc_html($uid) }} .washpass-promo__wrap {
    max-width: 1320px;
    margin: 0 auto;
}

#{{ esc_html($uid) }} .washpass-promo__heading {
    margin: 0 auto 46px;
    text-align: center;
    font-family: "Causten", sans-serif;
    line-height: 0.95;
    font-weight: 700;
}

#{{ esc_html($uid) }} .washpass-promo__grid {
    display: grid;
    grid-template-columns: 350px 1fr;
    gap: 34px;
    margin-top: 30px;
}

#{{ esc_html($uid) }} .washpass-promo__left {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

#{{ esc_html($uid) }} .washpass-promo__left-image {
    border-radius: 38px;
    overflow: hidden;
    max-height: 290px;
}

#{{ esc_html($uid) }} .washpass-promo__left-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

#{{ esc_html($uid) }} .washpass-promo__panel {
    border-radius: 38px;
    padding: 32px 32px 32px 0px;
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 36px;
    align-items: center;
}

#{{ esc_html($uid) }} .washpass-promo__panel-media img {
    width: 100%;
    height: auto;
    display: block;
}





#{{ esc_html($uid) }} .washpass-promo__benefits {
    margin: 20px 0 0;
    padding: 0;
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

#{{ esc_html($uid) }} .washpass-promo__benefits li {
    display: grid;
    grid-template-columns: 30px 1fr;
    column-gap: 10px;
    align-items: start;
    color: #17338f;
    font-family: "Causten", sans-serif;
    font-size: 18px;
    line-height: 1.25;
    font-weight: 700;
}

#{{ esc_html($uid) }} .washpass-promo__check {
    fill: #f5bb14;
    font-size: 18px;
    line-height: 1.2;
}

#{{ esc_html($uid) }} .washpass-promo__cta {
    margin-top: 22px;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    background: #17338f;
    color: #fff;
    border-radius: 999px;
    padding: 15px 30px;
    font-family: "Causten", sans-serif;
    font-size: 18px;
    font-weight: 700;
}

@media (max-width: 1120px) {
    #{{ esc_html($uid) }} .washpass-promo__grid {
        grid-template-columns: 1fr;
    }

    #{{ esc_html($uid) }} .washpass-promo__left {
        flex-direction: row;
    }

    #{{ esc_html($uid) }} .washpass-promo__left-image {
        flex: 1;
        min-height: 220px;
    }
}

@media (max-width: 820px) {
    #{{ esc_html($uid) }} .washpass-promo__panel {
        grid-template-columns: 1fr;
    }

    #{{ esc_html($uid) }} .washpass-promo__left {
        flex-direction: column;
    }
}

@media (max-width: 600px) {

    .washpass-promo__left {
        display: none !important;
    }
    .washpass-promo__panel-media {
        max-width: 80%;
    }
    .washpass-promo {
      padding-left: 16px;
      padding-right: 16px;
    }
    .washpass-promo img,
    .washpass-promo video {
      max-width: 100%;
      height: auto;
    }
    .washpass-promo [class*="grid"],
    .washpass-promo [class*="cards"],
    .washpass-promo [class*="columns"],
    .washpass-promo [class*="row"] {
      grid-template-columns: 1fr;
    }
}
</style>
