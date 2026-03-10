<?php

namespace App\Providers;

use App\Blocks\CtaBlock;
use App\Blocks\GalleryBlock;
use App\Blocks\GlansTilesBlock;
use App\Blocks\InfoBlock;
use App\Blocks\MembershipOfferBlock;
use App\Blocks\PricingPlansBlock;
use App\Blocks\ShineShowcaseBlock;
use App\Blocks\SnelsparenIntroBlock;
use App\Blocks\faqBlock;
use App\Blocks\VideoIntroBlock;
use App\Blocks\WashPassPromoBlock;
use Illuminate\Support\ServiceProvider;

class BlockServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        add_action('acf/init', function (): void {
            if (! function_exists('acf_register_block_type')) {
                return;
            }

            $this->registerBlocks();
        });
    }

    protected function registerBlocks(): void
    {
        $this->registerBlock('hero', __('Hero Block'), __('A custom hero section'), 'cover-image', ['hero', 'banner'], 'blocks.hero');
        $this->registerBlock('cta', __('CTA Block'), __('A custom CTA section'), 'button', ['cta', 'button'], 'blocks.cta');
        $this->registerBlock('personeel', __('Personeel Block'), __('Overzicht van personeelsleden', 'test'), 'groups', ['personeel', 'team', 'medewerkers'], 'blocks.personeel');
        $this->registerBlock('animatie', __('Animatie Block'), __('Animatie', 'test'), 'groups', ['personeel', 'team', 'medewerkers'], 'blocks.animatie');
        $this->registerBlock('vacature', __('Vacature Block'), __('Vacature', 'test'), 'groups', ['personeel', 'team', 'medewerkers'], 'blocks.vacature');
        $this->registerBlock('benefits', __('Benefit Block'), __('Benefit', 'test'), 'groups', ['personeel', 'team', 'medewerkers'], 'blocks.benefits');
        $this->registerBlock('Pricing', __('Pricing Block'), __('Pricing', 'test'), 'groups', ['personeel', 'team', 'medewerkers'], 'blocks.pricing');
        $this->registerBlock('herov2', __('Hero v2 Block'), __('herov2', 'test'), 'groups', ['personeel', 'team', 'medewerkers'], 'blocks.herov2');
        acf_register_block_type([
            'name'            => 'glans-tiles',
            'title'           => __('Glans Tiles Block', 'test'),
            'description'     => __('Tile grid with text/image tiles and custom colors.', 'test'),
            'render_callback' => function (array $block): void {
                echo view('blocks.glans-tiles', GlansTilesBlock::make($block))->render();
            },
            'category'        => 'layout',
            'icon'            => 'grid-view',
            'keywords'        => ['section', 'tiles', 'grid'],
            'mode'            => 'edit',
            'supports'        => ['align' => true, 'jsx' => true],
        ]);
        $this->registerBlock(
            'spaarstappen',
            __('Spaarstappen Block', 'test'),
            __('4-step card grid block.', 'test'),
            'index-card',
            ['stappen', 'cards', 'spaarpunten'],
            'blocks.spaarstappen',
            'layout',
            'edit',
            ['align' => true, 'jsx' => true]
        );

        acf_register_block_type([
            'name'            => 'video-intro',
            'title'           => __('Video Intro Block', 'test'),
            'description'     => __('Two-column intro block with left video.', 'test'),
            'render_callback' => function (array $block): void {
                echo view('blocks.video-intro', VideoIntroBlock::make($block))->render();
            },
            'category'        => 'layout',
            'icon'            => 'video-alt3',
            'keywords'        => ['video', 'intro', 'hero'],
            'mode'            => 'edit',
            'supports'        => ['align' => true, 'jsx' => true],
        ]);


        acf_register_block_type([
            'name'            => 'call-to-action',
            'title'           => __('call-to-action Block', 'test'),
            'description'     => __('Simple call-to-actiony block.', 'test'),
            'render_callback' => function (array $block): void {
                echo view('blocks.call-to-action', CtaBlock::make($block))->render();
            },
            'category'        => 'layout',
            'icon'            => 'format-gallery',
            'keywords'        => ['gallery', 'images', 'photos'],
            'supports'        => [
                'align' => true,
            ],
        ]);

        acf_register_block_type([
            'name'            => 'gallery',
            'title'           => __('Gallery Block', 'test'),
            'description'     => __('Simple image gallery block.', 'test'),
            'render_callback' => function (array $block): void {
                echo view('blocks.gallery', GalleryBlock::make($block))->render();
            },
            'category'        => 'layout',
            'icon'            => 'format-gallery',
            'keywords'        => ['gallery', 'images', 'photos'],
            'supports'        => [
                'align' => true,
            ],
        ]);

        acf_register_block_type([
            'name'            => 'shine-showcase',
            'title'           => __('Shine Showcase Block', 'test'),
            'description'     => __('Centered heading with floating image bubbles and CTA.', 'test'),
            'render_callback' => function (array $block): void {
                echo view('blocks.shine-showcase', ShineShowcaseBlock::make($block))->render();
            },
            'category'        => 'layout',
            'icon'            => 'star-filled',
            'keywords'        => ['shine', 'showcase', 'auto'],
            'mode'            => 'edit',
            'supports'        => [
                'align' => true,
                'jsx' => true,
            ],
        ]);

        acf_register_block_type([
            'name'            => 'membership-offer',
            'title'           => __('Membership Offer Block', 'test'),
            'description'     => __('Membership promo section with feature cards and CTA.', 'test'),
            'render_callback' => function (array $block): void {
                echo view('blocks.membership-offer', MembershipOfferBlock::make($block))->render();
            },
            'category'        => 'layout',
            'icon'            => 'money-alt',
            'keywords'        => ['membership', 'abonnement', 'offer'],
            'mode'            => 'edit',
            'supports'        => [
                'align' => true,
                'jsx' => true,
            ],
        ]);
        acf_register_block_type([
            'name'            => 'info-block',
            'title'           => __('info Block', 'test'),
            'description'     => __('A simple info block', 'test'),
            'render_callback' => function (array $block): void {
                echo view('blocks.info', InfoBlock::make($block))->render();
            },
            'category'        => 'layout',
            'icon'            => 'money-alt',
            'keywords'        => ['membership', 'abonnement', 'offer'],
            'mode'            => 'edit',
            'supports'        => [
                'align' => true,
                'jsx' => true,
            ],
        ]);

        acf_register_block_type([
            'name'            => 'pricing-plans',
            'title'           => __('Pricing Plans Block', 'test'),
            'description'     => __('Three-column pricing plans section.', 'test'),
            'render_callback' => function (array $block): void {
                echo view('blocks.pricing-plans', PricingPlansBlock::make($block))->render();
            },
            'category'        => 'layout',
            'icon'            => 'table-col-after',
            'keywords'        => ['pricing', 'plans', 'wash'],
            'mode'            => 'edit',
            'supports'        => [
                'align' => true,
                'jsx' => true,
            ],
        ]);

        acf_register_block_type([
            'name'            => 'washpass-promo',
            'title'           => __('Washpass Promo Block', 'test'),
            'description'     => __('Heading with left stacked images and right promo card.', 'test'),
            'render_callback' => function (array $block): void {
                echo view('blocks.washpass-promo', WashPassPromoBlock::make($block))->render();
            },
            'category'        => 'layout',
            'icon'            => 'id-alt',
            'keywords'        => ['washpas', 'promo', 'snella'],
            'mode'            => 'edit',
            'supports'        => [
                'align' => true,
                'jsx' => true,
            ],
        ]);

        acf_register_block_type([
            'name'            => 'snelsparen-intro',
            'title'           => __('Snelsparen Intro Block', 'test'),
            'description'     => __('Centered heading and text with floating circular images.', 'test'),
            'render_callback' => function (array $block): void {
                echo view('blocks.snelsparen-intro', SnelsparenIntroBlock::make($block))->render();
            },
            'category'        => 'layout',
            'icon'            => 'money',
            'keywords'        => ['snelsparen', 'sparen', 'snella'],
            'mode'            => 'edit',
            'supports'        => [
                'align' => true,
                'jsx' => true,
            ],
        ]);
    }

    protected function registerBlock(
        string $name,
        string $title,
        string $description,
        string $icon,
        array $keywords,
        string $view,
        string $category = 'layout',
        string $mode = 'preview',
        array $supports = ['align' => true]
    ): void {
        acf_register_block_type([
            'name'            => $name,
            'title'           => $title,
            'description'     => $description,
            'render_callback' => function () use ($view): void {
                echo view($view)->render();
            },
            'category'        => $category,
            'icon'            => $icon,
            'keywords'        => $keywords,
            'mode'            => $mode,
            'supports'        => $supports,
        ]);
    }
}
