<?php
$title  = (string) (get_field('title') ?: 'Call to action title');
$text   = (string) (get_field('text') ?: 'Add a short call to action message.');
$button = get_field('button');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class_name); ?>">
    <div class="brein-section-inner container brein-cta-inner">
        <h2><?php echo esc_html($title); ?></h2>
        <p><?php echo esc_html($text); ?></p>
        <?php if (is_array($button) && !empty($button['url']) && !empty($button['title'])) : ?>
            <a class="brein-section-button" href="<?php echo esc_url($button['url']); ?>" <?php echo !empty($button['target']) ? 'target="' . esc_attr($button['target']) . '"' : ''; ?>>
                <?php echo esc_html($button['title']); ?>
            </a>
        <?php endif; ?>
    </div>
</section>

<style>
@media (max-width: 600px) {
    .brein-cta-inner {
      padding-left: 16px;
      padding-right: 16px;
    }
}
</style>
