<?php

namespace App\Blocks;

class InfoBlock
{
    public static function make(array $block): array
    {
        return [
            'uid' => 'info-block-' . (isset($block['id']) ? sanitize_html_class($block['id']) : wp_unique_id()),
            'sectionBg' => get_field('info_section_bg') ?: '#ececec',
            'text' => get_field('info_text') ?: '',
            'paragraph' => get_field('info_paragraph') ?: '',

            'allowedHeadingHtml' => [
                'span' => ['style' => []],
                'br' => [],
            ],
        ];
    }
}
