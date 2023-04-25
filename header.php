<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package notebook
 */

?>

<!--class="fontawesome-i2svg-active fontawesome-i2svg-complete"-->

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<html lang="ru" class="fontawesome-i2svg-active fontawesome-i2svg-complete">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=12.0, minimum-scale=.25, user-scalable=no"/>
    <?php $src = get_template_directory_uri(); ?>
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $src; ?>/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $src; ?>/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $src; ?>/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $src; ?>/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $src; ?>/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $src; ?>/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $src; ?>/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $src; ?>/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $src; ?>/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $src; ?>/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $src; ?>/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo $src; ?>/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $src; ?>/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $src; ?>/favicon/favicon-16x16.png">
    <!-- <link rel="manifest" href="<?php //echo $src; ?>/favicon/manifest.json"> -->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    
    <?php wp_head(); ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-1904850-12"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-1904850-12');
    </script>


	<!-- Facebook Pixel Code -->
	<script>
	  !function(f,b,e,v,n,t,s)
	  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	  n.queue=[];t=b.createElement(e);t.async=!0;
	  t.src=v;s=b.getElementsByTagName(e)[0];
	  s.parentNode.insertBefore(t,s)}(window, document,'script',
	  'https://connect.facebook.net/en_US/fbevents.js');
	  fbq('init', '1552710784862631');
	  fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	  src="https://www.facebook.com/tr?id=1552710784862631&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->



</head>
<body <?php body_class('site'); ?>>
<div class="global_wrap">
    <header>
        <div class="container-fluid">
            <div class="header-wrapper">
                <div class="header__menu">
                    <div class="burger-menu">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>
                </div>
                <div class="header__logo">
                    <a class="logotype" href="<?php echo esc_url(home_url('/')); ?>">
                        <?php $svg_file = file_get_contents(wp_get_attachment_image_url(carbon_get_theme_option('logo_header'), 'full')); ?>
                        <?php echo $svg_file; ?>
                    </a>
                </div>
                <div class="header__info">
                    <div class="header__contact">
                        <a href="tel:<?php echo carbon_get_theme_option('phone_header'); ?>" class="telephone">
                            <?php echo carbon_get_theme_option('phone_header'); ?>
                        </a>
                    </div>
                    <div class="header__cart">
                        <a class="cart_shop full" href="#">
                            <?php $cart_count = WC()->cart->get_cart_contents_count(); ?>

                            <?php if ($cart_count != 0): ?>
                                <!-- <span id="cart_count"><?php echo $cart_count; ?></span> -->
                            <?php else: ?>
                                <style>.full:before {
                                        opacity: 0;
                                    }</style>
                                <!-- <span id="cart_count" style="display: none;"><?php echo $cart_count; ?></span> -->
                            <?php endif; ?>

                            <?php $svg_file = file_get_contents(wp_get_attachment_image_url(carbon_get_theme_option('cart_header'), 'full')); ?>
                            <?php echo $svg_file; ?>
                        </a>
                    </div>
                </div>
                <!-- /.header__info -->
            </div>
        </div>
    </header>