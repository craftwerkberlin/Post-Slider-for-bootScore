<?php
/*Plugin Name: bS Post Slider
Plugin URI: https://bootscore.me/plugins/bs-post-slider/
Description: Post slider for bootScore theme https://bootscore.me. Use Shortcode like this [bs-post-slider type="post" category="sample-category" order="ASC" orderby="title" posts="12"] and read readme.txt in PlugIn folder for options.
Version: 1.0.3
Author: Bastian Kreiter
Author URI: https://crftwrk.de
License: GPLv2
*/





// Register Styles and Scripts
function my_scripts() {
    
    wp_enqueue_script( 'swiper-js', plugins_url( '/js/swiper.min.js', __FILE__ ));
    
    wp_enqueue_script( 'slider', plugins_url( '/js/slider.js', __FILE__ ));
    
    wp_register_style( 'swiper', plugins_url('css/swiper.min.css', __FILE__) );
        wp_enqueue_style( 'swiper' );
    
    wp_register_style( 'custom-style', plugins_url('css/custom-style.css', __FILE__) );
        wp_enqueue_style( 'custom-style' );
    }

add_action('wp_enqueue_scripts','my_scripts');


// Post Slider Shortcode
add_shortcode( 'bs-post-slider', 'bootscore_post_slider' );
function bootscore_post_slider( $atts ) {
	ob_start();
	extract( shortcode_atts( array (
		'type' => 'post',
		'order' => 'date',
		'orderby' => 'date',
		'posts' => -1,
		'category' => '',
	), $atts ) );
	$options = array(
		'post_type' => $type,
		'order' => $order,
		'orderby' => $orderby,
		'posts_per_page' => $posts,
		'category_name' => $category,
	);
	$query = new WP_Query( $options );
	if ( $query->have_posts() ) { ?>


<!-- Swiper -->

<div class="px-5 position-relative my-5 post-slider">

    <div class="swiper-container">

        <div class="swiper-wrapper">

            <?php while ( $query->have_posts() ) : $query->the_post(); ?>

            <div class="swiper-slide card h-auto mb-5">
                <!-- Featured Image-->
                <?php the_post_thumbnail('medium', array('class' => 'card-img-top')); ?>

                <div class="card-body d-flex flex-column">
                    <div class="mb-2">
                        <!-- Category Badge -->
                        <?php
				            $thelist = '';
				            $i = 0;
				            foreach( get_the_category() as $category ) {
				                if ( 0 < $i ) $thelist .= ' ';
								    $thelist .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="badge badge-secondary">' . $category->name.'</a>';
								    $i++;
								}
								echo $thelist;
				            ?>
                    </div>
                    <!-- Title -->
                    <h2 class="blog-post-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    <!-- Meta -->
                    <?php if ( 'post' === get_post_type() ) : ?>
                    <small class="text-muted mb-2">
                        <?php
				            bootscore_date();
				            bootscore_author();
				            bootscore_comments();
				            bootscore_edit();
				        ?>
                    </small>
                    <?php endif; ?>
                    <!-- Excerpt & Read more -->
                    <div class="card-text">
                        <?php the_excerpt(); ?>
                    </div>
                            
                    <div class="mt-auto">
                        <a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read more »', 'bootscore'); ?></a>
                    </div>
                    <!-- Tags -->
                    <?php bootscore_tags(); ?>

                </div>

            </div>

            <?php endwhile; wp_reset_postdata(); ?>
            
        </div> <!-- .swiper-wrapper -->
        
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        
    </div><!-- swiper-container -->

    <!-- Add Arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>

</div><!-- px-5 position-relative mb-5 -->

<!-- Swiper End -->

<?php $myvariable = ob_get_clean();
	return $myvariable;
	}	
}

// Post Slider Shortcode End