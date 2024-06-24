<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = get_field('block_title');
$block_description = get_field('description');
$table = get_field('table');
?>
<?php if (!empty($table)) { ?>
    <div id="table-block" class="block-margin <?= $classes; ?> <?= $align; ?>">
        <?php if ($block_title) { ?>
            <h2 class="block-title"><?= $block_title; ?></h2>
        <?php } ?>

        <?php if ($block_description) { ?>
            <div class="block__description text-block"><?= $block_description; ?></div>
        <?php } ?>

        <?php
        $header = $table['header'];
        $body = $table['body'];
        ?>
        <div class="table-container">
            <table>
                <?php if ($header) { ?>
                    <thead>
                    <?php foreach ($header as $item) {
                        $td = $item['c'];
                        ?>
                        <td><h5><?= $td; ?></h5></td>
                    <?php } ?>
                    </thead>
                <?php } ?>

                <tbody>
                <?php foreach ($body as $tr) { ?>
                    <tr>
                        <?php foreach ($tr as $key => $item) {
                            $td = $item['c'];
                            ?>
                            <td>
                                <?php if ($key == 0) { ?>
                                    <div class="text-block"><?= $td; ?></div>
                                <?php } else { ?>
                                    <div class="p1"><?= $td; ?></div>
                                <?php } ?>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } ?>
