<?php

$rows = get_field( 'rows' );
$heading = get_field( 'heading' );
 

?>


<section>

<div class="headingsection">
    <h2> Waarom <br>
    Snella Business
</h2>

</div>

<div class="benefit_section">
<?php if (have_rows('benefit_group')): ?>
    <?php while (have_rows('benefit_group')):
        the_row(); ?>
        <div class="benefit_grid">
            <div class="image-group">
            <img src="<?php the_sub_field('image'); ?>">  


        </div>
            <h2 class="benefit_grid_heading"><?php the_sub_field('heading'); ?></h2>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
</div>


<div class="aanvraagdiv">
<button class="aanvragen">
    Nu aanvragen
</button>
    </div>
</section>

<style>


.aanvraagdiv {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 40px 0px;
}

.aanvragen {
    background: #fdc41f;
    border: none;
    padding: 20px;
    border-radius: 20px;
    font-size: 20px;
}

.image-group {
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.image-group img {
    width: 40%;
    height: 100%;

}

.benefit_section {
    display: grid;
    grid-template-columns: repeat(<?php echo esc_html($rows); ?>, 1fr);
    grid-column-gap: 20px;
    grid-row-gap: 20px;
    align-items: center;
    justify-content: center;
}

.benefit_grid {
    background:rgb(255, 255, 255);
    padding: 10px;
    border-radius: 20px;
    border: 1px solid rgb(221, 221, 221);
    padding: 20px;

}

.benefit_grid_heading {
    font-size: 18px;
    text-align: center;
}

.headingsection h2 {
    font-size: 48px;
    text-align: center;
}

.headingsection {
    margin-bottom: 40px;
}



</style>