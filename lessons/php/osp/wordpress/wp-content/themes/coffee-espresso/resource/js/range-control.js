wp.customize.controlConstructor['coffee-espresso-range-slider'] = wp.customize.Control.extend({

	ready: function() {
		'use strict';

		var control = this,
			slider = control.container.find( '.coffee-espresso-range-slider-range' ),
			output = control.container.find( '.coffee-espresso-range-slider-value' );

		slider[0].oninput = function() {
			control.setting.set( this.value );
		}

		if ( control.params.default !== false ) {
			var reset = control.container.find( '.coffee-espresso-range-reset-slider' );

			reset[0].onclick = function() {
				control.setting.set( control.params.default );
			}
		}
	}

});