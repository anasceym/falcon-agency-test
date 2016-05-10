var Vue = require('Vue');

window.Application = new Vue({

	el: '#falcon-agency-test-application',

	init: function () {

	},

	ready: function () {

		this.initPlugins();

		console.log('[Application] Ready');
	},

	methods: {
		
		deleteItem: function(e) {
			
			var $elem = $(e.target);
			
		},

		initPlugins: function () {

			$.each($('[data-plugin=touchspin]'), function () {

				var element = $(this);

				var defaultOptions = [
					'prefix',
					'postfix',
					'min',
					'max',
					'steps',
					'decimals'
				];

				var options = {};

				defaultOptions.forEach(function (opt) {

					if (typeof element.data(opt) !== 'undefined') options[opt] = element.data(opt);
				});

				$(this).TouchSpin(options);
			});

			$.each($('[data-plugin=datepicker]'), function () {

				$(this).datepicker({});
			});
			
			if($('[data-plugin=notification]').length) {
				
				var element = $('[data-plugin=notification]');
				
				swal({
					title: '',
					text: element.val(),
					type: element.data('type') 
				});
			}
			
			$.each($('[data-method=delete]'), function() {
				
				var $element = $(this);
				var classes = $element.attr('class');
				var link = $element.attr('href');
				var csrfToken = $element.data('csrfToken'); 
				
				$element.wrap('<form style="display: inline-block;" action="'+link+'" method="POST"><input type="hidden" value="DELETE" name="_method"><input type="hidden" name="_token" value="'+csrfToken+'"/><button type="submit" class="'+classes+'"><i class="fa fa-remove"></i></button></form>');
			});
		}
	}
});