<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = get_field('block_title');
$show_all = get_field('show_all');
$maxQasOnLoad = 4;
if ($show_all) {
    $qas = get_posts(array(
        'numberposts' => $maxQasOnLoad,
        'post_type' => 'qas',
    ));
} else {
    $qas = get_field('qas');
}

$postsIDs = [];
foreach ($qas as $qa) {
    $postsIDs[] = $qa->ID;
}
?>
<?php if (!empty($qas)) { ?>
    <div id="faq-block" class="block-margin block-padding <?= $classes; ?> <?= $align; ?>">
        <div class="container">
            <?php if ($block_title) { ?>
                <h2 class="block__title block-title"><?= $block_title; ?></h2>
            <?php } ?>

            <div class="block__content">
                <div class="block__qas">
                    <?php
                    $IDsArray = [];
                    foreach ($qas as $key => $qa) {
                        $postID = $qa->ID;
                        $question = get_the_title($qa);
                        $answer = get_field('answer', $qa);
                        ?>
                        <?php if ($key < $maxQasOnLoad) { ?>
                            <div class="qa">
                                <div class="question">
                                    <h4 class="question__title"><?= $question; ?></h4>

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none">
                                        <path d="M12 6V18" stroke="var(--head)" stroke-width="1.5"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                        <path d="M6 12H18" stroke="var(--head)" stroke-width="1.5"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </svg>
                                </div>

                                <div class="answer">
                                    <div class="text-block"><?= $answer; ?></div>
                                </div>
                            </div>
                            <?php $IDsArray[] = $postID;
                        } ?>
                    <?php } ?>

                    <?php if (count($qas)>$maxQasOnLoad) { ?>
                        <div id="loadmore" class="link">
                            <?= inline('assets/images/link.svg'); ?>

                            Показать еще
                        </div>
                    <?php } ?>
                </div>

                <div class="block__form">
                    <?php get_form('question') ?>
                </div>
            </div>
        </div>

        <script>
            jQuery(document).ready(function ($) {
                const loadmoreBtn = $('#faq-block #loadmore');
                const qas = $('#faq-block .block__qas');

                loadmoreBtn.click(function () {
                    $(this).hide();

                    $.ajax({
                        type: 'POST',
                        url: '/wp-admin/admin-ajax.php',
                        data: {
                            postsIDs: '<?= implode(',', $postsIDs); ?>',
                            action: 'load_questions',
                        },
                        beforeSend: function (xhr) {
                            qas.addClass('loading');
                        },
                        success: function (response) {
                            qas.html(response);
                            qas.removeClass('loading');

                            const questions = $('#faq-block .qa');
                            questions.each(function () {
                                $(this).click(function (){
                                    let parent = $(this);
                                    let question = $(this).find('.question');
                                    let answer = $(this).find('.answer');
                                    $(this).toggleClass('opened').siblings().removeClass('opened');

                                    questions.each(function () {
                                        if($(this).hasClass('opened')){
                                            $(this).find('.answer').slideDown();
                                        }else{
                                            $(this).find('.answer').slideUp();
                                        }
                                    })
                                })
                            })
                        }
                    });
                })
            });
        </script>
    </div>
<?php } ?>