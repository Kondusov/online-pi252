<?php
/**
 * Right Buttons Panel.
 *
 * @package coffee_espresso
 */
?>
<div class="panel-right">
	<div class="pro-btn theme-btn">
		<div class="screenshot">
			<img src="<?php echo esc_url(get_template_directory_uri()) .'/theme-library/getting-started/images/proscreenshot.png'; ?>" />
		</div>
		<br>
		<div class="theme-info">
			<h3><?php esc_html_e( 'Property WordPress Theme', 'coffee-espresso' ); ?></h3>
			<div class="theme-price">
				<span class="price-text"><?php esc_html_e( 'Price:', 'coffee-espresso' ); ?></h6>
				<del><?php esc_html_e( '$49', 'coffee-espresso' ); ?></del>
				<span><?php esc_html_e( '$39', 'coffee-espresso' ); ?></span>
			</div>
			<div class="panelbutton">
				<a class="button button-primary" href="<?php echo esc_url( COFFEE_ESPRESSO_PREMIUM_PAGE ); ?>" title="<?php esc_attr_e( 'Go Pro', 'coffee-espresso' ); ?>" target="_blank"><?php esc_html_e( 'Try Premium', 'coffee-espresso' ); ?></a>

				<a class="button button-primary" href="<?php echo esc_url( COFFEE_ESPRESSO_PRO_DEMO ); ?>" title="<?php esc_attr_e( 'Live Demo', 'coffee-espresso' ); ?>" target="_blank"><?php esc_html_e( 'Live Demo', 'coffee-espresso' ); ?></a>
			</div>
			<a class="button button-primary pro-doc" href="<?php echo esc_url( COFFEE_ESPRESSO_PREMIUM_DOCUMENTATION ); ?>" title="<?php esc_attr_e( 'Pro Documentation', 'coffee-espresso' ); ?>" target="_blank"><?php esc_html_e( 'Pro Documentation', 'coffee-espresso' ); ?></a>
		</div>
	</div>
	<div class="pro-btn bundle-btn">
		<div class="bundle-img">
			<img src="<?php echo esc_url(get_template_directory_uri()) .'/theme-library/getting-started/images/bundle.png'; ?>" />
		</div>
		<br>
		<h3><?php esc_html_e( 'WP Theme Bundle', 'coffee-espresso' ); ?></h3>
		<p><?php esc_html_e( 'Get access to a collection of premium WordPress themes in one bundle. Enjoy effortless website building, full customization, and dedicated customer support for a smooth, professional web experience.', 'coffee-espresso' ); ?></p>
		<a class="button button-primary" href="<?php echo esc_url( COFFEE_ESPRESSO_BUNDLE_PAGE ); ?>" title="<?php esc_attr_e( 'Go Pro', 'coffee-espresso' ); ?>" target="_blank">
            <?php esc_html_e( 'Exclusive Theme Bundle - $79', 'coffee-espresso' ); ?>
        </a>
	</div>
</div>