<?php
get_header();
global $WoocommerceCompare;
$CompareItems = $WoocommerceCompare->compare_items();
$attributes = $WoocommerceCompare->get_attr_products_in_compare();
?>

    <div class="page-compare-list">
        <div class="container">
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php if (function_exists('bcn_display')) {
                    bcn_display();
                }
                ?>
            </div>
            <div class="title-page"><h1><?php wp_title("", true); ?></h1></div>
            <div class="page-compare-list-body">
                <?php if (!empty($CompareItems)) { ?>
                    <table class="page-compare-table">
                        <tbody>
                        <tr class="products-row">
                            <td></td>
                            <?php
                            foreach ($CompareItems as $CompareItem) { ?>
                                <td class="product-item">
                                    <?php
                                    $post_object = get_post($CompareItem);
                                    setup_postdata($GLOBALS['post'] =& $post_object);
                                    wc_get_template_part('content', 'product');
                                    ?>
                                </td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php if (get_option('show_price_compare') == 'yes') { ?>
                            <tr class="attributes-row">
                                <td class="attribute-name">Цена</td>
                                <?php
                                foreach ($CompareItems as $CompareItem) {
                                    $_c_product = wc_get_product($CompareItem); ?>
                                    <td class="attribute-value">
                                        <?php echo $_c_product->get_price_html(); ?>
                                    </td>
                                    <?php
                                }
                                ?>
                            </tr>
                        <?php } ?>
                        <?php
                        foreach ($attributes as $attribute) { ?>
                            <tr class="attributes-row">
                                <td class="attribute-name">
                                    <?php echo wc_attribute_label($attribute); ?>
                                </td>
                                <?php foreach ($CompareItems as $CompareItem) { ?>
                                    <td class="attribute-value">
                                        <?php
                                        $_c_product = wc_get_product($CompareItem);
                                        $attr_val = $_c_product->get_attribute($attribute);
                                        if ($attr_val) {
                                            echo $attr_val;
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                <?php } ?>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr class="products-buttons-delete-row">
                            <td></td>
                            <?php
                            foreach ($CompareItems as $CompareItem) { ?>
                                <td class="product-button-delete">
                                    <button value="<?php echo $CompareItem; ?>" class="compare-delete-item">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none">
                                                <path d="M7 7L17 17M7 17L17 7" stroke="var(--primary)"
                                                      stroke-width="1.5"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>

                                        <h6>
                                            Удалить
                                        </h6>
                                    </button>
                                </td>
                                <?php
                            }
                            ?>
                        </tr>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
            <?php if (empty($CompareItems)) { ?>
                <div class="not-found-items">
                    Сейчас у Вас нет товаров в сравнении!
                </div>
            <?php } ?>
        </div>
    </div>

<?php get_footer(); ?>