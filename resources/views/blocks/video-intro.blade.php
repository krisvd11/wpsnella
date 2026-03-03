<section id="{{ esc_attr($uid) }}" class="video-intro-block" style="background: {{ esc_attr($sectionBg) }};">
    <div class="video-intro-wrap">
        <div class="video-intro-left">
            @if (!empty($videoUrl))
                <video autoplay muted loop playsinline>
                    <source src="{{ esc_url($videoUrl) }}" type="video/mp4">
                </video>
            @endif
            <span class="video-intro-overlay" aria-hidden="true"></span>
        </div>

        <div class="video-intro-right">
            @if (!empty($badgeText))
                <p class="video-intro-badge" style="background: {{ esc_attr($badgeBg) }}; color: {{ esc_attr($headingColor) }};">
                    <span class="video-intro-badge-dot" aria-hidden="true"></span>
                    <span>{{ esc_html($badgeText) }}</span>
                </p>
            @endif

            @if (!empty($headingHtml))
                <h2 class="video-intro-title" style="color: {{ esc_attr($headingColor) }};">
                    {!! wp_kses($headingHtml, $allowedHeadingHtml) !!}
                </h2>
            @endif

            @if (!empty($description))
                <p class="video-intro-text" style="color: {{ esc_attr($textColor) }};">
                    {!! wp_kses_post($description) !!}
                </p>
            @endif
        </div>
    </div>
</section>

<style>
.video-intro-block {
    padding: 14px 18px;
}

.video-intro-wrap {
    max-width: 1320px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
    gap: 54px;
    align-items: stretch;
}

.video-intro-left {
    position: relative;
    border-radius: 34px;
    overflow: hidden;
    min-height: 720px;
    background: #17338f;
}

.video-intro-left video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.video-intro-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(37, 161, 241, 0.55) 0%, rgba(20, 47, 150, 0.62) 100%);
    pointer-events: none;
}

.video-intro-right {
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 30px 6px 30px 0;
}

.video-intro-badge {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px !important;
    border-radius: 12px;
    font-family: "Causten", sans-serif;
    font-size: 18px;
    font-weight: 700;
    width: fit-content;
}

.video-intro-badge-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #26a87d;
    flex-shrink: 0;
}

.video-intro-title {
    margin: 0 0 24px;
    font-family: "Causten", sans-serif;
    font-size: clamp(66px, 6vw, 93px);
    line-height: 0.95;
    font-weight: 700;
}

.video-intro-text {
    margin: 0;
    font-family: "Causten regular", sans-serif;
    font-size: 21px; !important;
    padding-right: 100px !important;
    line-height: 1.45;
    max-width: 760px;
}

@media (max-width: 1120px) {
    .video-intro-wrap {
        grid-template-columns: 1fr;
    }

    .video-intro-left {
        min-height: 420px;
    }

    .video-intro-right {
        padding: 8px 4px 20px;
    }

    .video-intro-title {
        font-size: clamp(48px, 10vw, 76px);
    }

    .video-intro-text {
        font-size: clamp(22px, 4.5vw, 32px);
    }
}
</style>
