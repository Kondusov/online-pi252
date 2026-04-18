<?php
/**
 * Template part for displaying Audio Format
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package coffee_espresso
 */

?>
<?php $coffee_espresso_readmore = get_theme_mod( 'coffee_espresso_readmore_button_text','Read More');?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mag-post-single">
        <?php
			// Get the post ID
			$coffee_espresso_post_id = get_the_ID();

			// Check if there are audio embedded in the post content
			$coffee_espresso_post = get_post($coffee_espresso_post_id);
			$coffee_espresso_content = do_shortcode(apply_filters('the_content', $coffee_espresso_post->post_content));
			$coffee_espresso_embeds = get_media_embedded_in_content($coffee_espresso_content);

			if (!empty($coffee_espresso_embeds)) {
			    // Loop through embedded media and display only audio
			    foreach ($coffee_espresso_embeds as $coffee_espresso_embed) {
			        // Check if the embed code contains an audio tag or specific audio providers like SoundCloud
			        if (strpos($coffee_espresso_embed, 'audio') !== false || strpos($coffee_espresso_embed, 'soundcloud') !== false) {
			            ?>
			            <div class="custom-embedded-audio">
			                <div class="media-container">
			                    <?php echo esc_url($coffee_espresso_embed );  ?>
			                </div>
			                <div class="media-comments">
			                    <?php
			                    // Add your comments section here
			                    comments_template(); // This will include the default WordPress comments template
			                    ?>
			                </div>
			            </div>
			            <?php
			        }
			    }
			}
		?>
		<div class="mag-post-detail">
			<div class="mag-post-category">
				<?php coffee_espresso_categories_list(); ?>
			</div>
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title mag-post-title">', '</h1>' );
			else :
				if ( get_theme_mod( 'coffee_espresso_post_hide_post_heading', true ) ) { 
					the_title( '<h2 class="entry-title mag-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			    }
			endif;
			?>
			<div class="mag-post-meta">
				<?php
				coffee_espresso_posted_on();
				coffee_espresso_posted_by();
				coffee_espresso_posted_comments();
				coffee_espresso_posted_time();
				?>
			</div>
			<?php if ( get_theme_mod( 'coffee_espresso_post_hide_post_content', true ) ) { ?>
				<div class="mag-post-excerpt">
					<?php the_excerpt(); ?>
				</div>
		    <?php } ?>
			<?php if ( get_theme_mod( 'coffee_espresso_post_readmore_button', true ) === true ) : ?>
				<div class="mag-post-read-more">
					<a href="<?php the_permalink(); ?>" class="read-more-button">
						<?php if ( ! empty( $coffee_espresso_readmore ) ) { ?> <?php echo esc_html( $coffee_espresso_readmore ); ?> <?php } ?>
						<i class="<?php echo esc_attr( get_theme_mod( 'coffee_espresso_readmore_btn_icon', 'fas fa-chevron-right' ) ); ?>"></i>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->