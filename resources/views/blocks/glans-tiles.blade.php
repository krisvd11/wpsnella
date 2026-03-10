<?php

$id = 'glans-tiles-' . uniqid();
$class_name = 'glans-tiles';

if (isset($block)) {
    $id = 'glans-tiles-' . $block['id'];

    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }

    if (!empty($block['className'])) {
        $class_name .= ' ' . $block['className'];
    }

    if (!empty($block['align'])) {
        $class_name .= ' align' . $block['align'];
    }
}

$tiles = [];

$items = get_field('glans_tiles_items');
if (is_array($items)) {
    foreach ($items as $item) {
        $tile_type  = isset($item['tile_type']) ? (string) $item['tile_type'] : 'text';
        $tile_image = isset($item['image']) ? $item['image'] : null;
        $image_id   = (is_array($tile_image) && isset($tile_image['ID'])) ? (int) $tile_image['ID'] : 0;

        $tiles[] = [
            'type'         => $tile_type,
            'text'         => isset($item['text']) ? (string) $item['text'] : '',
            'overlay_text' => isset($item['overlay_text']) ? (string) $item['overlay_text'] : '',
            'image_id'     => $image_id,
            'tile_bg'      => !empty($item['tile_bg']) ? (string) $item['tile_bg'] : '#17338f',
            'text_color'   => !empty($item['text_color']) ? (string) $item['text_color'] : '#ffffff',
        ];
    }
}

$section_bg = get_field('glans_tiles_section_bg') ?: '#ececec';

?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class_name); ?> glans-tiles-block" style="background: <?php echo esc_attr($section_bg); ?>;">
    <div class="glans-tiles-row container">
        <?php if (is_array($tiles) && count($tiles)) : ?>
            <?php foreach ($tiles as $tile) : ?>
                <article class="glans-tile" style="background: <?php echo esc_attr($tile['tile_bg']); ?>;">
                    <?php if ($tile['type'] === 'image' && !empty($tile['image_id'])) : ?>
                        <?php echo wp_kses_post(wp_get_attachment_image((int) $tile['image_id'], 'large')); ?>
                        <?php if (!empty($tile['overlay_text'])) : ?>
                            <p class="glans-tile__overlay" style="color: <?php echo esc_attr($tile['text_color']); ?>;"><?php echo esc_html($tile['overlay_text']); ?></p>
                        <?php endif; ?>
                    <?php else : ?>
                        <p style="color: <?php echo esc_attr($tile['text_color']); ?>;"><?php echo esc_html($tile['text']); ?></p>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        <?php elseif (is_admin()) : ?>
            <p><?php echo esc_html__('Add up to 4 tiles to Glans Tiles Block.', 'brein-plugin'); ?></p>
        <?php endif; ?>
    </div>
</section>

<style>
    .glans-tiles-block {
        padding: 52px 12px;
    }

    .glans-tiles-row {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 17.5px;
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

    .glans-tile:nth-child(2),
    .glans-tile:nth-child(4) {
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

@media (max-width: 600px) {
    .glans-tiles-block {
      padding-left: 16px;
      padding-right: 16px;
    }
    .glans-tiles-block img,
    .glans-tiles-block video {
      max-width: 100%;
      height: auto;
    }

}
</style>
