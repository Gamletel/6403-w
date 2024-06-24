<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = get_field('block_title');
$pay = get_field('pay');
$delivery = get_field('delivery');
?>
<?php if (!empty($pay) || !empty($delivery)) { ?>
    <div id="pay-delivery-block" class="block-margin <?= $classes; ?> <?= $align; ?>">
        <?php if ($block_title) { ?>
            <h2 class="block-title"><?= $block_title; ?></h2>
        <?php } ?>

        <?php if (!empty($pay)) {
            $text = $pay['text'];
            $images = $pay['images'];
            ?>
            <div class="pay block">
                <div class="block__content">
                    <h3 class="block__title">
                        Оплата
                    </h3>

                    <?php if ($text) { ?>
                        <div class="block__text text-block"><?= $text; ?></div>
                    <?php } ?>
                </div>

                <?php if (!empty($images)) { ?>
                    <div class="block__images">
                        <?php foreach ($images as $item) {
                            $image = get_image($item, [90, 90]);
                            ?>
                            <?= $image; ?>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <?php if (!empty($delivery)) {
            $text = $delivery['text'];
            $images = $delivery['images'];
            ?>
            <div class="pay block">
                <div class="block__content">
                    <h3 class="block__title">
                        Доставка
                    </h3>

                    <?php if ($text) { ?>
                        <div class="block__text text-block"><?= $text; ?></div>
                    <?php } ?>
                </div>

                <?php if (!empty($images)) { ?>
                    <div class="block__images">
                        <?php foreach ($images as $item) {
                            $image = get_image($item, [90, 90]);
                            ?>
                            <?= $image; ?>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>
