<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bizberg
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('detail-content single_page' ); ?>>

	<div class="entry-content1">

		<?php

		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bizberg' ),
			'after'  => '</div>',
		) );
		?>

	</div>

</article>
