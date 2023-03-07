<?php
/**
 * @package Avant
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php get_template_part( '/templates/titlebar' ); ?>
	
	<?php if ( !get_theme_mod( 'avant-single-remove-meta' ) ) : ?>
		<div class="entry-meta">
			<?php avant_posted_on(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>
	
	<?php if ( get_theme_mod( 'avant-single-page-fimage-layout' ) == 'avant-single-page-fimage-layout-standard' ) : ?>
	
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-content-img">
				<?php the_post_thumbnail( 'full' ); ?>
			</div>
		<?php endif; ?>
		
	<?php endif; ?>
	
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'avant' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	
	<?php if ( !get_theme_mod( 'avant-single-remove-cattags' ) ) : ?>
		<footer class="entry-footer">
			<?php avant_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
	
</article><!-- #post-## -->
