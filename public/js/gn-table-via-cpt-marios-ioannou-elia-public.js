(function ($) {
	'use strict';

	$(document).ready(function () {

		const GnWorksTable = {
			wrapper: $('#gn-works-wrapper'),
			search: $('#gn-works-search'),
			body: $('#gn-works-body'),
			pagination: $('#gn-works-pagination'),
			loader: $('#gn-works-loader'),
			state: {
				page: 1,
				search: '',
				orderby: 'year',
				order: 'DESC'
			},
			typingTimer: null,

			init: function () {
				if (!this.wrapper.length) return;

				this.bindEvents();
			},

			bindEvents: function () {
				const self = this;

				// Search Debounce
				this.search.on('keyup', function () {
					clearTimeout(self.typingTimer);
					self.state.search = $(this).val();
					self.state.page = 1; // Reset to page 1 on search
					self.typingTimer = setTimeout(function () {
						self.fetchWorks();
					}, 500);
				});

				// Sort Headers
                                this.wrapper.on('click', '.gn-sortable', function () {
                                        const sort = $(this).data('sort');
                                        let order = 'ASC';

                                        // Toggle order if clicking same header
                                        if (self.state.orderby === sort && self.state.order === 'ASC') {
                                                order = 'DESC';
                                        }

                                        // Update UI
                                        $('.gn-sortable').removeAttr('data-order').find('.gn-sort-icon').text('');
                                        $(this).attr('data-order', order.toLowerCase());
                                        $(this).find('.gn-sort-icon').text(order === 'ASC' ? '▲' : '▼');

                                        self.state.orderby = sort;
                                        self.state.order = order;
                                        self.state.page = 1; // Reset to first page when sorting
                                        self.fetchWorks();
                                });

                                // Pagination
                                this.wrapper.on('click', '.gn-page-btn', function () {
                                        if ($(this).hasClass('active')) return;
                                        self.state.page = parseInt($(this).data('page'), 10);
                                        self.fetchWorks();
                                });
			},

			fetchWorks: function () {
				const self = this;

				this.loader.show();
				this.body.css('opacity', '0.5');

				$.ajax({
					url: gn_table_ajax.ajax_url,
					type: 'POST',
					data: {
						action: 'gn_get_works',
						nonce: gn_table_ajax.nonce,
						page: this.state.page,
						search: this.state.search,
						orderby: this.state.orderby,
						order: this.state.order
					},
					success: function (response) {
						if (response.success) {
							self.body.html(response.data.html);
							self.pagination.html(response.data.pagination);
						}
					},
					complete: function () {
						self.loader.hide();
						self.body.css('opacity', '1');
					}
				});
			}
		};

		GnWorksTable.init();

	});

})(jQuery);
