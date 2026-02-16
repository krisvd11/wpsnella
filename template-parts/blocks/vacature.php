<?php


$color_bg = get_field( 'bg-color' );
$color_hover_bg = get_field( 'background-color_hover' );
$transition_time = get_field( 'transition' );
$gap = get_field( 'gap' );
$border_radius = get_field( 'border_radius' );




$vacature_query = new WP_Query([
    'post_type'      => 'vacature',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'DESC',
]);
?>


<?php if ( $vacature_query->have_posts() ) : ?>
    <section class="block-vacature">
        <div class="block-vacature_inner">
                <?php while ( $vacature_query->have_posts() ) : $vacature_query->the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="block-vacature__item">
                        <div class="block-vacature__content">
                            <h3 class="block-vacature__title"><?php the_title(); ?></h3>
                        </div>
                    </a>
                <?php endwhile; ?>
        </div>
    </section>
    <?php wp_reset_postdata(); ?>
<?php else : ?>
    <p class="block-vacature__empty">
        <?php esc_html_e( 'Er zijn nog geen vacatures toegevoegd.', 'test' ); ?>
    </p>
<?php endif; ?>


<style>
.block-vacature__item {
    font-size: 24px;
    padding: 20px 40px;
    width: 800px !important;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-radius: <?php echo esc_html($border_radius); ?>px;
    background: <?php echo esc_html($color_bg); ?>;
    text-decoration: none;
    color: #0f2a84;
    z-index: 2222;
    transition: 0.<?php echo esc_html($transition_time); ?>s;
}

.block-vacature__item:hover {
    background: <?php echo esc_html($color_hover_bg); ?>;
}


.block-vacature_inner {
    display: flex;
    flex-direction: column;
    gap: <?php echo esc_html($gap); ?>px;
}
</style>