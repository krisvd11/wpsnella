<section id="{{ esc_attr($uid) }}" class="shine-showcase">
    <div class="shine-showcase__container">
        <div class="shine-showcase__content">
            <h2 class="shine-showcase__title">
                <span class="shine-showcase__title-top">{{ esc_html($headingTop) }}</span>
                <span class="shine-showcase__title-bottom">{{ esc_html($headingBottom) }}</span>
            </h2>

            @if (!empty($description))
                <p class="shine-showcase__description">{!! wp_kses_post($description) !!}</p>
            @endif

            @if ($showActions)
                <div class="shine-showcase__actions">
                    <a class="shine-showcase__cta" href="{{ esc_url($ctaUrl) }}">
                        <span>{{ esc_html($ctaText) }}</span>
                        <span class="shine-showcase__cta-arrow" aria-hidden="true">&rarr;</span>
                    </a>

                    <p class="shine-showcase__badge">
                        <span class="shine-showcase__dot" aria-hidden="true"></span>
                        <span>{{ esc_html($badgeText) }}</span>
                    </p>
                </div>
            @endif

        </div>

        @for ($i = 0; $i < 4; $i++)
            @if (isset($imageIds[$i]))
                <figure class="shine-showcase__bubble shine-showcase__bubble--{{ $i + 1 }}">
                    {!! wp_get_attachment_image($imageIds[$i], 'medium_large') !!}
                </figure>
            @endif
        @endfor
    </div>
</section>

<style>
#{{ esc_html($uid) }} {
    background: {{ esc_attr($bgColor ?: '#ececec') }};
    padding: 56px 24px 172px !important;
    width: 100%;
}

#{{ esc_html($uid) }} .shine-showcase__container {
    max-width: 1520px;
    margin: 0 auto;
    position: relative;
    padding: 20px;
}

#{{ esc_html($uid) }} .shine-showcase__content {
    max-width: 560px;
    margin: 0 auto;
    text-align: center;
    position: relative;
    z-index: 2;
}

#{{ esc_html($uid) }} .shine-showcase__title {
    margin: 0 0 24px;
    line-height: 0.95;
}

#{{ esc_html($uid) }} .shine-showcase__title-top,
#{{ esc_html($uid) }} .shine-showcase__title-bottom {
    display: block;
    font-family: "Causten", sans-serif;
    font-size: clamp(44px, 5.4vw, 82px);
    font-weight: 700;
}

#{{ esc_html($uid) }} .shine-showcase__title-top {
    color: #f5bb14;
}

#{{ esc_html($uid) }} .shine-showcase__title-bottom {
    color: #17338f;
}

#{{ esc_html($uid) }} .shine-showcase__description {
    margin: 0;
    color: #17338f;
    font-family: "Causten regular", sans-serif;
    font-size: 18px;
    line-height: 1.55;
    text-align: center;
}

#{{ esc_html($uid) }} .shine-showcase__actions {
    margin-top: 34px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 22px;
}

#{{ esc_html($uid) }} .shine-showcase__cta {
    display: inline-flex;
    align-items: center;
    gap: 14px;
    padding: 15px 30px;
    border-radius: 999px;
    background: #f5bb14;
    color: #17338f;
    text-decoration: none;
    font-family: "Causten", sans-serif;
    font-size: 18px;
    font-weight: 700;
    line-height: 1;
}

#{{ esc_html($uid) }} .shine-showcase__cta-arrow {
    font-size: 28px;
    line-height: 1;
}

#{{ esc_html($uid) }} .shine-showcase__badge {
    margin: 0;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    color: #17338f;
    font-family: "Causten", sans-serif;
    font-size: 18px;
    font-weight: 700;
    line-height: 1;
}

#{{ esc_html($uid) }} .shine-showcase__dot {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: #f5bb14;
    flex-shrink: 0;
}

#{{ esc_html($uid) }} .shine-showcase__bubble {
    position: absolute;
    margin: 0;
    border-radius: 50%;
    overflow: hidden;
}

#{{ esc_html($uid) }} .shine-showcase__bubble img {
    width: 100%;
    height: 100% !important;
    object-fit: cover;
    display: block;
}

#{{ esc_html($uid) }} .shine-showcase__bubble--1 {
    width: 170px;
    height: 170px;
    left: 0;
    top: 0px;
    margin: 14px;
}

#{{ esc_html($uid) }} .shine-showcase__bubble--2 {
    width: 130px;
    height: 130px;
    left: 96px;
    top: 312px;
}

#{{ esc_html($uid) }} .shine-showcase__bubble--3 {
    width: 170px;
    height: 170px;
    right: 0;
    top: 0px;
    margin: 14px;

}

#{{ esc_html($uid) }} .shine-showcase__bubble--4 {
    width: 130px;
    height: 130px;
    right: 96px;
    top: 312px;
}



@media (max-width: 600px) {
    .shine-showcase__title {
        margin-top: 60px !important;
    }
    .shine-showcase__bubble--1 {
        width: 65px !important;
        height: 65px !important;
    left: 0;
    top: 0px !important;
}

.shine-showcase__bubble--3 {
    width: 65px !important;
    height: 65px !important;
    right: 0;
    top: 0px !important;
}


    .shine-showcase__bubble--4 {
        width: 80px !important;
    height: 80px !important;
    right: 0;
    top: -80px !important;
    }



    
    .shine-showcase__bubble--2 {
        width: 80px !important;
    height: 80px !important;
    left: 96px;
    top: -80px !important;

}
    
    .shine-showcase {
      padding-left: 16px;
      padding-right: 16px;
    }
    .shine-showcase img,
    .shine-showcase video {
      max-width: 100%;
      height: auto;
    }
    .shine-showcase [class*="grid"],
    .shine-showcase [class*="cards"],
    .shine-showcase [class*="columns"],
    .shine-showcase [class*="row"] {
      grid-template-columns: 2fr;
    }
}
</style>
