<?php 
/**
 * sidebar-company.php
 *
 * The company sidebar.
 */
?>

<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
	<?php dynamic_sidebar( 'sidebar-4' ); ?>
<?php endif; ?>