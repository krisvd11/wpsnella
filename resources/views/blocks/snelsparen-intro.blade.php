<section id="{{ esc_attr($uid) }}" class="snelsparen-intro" style="background: {{ esc_attr($sectionBg) }};">
    <div class="snelsparen-intro__wrap">
        <div class="snelsparen-intro__sides snelsparen-intro__sides--left">
            @foreach ($leftImageIds as $imageId)
                <div class="snelsparen-intro__bubble">
                    {!! wp_get_attachment_image($imageId, 'medium_large') !!}
                </div>
            @endforeach
        </div>

        <div class="snelsparen-intro__content">
            <h2 class="snelsparen-intro__heading">
                <span class="snelsparen-intro__line-one">
                    <span class="snelsparen-intro__accent" style="color: {{ esc_attr($headingAccentColor) }};">
                        {{ esc_html($headingLineOneAccent) }}
                    </span>
                    <span class="snelsparen-intro__base" style="color: {{ esc_attr($headingBaseColor) }};">
                        {{ esc_html($headingLineOneBase) }}
                    </span>
                </span>
                <span class="snelsparen-intro__line-two" style="color: {{ esc_attr($headingBaseColor) }};">
                    {{ esc_html($headingLineTwo) }}
                </span>
            </h2>

            @if (!empty($description))
                <p class="snelsparen-intro__description" style="color: {{ esc_attr($descriptionColor) }};">
                    {!! nl2br(esc_html($description)) !!}
                </p>
            @endif
        </div>

        <div class="snelsparen-intro__sides snelsparen-intro__sides--right">
            @foreach ($rightImageIds as $imageId)
                <div class="snelsparen-intro__bubble">
                    {!! wp_get_attachment_image($imageId, 'medium_large') !!}
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
#{{ esc_html($uid) }} {
    padding: 70px 20px 56px;
}

#{{ esc_html($uid) }} .snelsparen-intro__wrap {
    max-width: 1240px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 170px minmax(0, 1fr) 170px;
    gap: 24px;
    align-items: center;
}

#{{ esc_html($uid) }} .snelsparen-intro__sides {
    display: flex;
    flex-direction: column;
    gap: 26px;
}

#{{ esc_html($uid) }} .snelsparen-intro__sides--left .snelsparen-intro__bubble:nth-child(1),
#{{ esc_html($uid) }} .snelsparen-intro__sides--right .snelsparen-intro__bubble:nth-child(1) {
    width: 114px;
    height: 114px;
}

#{{ esc_html($uid) }} .snelsparen-intro__sides--left .snelsparen-intro__bubble:nth-child(2),
#{{ esc_html($uid) }} .snelsparen-intro__sides--right .snelsparen-intro__bubble:nth-child(2) {
    width: 94px;
    height: 94px;
    margin-left: auto;
}

#{{ esc_html($uid) }} .snelsparen-intro__bubble {
    border-radius: 50%;
    overflow: hidden;
}

#{{ esc_html($uid) }} .snelsparen-intro__bubble img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

#{{ esc_html($uid) }} .snelsparen-intro__content {
    text-align: center;
    max-width: 700px;
    margin: 0 auto;
}

#{{ esc_html($uid) }} .snelsparen-intro__heading {
    margin: 0;
    font-family: "Causten", sans-serif;
    font-size: clamp(48px, 4.4vw, 72px);
    line-height: 0.95;
    font-weight: 700;
}

#{{ esc_html($uid) }} .snelsparen-intro__line-one {
    display: block;
}

#{{ esc_html($uid) }} .snelsparen-intro__line-two {
    display: block;
}

#{{ esc_html($uid) }} .snelsparen-intro__description {
    margin: 26px auto 0;
    font-family: "Causten regular", sans-serif;
    line-height: 1.5;
    width: 100%;
}

.snelsparen-intro__sides.snelsparen-intro__sides--right {
    display: flex;
    flex-direction: column-reverse !important;
}

@media (max-width: 900px) {
    #{{ esc_html($uid) }} .snelsparen-intro__wrap {
        grid-template-columns: 1fr;
        gap: 22px;
    }

    #{{ esc_html($uid) }} .snelsparen-intro__sides {
        flex-direction: row;
        justify-content: center;
    }

    #{{ esc_html($uid) }} .snelsparen-intro__sides--left .snelsparen-intro__bubble:nth-child(2),
    #{{ esc_html($uid) }} .snelsparen-intro__sides--right .snelsparen-intro__bubble:nth-child(2) {
        margin-left: 0;
    }
}
</style>
