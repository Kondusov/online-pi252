<?php
if ( ! get_theme_mod( 'coffee_espresso_enable_product_section', false ) ) {
	return;
}

$coffee_espresso_args = '';

coffee_espresso_render_service_section( $coffee_espresso_args );

/**
 * Render Product Section.
 */
function coffee_espresso_render_service_section( $coffee_espresso_args ) { ?>
		<section id="coffee_espresso_trending_section" class="asterthemes-frontpage-section product-section trending-style-1">
		<?php
		if ( is_customize_preview() ) :
			coffee_espresso_section_link( 'coffee_espresso_service_section' );
		endif;

		$coffee_espresso_trending_product_sub_heading = get_theme_mod( 'coffee_espresso_trending_product_sub_heading', '' );
		$coffee_espresso_trending_product_heading     = get_theme_mod( 'coffee_espresso_trending_product_heading' );
		$coffee_espresso_product_view_button_text     = get_theme_mod( 'coffee_espresso_product_view_button_text' );
		$coffee_espresso_product_view_button_url      = get_theme_mod( 'coffee_espresso_product_view_button_url' );
		?>
		<div class="asterthemes-wrapper">
			<?php if ( ! empty( $coffee_espresso_trending_product_sub_heading ) || ! empty( $coffee_espresso_trending_product_heading ) ) { ?>
				<div class="header-contact-inner product-section-header wow bounceInUp">
					<?php if ( ! empty( $coffee_espresso_trending_product_sub_heading ) ) { ?>
						<span class="product-sub-heading"><?php echo esc_html( $coffee_espresso_trending_product_sub_heading ); ?></span>
					<?php } ?>
					<?php if ( ! empty( $coffee_espresso_trending_product_heading ) ) { ?>
						<h3><?php echo esc_html( $coffee_espresso_trending_product_heading ); ?></h3>
					<?php } ?>
				</div>
			<?php } ?>
			<?php
			$coffee_espresso_catData = get_theme_mod( 'coffee_espresso_trending_product_category', '' );
			if ( class_exists( 'WooCommerce' ) ) {
				$coffee_espresso_args = array(
					'post_type'      => 'product',
					'posts_per_page' => -1,
					'product_cat'    => $coffee_espresso_catData,
					'order'          => 'ASC',
				);
				$coffee_espresso_loop = new WP_Query( $coffee_espresso_args );
				if ( $coffee_espresso_loop->have_posts() ) { ?>
					<div class="product-box wow zoomIn delay-1000">
						<div class="owl-carousel">
							<?php while ( $coffee_espresso_loop->have_posts() ) : $coffee_espresso_loop->the_post(); global $product; ?>
								<div class="tab-product">
									<div class="tab-product-img">
										<?php
										if ( has_post_thumbnail( $coffee_espresso_loop->post->ID ) ) {
											echo get_the_post_thumbnail( $coffee_espresso_loop->post->ID, 'shop_catalog' );
										} else {
											echo '<img src="' . esc_url( wc_placeholder_img_src() ) . '" alt="' . esc_attr( get_the_title() ) . '" />';
										}
										?>
									</div>
									<div class="product-content-box">
										<div class="product-rating">
											<?php echo wp_kses_post( wc_get_rating_html( $product->get_average_rating(), $product->get_rating_count() ) ); ?>
										</div>
										<h5 class="product-text">
											<a href="<?php echo esc_url( get_permalink( $coffee_espresso_loop->post->ID ) ); ?>"><?php the_title(); ?></a>
										</h5>
									</div>
									<div class="product-footer-box">
										<div class="addcart">
											<?php
											$_product_type = $product->get_type();
											$_is_ajaxable  = $product->is_purchasable() && $product->is_in_stock() && $_product_type === 'simple';
											$_btn_classes  = $_is_ajaxable
												? 'add_to_cart_button ajax_add_to_cart product_type_simple button'
												: 'button product_type_' . esc_attr( $_product_type );
											?>
											<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>"
											   class="<?php echo esc_attr( $_btn_classes ); ?>"
											   <?php if ( $_is_ajaxable ) : ?>
											   data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
											   data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>"
											   data-quantity="1"
											   aria-label="<?php echo esc_attr( wp_strip_all_tags( $product->add_to_cart_description() ) ); ?>"
											   <?php endif; ?>
											   rel="nofollow">
												<i class="fas fa-shopping-cart"></i>
											</a>
										</div>
										<div class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>">
											<?php echo wp_kses_post( $product->get_price_html() ); ?>
										</div>
									</div>
								</div>
							<?php endwhile; wp_reset_postdata(); ?>
						</div>
					</div>
				<?php }
			} ?>
		</div>
	</section>
	<?php
}