<?php

namespace Brisum\Wordpress\PostTabs\Plugin;

use Brisum\Wordpress\PostTabs\Post;

class Filter
{
    public function __construct()
    {
        add_filter('page_rewrite_rules', [$this, 'filterPageRewriteRules']);
        add_filter('query_vars', [$this, 'filterQueryVars']);
    }

    public function filterPageRewriteRules($wp_rewrite)
    {
        $wp_rewrite["^([^/]+)/([^/]+)/?$"] = 'index.php?pagename=$matches[1]&' . Post::QUERY_VAR_POST_TAB . '=$matches[2]';
        return $wp_rewrite;
    }

    public function filterQueryVars($vars)
    {
        $vars[] = Post::QUERY_VAR_POST_TAB;
        return $vars;
    }
}
