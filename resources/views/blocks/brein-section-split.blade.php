<?php
$title     = (string) (get_field('title') ?: 'Split content title');
$left_text = (string) (get_field('left_text') ?: 'Left column content.');
$right_text = (string) (get_field('right_text') ?: 'Right column content.');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class_name); ?>">
    <div class="brein-section-inner container brein-split-inner">
        <h2><?php echo esc_html($title); ?></h2>
        <div class="brein-split-grid">
            <div><?php echo wp_kses_post(wpautop($left_text)); ?></div>
            <div><?php echo wp_kses_post(wpautop($right_text)); ?></div>
        </div>
    </div>
</section>

<style>
@media (max-width: 600px) {
    .brein-split-inner {
      padding-left: 16px;
      padding-right: 16px;
    }

    .brein-split-grid {
      grid-template-columns: 1fr;
    }
}
</style>
