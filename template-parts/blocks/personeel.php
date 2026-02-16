<?php

$personeel_query = new WP_Query([
    'post_type'      => 'personeel',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'DESC',
]);
?>

<?php if ( $personeel_query->have_posts() ) : ?>
    <section class="block-personeel">
        <div class="block-personeel_inner">
                <?php while ( $personeel_query->have_posts() ) : $personeel_query->the_post(); ?>
                    <div class="block-personeel__item">
                        <?php if ( has_post_thumbnail() ) : ?>
    <?php $thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ); ?>
        <img class="personeel_img" src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>">
<?php endif; ?>
                            <div class="block-personeel__content">
                                <h3 class="block-personeel__title"><?php the_title(); ?></h3>

                                <?php if ( has_excerpt() ) : ?>
                                    <p class="block-personeel__excerpt">
                                        <?php echo esc_html( the_content() ); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                                </div>
                <?php endwhile; ?>
        </div>
    </section>
    <?php wp_reset_postdata(); ?>
<?php else : ?>
    <p class="block-personeel__empty">
        <?php esc_html_e( 'Er zijn nog geen personeelsleden toegevoegd.', 'test' ); ?>
    </p>
<?php endif; ?>


<style> 


.block-personeel_inner {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-column-gap: 20px;
    grid-row-gap: 20px;
    align-items: center;
    justify-content: center;
}

.personeel_img {
    width: 300px;
    height: 300px;
    object-fit: cover;
    border-radius: 30px;
    object-position: 50% 10%;
}
.block-personeel__item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 20px;
}

</style>