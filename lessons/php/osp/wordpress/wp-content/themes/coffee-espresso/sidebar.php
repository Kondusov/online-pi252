<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package coffee_espresso
 */
?>

<aside id="secondary" class="widget-area wow zoomIn delay-1000" data-wow-duration="2s">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->

<?php 
  if ( ! is_active_sidebar( 'sidebar-1' )) { ?>
	<aside id="secondary" class="widget-area wow zoomIn delay-1000" data-wow-duration="2s">
		<section id="Search" class="widget widget_block widget_archive " >
		    <h2 class="widget-title"><?php esc_html_e('Search', 'coffee-espresso'); ?></h2>
		    <?php get_search_form(); ?>
		</section>
		<section id="archives" class="widget widget_block widget_archive " >
		    <h2 class="widget-title"><?php esc_html_e('Archives', 'coffee-espresso'); ?></h2>
		    <ul>
		        <?php
		        wp_get_archives(array(
		            'type'            => 'monthly',
		            'show_post_count' => true,
		        ));
		        ?>
		    </ul>
		</section>
		<section id="categories" class="widget widget_categories" role="complementary">
		    <h2 class="widget-title"><?php esc_html_e('Categories', 'coffee-espresso'); ?></h2>
		    <ul>
		        <?php
		        wp_list_categories(array(
		            'orderby'    => 'name',
		            'title_li'   => '',
		            'show_count' => true,
		        ));
		        ?>
		    </ul>
		</section>
		<section id="tags" class="widget widget_tag_cloud" role="complementary">
		    <h2 class="widget-title"><?php esc_html_e('Tags', 'coffee-espresso'); ?></h2>
		    <?php
				$coffee_espresso_tags = get_tags();
				if ($coffee_espresso_tags) {
				    echo '<div class="tag-cloud">';
				    foreach ($coffee_espresso_tags as $coffee_espresso_tag) {
				        $coffee_espresso_tag_link = get_tag_link($coffee_espresso_tag->term_id);
				        echo '<a href="' . esc_url($coffee_espresso_tag_link) . '" style="font-size:' . esc_attr($coffee_espresso_tag->font_size) . 'px;" class="tag-link">' . esc_html($coffee_espresso_tag->name) . '</a>';
				    }
				    echo '</div>';
				} else {
					echo '<p>' . esc_html__( 'No tags found.', 'coffee-espresso' ) . '</p>';
				}
			?>
		</section>
		<section id="recent-posts" class="widget" role="complementary">
		    <h2 class="widget-title"><?php esc_html_e('Recent Posts', 'coffee-espresso'); ?></h2>
		    <ul class="recent-posts-list">
		        <?php
		        $coffee_espresso_recent_posts = get_posts(array(
		            'numberposts' => 5, // Adjust the number of posts to display
		            'post_status' => 'publish',
		        ));

		        foreach ($coffee_espresso_recent_posts as $coffee_espresso_post) :
		            setup_postdata($coffee_espresso_post);
		            ?>
		            <li>
		                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		            </li>
		            <?php
		        endforeach;
		        wp_reset_postdata();
		        ?>
		    </ul>
		</section>

	</aside><!-- #secondary -->
<?php } ?>