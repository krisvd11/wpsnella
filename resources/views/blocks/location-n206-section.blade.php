<?php
$section_bg = (string) (get_field('location_n206_section_bg') ?: '#ececec');
$inner_bg = (string) (get_field('location_n206_inner_bg') ?: '#f0f0f0');
$card_bg = (string) (get_field('location_n206_card_bg') ?: '#e9e9e9');
$title_line_1 = (string) (get_field('location_n206_title_line_1') ?: 'Snella Autowas');
$title_line_2 = (string) (get_field('location_n206_title_line_2') ?: 'Aan de N206');
$intro = (string) (get_field('location_n206_intro') ?: '');
$features_title = (string) (get_field('location_n206_features_title') ?: 'Hier vind je:');
$features = get_field('location_n206_features');
$features = is_array($features) ? $features : array();
$contact_title = (string) (get_field('location_n206_contact_title') ?: 'Snella Autowas N206');
$address = (string) (get_field('location_n206_address') ?: '');
$phone = (string) (get_field('location_n206_phone') ?: '');
$email = (string) (get_field('location_n206_email') ?: '');
$hours_title = (string) (get_field('location_n206_hours_title') ?: 'Openingstijden');
$hours = get_field('location_n206_hours');
$hours = is_array($hours) ? $hours : array();
$gallery = get_field('location_n206_gallery');
$gallery = is_array($gallery) ? $gallery : array();
$title_color = (string) (get_field('location_n206_title_color') ?: '#17338f');
$accent_color = (string) (get_field('location_n206_accent_color') ?: '#f2bb13');
$text_color = (string) (get_field('location_n206_text_color') ?: '#17338f');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class_name); ?> location-n206-section" style="background: <?php echo esc_attr($section_bg); ?>;">
    <div class="location-n206__inner container" style="background: <?php echo esc_attr($inner_bg); ?>; --loc-title: <?php echo esc_attr($title_color); ?>; --loc-accent: <?php echo esc_attr($accent_color); ?>; --loc-text: <?php echo esc_attr($text_color); ?>; --loc-card: <?php echo esc_attr($card_bg); ?>;">
        <div class="location-n206__top">
            <div class="location-n206__left">
                <h2 class="location-n206__title">
                    <span class="location-n206__title-main"><?php echo esc_html($title_line_1); ?></span>
                    <span class="location-n206__title-accent"><?php echo esc_html($title_line_2); ?></span>
                </h2>

                <?php if ($intro !== '') : ?>
                    <p class="location-n206__intro"><?php echo nl2br(esc_html($intro)); ?></p>
                <?php endif; ?>

                <div class="location-n206__features">
                    <?php if ($features_title !== '') : ?>
                        <h6 class="location-n206__features-title"><?php echo esc_html($features_title); ?></h6>
                    <?php endif; ?>

                    <?php if (!empty($features)) : ?>
                        <ul class="location-n206__features-list">
                            <?php foreach ($features as $feature) : ?>
                                <?php $feature_text = isset($feature['text']) ? (string) $feature['text'] : ''; ?>
                                <?php if ($feature_text !== '') : ?>
                                    <li>
                                        <svg class="location-n206__check" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" width="20px" height="20px" viewBox="0 0 78.369 78.369" xml:space="preserve"> <g> <path d="M78.049,19.015L29.458,67.606c-0.428,0.428-1.121,0.428-1.548,0L0.32,40.015c-0.427-0.426-0.427-1.119,0-1.547l6.704-6.704   c0.428-0.427,1.121-0.427,1.548,0l20.113,20.112l41.113-41.113c0.429-0.427,1.12-0.427,1.548,0l6.703,6.704   C78.477,17.894,78.477,18.586,78.049,19.015z"></path> </g> </svg>
                                        <span><?php echo esc_html($feature_text); ?></span>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <aside class="location-n206__right">
                <?php if ($contact_title !== '') : ?>
                    <h6 class="location-n206__contact-title"><?php echo esc_html($contact_title); ?></h6>
                <?php endif; ?>

                <?php if ($address !== '') : ?>
                    <p class="location-n206__address"><?php echo nl2br(esc_html($address)); ?></p>
                <?php endif; ?>

                <?php if ($phone !== '' || $email !== '') : ?>
                    <div class="location-n206__contact-lines">
                        <?php if ($phone !== '') : ?>
                            <p>Telefoon: <?php echo esc_html($phone); ?></p>
                        <?php endif; ?>
                        <?php if ($email !== '') : ?>
                            <p>Email: <?php echo esc_html($email); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if ($hours_title !== '') : ?>
                    <h6 class="location-n206__hours-title"><?php echo esc_html($hours_title); ?></h6>
                <?php endif; ?>

                <?php if (!empty($hours)) : ?>
                    <div class="location-n206__hours-list">
                        <?php foreach ($hours as $row) : ?>
                            <?php
                            $day = isset($row['day']) ? (string) $row['day'] : '';
                            $time = isset($row['time']) ? (string) $row['time'] : '';
                            if ($day === '' && $time === '') {
                                continue;
                            }
                            ?>
                            <div class="location-n206__hours-row">
                                <span><?php echo esc_html($day); ?></span>
                                <span><?php echo esc_html($time); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </aside>
        </div>

        <?php if (!empty($gallery)) : ?>
            <div class="location-n206__gallery">
                <?php foreach ($gallery as $item) : ?>
                    <?php $img = isset($item['image']) && is_array($item['image']) ? $item['image'] : null; ?>
                    <?php if ($img && !empty($img['ID'])) : ?>
                        <figure class="location-n206__gallery-item">
                            <?php echo wp_kses_post(wp_get_attachment_image((int) $img['ID'], 'large', false, array('class' => 'location-n206__gallery-image'))); ?>
                        </figure>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
    .location-n206-section {
        padding: clamp(34px, 4vw, 54px) 12px;
    }

    .location-n206__inner {
        border-radius: 30px;
        padding: clamp(26px, 3vw, 42px);
        color: var(--loc-text);
    }

    .location-n206__top {
        display: grid;
        grid-template-columns: 1.18fr 0.82fr;
        gap: clamp(20px, 2.5vw, 34px);
        align-items: start;
    }

    .location-n206__title {
        margin: 0;
        display: flex;
        flex-direction: column;
        line-height: 0.96;
        font-family: "Causten", sans-serif;
        font-size: clamp(46px, 4.5vw, 68px);
    }

    .location-n206__title-main {
        color: var(--loc-title);
        font-weight: 700;
    }

    .location-n206__title-accent {
        color: var(--loc-accent);
        font-weight: 700;
    }

    .location-n206__intro {
        margin: 26px 0 0;
        max-width: 680px;
        font-size: 18px;
        line-height: 1.6;
        font-family: 'Causten regular', sans-serif;
    }

    .location-n206__features {
        margin-top: 28px;
        border-radius: 24px;
        background: var(--loc-card);
        padding: 24px 26px;
    }

    .location-n206__features-title {
        margin: 0;
        color: var(--loc-title);
        font-family: "Causten", sans-serif;
        line-height: 1.2;
        font-weight: 700;
    }

    .location-n206__features-list {
        margin: 18px 0 0;
        padding: 0;
        list-style: none;
        display: grid;
        gap: 10px;
    }

    .location-n206__features-list li {
        display: grid;
        grid-template-columns: 24px 1fr;
        gap: 10px;
        align-items: start;
        font-size: 18px;
        line-height: 1.3;
        font-family: "Causten", sans-serif;
        color: var(--loc-title);
        font-weight: 700;
    }

    .location-n206__check {
        fill: var(--loc-accent);
        width: 20px;
        height: 20px;
        margin-top: 3px !important;
    }

    .location-n206__right {
        background: var(--loc-card);
        border-radius: 26px;
        padding: clamp(24px, 2.2vw, 32px);
    }

    .location-n206__contact-title {
        margin: 0;
        color: var(--loc-title);
        font-family: "Causten", sans-serif;
        line-height: 1.2;
        font-weight: 700;
    }

    .location-n206__address,
    .location-n206__contact-lines p {
        margin: 12px 0 0;
        line-height: 1.5;
        font-family: 'Causten regular', sans-serif;
    }

    .location-n206__contact-lines {
        margin-top: 16px;
    }

    .location-n206__hours-title {
        margin: 24px 0 0;
        color: var(--loc-title);
        font-family: "Causten", sans-serif;
        line-height: 1.2;
        font-weight: 700;
    }

    .location-n206__hours-list {
        margin-top: 10px;
        display: grid;
        gap: 7px;
    }

    .location-n206__hours-row {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 14px;
        line-height: 1.35;
        font-family: 'Causten regular', sans-serif;
    }

    .location-n206__gallery {
        margin-top: clamp(24px, 2.4vw, 34px);
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: clamp(14px, 1.4vw, 18px);
    }

    .location-n206__gallery-item {
        margin: 0;
        border-radius: 26px;
        overflow: hidden;
        aspect-ratio: 1.55 / 1;
        background: #d6d6d6;
    }

    .location-n206__gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    @media (max-width: 980px) {
        .location-n206__top {
            grid-template-columns: 1fr;
        }

        .location-n206__gallery {
            grid-template-columns: 1fr;
        }
    }


    

@media (max-width: 600px) {
    .location-n206-section {
      padding-left: 16px;
      padding-right: 16px;
    }
    .location-n206-section img,
    .location-n206-section video {
      max-width: 100%;
      height: auto;
    }
    .location-n206-section [class*="grid"],
    .location-n206-section [class*="cards"],
    .location-n206-section [class*="columns"],
    .location-n206-section [class*="row"] {
      grid-template-columns: 1fr;
    }
}
</style>
