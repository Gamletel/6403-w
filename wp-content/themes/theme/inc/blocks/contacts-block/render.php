<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align   = (isset($block['align']) && !empty($block['align'])) ? 'align'.$block['align'] : '';

$block_title = get_field('block_title');
$addresses = @settings('addresses');
$phones = @settings('phones');
$emails = @settings('emails');
$socials = @settings('socials');
$show_map = get_field('show_map');
?>
<div id="contacts-block" class="block-margin <?=$classes;?> <?=$align;?>">
    <?php if ($block_title) {?>
        <h2 class="block-title"><?= $block_title; ?></h2>
    <?php } ?>

    <div class="block__content">
        <div class="block__contacts">
            <?php if (!empty($addresses)) {?>
                <div class="contacts">
                    <div class="contacts__title p3">Адрес</div>

                    <div class="contacts__wrapper">
                        <?php foreach ($addresses as $item) {
                            $value = $item['value'];
                            ?>
                            <div class="contact">
                                <h5 class="contact__title"><?= $value; ?></h5>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

            <?php if (!empty($phones)) {?>
                <div class="contacts">
                    <div class="contacts__title p3">Номер телефона</div>

                    <div class="contacts__wrapper">
                        <?php foreach ($phones as $item) {
                            $name = $item['name'];
                            $value = $item['value'];
                            ?>
                            <a href="tel:<?= $value; ?>" class="contact phone">
                                <h5 class="contact__title"><?= $name; ?></h5>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

            <?php if (!empty($emails)) {?>
                <div class="contacts">
                    <div class="contacts__title p3">Электронная почта</div>

                    <div class="contacts__wrapper">
                        <?php foreach ($emails as $item) {
                            $name = $item['name'];
                            $value = $item['value'];
                            ?>
                            <a href="mailto:<?= $value; ?>" class="contact email">
                                <h5 class="contact__title"><?= $name; ?></h5>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

            <?php if (!empty($socials)) {?>
                <div class="socials">
                    <?php foreach ($socials as $social) {
                        $value = $social['value'];
                        $icon = $social['icon'];
                        ?>
                        <a href="<?= $value; ?>" target="_blank" class="social">
                            <?= get_image($icon, 'full') ?>
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        
        <?php if ($show_map) {?>
            <div class="block__map">
                <?php render_map() ?>
            </div>
        <?php } ?>
    </div>
</div>