<?php

use Brisum\Lib\ObjectManager;
use Brisum\Wordpress\PostTabs\PostFactory;

$objectManager = ObjectManager::getInstance();
$objectManager->create('Brisum\Wordpress\PostTabs\Plugin\Filter');
/** @var PostFactory $postFactory */
$postFactory = $objectManager->get('Brisum\Wordpress\PostTabs\PostFactory');

new Brisum\Wordpress\PostTabs\Shortcode($postFactory);
