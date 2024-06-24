<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = get_field('block_title');
$pages = get_field('pages');
?>
<?php if ($pages) { ?>
    <div id="pages-block" class="block-margin <?= $classes; ?> <?= $align; ?>">
        <?php if ($block_title) { ?>
            <h2 class="block-title"><?= $block_title; ?></h2>
        <?php } ?>

        <div class="pages">
            <?php foreach ($pages as $page) {
                $icon = get_image($page['icon'], 'full');
                $title = $page['title'];
                $link = $page['link'];
                ?>
                <a href="<?= $link; ?>" class="page">
                    <?php if ($title) { ?>
                        <h5 class="page__title"><?= $title; ?></h5>
                    <?php } ?>

                    <div class="page__bottom">
                        <div class="page__btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                 fill="none">
                                <rect width="30" height="30" rx="15" fill="var(--primary)"/>

                                <path d="M21.3536 15.3536C21.5488 15.1583 21.5488 14.8417 21.3536 14.6464L18.1716 11.4645C17.9763 11.2692 17.6597 11.2692 17.4645 11.4645C17.2692 11.6597 17.2692 11.9763 17.4645 12.1716L20.2929 15L17.4645 17.8284C17.2692 18.0237 17.2692 18.3403 17.4645 18.5355C17.6597 18.7308 17.9763 18.7308 18.1716 18.5355L21.3536 15.3536ZM9 15.5H21V14.5H9V15.5Z"
                                      fill="var(--card)"/>
                            </svg>
                        </div>
                        <?php if ($icon) { ?>
                            <div class="page__icon"><?= $icon; ?></div>
                        <?php } ?>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
<?php } ?>
