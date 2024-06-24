<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = get_field('block_title');
$steps = get_field('steps');
$last_step = get_field('last_step');
?>
<?php if (!empty($steps)) { ?>
    <div id="steps-block" class="block-margin block-padding <?= $classes; ?> alignfull">
        <div class="container">
            <?php if ($block_title) { ?>
                <h2 class="block-title"><?= $block_title; ?></h2>
            <?php } ?>

            <div class="steps">
                <?php foreach ($steps as $key => $step) {
                    $curStep = $key + 1;
                    $title = $step['title'];
                    $text = $step['text'];
                    ?>
                    <div class="step">
                        <div class="step__index">
                            <?php if($curStep < 10){
                                echo '0'.$curStep;
                            }else{
                                echo $curStep;
                            } ?>
                        </div>
                        <?php if ($title) { ?>
                            <h6 class="step__title"><?= $title; ?></h6>
                        <?php } ?>

                        <?php if ($text) { ?>
                            <div class="p2 step__text"><?= $text; ?></div>
                        <?php } ?>
                    </div>
                <?php } ?>

                <?php if (!empty($last_step)) {
                    $title = $last_step['title'];
                    $text = $last_step['text'];
                    $link = $last_step['link'];
                    $btn_text = $last_step['btn_text'];
                    ?>
                    <div class="last-step">
                        <?php if ($title) { ?>
                            <h5 class="last-step__title"><?= $title; ?></h5>
                        <?php } ?>

                        <?php if ($text) { ?>
                            <div class="p2 last-step__text"><?= $text; ?></div>
                        <?php } ?>

                        <?php if ($link && $btn_text) { ?>
                            <a href="<?= $link; ?>" class="last-step__btn btn card">
                                <?= $btn_text; ?>
                            </a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
