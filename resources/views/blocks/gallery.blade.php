<section id="{{ esc_attr($uid) }}" class="gallery-showcase">
    <div class="gallery-showcase__container">
        <div class="gallery-showcase__content">
            <h2 class="gallery-showcase__title">
                <span class="gallery-showcase__title-top">{{ esc_html($headingTop) }}</span>
                <span class="gallery-showcase__title-bottom">{{ esc_html($headingBottom) }}</span>
            </h2>

            @if (!empty($description))
                <p class="gallery-showcase__description">{!! wp_kses_post($description) !!}</p>
            @endif

            <div class="gallery-showcase__actions">
                <a class="gallery-showcase__cta" href="{{ esc_url($ctaUrl) }}">
                    <span>{{ esc_html($ctaText) }}</span>
                    <span class="gallery-showcase__cta-arrow" aria-hidden="true">&rarr;</span>
                </a>

                <p class="gallery-showcase__badge">
                    <span class="gallery-showcase__dot" aria-hidden="true"></span>
                    <span>{{ esc_html($badgeText) }}</span>
                </p>
            </div>
        </div>

        @for ($i = 0; $i < 4; $i++)
            @if (isset($imageIds[$i]))
                <figure class="gallery-showcase__bubble gallery-showcase__bubble--{{ $i + 1 }}">
                    {!! wp_get_attachment_image($imageIds[$i], 'medium_large') !!}
                </figure>
            @endif
        @endfor
    </div>

    @if (is_admin() && count($imageIds) < 4)
        <p class="gallery-showcase__hint">{{ esc_html__('Tip: add 4 images to match the designed layout.', 'test') }}</p>
    @endif
</section>

<style>
#{{ esc_html($uid) }} {
    padding: 60px 24px;
    overflow: hidden;
    width: 100%;
}

#{{ esc_html($uid) }} .gallery-showcase__container {
    margin: 0 auto;
    position: relative;
    min-height: 390px;
    width: 100%;
}

#{{ esc_html($uid) }} .gallery-showcase__content {
    max-width: 640px;
    margin: 0 auto;
    text-align: center;
    position: relative;
    z-index: 2;
}

#{{ esc_html($uid) }} .gallery-showcase__title {
    margin: 0 0 24px;
    line-height: 0.95;
}

#{{ esc_html($uid) }} .gallery-showcase__title-top,
#{{ esc_html($uid) }} .gallery-showcase__title-bottom {
    display: block;
    font-family: "Causten", sans-serif;
    font-size: clamp(42px, 6vw, 74px);
    font-weight: 700;
}

#{{ esc_html($uid) }} .gallery-showcase__title-top {
    color: #f5bb14;
}

#{{ esc_html($uid) }} .gallery-showcase__title-bottom {
    color: #17338f;
}

#{{ esc_html($uid) }} .gallery-showcase__description {
    color: #17338f;

}

#{{ esc_html($uid) }} .gallery-showcase__actions {
    margin-top: 34px;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 24px;
    flex-wrap: wrap;
}

#{{ esc_html($uid) }} .gallery-showcase__cta {
    display: inline-flex;
    align-items: center;
    gap: 16px;
    padding: 16px 30px;
    border-radius: 999px;
    background: #f5bb14;
    color: #17338f;
    text-decoration: none;
    font-family: "Causten", sans-serif;
    font-size: 33px;
    font-weight: 700;
    line-height: 1;
}

#{{ esc_html($uid) }} .gallery-showcase__cta-arrow {
    font-size: 49px;
    line-height: 1;
    margin-top: -2px;
}

#{{ esc_html($uid) }} .gallery-showcase__badge {
    margin: 0;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    color: #17338f;
    font-family: "Causten", sans-serif;
    font-size: 39px;
    font-weight: 700;
    line-height: 1;
}

#{{ esc_html($uid) }} .gallery-showcase__dot {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: #f5bb14;
    flex-shrink: 0;
}

#{{ esc_html($uid) }} .gallery-showcase__bubble {
    position: absolute;
    margin: 0;
    border-radius: 50%;
    overflow: hidden;
    z-index: 1;
}

#{{ esc_html($uid) }} .gallery-showcase__bubble img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

#{{ esc_html($uid) }} .gallery-showcase__bubble--1 {
    width: 120px;
    height: 120px;
    top: 0;
    left: 0;
}

#{{ esc_html($uid) }} .gallery-showcase__bubble--2 {
    width: 96px;
    height: 96px;
    left: 120px;
    top: 180px;
}

#{{ esc_html($uid) }} .gallery-showcase__bubble--3 {
    width: 120px;
    height: 120px;
    top: 0;
    right: 0;
}

#{{ esc_html($uid) }} .gallery-showcase__bubble--4 {
    width: 96px;
    height: 96px;
    right: 90px;
    top: 190px;
}

#{{ esc_html($uid) }} .gallery-showcase__hint {
    margin: 20px auto 0;
    max-width: 1180px;
    text-align: center;
    color: #17338f;
}

@media (max-width: 1024px) {
    #{{ esc_html($uid) }} .gallery-showcase__description {
        font-size: 22px;
    }

    #{{ esc_html($uid) }} .gallery-showcase__cta {
        font-size: 24px;
    }

    #{{ esc_html($uid) }} .gallery-showcase__badge {
        font-size: 28px;
    }

    #{{ esc_html($uid) }} .gallery-showcase__bubble--1,
    #{{ esc_html($uid) }} .gallery-showcase__bubble--3 {
        width: 86px;
        height: 86px;
    }

    #{{ esc_html($uid) }} .gallery-showcase__bubble--2,
    #{{ esc_html($uid) }} .gallery-showcase__bubble--4 {
        width: 72px;
        height: 72px;
        top: 210px;
    }

    #{{ esc_html($uid) }} .gallery-showcase__bubble--2 {
        left: 40px;
    }

    #{{ esc_html($uid) }} .gallery-showcase__bubble--4 {
        right: 24px;
    }
}

@media (max-width: 767px) {
    #{{ esc_html($uid) }} {
        padding: 36px 16px;
    }

    #{{ esc_html($uid) }} .gallery-showcase__container {
        min-height: 0;
    }

    #{{ esc_html($uid) }} .gallery-showcase__description {
        font-size: 18px;
    }

    #{{ esc_html($uid) }} .gallery-showcase__cta {
        font-size: 19px;
        padding: 13px 20px;
    }

    #{{ esc_html($uid) }} .gallery-showcase__cta-arrow {
        font-size: 32px;
    }

    #{{ esc_html($uid) }} .gallery-showcase__badge {
        font-size: 22px;
    }

    #{{ esc_html($uid) }} .gallery-showcase__bubble {
        display: none;
    }
}
</style>
