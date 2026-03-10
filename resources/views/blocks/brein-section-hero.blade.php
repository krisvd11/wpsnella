<?php
$title  = (string) (get_field('title') ?: 'Hero title');
$text   = (string) (get_field('text') ?: 'Short intro text for this hero section.');
$button = get_field('button');
$image  = get_field('hero_image');
$checks = get_field('hero_checks');
$checks = is_array($checks) ? $checks : array();

$section_bg = (string) (get_field('hero_section_bg') ?: '#d9d9d9');
$title_color = (string) (get_field('hero_title_color') ?: '#f2bb13');
$text_color = (string) (get_field('hero_text_color') ?: '#18328b');
$check_color = (string) (get_field('hero_check_color') ?: '#f2bb13');
$button_bg = (string) (get_field('hero_button_bg') ?: '#f2bb13');
$button_text_color = (string) (get_field('hero_button_text_color') ?: '#ffffff');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class_name); ?> brein-hero-v2" style="background: <?php echo esc_attr($section_bg); ?>;">
    <div class="brein-section-inner container brein-hero-inner-v2">
        <div class="brein-hero-v2__media">
            <?php if (is_array($image) && !empty($image['ID'])) : ?>
                <?php echo wp_kses_post(wp_get_attachment_image((int) $image['ID'], 'large', false, array('class' => 'brein-hero-v2__image'))); ?>
            <?php elseif (is_admin()) : ?>
                <p><?php echo esc_html__('Add a hero image.', 'brein-plugin'); ?></p>
            <?php endif; ?>
        </div>

        <div class="brein-hero-v2__content">
            <h1 style="color: <?php echo esc_attr($title_color); ?>;"><?php echo ($title); ?></h1>
            <div class="brein-hero-v2__text" style="color: <?php echo esc_attr($text_color); ?>;">
                <?php echo wp_kses_post(wpautop($text)); ?>
            </div>

            <?php if (!empty($checks)) : ?>
                <ul class="brein-hero-v2__checks">
                    <?php foreach ($checks as $check) : ?>
                        <?php $check_text = isset($check['check_text']) ? (string) $check['check_text'] : ''; ?>
                        <?php if ($check_text === '') : continue; endif; ?>
                        <li>

                            <span class="brein-hero-v2__check-icon">


                                <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="<?php echo esc_attr($check_color); ?>" version="1.1" id="Capa_1" width="20px" height="20px" viewBox="0 0 78.369 78.369" xml:space="preserve"> <g> <path d="M78.049,19.015L29.458,67.606c-0.428,0.428-1.121,0.428-1.548,0L0.32,40.015c-0.427-0.426-0.427-1.119,0-1.547l6.704-6.704   c0.428-0.427,1.121-0.427,1.548,0l20.113,20.112l41.113-41.113c0.429-0.427,1.12-0.427,1.548,0l6.703,6.704   C78.477,17.894,78.477,18.586,78.049,19.015z"></path> </g> </svg>
                            </span>
                            <span style="color: <?php echo esc_attr($text_color); ?>;"><?php echo esc_html($check_text); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if (is_array($button) && !empty($button['url']) && !empty($button['title'])) : ?>
                <a class="brein-section-button brein-hero-v2__button" style="background: <?php echo esc_attr($button_bg); ?>; color: <?php echo esc_attr($button_text_color); ?>;" href="<?php echo esc_url($button['url']); ?>" <?php echo !empty($button['target']) ? 'target="' . esc_attr($button['target']) . '"' : ''; ?>>
                    <span><?php echo esc_html($button['title']); ?></span>
                        <span class="arrow-svg"><svg xmlns="http://www.w3.org/2000/svg" width="32.611" height="19.338" viewBox="0 0 32.611 19.338">
                            <g id="Group_459" data-name="Group 459" transform="translate(-251.811 -660.331)">
                              <path id="Path_214" data-name="Path 214" d="M-3441.939-7041h29.205" transform="translate(3695 7711)" fill="none" stroke="#18328b" stroke-linecap="round" stroke-width="2.5"></path>
                              <path id="Path_215" data-name="Path 215" d="M-3405.73-7048.316l7.9,7.9-7.9,7.9" transform="translate(3681 7710.415)" fill="none" stroke="#18328b" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
                            </g>
                          </svg></span>                      </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
    .brein-hero-v2 {
        padding: 14px 8px 24px;
    }

    .brein-hero-inner-v2 {
        display: grid;
        gap: 60px;
        grid-template-columns: minmax(0, 1fr) minmax(0, 0.9fr);
        align-items: center;
    }

    .brein-hero-v2__media {
        border-radius: 12px;
        overflow: hidden;
    }

    .brein-hero-v2__image {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
        min-height: 420px;
    }

    .brein-hero-v2__content h2 {
        margin: 0 0 16px;
        font-size: clamp(52px, 6vw, 96px);
        line-height: 0.94;
    }

    .brein-hero-v2__text {
        font-size: clamp(22px, 1.7vw, 34px);
        line-height: 1.45;
        margin-bottom: 18px;
    }

    .brein-hero-v2__checks {
        margin: 0 0 26px;
        padding: 0;
        list-style: none;
        display: grid;
        gap: 10px;
    }

    .brein-hero-v2__checks li {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 18px;
        line-height: 1.2;
        font-weight: 700;
        font-family: 'Causten', sans-serif;
    }

    

    .brein-hero-v2__check-icon {
        font-size: 1.1em;
        line-height: 1;
        padding-top: 6px;
    }

    .brein-hero-v2__button {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        border-radius: 999px;
        padding: 15px 30px;
        font-size: 18px;
        font-weight: 700;
        color: #18328b !important;
        font-family: 'Causten', sans-serif;
    }

    .brein-hero-v2__button-arrow {
        line-height: 1;
    }

    @media (max-width: 900px) {
        .brein-hero-inner-v2 {
            grid-template-columns: 1fr;
        }

        .brein-hero-v2__image {
            min-height: 280px;
        }
    }

@media (max-width: 600px) {
    .brein-hero-v2 {
      padding-left: 16px;
      padding-right: 16px;
    }
    .brein-hero-v2 img,
    .brein-hero-v2 video {
      max-width: 100%;
      height: auto;
    }
    .brein-hero-v2 [class*="grid"],
    .brein-hero-v2 [class*="cards"],
    .brein-hero-v2 [class*="columns"],
    .brein-hero-v2 [class*="row"] {
      grid-template-columns: 1fr;
    }
}
</style>
