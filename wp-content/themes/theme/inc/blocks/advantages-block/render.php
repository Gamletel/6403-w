<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = get_field('block_title');
$advantages = get_field('advantages');
?>
<?php if ($advantages) { ?>
    <div id="advantages-block" class="block-margin <?= $classes; ?> <?= $align; ?>">
        <?php if ($block_title) { ?>
            <h2 class="block-title"><?= $block_title; ?></h2>
        <?php } ?>

        <div class="advantages">
            <?php foreach ($advantages as $advantage) {
                $title = $advantage['title'];
                $text = $advantage['text'];
                ?>
                <div class="advantage">
                    <?php if ($title) { ?>
                        <h3 class="advantage__title"><?= $title; ?></h3>
                    <?php } ?>

                    <?php if ($text) { ?>
                        <h3 class="advantage__text"><?= $text; ?></h3>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>
