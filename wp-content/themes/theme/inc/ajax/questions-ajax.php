<?php
$qa = $args['item'];
$question = get_the_title($qa);
$answer = get_field('answer', $qa);
?>
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