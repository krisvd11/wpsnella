<?php
$title_1 = get_field('title_1');

$img_1 = get_field('leftupperimg');
$img_2 = get_field('leftlowerimg');
$main_img = get_field('mainimg');

$box_title = get_field('box_title');
$box_p = get_field('box_paragraph');

$border_radius = get_field('border-radius');


$bg_button = get_field('button-bg');
$text_button = get_field('button-text');
$link_button = get_field('button-link');

?>


<section class="cta-block">
    <h2 class="heading"><?php echo esc_html($title_1); ?></h2>

    <div class="content">

        <div style="border-radius: <?php echo esc_html($border_radius); ?>px" class="content-left">

            <img src="<?php echo esc_html($img_1); ?>">
            <img src="<?php echo esc_html($img_2); ?>">

        </div>

        <div style="border-radius: <?php echo esc_html($border_radius); ?>px" class="content-right">


            <div class="content-box">

                <div class="content_img">
                    <img src="<?php echo esc_html($main_img); ?>">


                </div>

                <div class="content_tekst">

                    <h2> <?php echo esc_html($box_title); ?></h2>
                    <p><?php echo esc_html($box_p); ?> </p>
                    <?php if (have_rows('benefit')): ?>
                        <?php while (have_rows('benefit')):
                            the_row(); ?>
                            <div class="benefit">
                                <svg class="benefiticon" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" version="1.1" id="Capa_1"
                                    width="18px" height="18px" viewBox="0 0 78.369 78.369" xml:space="preserve">
                                    <g>
                                        <path
                                            d="M78.049,19.015L29.458,67.606c-0.428,0.428-1.121,0.428-1.548,0L0.32,40.015c-0.427-0.426-0.427-1.119,0-1.547l6.704-6.704   c0.428-0.427,1.121-0.427,1.548,0l20.113,20.112l41.113-41.113c0.429-0.427,1.12-0.427,1.548,0l6.703,6.704   C78.477,17.894,78.477,18.586,78.049,19.015z" />
                                    </g>
                                </svg>

                                <p><?php the_sub_field('benefit_tekst'); ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>


                    <button>
                        Waspas aanvragen
                        <svg xmlns="http://www.w3.org/2000/svg" width="32.611" height="19.338"
                            viewBox="0 0 32.611 19.338">
                            <g id="Group_459" data-name="Group 459" transform="translate(-251.811 -660.331)">
                                <path id="Path_214" data-name="Path 214" d="M-3441.939-7041h29.205"
                                    transform="translate(3695 7711)" fill="none"
                                    stroke="<?php echo esc_html($text_button); ?>" stroke-linecap="round"
                                    stroke-width="2.5"></path>
                                <path id="Path_215" data-name="Path 215" d="M-3405.73-7048.316l7.9,7.9-7.9,7.9"
                                    transform="translate(3681 7710.415)" fill="none"
                                    stroke="<?php echo esc_html($text_button); ?>" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2.5"></path>
                            </g>
                        </svg>
                    </button>
                </div>



            </div>

        </div>

    </div>


</section>


<style>


    button {
        border: none;
        border-radius: <?php echo esc_html($border_radius); ?>px;
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 18px;
        font-weight: 700;
        line-height: 1;
        padding: 15px 30px 13px;
        letter-spacing: -.025em;
        color:
            <?php echo esc_html($text_button) ?>
        ;
        background:
            <?php echo esc_html($bg_button) ?>
        ;

    }

    .content-box {
        display: flex;
        width: 100%;
        gap: 20px;
        height: 100%
    }

    .content_img {
        width: 40%;
        display: flex;
        justify-content: start;
        align-items: center;
    }

    .content_img img {
        width: 80%;
    }

    .heading {
        text-align: center;
        max-width: 900px;
        margin-bottom: 40px;
    }

    .content_tekst {
        width: 60%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 20px;

    }

    .content-left img {
        width: 100%;
        height: 50%;
        object-fit: cover;
        border-radius:<?php echo esc_html($border_radius); ?>px;
    }


    .content-left {
        width: 35%;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }


    .content-right {
        width: 65%;
        background: white;
        padding: 20px 20px 20px 0px;
    }

    .benefit {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: start;
        gap: 10px;
        margin: 0px;
    }

    h2 {
        font-size: clamp(3.2rem, 3.2rem + (1vw - .375rem) * 2.0809248555, 5rem);
        line-height: .8;
    }

    .benefit p {
        margin: 0px;
        font-weight: 600;
    }

    .benefiticon {
        padding-top: 6px;
    }

    .content {
        display: flex;
        flex-direction: row;
        gap: 20px;
        width: 100%;
        height: 800px;
    }

    .cta-block h1 {
        text-align: center;
    }


    .cta-block {
        background: #f8f8f8;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 20px;
        gap: 40px;
    }
</style>