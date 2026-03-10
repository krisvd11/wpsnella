<?php
$section_bg = (string) (get_field('wash_program_section_bg') ?: '#d9d9d9');
$column_gap = (int) (get_field('wash_program_gap') ?: 20);
$cards = get_field('wash_program_cards');
$cards = is_array($cards) ? $cards : array();

$left_cards = array();
$right_cards = array();

foreach ($cards as $card) {
    $column = isset($card['column']) ? (string) $card['column'] : 'left';
    if ($column === 'right') {
        $right_cards[] = $card;
    } else {
        $left_cards[] = $card;
    }
}

$render_card = static function ($card) {
    $type = isset($card['card_type']) ? (string) $card['card_type'] : 'text';
    $title = isset($card['title']) ? (string) $card['title'] : '';
    $text = isset($card['text']) ? (string) $card['text'] : '';
    $price = isset($card['price']) ? (string) $card['price'] : '';
    $price_subtext = isset($card['price_subtext']) ? (string) $card['price_subtext'] : '';
    $card_bg = isset($card['card_bg']) && $card['card_bg'] !== '' ? (string) $card['card_bg'] : '#f4f4f4';
    $accent_bg = isset($card['accent_bg']) && $card['accent_bg'] !== '' ? (string) $card['accent_bg'] : '#f7c30f';
    $text_color = isset($card['text_color']) && $card['text_color'] !== '' ? (string) $card['text_color'] : '#143487';
    $min_height = isset($card['min_height']) ? (int) $card['min_height'] : 0;
    $top_offset = isset($card['top_offset']) ? (int) $card['top_offset'] : 0;
    $link = isset($card['link']) && is_array($card['link']) ? $card['link'] : null;
    $image = isset($card['image']) && is_array($card['image']) ? $card['image'] : null;
    $icon = isset($card['icon']) && is_array($card['icon']) ? $card['icon'] : null;
    $vacancy_rows = isset($card['vacancy_rows']) && is_array($card['vacancy_rows']) ? $card['vacancy_rows'] : array();

    $style = 'background:' . esc_attr($card_bg) . ';color:' . esc_attr($text_color) . ';';
    if ($min_height > 0) {
        $style .= 'min-height:' . (int) $min_height . 'px;';
    }
    if ($top_offset > 0) {
        $style .= 'margin-top:' . (int) $top_offset . 'px;';
    }

    if ($type === 'image') {
        echo '<article class="wash-card wash-card--image" style="' . $style . '">';
        if ($image && !empty($image['ID'])) {
            echo wp_kses_post(wp_get_attachment_image((int) $image['ID'], 'large', false, array('class' => 'wash-card__image')));
        }
        echo '</article>';
        return;
    }

    if ($type === 'feature') {
        echo '<article class="wash-card wash-card--feature" style="' . $style . '">';
        echo '<div class="wash-card__feature-icon" style="background:' . esc_attr($accent_bg) . ';">';
        if ($icon && !empty($icon['ID'])) {
            echo wp_kses_post(wp_get_attachment_image((int) $icon['ID'], 'thumbnail', false, array('class' => 'wash-card__icon-image')));
        }
        echo '</div>';
        echo '<div class="wash-card__feature-content">';
        if ($title !== '') {
            echo '<h3>' . esc_html($title) . '</h3>';
        }
        if ($text !== '') {
            echo '<p>' . wp_kses_post(wpautop($text)) . '</p>';
        }
        echo '</div>';
        echo '</article>';
        return;
    }

    if ($type === 'price') {
        echo '<article class="wash-card wash-card--price" style="background:' . esc_attr($accent_bg) . ';color:' . esc_attr($text_color) . ';' . ($top_offset > 0 ? 'margin-top:' . (int) $top_offset . 'px;' : '') . '">';
        if ($price !== '') {
            echo '<h2 class="wash-card__price">' . esc_html($price) . '</h2>';
        }
        if ($price_subtext !== '') {
            echo '<p class="wash-card__price-subtext">' . esc_html($price_subtext) . '</p>';
        }
        echo '</article>';
        return;
    }

    if ($type === 'vacancies') {
        echo '<article class="wash-card wash-card--vacancies" style="' . $style . '">';
        if ($title !== '') {
            echo '<h3 class="wash-card__vacancies-title">' . esc_html($title) . '</h3>';
        }
        if (!empty($vacancy_rows)) {
            echo '<div class="wash-card__vacancies-rows">';
            foreach ($vacancy_rows as $vacancy_row) {
                $row_link = isset($vacancy_row['link']) && is_array($vacancy_row['link']) ? $vacancy_row['link'] : null;
                $row_label = isset($vacancy_row['label']) ? (string) $vacancy_row['label'] : '';
                if ($row_label === '' && $row_link && !empty($row_link['title'])) {
                    $row_label = (string) $row_link['title'];
                }
                if ($row_label === '') {
                    continue;
                }
                if ($row_link && !empty($row_link['url'])) {
                    echo '<a class="wash-card__vacancy-row" href="' . esc_url($row_link['url']) . '"';
                    if (!empty($row_link['target'])) {
                        echo ' target="' . esc_attr($row_link['target']) . '"';
                    }
                    echo '>';
                    echo '<span class="wash-card__vacancy-label">' . esc_html($row_label) . '</span>';
                    echo '<span class="wash-card__vacancy-arrow" aria-hidden="true">&rarr;</span>';
                    echo '</a>';
                } else {
                    echo '<div class="wash-card__vacancy-row">';
                    echo '<span class="wash-card__vacancy-label">' . esc_html($row_label) . '</span>';
                    echo '<span class="wash-card__vacancy-arrow" aria-hidden="true">&rarr;</span>';
                    echo '</div>';
                }
            }
            echo '</div>';
        }
        echo '</article>';
        return;
    }

    echo '<article class="wash-card wash-card--text" style="' . $style . '">';
    if ($title !== '') {
        echo '<h3>' . esc_html($title) . '</h3>';
    }
    if ($text !== '') {
        echo '<p>' . wp_kses_post(wpautop($text)) . '</p>';
    }
    if ($link && !empty($link['url']) && !empty($link['title'])) {
        echo '<a class="wash-card__link" href="' . esc_url($link['url']) . '"';
        if (!empty($link['target'])) {
            echo ' target="' . esc_attr($link['target']) . '"';
        }
        echo '>' . esc_html($link['title']) . '</a>';
    }
    echo '</article>';
};
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class_name); ?> wash-program-section" style="background: <?php echo esc_attr($section_bg); ?>;">
    <?php if (empty($cards) && is_admin()) : ?>
        <div class="brein-section-inner container">
            <p><?php echo esc_html__('Add cards to build the wash program section.', 'brein-plugin'); ?></p>
        </div>
    <?php endif; ?>
    <div class="wash-program__inner container" style="--wash-gap: <?php echo (int) $column_gap; ?>px;">
        <div class="wash-program__column">
            <?php foreach ($left_cards as $card) : ?>
                <?php $render_card($card); ?>
            <?php endforeach; ?>
        </div>
        <div class="wash-program__column">
            <?php foreach ($right_cards as $card) : ?>
                <?php $render_card($card); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
    .wash-program-section {
        padding: 12px 8px;
    }

    .wash-program__inner {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: var(--wash-gap, 20px);
    }

    .wash-program__column {
        display: grid;
        gap: 18px;
        align-content: start;
    }

    .wash-card {
        border-radius: 20px;
        overflow: hidden;
        padding: 24px;
    }

    .wash-card h3 {
        line-height: 0.8 !important;
        margin: 0 0 14px;
        font-size: 50px !important
        }

    .wash-card p {
        margin: 0;
        font-size: 16px !important;
        line-height: 1.6;
    }

    p.wash-card__price-subtext {
        color: white;
        font-size: 26px !important;
    }

    .wash-card__link {
        display: inline-block;
        margin-top: 18px;
        color: inherit;
        font-weight: 700;
        text-decoration: none;
    }

    .wash-card--image {
        padding: 0;
        height: 320px;
        display: flex;
        justify-content: center;
        align-items: center; 
    }

    .wash-card__image {
    width: 100%;
    max-height: 320px;
    object-fit: cover;
}

    .wash-card--feature {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 38px;
        align-items: center;
    }

    .wash-card__feature-icon {
        width: 170px;
        height: 170px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .wash-card__icon-image {
        width: 100px;
        height: 100px;
        object-fit: contain;
    }

    .wash-card--feature h3 {
        font-size: clamp(36px, 3.2vw, 54px);
        margin-bottom: 6px;
    }

    .wash-card--price {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        min-height: 170px;
    }

    .wash-card__price {
        font-size: 120px;
        font-weight: 700;
        line-height: 0.95;
    }

    .wash-card__price-subtext {
        margin-top: 8px;
        font-size: clamp(24px, 2.8vw, 40px);
        line-height: 1.1;
    }

    .wash-card--vacancies {
        display: flex;
        flex-direction: column;
        gap: 18px;
        padding: 34px 28px;
    }

    .wash-card__vacancies-title {
        margin: 0;
        line-height: 1;
    }

    .wash-card__vacancies-rows {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .wash-card__vacancy-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        border-radius: 999px;
        padding: 16px 20px;
        background: rgba(255, 255, 255, 0.28);
        color: inherit;
        text-decoration: none;
        font-size: clamp(22px, 1.6vw, 28px);
        line-height: 1.1;
        font-weight: 700;
    }

    .wash-card__vacancy-arrow {
        flex: 0 0 auto;
        font-size: 1.2em;
        line-height: 1;
    }

    @media (max-width: 980px) {
        .wash-program__inner {
            grid-template-columns: 1fr;
        }

        .wash-card h3 {
            font-size: clamp(34px, 8vw, 56px);
        }

        .wash-card p {
            font-size: 16px;
        }

        .wash-card--vacancies {
            padding: 24px 18px;
        }

        .wash-card__vacancy-row {
            font-size: clamp(18px, 5.8vw, 30px);
            padding: 14px 16px;
        }
    }

@media (max-width: 600px) {

.wash-program-section {
  padding: 16px;
}

.wash-program__inner {
  grid-template-columns: 1fr;
  gap: 16px;
}

.wash-program__column {
  gap: 16px;
}

.wash-card {
  border-radius: 16px;
}

/* Feature cards stack vertically */
.wash-card--feature {
  grid-template-columns: 1fr;
  gap: 16px;
}

.wash-card__feature-icon {
  width: 170px;
  height: 170px;
}

.wash-card__icon-image {
  width: 100px;
  height: 100px;
}

.wash-card--image {
  height: auto;
}

.wash-card__image {
  width: 100%;
  height: auto;
  max-height: 240px;
  object-fit: cover;
}

.wash-card__vacancy-row {
  padding: 14px 16px;
}


}
</style>
