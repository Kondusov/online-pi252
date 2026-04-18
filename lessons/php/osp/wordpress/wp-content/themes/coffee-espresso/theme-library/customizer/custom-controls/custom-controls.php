<?php
/**
 * Customizer Custom Controls
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

	/**
	 * Toggle Switch Custom Control
	 */
	class Coffee_Espresso_Toggle_Switch_Custom_Control extends WP_Customize_Control {
		public $coffee_espresso_type = 'toggle_switch';
		public function render_content() {
			?>
			<div class="toggle-switch-control">
				<div class="toggle-switch">
					<input type="checkbox" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" class="toggle-switch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" 
					<?php
						$this->link();
						checked( $this->value() );
					?>
					>
					<label class="toggle-switch-label" for="<?php echo esc_attr( $this->id ); ?>">
						<span class="toggle-switch-inner"></span>
						<span class="toggle-switch-switch"></span>
					</label>
				</div>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
			</div>
			<?php
		}
	}

	/**
	 * Separator/Heading Custom Control
	 */
	class Coffee_Espresso_Separator_Custom_Control extends WP_Customize_Control {
		public $coffee_espresso_type = 'separator';
		public function render_content() {
			?>
			<div class="separator-control">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<hr />
			</div>
			<?php
		}
	}

	class Coffee_Espresso_Image_Radio_Control extends WP_Customize_Control {

		public function render_content() {
			if (empty($this->choices)) return;
	
			$coffee_espresso_name = '_customize-radio-' . $this->id;
			?>
			
			<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
		   
			<ul class="controls" id='coffee-espresso-custom-container'>
				<?php
				
				foreach ($this->choices as $coffee_espresso_value => $coffee_espresso_label) :
					
					$class = ($this->value() == $coffee_espresso_value) ? 'coffee-espresso-selected-img coffee-espresso-selector-img ' : 'coffee-espresso-selector-img';
					?>
					
					<li style="display: inline;">
						<label>
							<input <?php $this->link(); ?> style='display:none' type="radio" value="<?php echo esc_attr($coffee_espresso_value); ?>" name="<?php echo esc_attr($coffee_espresso_name); ?>" <?php
								  $this->link();
								  checked($this->value(), $coffee_espresso_value);
								  ?> />
	
							<img src='<?php echo esc_url($coffee_espresso_label); ?>' class='<?php echo esc_attr($class); ?>' />
						</label>
					</li>
					<?php
				endforeach;
				?>
			</ul>
	
			<script type="text/javascript">
				(function($) {
					$(document).ready(function() {
						$('#coffee-espresso-custom-container img').on('click', function() {
							var $this = $(this);
							var input = $this.prev('input');
							var inputName = input.attr('name');
	
							// Remove the 'coffee-espresso-selected-img' class from all images
							$('#coffee-espresso-custom-container img').removeClass('coffee-espresso-selected-img');
	
							// Add the 'coffee-espresso-selected-img' class to the clicked image
							$this.addClass('coffee-espresso-selected-img');
	
							// Set the input as checked
							input.prop('checked', true).trigger('change');
	
							// Optionally: Update the WordPress Customizer to reflect the change
							wp.customize.control(inputName).setting.set(input.val());
						});
					});
				})(jQuery);
			</script>
			<?php
		}
	}

	// Add Coffee_Espresso_Customize_Range_Control
	class Coffee_Espresso_Customize_Range_Control extends WP_Customize_Control {
		public $type = 'coffee-espresso-range-slider';

		public function to_json() {
			if ( ! empty( $this->setting->default ) ) {
				$this->json['default'] = $this->setting->default;
			} else {
				$this->json['default'] = false;
			}
			parent::to_json();
		}

		public function enqueue() {
			wp_enqueue_script( 'coffee-espresso-range-slider', get_template_directory_uri() . '/resource/js/range-control.js', array( 'jquery' ), '', true );
			wp_enqueue_style( 'coffee-espresso-range-slider', get_template_directory_uri() . '/resource/css/range-control.css' );
		}

		public function render_content() {
			?>
			<label>
				<?php if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif;
				if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>
				<div id="<?php echo esc_attr( $this->id ); ?>">
					<div class="coffee-espresso-range-slider">
						<input class="coffee-espresso-range-slider-range" type="range" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->input_attrs(); $this->link(); ?> />
						<input class="coffee-espresso-range-slider-value" type="number" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->input_attrs(); $this->link(); ?> />
						<?php if ( ! empty( $this->setting->default ) ) : ?>
							<span class="coffee-espresso-range-reset-slider" title="<?php esc_attr_e( 'Reset', 'coffee-espresso' ); ?>"><span class="dashicons dashicons-image-rotate"></span></span>
						<?php endif;?>
					</div>
				</div>
			</label>
			<?php
		}
	}

	class Coffee_Espresso_Customize_Category_Dropdown_Control extends WP_Customize_Control {
		public $coffee_espresso_type = 'category_dropdown';
	
		public function render_content() {
			$coffee_espresso_categories = get_categories();
			$coffee_espresso_selected = esc_attr($this->value());
	
			echo '<select ' . $this->get_link() . '>';
			echo '<option value="">' . __('Select a Category', 'coffee-espresso') . '</option>';
	
			foreach ($coffee_espresso_categories as $coffee_espresso_category) {
				echo '<option value="' . esc_attr($coffee_espresso_category->slug) . '" ' . selected($coffee_espresso_selected, $coffee_espresso_category->slug, false) . '>';
				echo esc_html($coffee_espresso_category->name);
				echo '</option>';
			}
	
			echo '</select>';
		}
	}
}

if ( class_exists( 'WP_Customize_Section' ) ) {
	/**
	 * Upsell section
	 */
	class Coffee_Espresso_Upsell_Section extends WP_Customize_Section {
		/**
		 * The type of control being rendered
		 */
		public $type = 'coffee-espresso-upsell';

		/**
		 * The Upsell button text
		 */
		public $button_text = '';

		/**
		 * The Upsell URL
		 */
		public $url = '';

		/**
		 * The background color for the control
		 */
		public $background_color = '';

		/**
		 * The text color for the control
		 */
		public $text_color = '';

		/**
		 * Render the section, and the controls that have been added to it.
		 */
		protected function render() {
			$background_color = ! empty( $this->background_color ) ? esc_attr( $this->background_color ) : '#fff';
			$text_color       = ! empty( $this->text_color ) ? esc_attr( $this->text_color ) : '#50575e';
			$section_class    = esc_attr( $this->id ); // Use the section ID as the class name
			?>
			<li id="accordion-section-<?php echo esc_attr( $this->id ); ?>" class="Coffee_Espresso_Upsell_Section accordion-section control-section control-section-<?php echo esc_attr( $this->id ); ?> cannot-expand <?php echo $section_class; ?>">
				<h3 class="accordion-section-title" style="color:<?php echo esc_attr( $text_color ); ?>; background:<?php echo esc_attr( $background_color ); ?>;border-left-color:<?php echo esc_attr( $background_color ); ?>;">
					<?php echo esc_html( $this->title ); ?>
					<a href="<?php echo esc_url( $this->url ); ?>" class="button button-secondary alignright" target="_blank" style="margin-top: -4px;"><?php echo esc_html( $this->button_text ); ?></a>
				</h3>
			</li>
			<?php
		}
	}
}