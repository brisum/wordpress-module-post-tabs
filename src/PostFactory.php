<?php

namespace Brisum\Wordpress\PostTabs;

use Brisum\Lib\ObjectManager;
use InvalidArgumentException;

class PostFactory
{
    /**
     * @var array
     */
    protected static $pages = [];

    /**
     * PageFactory constructor.
     */
    public function __construct()
    {
        add_action('init', [$this, 'actionInit'], 100);
    }

    /**
     * @return void
     */
    public function actionInit()
    {
        self::$pages = apply_filters("bsm_page_tabs_pages", self::$pages);
    }

    /**
     * @param string $name
     * @return Post
     */
    public function createPost($name)
    {
        if (!isset(self::$pages[$name])) {
            throw new InvalidArgumentException("Invalid name argument \"{$name}\"");
        }

        /** @var Post $post */
        $post = ObjectManager::getInstance()->create(
            self::$pages[$name],
            ['name' => $name]
        );

        return $post;
    }
}
