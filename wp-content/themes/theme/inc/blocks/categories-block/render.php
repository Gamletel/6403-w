<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = get_field('block_title');
$categories = get_field('categories');
$archive_link_holder = get_field('archive_link_holder');
$archive_link = get_post_type_archive_link('product');
?>
<?php if ($categories) { ?>
    <div id="categories-block"
         class="archive post-type-archive-product block-padding block-margin <?= $classes; ?> <?= $align; ?>">
        <div class="container">
            <div class="block__content">
                <?php if ($block_title) { ?>
                    <h2 class="block-title"><?= $block_title; ?></h2>
                <?php } ?>

                <div class="categories">
                    <?php
                    wc_get_template('loop/loop-start.php');

                    foreach ($categories as $item) {
                        $category = get_term($item);
                        wc_get_template(
                            'content-product_cat.php',
                            array(
                                'category' => $category,
                            )
                        );
                    }

                    if (!empty($archive_link_holder)) {
                        $title = $archive_link_holder['title'];
                        $btn_text = $archive_link_holder['btn_text'];
                        ?>
                        <a href="<?= $archive_link; ?>" class="archive-link-holder">
                            <div class="archive-link-holder__bg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="315" height="404" viewBox="0 0 315 404"
                                     fill="none">
                                    <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd"
                                          d="M533.479 96.1954C564.272 206.882 598.905 324.287 617.764 371.029L543.583 400.96C529.831 366.877 509.602 302.301 488.723 231.025C490.815 287.441 493.001 330.859 495.293 346.106L420.818 371.546C403.564 340.635 379.275 285.443 353.128 222.634C381.32 340.161 406.92 438.02 408.707 444.686L336.666 477.029C316.56 446.486 288.837 399.013 259.451 346.697C262.004 356.23 264.586 365.864 267.199 375.615C271.285 390.866 275.448 406.402 279.699 422.286L308.112 528.429L218.116 465.386C96.2094 379.988 23.3245 343.766 -21.207 333.824C-42.4045 329.091 -53.7848 331.127 -60.0598 333.646C-66.1996 336.11 -72.2907 340.963 -79.3379 351.409C-86.8569 362.554 -93.4363 376.894 -101.976 396.234C-102.391 397.174 -102.81 398.124 -103.233 399.085C-111.014 416.728 -120.254 437.679 -132.255 457.846C-158.812 502.472 -199.785 544.736 -274.046 560.93L-291.089 482.774C-243.522 472.402 -219.166 447.472 -200.996 416.939C-191.543 401.054 -184.061 384.107 -175.821 365.44L-175.152 363.924C-167.143 345.785 -157.838 324.739 -145.651 306.673C-132.991 287.908 -115.553 269.724 -89.8544 259.41C-64.2909 249.15 -35.5233 248.666 -3.77682 255.754C41.4028 265.841 98.9614 292.782 174.978 340.476C147.784 238.817 123.416 146.756 97.9097 44.224L172.274 16.2436C176.387 24.224 215.453 99.092 262.125 185.498C246.861 120.192 231.725 52.1489 219.966 -7.72009C207.738 -69.9786 198.559 -126.296 197.483 -161.328L273.067 -180.771C290.469 -146.754 324.166 -62.6618 360.204 27.2719C366.241 42.3374 372.343 57.5668 378.446 72.7522C387.574 95.4668 396.707 118.095 405.67 140.085C405.008 118.372 404.361 96.3933 403.724 74.7669C401.538 0.498404 399.474 -69.6103 397.334 -110.491L476.97 -117.481C476.944 -117.691 477.039 -117.274 477.304 -116.112C477.833 -113.793 479.039 -108.503 481.312 -99.3041C484.324 -87.1115 488.579 -70.4721 493.778 -50.5952C504.171 -10.8676 518.239 41.417 533.479 96.1954Z"
                                          fill="var(--card)"/>
                                </svg>
                            </div>

                            <?php if ($title) { ?>
                                <h3 class="archive-link-holder__title"><?= $title; ?></h3>
                            <?php } ?>

                            <?php if ($btn_text) { ?>
                                <div class="archive-link-holder__btn btn card"><?= $btn_text; ?></div>
                            <?php } ?>
                        </a>
                    <?php }

                    wc_get_template('loop/loop-end.php');
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
