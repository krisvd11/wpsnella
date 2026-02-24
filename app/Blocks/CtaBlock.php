<?php

namespace App\Blocks;

class CtaBlock
{
    public static function make(array $block): array
    {


        return [
            'uid' => 'video-intro-' . (isset($block['id']) ? sanitize_html_class($block['id']) : wp_unique_id()),
            'heading' => get_field('cta_heading') ?: '#ececec',
            'paragraph' => get_field('cta_description') ?: '',
            'allowedHeadingHtml' => [
                'span' => ['style' => []],
                'br' => [],
            ],
        ];
    }
}
