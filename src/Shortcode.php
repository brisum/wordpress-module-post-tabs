<?php

namespace Brisum\Wordpress\PostTabs;

class Shortcode
{
    const BSM_POST_TABS_SHORTCODE = 'bsm-post-tabs';

    /**
     * @var PostFactory
     */
    protected $pageFactory;

    /**
     * Shortcode constructor.
     * @param PostFactory $pageFactory
     */
    public function __construct(PostFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
        add_shortcode(self::BSM_POST_TABS_SHORTCODE, [$this, 'doShortcode']);
    }

    /**
     * @param array $atts
     * @return string
     */
    public function doShortcode(array $atts = [])
    {
        $atts = shortcode_atts(
            [
                'name' => ''
            ],
            $atts,
            self::BSM_POST_TABS_SHORTCODE
        );

        return $this->pageFactory->createPost($atts['name'])->content();
    }
}
