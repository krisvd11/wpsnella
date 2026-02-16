<?php


$category = get_field('category-name');
$limit = get_field('limit');
$icon = get_field('icon');
$priority = get_field('priority');
$faq_ids = get_field('manual_selected');
$method = get_field('option');


$manual_query = new WP_Query([
    'post_type'      => 'faq',
    'post__in'       => $faq_ids,
    'orderby'        => 'post__in', 
    'posts_per_page' =>  $limit,

]);


$category_query = new WP_Query([
    'post_type'      => 'faq',
    'posts_per_page' => $limit,
    'meta_key'       => 'priority',
    'orderby'        => 'meta_value_num',
    'order'          => 'DESC',

    'tax_query'      => [
        [
            'taxonomy' => 'category', 
            'field'    => 'term_id',
            'terms'    => $category,
            'operator' => 'IN',
        ],
    ],
]);





$query = ($method === 'manual') ? $manual_query : $category_query;


?>





<?php if ( $query->have_posts() ) : ?>

<div class="acf-faq-accordion">
<?php while ( $query->have_posts() ) : $query->the_post(); ?>
<div class="faq-item">
            <button class="faq-question" aria-expanded="false">
           <h4 class="faq-h4"> <?php the_title(); ?>       </h4>
           
           
           <?php if ( $icon === 'icon_plus' ) : ?>
            <div class="plus_wrapper">
            <svg class="vertical_line" width="18px" height="18px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
               <g id="Interface / Line_L">
            <path id="Vector" d="M12 19V5" stroke="#000000" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/> </g>
            </svg>   
            
            <svg class="horizontal_line" width="18px" height="18px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
               <g id="Interface / Line_L">
            <path id="Vector" d="M12 19V5" stroke="#000000" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/> </g>
            </svg>   
           </div>
            <?php endif; ?>

            <?php if ( $icon === 'icon_down' ) : ?>

            <svg class="down_arrow" width="18px" height="18px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.70711 9.71069C5.31658 10.1012 5.31658 10.7344 5.70711 11.1249L10.5993 16.0123C11.3805 16.7927 12.6463 16.7924 13.4271 16.0117L18.3174 11.1213C18.708 10.7308 18.708 10.0976 18.3174 9.70708C17.9269 9.31655 17.2937 9.31655 16.9032 9.70708L12.7176 13.8927C12.3271 14.2833 11.6939 14.2832 11.3034 13.8927L7.12132 9.71069C6.7308 9.32016 6.09763 9.32016 5.70711 9.71069Z" fill="#0F0F0F"/>
</svg>
<?php endif; ?>

        </button>
            <div class="faq-answer">
            <?php the_content(); ?>
            </div>
        </div>
        <?php endwhile; ?>
        </div>

<?php endif; ?>
<?php wp_reset_postdata(); ?>

<style>

.faq-item {
    width: 100%;
    background: blue;
}
.plus_wrapper {
    position: relative;
    width: 18px;
    height: 18px;
}

.plus_wrapper svg {
    position: absolute;
    top: 0;
    left: 0;
}

.vertical_line {
    transition: all .3s cubic-bezier(.175,.885,.32,1.275);
}

.active .vertical_line {
    height: 0;
}

.horizontal_line {
    rotate: 90deg;
}
.acf-faq-accordion {
    width: 500px;
    border-radius: 20px;
    border: 1px solid red;
    overflow: hidden;

}


.faq-question {
    width: 100%;
    padding: 15px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    background: white;
    border-bottom: 1px solid black;
}

.faq-answer {
    max-height: 0;
    max-width: 480px;
    transition: all .3s cubic-bezier(.175,.885,.32,1.275);
    opacity: 0;
    padding: 0px 10px;

}

.faq-h4 {
    font-size: 26px;
}

.active .faq-answer {
    background: purple;
}

.faq-item.active .faq-answer {
    max-height: 800px;
    opacity: 1;
    max-width: 480px;
    padding: 10px;
}


.down_arrow {
    transition: 0.3s;
}


.active .faq-question .down_arrow {
    rotate: 180deg;
}

</style>


