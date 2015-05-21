<?php 
/**
 * sidebar-footer.php
 *
 * The footer sidebar.
 */
?>

<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
<?php endif; ?>