<?php
/**
 * ----------------------------------------------------------------------------------------
 * Create pages and insert into database
 * ----------------------------------------------------------------------------------------
 */
function addThisPage() {

	// add home page
	$page_home = array(
		'post_title'	=> 'Home',
		'post_status'	=> 'publish',
		'post_type'		=> 'page',
		'post_content'	=> 'Some default content',
		'menu_order'	=> 4
		);
	$page_home_exists = get_page_by_title( $page_home['post_title'] );

	if( ! $page_home_exists) {
		$insert_home_id = wp_insert_post( $page_home );
		if( $insert_home_id ) {
			update_post_meta( $insert_home_id, '_wp_page_template', 'home-template.php' );

			// Set "static page" as the option
			update_option( 'show_on_front', 'page' );

			// Set the front page ID
			update_option( 'page_on_front', $insert_home_id );
		}
	}

	// add blog page
	$page_blog = array(
		'post_title'	=> 'Blog',
		'post_status'	=> 'publish',
		'post_type'		=> 'page',
		'post_content'	=> '',
		'menu_order'	=> 5
		);
	$page_blog_exists = get_page_by_title( $page_blog['post_title'] );

	if( !$page_blog_exists ) {
		$insert_blog_id = wp_insert_post( $page_blog );
		if( $insert_blog_id ) {

			// Set the front page ID
			update_option( 'page_for_posts', $insert_blog_id );
			update_option( 'posts_per_page', 3 );
		}
	}

	// add blog posts
	$post_1 = array(
		'post_title'	=> 'Where\'s The Human',
		'post_status'	=> 'publish',
		'post_type'		=> 'post',
		'post_content'	=> '<p> The Great White Whale when it comes to forming new habits, for most people, is exercise. Along with eating your vegetables, meditation, getting good sleep and quitting smoking, exercise is probably the most important habit change anyone can make. And yet, most people struggle with creating a lasting exercise habit. The solution is to replace... The Great White Whale when it comes to forming new habits, for most people, is exercise. Along with eating your vegetables, meditation, getting good sleep and quitting smoking, exercise is probably the most important habit change anyone can make. And yet, most people struggle with creating a lasting exercise habit. The solution is to replace... The Great White Whale when it comes to forming new habits, for most people, is exercise. Along with eating your vegetables, meditation, getting good sleep and quitting smoking, exercise is probably the most important habit change anyone can make. And yet, most people struggle with creating a lasting exercise habit. The solution is to replace... The Great White Whale when it comes to forming new habits, for most people, is exercise. Along with eating your vegetables, meditation, getting good sleep and quitting smoking, exercise is probably the most important habit change anyone can make. And yet, most people struggle with creating a lasting exercise habit. The solution is to replace...</p>
							<p>The Great White Whale when it comes to forming new habits, for most people, is exercise. Along with eating your vegetables, meditation, getting good sleep and quitting smoking, exercise is probably the most important habit change anyone can make. And yet, most people struggle with creating a lasting exercise habit. The solution is to replace...</p>'
		);
	$posts_exists = get_page_by_title( $post_1['post_title'], '', 'post' );
	if( !$posts_exists ) {
		for ( $i=3; $i>0; $i-- ) {
			$post_id = wp_insert_post( $post_1 );
			if ($post_id) {
				// upload and set up the post thumbnail
				$image_url = IMAGES . '/human-' . $i . '.png';
				$upload_dir = wp_upload_dir();
				$image_data = file_get_contents($image_url);
				$filename = basename($image_url);
				if(wp_mkdir_p($upload_dir['path']))
					$file = $upload_dir['path'] . '/' . $filename;
				else
					$file = $upload_dir['basedir'] . '/' . $filename;
				file_put_contents($file, $image_data);

				$wp_filetype = wp_check_filetype($filename, null );
				$attachment = array(
					'post_mime_type' => $wp_filetype['type'],
					'post_title' => sanitize_file_name($filename),
					'post_content' => '',
					'post_status' => 'inherit'
				);
				$attach_id = wp_insert_attachment( $attachment, $file, $post_id );
				require_once(ABSPATH . 'wp-admin/includes/image.php');
				$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
				wp_update_attachment_metadata( $attach_id, $attach_data );

				set_post_thumbnail( $post_id, $attach_id );
			}
		}
	}

	// add software egineering page
	$page_softEngin = array(
		'post_title'	=> 'Software Engineering',
		'post_status'	=> 'publish',
		'post_type'		=> 'page',
		'post_content'	=> 'Some default content',
		'menu_order'	=> 1
		);
	$page_softEngin_exists = get_page_by_title( $page_softEngin['post_title'] );

	if( !$page_softEngin_exists ) {
		$insert_softEngin_id = wp_insert_post( $page_softEngin );
		if( $insert_softEngin_id ) {
			update_post_meta( $insert_softEngin_id, '_wp_page_template', 'softEngin-template.php' );

			// upload and set up the post thumbnail
			$image_url = IMAGES . '/software.png';
			$upload_dir = wp_upload_dir();
			$image_data = file_get_contents($image_url);
			$filename = basename($image_url);
			if(wp_mkdir_p($upload_dir['path']))
				$file = $upload_dir['path'] . '/' . $filename;
			else
				$file = $upload_dir['basedir'] . '/' . $filename;
			file_put_contents($file, $image_data);

			$wp_filetype = wp_check_filetype($filename, null );
			$attachment = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => sanitize_file_name($filename),
				'post_content' => '',
				'post_status' => 'inherit'
			);
			$attach_id = wp_insert_attachment( $attachment, $file, $insert_softEngin_id );
			require_once(ABSPATH . 'wp-admin/includes/image.php');
			$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
			wp_update_attachment_metadata( $attach_id, $attach_data );

			set_post_thumbnail( $insert_softEngin_id, $attach_id );
		}
	}

	// add company page
	$page_company = array(
		'post_title'	=> 'Company',
		'post_status'	=> 'publish',
		'post_type'		=> 'page',
		'post_content'	=> '<h4 class="text-center">
								In today\'s tutorial I\'am going to introduce you to Avocode, developed by the<br>
								"eleven brave men and onebrave woman".
							</h4>
							<p>
								In today\'s tutorial I\'am going to introduce you to Avocode, developed by the "eleven brave men and onebrave woman" of Source and recently released in the form of version 1.0.Avocode is an application which allows you to work with.psd and In today\'s tutorial I\'am going to introduce you to Avocode, developed by the "eleven brave men and onebrave woman" of Source and recently released in the form of version 1.0.Avocode is an application which allows you to work with.psd and code, whithout even opening Photoshop.
							</p>
							<p>
								In today\'s tutorial I\'am going to introduce you to Avocode, developed by the "eleven brave men and onebrave woman" of Source and recently released in the form of version 1.0.Avocode is an application which allows you to work with.psd and In today\'s tutorial I\'am going to introduce you to Avocode, developed by the "eleven brave men and onebrave woman" of Source and recently released in the form of version 1.0.Avocode is an application which allows you to work with.psd and code, whithout even opening Photoshop.
							</p>',
		'menu_order'	=> 2
		);
	$page_company_exists = get_page_by_title( $page_company['post_title'] );

	if( !$page_company_exists ) {
		$insert_company_id = wp_insert_post( $page_company );
		if( $insert_company_id ) {
			update_post_meta( $insert_company_id, '_wp_page_template', 'company-template.php' );

			// upload and set up the post thumbnail
			$image_url = IMAGES . '/company.png';
			$upload_dir = wp_upload_dir();
			$image_data = file_get_contents($image_url);
			$filename = basename($image_url);
			if(wp_mkdir_p($upload_dir['path']))
				$file = $upload_dir['path'] . '/' . $filename;
			else
				$file = $upload_dir['basedir'] . '/' . $filename;
			file_put_contents($file, $image_data);

			$wp_filetype = wp_check_filetype($filename, null );
			$attachment = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => sanitize_file_name($filename),
				'post_content' => '',
				'post_status' => 'inherit'
			);
			$attach_id = wp_insert_attachment( $attachment, $file, $insert_company_id );
			require_once(ABSPATH . 'wp-admin/includes/image.php');
			$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
			wp_update_attachment_metadata( $attach_id, $attach_data );

			set_post_thumbnail( $insert_company_id, $attach_id );
		}
	}

	// add career page
	$page_career = array(
		'post_title'	=> 'Career',
		'post_status'	=> 'publish',
		'post_type'		=> 'page',
		'post_content'	=> 'Some default content',
		'menu_order'	=> 3
		);
	$page_career_exists = get_page_by_title( $page_career['post_title'] );

	if( !$page_career_exists ) {
		$insert_career_id = wp_insert_post( $page_career );
		if( $insert_career_id ) {
			update_post_meta( $insert_career_id, '_wp_page_template', 'career-template.php' );

			// upload and set up the post thumbnail
			$image_url = IMAGES . '/career.png';
			$upload_dir = wp_upload_dir();
			$image_data = file_get_contents($image_url);
			$filename = basename($image_url);
			if(wp_mkdir_p($upload_dir['path']))
				$file = $upload_dir['path'] . '/' . $filename;
			else
				$file = $upload_dir['basedir'] . '/' . $filename;
			file_put_contents($file, $image_data);

			$wp_filetype = wp_check_filetype($filename, null );
			$attachment = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => sanitize_file_name($filename),
				'post_content' => '',
				'post_status' => 'inherit'
			);
			$attach_id = wp_insert_attachment( $attachment, $file, $insert_career_id );
			require_once(ABSPATH . 'wp-admin/includes/image.php');
			$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
			wp_update_attachment_metadata( $attach_id, $attach_data );

			set_post_thumbnail( $insert_career_id, $attach_id );
		}
	}
}

add_action( 'after_switch_theme', 'addThisPage' );
?>