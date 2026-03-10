<?php
$section_bg = (string) (get_field('unlimited_bg') ?: '#d9d9d9');
$inner_bg = (string) (get_field('unlimited_inner_bg') ?: '#efefef');
$title = (string) (get_field('unlimited_title') ?: 'Waarom Snella Unlimited');
$text_color = (string) (get_field('unlimited_text_color') ?: '#18328b');
$tile_bg = (string) (get_field('unlimited_tile_bg') ?: '#e7e7e7');
$accent_color = (string) (get_field('unlimited_accent_color') ?: '#f2b90f');
$price_bg = (string) (get_field('unlimited_price_bg') ?: '#f2bd13');
$price_text_color = (string) (get_field('unlimited_price_text_color') ?: '#18328b');
$button_bg = (string) (get_field('unlimited_button_bg') ?: '#1a3592');
$button_text_color = (string) (get_field('unlimited_button_text_color') ?: '#ffffff');
$items = get_field('unlimited_items');
$items = is_array($items) ? $items : array();
$button = get_field('unlimited_button');
$note = (string) (get_field('unlimited_note') ?: '');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class_name); ?> unlimited-benefits-section" style="background: <?php echo esc_attr($section_bg); ?>;">
    <div class="unlimited-benefits__inner container" style="background: <?php echo esc_attr($inner_bg); ?>; --unlimited-text: <?php echo esc_attr($text_color); ?>; --unlimited-tile: <?php echo esc_attr($tile_bg); ?>; --unlimited-accent: <?php echo esc_attr($accent_color); ?>; --unlimited-price-bg: <?php echo esc_attr($price_bg); ?>; --unlimited-price-text: <?php echo esc_attr($price_text_color); ?>; --unlimited-btn-bg: <?php echo esc_attr($button_bg); ?>; --unlimited-btn-text: <?php echo esc_attr($button_text_color); ?>;">
        <?php if ($title !== '') : ?>
            <h3 class="unlimited-benefits__title"><?php echo ($title); ?></h3>
        <?php endif; ?>

        <?php if (!empty($items)) : ?>
            <div class="unlimited-benefits__grid">
                <?php foreach ($items as $item) : ?>
                    <?php
                    $item_type = isset($item['item_type']) ? (string) $item['item_type'] : 'feature';
                    ?>
                    <?php if ($item_type === 'price') : ?>
                        <article class="unlimited-benefits__tile unlimited-benefits__tile--price">
                            <p class="unlimited-benefits__price"><?php echo esc_html((string) ($item['price'] ?? '€39')); ?></p>
                            <p class="unlimited-benefits__price-subtext"><?php echo esc_html((string) ($item['price_subtext'] ?? 'per maand')); ?></p>
                        </article>
                    <?php else : ?>
                        <?php $icon = isset($item['icon']) && is_array($item['icon']) ? $item['icon'] : null; ?>
                        <article class="unlimited-benefits__tile unlimited-benefits__tile--feature">
                            <?php if ($icon && !empty($icon['ID'])) : ?>
                                <div class="unlimited-benefits__icon-wrap">
                                    <?php echo wp_kses_post(wp_get_attachment_image((int) $icon['ID'], 'thumbnail', false, array('class' => 'unlimited-benefits__icon'))); ?>
                                </div>
                            <?php endif; ?>
                            <p class="unlimited-benefits__tile-text"><?php echo esc_html((string) ($item['text'] ?? '')); ?></p>
                        </article>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php elseif (is_admin()) : ?>
            <p><?php echo esc_html__('Add grid items to build this section.', 'brein-plugin'); ?></p>
        <?php endif; ?>

        <?php if (is_array($button) && !empty($button['url']) && !empty($button['title'])) : ?>
            <div class="unlimited-benefits__cta-wrap">
                <a class="unlimited-benefits__cta" href="<?php echo esc_url($button['url']); ?>" <?php echo !empty($button['target']) ? 'target="' . esc_attr($button['target']) . '"' : ''; ?>>
                    <?php echo esc_html($button['title']); ?><span class="cta-arrow" aria-hidden="true">→</span>
                </a>
            </div>
        <?php endif; ?>

        <?php if ($note !== '') : ?>
            <p class="unlimited-benefits__note"><?php echo esc_html($note); ?></p>
        <?php endif; ?>
    </div>
</section>

<style>
    .cta-arrow {
        margin-left: 10px;
    }
    .unlimited-benefits-section {
        max-width: 1350px;
    }

    .unlimited-benefits__inner {
        border-radius: 34px;
        padding: 40px;
        color: var(--unlimited-text);
    }

    .unlimited-benefits__title {
        color: var(--unlimited-text);
        text-align: center;
        margin: 0 0 54px !important;
    }

    .unlimited-benefits__grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 20px;
        max-width: 1100px;
        width: 100%;
        margin: auto;
    }

    .unlimited-benefits__tile {
        border-radius: 30px;
        min-height: 186px;
    }

    .unlimited-benefits__tile--feature {
        background: var(--unlimited-tile);
        display: grid;
        justify-items: center;
        text-align: center;
        align-content: center;
        gap: 14px;
        padding: 22px 28px;
    }

    .unlimited-benefits__icon-wrap {
        width: 72px;
        height: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .unlimited-benefits__icon {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .unlimited-benefits__tile-text {
        margin: 0;
        color: var(--unlimited-text);
        font-size: clamp(18px, 1.45vw, 30px);
        font-weight: 700;
        line-height: 1.12;
        font-family: 'Causten', sans-serif;
    }

    .unlimited-benefits__tile--price {
        background: var(--unlimited-price-bg);
        color: var(--unlimited-price-text);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 16px;
    }

    .unlimited-benefits__price {
        margin: 0;
        font-size: clamp(60px, 5.2vw, 96px);
        line-height: 0.96;
        font-weight: 700;
    }

    .unlimited-benefits__price-subtext {
        margin: 8px 0 0 !important;
        line-height: 1;
        color: white;
    }

    .unlimited-benefits__cta-wrap {
        display: flex;
        justify-content: center;
        margin-top: 38px;
    }

    .unlimited-benefits__cta {
        background: var(--unlimited-btn-bg);
        color: var(--unlimited-btn-text);
        text-decoration: none;
        font-size: 18px;
        font-weight: 700;
        line-height: 1;
        border-radius: 999px;
        padding: 15px 30px;
    }

    .unlimited-benefits__note {
        margin: 28px 0 0 !important;
        text-align: center;
        color: var(--unlimited-text);
        line-height: 1.2;
    }

    @media (max-width: 1100px) {
        .unlimited-benefits__grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 680px) {
        .unlimited-benefits__inner {
            border-radius: 24px;
            padding: 34px 18px;
        }

        .unlimited-benefits__grid {
            grid-template-columns: 1fr;
        }

        .unlimited-benefits__tile {
            min-height: 140px;
            border-radius: 20px;
        }

        .unlimited-benefits__cta {
            font-size: 22px;
            padding: 14px 26px;
        }
    }

@media (max-width: 600px) {

    .unlimited-benefits__tile-text {
        max-width: 120px;
    }
    .unlimited-benefits__inner {
        padding: 0px 20px !important;
    }
    .unlimited-benefits-section {
      padding-left: 16px;
      padding-right: 16px;
    }
    .unlimited-benefits-section img,
    .unlimited-benefits-section video {
      max-width: 100%;
      height: auto;
    }
    .unlimited-benefits-section [class*="grid"],
    .unlimited-benefits-section [class*="cards"],
    .unlimited-benefits-section [class*="columns"],
    .unlimited-benefits-section [class*="row"] {
      grid-template-columns: 1fr;
    }
}
</style>
