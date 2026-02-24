<?php

namespace App\Blocks;

class VideoIntroBlock
{
    public static function make(array $block): array
    {
        $video = get_field('video_intro_video');
        $videoUrl = is_array($video) && isset($video['url']) ? $video['url'] : '';

        return [
            'uid' => 'video-intro-' . (isset($block['id']) ? sanitize_html_class($block['id']) : wp_unique_id()),
            'sectionBg' => get_field('video_intro_section_bg') ?: '#ececec',
            'badgeText' => get_field('video_intro_badge_text') ?: '',
            'headingHtml' => get_field('video_intro_heading_html') ?: '',
            'description' => get_field('video_intro_description') ?: '',
            'videoUrl' => $videoUrl,
            'headingColor' => get_field('video_intro_heading_color') ?: '#17338f',
            'textColor' => get_field('video_intro_text_color') ?: '#17338f',
            'badgeBg' => get_field('video_intro_badge_bg') ?: '#f1f1f1',
            'allowedHeadingHtml' => [
                'span' => ['style' => []],
                'br' => [],
            ],
        ];
    }
}
