<?php
$heading = get_field('heading');
$paragraph = get_field('paragraph');
$benefit  = get_field('benefit');
$btn_link = get_field('btn-link');
$btn_tekst = get_field('btn-tekst');
$img = get_field('img');
?>


<section>
<div class="hero-section-v2">
<div class="left-hero-v2">
<?php if ($img): ?>
    <img src="<?php echo esc_html($img); ?>">
 <?php endif; ?>
</div>

<div class="right-hero-v2">

<?php if ($heading): ?>
    <h1><?php echo esc_html($heading); ?></h1>
<?php endif; ?>

<?php if ($paragraph): ?>
    <p><?php echo esc_html($paragraph); ?></p>
<?php endif; ?>

<?php if (have_rows('benefit')): ?>
    <div class="benefitspace">
    <?php while (have_rows('benefit')):
        the_row(); ?>
        <div class="benefit_row">
            <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#fdc41f" version="1.1" id="Capa_1" width="18px" height="18px" viewBox="0 0 78.369 78.369" xml:space="preserve"> <g> <path d="M78.049,19.015L29.458,67.606c-0.428,0.428-1.121,0.428-1.548,0L0.32,40.015c-0.427-0.426-0.427-1.119,0-1.547l6.704-6.704   c0.428-0.427,1.121-0.427,1.548,0l20.113,20.112l41.113-41.113c0.429-0.427,1.12-0.427,1.548,0l6.703,6.704   C78.477,17.894,78.477,18.586,78.049,19.015z" /> </g> </svg>
            <p><?php the_sub_field('benefit_tekst'); ?> </p>  
        </div>
    <?php endwhile; ?>
    </div>
<?php endif; ?>



<?php if ($btn_link): ?>
    <a class="hero-link" href="<?php echo esc_html($btn_link); ?>">
    
<button class="hero-btn">
<?php echo esc_html($btn_tekst); ?>
</button>
    
</a>
<?php endif; ?>

</div>





</section>


<style>

.hero-link {
    text-decoration: none !important;
}

.hero-btn {
    border: none;
    border-radius: 20px;
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    font-size: 18px;
    font-weight: 700;
    line-height: 1;
    padding: 15px 30px;
    letter-spacing: -.025em;
    color: #0f2a84;
    background: #fdc41f;
    text-decoration: none !important;

}


.benefitspace {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.benefit_row p {
    margin: 0px;
    font-weight: 600;
    }

    .check-icon {
        padding-top: 6px;
    }

    .benefit_row {
        display: flex;
        align-items: center;
        gap: 10px;
    }


.hero-section-v2 {
    display: flex;
    flex-direction: row;
    gap: 40px;
    align-items: center;
}

.left-hero-v2 img {
    width: 100%;
}

.left-hero-v2 p {
    color: #0f2a84 !important;
}


.left-hero-v2 {
    width: 50%;
}


.right-hero-v2 {
    width: 50%;
    display: flex;
    flex-direction: column;
    gap: 20px;
}



</style>