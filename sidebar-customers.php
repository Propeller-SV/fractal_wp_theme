<?php 
/**
 * sidebar-customers.php
 *
 * The customers sidebar.
 */
?>

<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
	<?php dynamic_sidebar( 'sidebar-3' ); ?>
<?php endif; ?>