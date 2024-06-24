<form class="filters-form" method="get" data-auto="<?= wc_bool_to_string($instance['auto']) ?>"
      action="<?= esc_url($instance['current_url']) ?>">
    <?php
    if (get_query_var('s')) {
        ?>
        <input type="hidden" name="s" value="<?= get_query_var('s') ?>">
        <input type="hidden" name="post_type" value="product">
        <?php
    }

    foreach ($this->filters as $attr => $data) {
        if ($attr == 'price') {
            if ($data['price_min'] >= 0 and $data['price_max'] > 0 and ($data['price_min'] != $data['price_max'])) {
                ?>
                <div class="filter-block filter-block-price opened">
                    <div class="filter-block-header">
                        <?php /*<div class="filter-block-title"><?=esc_html($data['name'])?></div> */
                        ?>
                        <div class="filter-block-title">Цена (руб.)</div>
                    </div>
                    <div class="filter-block-content">
                        <div class="range-slider" data-filter-node="slider" data-min="<?= $data['price_min'] ?>"
                             data-max="<?= $data['price_max'] ?>"></div>
                        <div class="inputs price range" data-mode="<?= $data['type'] ?>">
                            <?php if ($data['type'] != 'ranges') { ?>
                                <div class="group">
                                    <input class="input" type="number" data-label="Мин. цена" data-type="min"
                                           data-min="<?= $data['price_min'] ?>" data-name="min_price"
                                           value="<?= $data['current_min_price'] ?>"
                                           <?php if ($data['current_min_price'] != $data['price_min'] and $data['current_min_price'] != '') { ?>name="min_price"<?php } ?>>
                                </div>
                                <span class="separator"></span>
                                <div class="group">
                                    <input class="input" type="number" data-label="Макс. цена" data-type="max"
                                           data-max="<?= $data['price_max'] ?>" data-name="max_price"
                                           value="<?= $data['current_max_price'] ?>"
                                           <?php if ($data['current_max_price'] != $data['price_max'] and $data['current_max_price'] != '') { ?>name="max_price"<?php } ?>>
                                </div>
                            <?php } else { ?>
                                <input type="hidden" data-type="min" data-min="<?= $data['price_min'] ?>"
                                       data-name="min_price" value="<?= $data['current_min_price'] ?>"
                                       <?php if ($data['current_min_price'] != $data['price_min'] and $data['current_min_price'] != '') { ?>name="min_price"<?php } ?>>
                                <input type="hidden" data-type="max" data-max="<?= $data['price_max'] ?>"
                                       data-name="max_price" value="<?= $data['current_max_price'] ?>"
                                       <?php if ($data['current_max_price'] != $data['price_max'] and $data['current_max_price'] != '') { ?>name="max_price"<?php } ?>>
                            <?php } ?>
                        </div>
                        <?php if ($data['type'] != 'slider') { ?>
                            <div class="inputs radios" data-filter-node="ranges">
                                <?php
                                foreach ($data['ranges'] as $index => $params) {
                                    $vid = esc_attr("filter_{$attr}_{$index}");
                                    $checked = ($params['active']) ? ' checked="checked"' : '';
                                    ?>
                                    <div class="group">
                                        <input type="radio" id="<?= $vid ?>" data-min="<?= $params['min'] ?>"
                                               data-max="<?= $params['max'] ?>" <?= $checked ?>>
                                        <label for="<?= $vid ?>"><?= esc_html($params['name']) ?></label>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        <?php } else { ?>
                        <?php } ?>
                    </div>
                </div>
                <?php
            }
        } elseif ($attr != 'tip' && $attr != 'glubina-sm' && $attr != 'vysota-sm') {
            $vc = count($data['values']);
            if ($vc > 0) {
                $has_search = $data['search'] && $vc > 0;
                $search_id = '';
                $search_class = '';
                if ($has_search) {
                    $search_id = ' id="fl_' . $attr . '"';
                    $search_class = 'filterable';
                }
                $opened = ($data['has_active']) ? ' opened' : '';
                ?>
                <div class="filter-block<?= $opened ?>">
                    <div class="filter-block-header">
                        <div class="filter-block-title"><?= esc_html($data['name']) ?></div>
                        <div class="filter-block-toggler">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6"
                                 fill="none">
                                <path d="M9 1L5 5L1 1" stroke="var(--main-text)" stroke-width="1.5"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    <div <?= $search_id ?> class="filter-block-content <?= $search_class ?>" <?php if (!$opened) {
                        echo 'style="display:none"';
                    } ?>>
                        <?php /* if ($has_search) { ?>
                            <div class="local-search" <?php if (!$opened) {
                                echo 'style="display:none"';
                            } ?>>
                                <input class="search" type="text" autocorrect="off" spellcheck="true"
                                       placeholder="Поиск">
                                <?= file_get_contents(TEMPLATEPATH . '/assets/images/search.svg'); ?>
                            </div>
                        <?php }  */ ?>
                        <div class="inputs checkboxes list">
                            <?php
                            foreach ($data['values'] as $params) {
                                $vid = esc_attr("filter_{$attr}_{$params['value']}");
                                $checked = ($params['active']) ? ' checked="checked"' : '';
                                $pl = ($params['depth'] > 0) ? ' style="padding-left:' . ($params['depth']) . 'em;"' : '';
                                ?>
                                <div class="group"<?= $pl ?>>
                                    <input type="checkbox" name="f_<?= $attr ?>[]" id="<?= $vid ?>"
                                           value="<?= $params['value'] ?>"<?= $checked ?>>
                                    <label class="group-label p3" for="<?= $vid ?>">
                                        <div class="indicator">
                                            <div class="checked">
                                                <?= inline('assets/images/checked.svg'); ?>
                                            </div>

                                            <div class="unchecked">
                                                <?= inline('assets/images/unchecked.svg'); ?>
                                            </div>
                                        </div>

                                        <?= esc_html($params['name']) ?></label>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
    ?>
    <?php if (!$instance['auto']) { ?>
        <button class="button btn" type="submit" value="filter"><span>Применить фильтры</span></button>

        <button class="button reset" type="reset" value="filter">
            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 11 11" fill="none">
                <g clip-path="url(#clip0_501_2343)">
                    <path d="M8.39414 0.5L5.5 3.39412L2.60588 0.5L0.5 2.60588L3.39414 5.5L0.5 8.39412L2.60586 10.5L5.5 7.60586L8.39414 10.5L10.5 8.39412L7.60586 5.49998L10.5 2.60586L8.39414 0.5Z"
                          fill="var(--main-text)"/>
                </g>
                <defs>
                    <clipPath id="clip0_501_2343">
                        <rect width="10" height="10" fill="white" transform="translate(0.5 0.5)"/>
                    </clipPath>
                </defs>
            </svg>

            Очистить фильтры
        </button>
    <?php } ?>
</form>