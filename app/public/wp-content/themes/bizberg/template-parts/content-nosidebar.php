<div id="post-<?php the_ID(); ?>" <?php post_class('col-sm-4 col-xs-4 blog-listing no-sidebars'); ?>>
    <div class="blog-post blog-large">
        <article>
            <header class="entry-header">
            	<?php 
            	if( has_post_thumbnail() ){ ?>
	                <div class="entry-thumbnail">
	                    <?php 
	                    the_post_thumbnail( 
	                    	'bizberg_blog_list', 
	                    	array( 
	                    		'class' => 'img-responsive', 
	                    		'alt' => esc_attr( get_the_title() ) 
	                    	) 
	                    ); ?>
	                    <span class="post-format post-format-video">
	                    	<i class="fa <?php echo esc_attr( bizberg_icon( $post->ID ) ); ?>"></i>
	                    </span>
	                </div>
	                <?php 
	            } ?>
                <div class="entry-date">
                	<a href="<?php echo esc_url( home_url() ); ?>/<?php echo esc_attr( date( 'Y/m' , strtotime( get_the_date() ) ) ); ?>"><?php echo esc_html( get_the_date() ); ?></a>
                </div>
                <h4 class="entry-title">
                	<a href="<?php the_permalink(); ?>">
                		<?php the_title(); ?>		
                	</a>
                </h4>
            </header>

            <div class="entry-content">
                <?php the_excerpt(); ?>
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

                if( $hide_category == 0 ){ ?>

	                <span class="entry-category">
	                	<i class="fa fa-folder"></i>
	                	<?php bizberg_post_categories( $post , 1 ); ?>
	                </span>

	                <?php 
	            } ?>

                <span class="entry-comments">
                    <?php 
                    bizberg_get_comments_number( $post );
                    ?>
                </span>

            </footer>

        </article>

    </div>

</div>