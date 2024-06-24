<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$slides = get_field('slides');
?>
<?php if (!empty($slides)) { ?>
    <div id="mainbanner-block" class="block-margin <?= $classes; ?> <?= $align; ?>">
        <div class="swiper">
            <div class="swiper-btn-prev invert"><?= inline('assets/images/swiper-btn.svg'); ?></div>

            <div class="swiper-btn-next invert"><?= inline('assets/images/swiper-btn.svg'); ?></div>

            <div class="swiper-wrapper">
                <?php
                $has_title = false;
                foreach ($slides as $slide) {
                    $background = wp_get_attachment_image_url($slide['background'], 'full');
                    $title = $slide['title'];
                    $subtitle = $slide['subtitle'];
                    $btn = $slide['btn'];
                    $btn_style = $btn['type'];
                    $advantages = $slide['advantages'];
                    ?>
                    <div class="swiper-slide">
                        <div class="content">
                            <?php if ($background) { ?>
                                <div class="content__background">
                                    <img src="<?= $background; ?>" alt="">
                                </div>
                            <?php } ?>

                            <div class="container">
                                <div class="content__text">
                                    <?php if ($title) { ?>
                                        <div class="title-container" data-swiper-parallax="-100">
                                            <?php if (!$has_title) { ?>
                                                <h1 class="content__title"
                                                ><?= $title; ?></h1>
                                                <?php
                                                $has_title = !$has_title;
                                            } else { ?>
                                                <h2 class="content__title"><?= $title; ?></h2>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>

                                    <?php if ($subtitle) { ?>
                                        <div class="subtitle-container" data-swiper-parallax="-200">
                                            <div class="p1 content__subtitle"><?= $subtitle; ?></div>
                                        </div>
                                    <?php } ?>

                                    <?php switch ($btn_style) {
                                        case 'none':
                                            break;

                                        case 'modal':
                                            $text = $btn['text'];
                                            ?>
                                            <div class="btn-container" data-swiper-parallax="-300">
                                                <div class="btn" data-modal="callback"><?= $text; ?></div>
                                            </div>
                                            <?php break;

                                        case 'link':
                                            $link = $btn['link'];
                                            $text = $btn['text'];
                                            ?>
                                            <div class="btn-container" data-swiper-parallax="-300">
                                                <a href="<?= $link; ?>" class="btn"><?= $text; ?></a>
                                            </div>
                                        <?php
                                    } ?>

                                    <?php if (!empty($advantages)) { ?>
                                        <div class="content__advantages" data-swiper-parallax="-400"
                                             data-swiper-parallax-opacity="0">
                                            <?php foreach ($advantages as $advantage) {
                                                $title = $advantage['title'];
                                                $subtitle = $advantage['subtitle'];
                                                ?>
                                                <div class="advantage">
                                                    <?php if ($title) { ?>
                                                        <h3 class="advantage__title"><?= $title; ?></h3>
                                                    <?php } ?>

                                                    <?php if ($subtitle) { ?>
                                                        <h5 class="advantage__subtitle"><?= $subtitle; ?></h5>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
