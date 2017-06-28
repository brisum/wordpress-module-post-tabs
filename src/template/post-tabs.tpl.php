<div class="row collapse">
    <div class="medium-3 columns">
        <ul class="tabs vertical" id="<?php echo $postName; ?>-tabs" data-tabs>
            <?php foreach ($tabs as $tab) : ?>
                <li class="tabs-title <?php echo $tab['is_active'] ? 'is-active' : ''; ?>">
                    <a href="#<?php echo esc_attr($tab['name']); ?>"
                       data-href="<?php echo esc_attr($baseLink); ?>/<?php echo esc_attr($tab['name']); ?>/">
                        <?php echo $tab['title']; ?>
                     </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="medium-9 columns">
        <div class="tabs-content vertical" data-tabs-content="my-account-tabs">
            <?php foreach ($tabs as $tab) : ?>
                <div class="tabs-panel <?php echo $tab['is_active'] ? 'is-active' : ''; ?>" id="<?php echo esc_attr($tab['name']); ?>">
                    <?php echo $tab['content']; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
