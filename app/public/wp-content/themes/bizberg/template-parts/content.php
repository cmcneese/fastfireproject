<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bizberg
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class('col-sm-12 col-xs-12 blog-listing'); ?>>

    <div class="blog-post blog-large blog-grid">

        <article>

        	<?php 
        	$sidebar_settings = get_theme_mod( 'sidebar_settings' , 1 );
        	$image_size = ( $sidebar_settings == 3 ? 'bizberg_blog_list_no_sidebar_1' : 'bizberg_blog_list' );

        	
        	if( has_post_thumbnail() ){ ?>

	            <header class="entry-header">
	                <div class="entry-thumbnail">
	                    <?php 
	                    the_post_thumbnail( 
	                    	$image_size, 
	                    	array( 
	                    		'class' => 'img-responsive', 
	                    		'alt' => esc_attr( get_the_title() ) 
	                    	) 
	                    ); ?>
	                    <span class="post-format post-format-video">
	                    	<i class="<?php echo esc_attr( bizberg_icon( $post->ID ) ); ?>"></i>
	                    </span>
	                </div>
	         
	            </header>

	           	<?php 	           	
	        } ?>

            <div class="entry-content">
            	<div class="entry-date">
            		<a href="<?php echo esc_url( home_url() ); ?>/<?php echo esc_attr( date( 'Y/m' , strtotime( get_the_date() ) ) ); ?>"><?php echo esc_html( get_the_date() ); ?></a>
            	</div>
                <h4 class="entry-title">
                	<a href="<?php the_permalink(); ?>">
                		<?php the_title(); ?>			
                	</a>
                </h4>
                
                <?php the_excerpt(); 

                /**
                * IF no sidebar, donot display the "read more" btn
                */
                if( $sidebar_settings != 3 ){

                    $read_more = get_theme_mod( 'read_more_text' ); 
                    $read_more = ( $read_more ? $read_more : 'Read More' ); ?>                

                    <!-- button -->
                    <div class="red-btn">
                    	<a class="btn btn-primary btn-lg" href="<?php the_permalink(); ?>">
                    		<?php echo esc_html( $read_more ); ?>
                    	</a>
                    </div>

                    <?php 

                } ?>
                
            </div>

            <footer class="entry-meta">

            	<?php 
            	$hide_author = get_theme_mod( 'hide_author' , 0 );
            	$hide_category = get_theme_mod( 'hide_category' , 0 );

            	if( $hide_author == 0 ){ ?>
	                <span class="entry-author">
	                	<i class="fa fa-user"></i> 
	                	<a href="<?php echo esc_url( get_author_posts_url( $post->post_author ) ); ?>">
	                		<?php bizberg_get_display_name( $post ); ?>
	                	</a>
	                </span>
	                <?php 
                } 

                /**
                * @param $category (boolean/string)
                * if return false, no category is defined
                * if string, dispaly the category
                */

                $category =  bizberg_post_categories( $post,1,false,false );
                if( $hide_category == 0 && $category != false ){ ?>

	                <span class="entry-category">
	                	<i class="fa fa-folder"></i> 
	                	<?php echo wp_kses_post( $category ); ?>
	                </span>

	                <?php 
	            } 

                if( $post->post_type == 'post' ){ ?>

                    <span class="entry-comments">                    
                        <?php 
                        bizberg_get_comments_number( $post );
                        ?>
                    </span>

                    <?php 
                } ?>
                
            </footer>
        </article>
    </div>
</div>