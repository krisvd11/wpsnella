<?php
$section_bg = (string) (get_field('simple_icon_content_bg') ?: '#d9d9d9');
$inner_bg = (string) (get_field('simple_icon_content_inner_bg') ?: '#efefef');
$title = (string) (get_field('simple_icon_content_title') ?: 'Helemaal onbeperkt');
$text = (string) (get_field('simple_icon_content_text') ?: '');
$title_color = (string) (get_field('simple_icon_content_title_color') ?: '#18328b');
$text_color = (string) (get_field('simple_icon_content_text_color') ?: '#18328b');
$icon = get_field('simple_icon_content_icon');
$show_side_icons = (bool) get_field('simple_icon_content_show_side_icons');
$side_icon_opacity = (float) (get_field('simple_icon_content_side_icon_opacity') ?: 0.2);
$reverse_layout = (bool) get_field('simple_icon_content_reverse_layout');
$button = get_field('simple_icon_content_button');
$side_icon_opacity = max(0, min(1, $side_icon_opacity));
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class_name); ?> simple-icon-content-section" style="background: <?php echo esc_attr($section_bg); ?>;">
    <div class="simple-icon-content__inner container<?php echo $reverse_layout ? ' simple-icon-content__inner--reversed' : ''; ?>" style="background: <?php echo esc_attr($inner_bg); ?>;">
        <div class="simple-icon-content__visual">
            <?php if ($show_side_icons && is_array($icon) && !empty($icon['ID'])) : ?>
                <div class="simple-icon-content__side simple-icon-content__side--left" style="opacity: <?php echo esc_attr((string) $side_icon_opacity); ?>;">
                    <?php echo wp_kses_post(wp_get_attachment_image((int) $icon['ID'], 'large')); ?>
                </div>
            <?php endif; ?>

            <?php if (is_array($icon) && !empty($icon['ID'])) : ?>
                <div class="simple-icon-content__main">
                    <?php echo wp_kses_post(wp_get_attachment_image((int) $icon['ID'], 'large')); ?>
                </div>
            <?php elseif (is_admin()) : ?>
                <p><?php echo esc_html__('Add an icon image to display here.', 'brein-plugin'); ?></p>
            <?php endif; ?>

            <?php if ($show_side_icons && is_array($icon) && !empty($icon['ID'])) : ?>
                <div class="simple-icon-content__side simple-icon-content__side--right" style="opacity: <?php echo esc_attr((string) $side_icon_opacity); ?>;">
                    <?php echo wp_kses_post(wp_get_attachment_image((int) $icon['ID'], 'large')); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="simple-icon-content__content">
            <h3 style="color: <?php echo esc_attr($title_color); ?>;"><?php echo ($title); ?></h3>
            <?php if ($text !== '') : ?>
                <div class="simple-icon-content__text" style="color: <?php echo esc_attr($text_color); ?>;">
                    <?php echo (wpautop($text)); ?>
                </div>
            <?php endif; ?>

            <?php if (is_array($button) && !empty($button['url']) && !empty($button['title'])) : ?>
                <a class="brein-section-button simple-icon-content__button" href="<?php echo esc_url($button['url']); ?>" <?php echo !empty($button['target']) ? 'target="' . esc_attr($button['target']) . '"' : ''; ?>>
                    <?php echo esc_html($button['title']); ?><span class="cta-arrow" aria-hidden="true">→</span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
    .simple-icon-content-section {
        padding: 40px 20px;
    }

    .cta-arrow {
        margin-left: 10px;
    }

    .simple-icon-content__inner {
        border-radius: 30px;
        padding: 34px 36px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        align-items: center;
    }
    
    .simple-icon-content__inner--reversed .simple-icon-content__visual {
        order: 2;
    }

    .simple-icon-content__inner--reversed .simple-icon-content__content {
        order: 1;
    }

    .simple-icon-content__visual {
        min-height: 320px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .simple-icon-content__main,
    .simple-icon-content__side {
        position: absolute;
        width: 52%;
    }

    .simple-icon-content__main {
        position: relative;
        width: 62%;
        z-index: 2;
    }

    .simple-icon-content__main img,
    .simple-icon-content__side img {
        width: 100%;
        height: auto;
        display: block;
    }

    .simple-icon-content__side--left {
        left: -20%;
        z-index: 1;
    }

    .simple-icon-content__side--right {
        right: -18%;
        z-index: 1;
    }



    .simple-icon-content__text {
        font-size: clamp(20px, 1.7vw, 32px);
        line-height: 1.45;
    }

    .simple-icon-content__text p {
        margin: 0 0 8px;
    }

    .simple-icon-content__text p:last-child {
        margin-bottom: 0;
    }

    .simple-icon-content__button {
        margin-top: 20px;
        display: inline-flex;
        background: transparent;
        color: #0f2a84;
        font-family: 'Causten', sans-serif;
        font-size: 20px;
    }

    @media (max-width: 600px) {
        .simple-icon-content__inner {
            grid-template-columns: 1fr;
            gap: 18px;
            padding: 24px 18px;
        }

        .simple-icon-content__content {
            order: 2 !important;
        }

        .simple-icon-content__visual {
            min-height: 220px;
        }

        .simple-icon-content__main {
            width: 100%;
            margin-top: -130px;
            z-index: 200;
        }

        .simple-icon-content__side {
            width: 45%;
        }

        .simple-icon-content__side--left {
            left: -10%;
        }

        .simple-icon-content__side--right {
            right: -10%;
        }
    }

@media (max-width: 600px) {
    .simple-icon-content-section {
      padding-left: 16px;
      padding-right: 16px;
    }
    .simple-icon-content-section img,
    .simple-icon-content-section video {
      max-width: 100%;
      height: auto;
    }
    .simple-icon-content-section [class*="grid"],
    .simple-icon-content-section [class*="cards"],
    .simple-icon-content-section [class*="columns"],
    .simple-icon-content-section [class*="row"] {
      grid-template-columns: 1fr;
    }
}
</style>
