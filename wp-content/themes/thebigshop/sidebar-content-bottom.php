<?php
if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
// If we get this far, we have widgets. Let's do this.
?>
<aside id="content-bottom-widgets" class="content-bottom-widgets">
       
	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		<div class="widget-area row">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div><!-- .widget-area -->
	<?php endif; ?>
</aside><!-- .content-bottom-widgets -->
