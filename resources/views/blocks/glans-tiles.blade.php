<section id="{{ esc_attr($uid) }}" class="glans-tiles-block" style="background: {{ esc_attr($sectionBg) }};">
    <div class="glans-tiles-row">
        @if (is_array($tiles) && count($tiles))
            @foreach ($tiles as $tile)
                <article class="glans-tile" style="background: {{ esc_attr($tile['tileBg']) }};">
                    @if ($tile['type'] === 'image' && !empty($tile['imageId']))
                        {!! wp_get_attachment_image((int) $tile['imageId'], 'large') !!}
                        @if (!empty($tile['overlayText']))
                            <p class="glans-tile__overlay" style="color: {{ esc_attr($tile['textColor']) }};">{{ esc_html($tile['overlayText']) }}</p>
                        @endif
                    @else
                        <p style="color: {{ esc_attr($tile['textColor']) }};">{{ esc_html($tile['text']) }}</p>
                    @endif
                </article>
            @endforeach
        @elseif (is_admin())
            <p>{{ esc_html__('Add up to 4 tiles to Glans Tiles Block.', 'test') }}</p>
        @endif
    </div>
</section>

<style>
.glans-tiles-block {
    padding: 52px 12px;
}

.glans-tiles-row {
    max-width: 1000px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 32px;
}

.glans-tile {
    height: 200px;
    border-radius: 30px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.glans-tile:nth-child(2) ,.glans-tile:nth-child(4) {
    margin-top: 30px !important;
}

.glans-tile p {
    margin-bottom: 18px !important;
    font-family: "Causten", sans-serif;
    font-size: clamp(56px, 5.4vw, 66px);
    font-weight: 700;
    line-height: 0.95;
    text-align: center;
}

.glans-tile img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.glans-tile__overlay {
    position: absolute;
    inset: 0;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 16px;
    font-family: "Causten", sans-serif;
    font-size: clamp(56px, 5.4vw, 86px);
    font-weight: 700;
    line-height: 0.95;
    pointer-events: none;
}

@media (max-width: 1320px) {
    .glans-tiles-row {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 720px) {
    .glans-tiles-row {
        grid-template-columns: 1fr;
        gap: 18px;
    }

    .glans-tile {
        min-height: 180px;
        border-radius: 20px;
    }

    .glans-tile p {
        font-size: clamp(42px, 13vw, 64px);
    }

    .glans-tile__overlay {
        font-size: clamp(42px, 13vw, 64px);
    }
}
</style>
