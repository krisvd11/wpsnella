<?php
$section_bg = (string) (get_field('team_section_bg') ?: '#ececec');
$title_line_1 = (string) (get_field('team_title_line_1') ?: 'Het team van');
$title_line_2 = (string) (get_field('team_title_line_2') ?: 'Snella Autowas');
$intro_text = (string) (get_field('team_intro_text') ?: '');
$title_color = (string) (get_field('team_title_color') ?: '#17338f');
$accent_color = (string) (get_field('team_accent_color') ?: '#f2bb13');
$text_color = (string) (get_field('team_text_color') ?: '#17338f');
$team_members = get_field('team_members');
$team_members = is_array($team_members) ? $team_members : array();
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class_name); ?> team-section" style="background: <?php echo esc_attr($section_bg); ?>;">
    <div class="team-section__inner container" style="--team-title: <?php echo esc_attr($title_color); ?>; --team-accent: <?php echo esc_attr($accent_color); ?>; --team-text: <?php echo esc_attr($text_color); ?>;">
        <div class="team-section__header">
            <?php if ($title_line_1 !== '' || $title_line_2 !== '') : ?>
                <h2 class="team-section__title">
                    <?php if ($title_line_1 !== '') : ?>
                        <span class="team-section__title-main"><?php echo esc_html($title_line_1); ?></span>
                    <?php endif; ?>
                    <?php if ($title_line_2 !== '') : ?>
                        <span class="team-section__title-accent"><?php echo esc_html($title_line_2); ?></span>
                    <?php endif; ?>
                </h2>
            <?php endif; ?>
            <?php if ($intro_text !== '') : ?>
                <p class="team-section__intro"><?php echo nl2br(esc_html($intro_text)); ?></p>
            <?php endif; ?>
        </div>

        <?php if (!empty($team_members)) : ?>
            <div class="team-section__grid">
                <?php foreach ($team_members as $member) : ?>
                    <?php
                    $member_image = isset($member['image']) && is_array($member['image']) ? $member['image'] : null;
                    $member_name = isset($member['name']) ? (string) $member['name'] : '';
                    $member_role = isset($member['role']) ? (string) $member['role'] : '';
                    ?>
                    <article class="team-member">
                        <div class="team-member__photo">
                            <?php if ($member_image && !empty($member_image['ID'])) : ?>
                                <?php echo wp_kses_post(wp_get_attachment_image((int) $member_image['ID'], 'medium_large', false, array('class' => 'team-member__image'))); ?>
                            <?php endif; ?>
                        </div>
                        <?php if ($member_name !== '') : ?>
                            <h5 class="team-member__name"><?php echo esc_html($member_name); ?></h5>
                        <?php endif; ?>
                        <?php if ($member_role !== '') : ?>
                            <p class="team-member__role"><?php echo esc_html($member_role); ?></p>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php elseif (is_admin()) : ?>
            <p><?php echo esc_html__('Add team members to show this section.', 'brein-plugin'); ?></p>
        <?php endif; ?>
    </div>
</section>

<style>
    .team-section {
        padding: clamp(56px, 6vw, 86px) 12px;
    }

    .team-section__inner {
        color: var(--team-text);
    }

    .team-member__role {
        font-size: 16px;
    }

    .team-section__header {
        text-align: center;
        max-width: 780px;
        margin: 0 auto clamp(36px, 4vw, 56px);
    }

    .team-section__title {
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 2px;
        line-height: 0.98;
        font-family: "Causten", sans-serif;
        font-size: clamp(52px, 5.2vw, 74px);
    }

    .team-section__title-main {
        color: var(--team-title);
        font-weight: 700;
    }

    .team-section__title-accent {
        color: var(--team-accent);
        font-weight: 700;
    }

    .team-section__grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 20px;
        align-items: start;
    }

    .team-member {
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

    .team-member__photo {
        border-radius: 30px;
        overflow: hidden;
        background: #d9d9d9;
        aspect-ratio: 1 / 1;
    }

    .team-member__image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .team-member__name {
        color: var(--team-title);
    }



    @media (max-width: 1200px) {
        .team-section__grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 900px) {
        .team-section__grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 640px) {
        .team-section__grid {
            gap: 26px;
            width: 100%;
            margin: 0 auto;
        }


    }

@media (max-width: 600px) {

    .team-member__photo {
        width: 120px !important;
        height: 120px !important;
    }
    .team-section {
      padding-left: 16px;
      padding-right: 16px;
    }
    .team-section img,
    .team-section video {
      max-width: 100%;
      height: auto;
    }
}
</style>
