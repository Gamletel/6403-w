<?php
$form_title = get_field('form_title');
$form_subtitle = get_field('form_subtitle');
?>
<div class="form form-v2 form-question">
    <?php if ($form_title) { ?>
        <h4 class="form__title"><?= $form_title; ?></h4>
    <?php } ?>

    <?php if ($form_subtitle) { ?>
        <div class="form__subtitle p2"><?= $form_subtitle; ?></div>
    <?php } ?>

    <div class="form__inputs">
        <input class="input" type="text" name="your-name" placeholder="Имя">

        <input class="input" type="tel" name="your-tel" placeholder="Телефон*" required>

        <input class="input" type="text" name="your-question" placeholder="Текст вопроса*" required>
    </div>

    <button class="btn" type="submit" form-send>
        Задать вопрос
    </button>
</div>