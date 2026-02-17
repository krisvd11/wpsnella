<div class="pricing-container">
<?php if (have_rows('pricing-table')): ?>
    <?php while (have_rows('pricing-table')): the_row(); ?>

        <div class="pricing-table-main pricing-table-<?php echo get_row_index(); ?>">
            <h2 class="title">
                <?php the_sub_field('pricing-title'); ?>
            </h2>

            <div class="pricing-info">
                <div class="price_div">
                    <h4 class="price"><?php the_sub_field('price'); ?></h4>
                </div>
                <div class="bonus_div">
                    <span class="bonus-punten"><?php the_sub_field('bonus-punten'); ?></h4>
                    <span class="punten-totaal"><?php the_sub_field('punten'); ?></h4>
                </div>
            </div>
            <?php if (have_rows('benefit-group')): ?>
                <?php while (have_rows('benefit-group')):
                    the_row(); ?>
                        <div class="benefit_grid">
                            <h2 class="benefit_grid_heading"><?php the_sub_field('benefit-tekst'); ?></h2>
                       </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>


        <style>


        .pricing-table-<?php echo get_row_index(); ?> {
            background: <?php the_sub_field('bg-color'); ?>;
        }


        </style>
        

    <?php endwhile; ?>
<?php endif; ?>
    </div>



<style>

.pricing-container {
    display: flex;
    width: 1000px;
}

.pricing-table-main {
    width: 100%;
    padding: 20px;
    font-family: 'Causten regular';
 
}

.pricing-table-main h2 {
    font-family: 'Causten';
}

</style>