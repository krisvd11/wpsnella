<?php
$title = get_field('title');
$title2 = get_field('title_2');
$text  = get_field('text');
$video = get_field('video_url');
$text_color = get_field('text_color_main');
$text_color2 = get_field('text_color_2');
$announcement = get_field('announcement');
$gsaptekst = get_field('gsaptekst');
?>

<section class="hero-block">

<div class="left">
    <?php if ($video): ?>
        <video class="hero-video" src="<?php echo esc_url($video); ?>" autoplay loop muted playsinline></video>
    <?php endif; ?>
    </div>

    <div class="right">

    <?php if ($announcement): ?>
        <div class="box">
        <p style="color: <?php echo esc_attr($text_color); ?>;"><?php echo esc_html($announcement); ?></p>

    </div>

    <?php endif; ?>

    <?php if ($title): ?>
        <h1 style="color: <?php echo esc_attr($text_color); ?>;"><?php echo esc_html($title); ?>
            <span id="gsap" class="hero-gsap-text" style="color: <?php echo esc_attr($text_color); ?>;"><?php echo esc_html($gsaptekst); ?></span>
            <span style="color: <?php echo esc_attr($text_color2); ?>;"><?php echo esc_html($title2); ?></span>
        </h1>
    <?php endif; ?>

    <?php if ($text): ?>
        <p style="color: <?php echo esc_attr($text_color); ?>;"><?php echo esc_html($text); ?></p>
    <?php endif; ?>

    </div>
</section>

<style>

    body {
        margin: 0;
        padding: 0;
    }

    .hero-video {
        width: 100%;
        border-radius: 20px;
    }

    .hero-block {
        background: #f8f8f8;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        gap: 60px;
    }

    .box {
display: flex;
    align-items: center;
    width: fit-content;
    gap: 15px;
    padding: 13px 18px;
    background: #fff;
    border-radius: 10px;
    margin-bottom: 2rem;

    }

    .left {
        width: 50%;
    }

    .right {
        width: 50%;
    }


    </style>