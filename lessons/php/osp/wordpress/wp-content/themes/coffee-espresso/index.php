<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package coffee_espresso
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php

	if ( have_posts() ) :

		if ( is_home() && ! is_front_page() ) :
			?>
			<?php
		endif;

		/* Start the Loop */
		while ( have_posts() ) :
			the_post();
			
			get_template_part( 'template-parts/content', get_post_type() );

		endwhile;

		do_action( 'coffee_espresso_posts_pagination' );

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

</main>

<?php
if ( coffee_espresso_is_sidebar_enabled() ) {
	get_sidebar();
}
get_footer();