<?php

namespace Brisum\Wordpress\PostTabs;

use Brisum\Lib\ObjectManager;
use InvalidArgumentException;

class Post
{
    const QUERY_VAR_POST_TAB = 'bsm-page-tab';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $tabs = [];

    /**
     * Post constructor.
     */
    public function __construct(array $tabs)
    {
        foreach ($tabs as $tab) {
            if (empty($tab['name']) || !is_string($tab['name'])) {
                throw  new InvalidArgumentException('Invalid tab parameter "name": ' . print_r($tab, true));
            }
            if (empty($tab['title']) || !is_string($tab['title'])) {
                throw  new InvalidArgumentException('Invalid tab parameter "title": ' . print_r($tab, true));
            }
            if (empty($tab['class']) || !is_string($tab['class'])) {
                throw  new InvalidArgumentException('Invalid tab parameter "class": ' . print_r($tab, true));
            }

            $this->tabs[$tab['name']] = [
                'name' => $tab['name'],
                'title' => $tab['title'],
                'class' => $tab['class'],
            ];
        }
    }

    protected function getData()
    {
        global $post;
        $postLink = get_permalink($post);
        $currentTabName = get_query_var(self::QUERY_VAR_POST_TAB);
        $tabs = $this->tabs;

        if (!$currentTabName || !isset($tabs[$currentTabName])) {
            reset($tabs);
            $currentTabName = key($tabs);
        }

        foreach ($tabs as $tabName => $tab) {
            if ($currentTabName === $tabName) {
                $tab['is_active'] = true;
                $tab['content'] = ObjectManager::getInstance()
                    ->create($tab['class'])
                    ->content();
            } else {
                $tab['is_active'] = false;
                $tab['content'] = '';
            }

            $tabs[$tabName] = $tab;
        }

        return [
            'postLink' => $postLink,
            'tabs' => $tabs
        ];
    }

    public function content()
    {
        $data = $this->getData();

        ob_start();
        extract($data);
        require __DIR__ . '/template/post-tabs.tpl.php';
        return ob_get_clean();
    }
}
