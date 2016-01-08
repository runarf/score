<?php
/**
 * @package Serene
 * @since Serene 1.0
 */?><!DOCTYPE html>
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />

	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="container">
		<header id="main-header" class="clearfix">
			<div class="header-image">
				<img width="1280" height="540" alt="2010" class="attachment-serene-featured-image size-serene-featured-image wp-post-image" src="http://localhost:8888/wordpress/wp-content/uploads/2016/01/vorspiel.jpg">
			</div>
			<!-- <h1 id="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			</h1> -->
			<nav id="top-menu">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'primary-menu',
					'container'      => '',
					'fallback_cb'    => '',
					'menu_class'     => 'nav',
					'echo'           => true,
				) ); ?>
			</nav>

			<?php do_action( 'et_header_top' ); ?>
		</header> <!-- #main-header -->
