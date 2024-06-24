<?php
	global $WoocommerceCompare;
	$prduct_id = get_the_ID();
?>

<button value="<?php echo $prduct_id; ?>" class="compare-button <?php if($WoocommerceCompare->compare_check_item($prduct_id) == true) { ?>added<?php } ?>">Добавить в сравнение</button>