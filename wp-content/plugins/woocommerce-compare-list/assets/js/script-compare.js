jQuery(document).ready(function ($) {
	// Создаем куку, если её нет
	if ($.cookie('woocommerce-compare') == null) {
		let cookieStart = [];
		$.cookie('woocommerce-compare', JSON.stringify(cookieStart), { expires: 30, path: '/' });
	}

	// Функция добавления / удаления товара
	$('body').on('click', '.compare-button', function () {
		let compareItems = $.parseJSON($.cookie('woocommerce-compare'));
		let currenItemId = $(this).val();
		let alreadyAdded = $.inArray(currenItemId, compareItems);

		if (alreadyAdded === -1) {
			compareItems.push(currenItemId);
			$.cookie('woocommerce-compare', JSON.stringify(compareItems), { expires: 30, path: '/' });
			$(this).addClass('added');
			if($('#compare-modal').length > 0) {
				compareModal('Товар добавлен в сравнение!');
			}
		} else {
			let newItems = compareItems.filter(function (n) { return n != currenItemId })
			$.cookie('woocommerce-compare', JSON.stringify(newItems), { expires: 30, path: '/' });
			$(this).removeClass('added');
			if($('#compare-modal').length > 0) {
				compareModal('Товар удален из сравнения!');
			}
		}
		if($('#compare-counter').length > 0) {
			insertCount();
		}
	});

	// Функция обновления счетчика товаров
	function insertCount() {
		$.ajax({
			url: '/wp-admin/admin-ajax.php',
			type: 'POST',
			data: { action: 'compare_counter', count: $.parseJSON($.cookie('woocommerce-compare')).length },
			success: function (data) {
				$('#compare-counter').text(data);
			},
			error: function () {
				console.log('Ошибка');
			}
		});
	}

	// Удаление товара из сравнения с перезагрузкой страницы
	$('body').on('click', '.compare-delete-item', function() {
		let compareItems = $.parseJSON($.cookie('woocommerce-compare'));
		let currenItemId = $(this).val();
		let alreadyAdded = $.inArray(currenItemId, compareItems);

		if(alreadyAdded !== -1) {
			let newItems = compareItems.filter(function (n) { return n != currenItemId })
			$.cookie('woocommerce-compare', JSON.stringify(newItems), { expires: 30, path: '/' });
			window.location.reload();
		}
	})

	//Функция для вызова модального окна
	function compareModal(text) {
		$.ajax({
			url: '/wp-admin/admin-ajax.php',
			type: 'GET',
			data: { action: 'add_modal_compare' },
			success: function (data) {
				$('#compare-modal').text(text);
				$('#compare-modal').addClass('active');
				setTimeout(function() {
					$('#compare-modal').removeClass('active');
				}, 2000);
			},
			error: function () {
				console.log('Ошибка');
			}
		});
	}
})