(function ($) {
	'use strict';

	$('#em-sortable-portfolio').sortable({
		axis: 'y',
		handle: '.dashicons-menu',
		placeholder: 'em-order-item ui-sortable-placeholder',
		update: function () {
			$('#em-sortable-portfolio .em-order-item').each(function (i) {
				$(this).find('.em-order-badge').text(i + 1);
			});
		},
	});

	$('#em-save-order').on('click', function () {
		var $btn    = $(this);
		var $notice = $('#em-order-notice');
		var ids     = [];

		$('#em-sortable-portfolio .em-order-item').each(function () {
			ids.push($(this).data('id'));
		});

		$btn.prop('disabled', true).text('Saving\u2026');
		$notice.hide();

		$.post(
			emPortfolioOrder.ajaxUrl,
			{
				action: 'em_save_portfolio_order',
				nonce:  emPortfolioOrder.nonce,
				ids:    ids,
			},
			function (response) {
				$btn.prop('disabled', false).text('Save Order');
				if (response.success) {
					$notice.text('Order saved.').css('color', '#46b450').fadeIn();
				} else {
					$notice.text('Error: ' + response.data).css('color', '#dc3232').fadeIn();
				}
				setTimeout(function () { $notice.fadeOut(); }, 3000);
			}
		).fail(function () {
			$btn.prop('disabled', false).text('Save Order');
			$notice.text('Request failed. Please try again.').css('color', '#dc3232').fadeIn();
		});
	});
}(jQuery));
