<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package notebook
 */
?>

<footer>
    <div class="container-fluid">
        <div class="footer-wrapper">
            <div class="footer__item footer__logo">
                <a class="logotype" href="<?php echo home_url('/'); ?>">
                    <?php $svg_file = file_get_contents(wp_get_attachment_image_url(carbon_get_theme_option('logo_footer'), 'full')); ?>
                    <?php echo $svg_file; ?>
                </a>
            </div>
            <div class="footer__item footer__list menu_medium">

                <?php if (has_nav_menu('menu-3')) {
                    wp_nav_menu(array(
                        'theme_location' => 'menu-3',
                        'container' => false,
                        'items_wrap' => '<ul class="menu_list">%3$s</ul>',
                    ));
                } ?>

            </div>
            <div class="footer__item footer__list menu_light">

                <?php if (has_nav_menu('menu-4')) {
                    wp_nav_menu(array(
                        'theme_location' => 'menu-4',
                        'container' => false,
                        'items_wrap' => '<ul class="menu_low">%3$s</ul>',
                    ));
                } ?>

            </div>
            <div class="footer__item footer__social">
<!--
	            <p class="social_head">Ми в соціальних мережах:</p>
-->
<!--
                <p class="social_head"><?php echo carbon_get_theme_option('title_subscr_footer'); ?></p>

                <form class="social_form" method="post" action="<?php echo home_url(); ?>/?na=s" onsubmit="return newsletter_check(this)">
                    <input type="hidden" name="nlang" value="">
                    <input type="hidden" name="nr" value="widget">
                    <input type="hidden" name="nl[]" value="0">
                    <input class="form_text" type="email" name="ne" placeholder="Введите Ваш e-mail" required>

                    <button class="form_submit" type="submit" value="">
                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                    </button>
                </form>
-->
                <ul class="social">
                    <?php $items = carbon_get_theme_option('rep_social_footer');
                    foreach ((array)$items as $item): ?>

                        <li class="social__links">
                            <?php if (isset($item['icons_rep_social_footer']) && !empty($item['icons_rep_social_footer'])): ?>
                                <a class="soc <?php echo $item['icons_rep_social_footer']['value']; ?>"
                                   href="<?php echo $item['url_rep_social_footer']; ?>">
                                    <i class="<?php echo $item['icons_rep_social_footer']['class']; ?>"></i>
                                </a>
                            <?php endif; ?>
                        </li>

                    <?php endforeach; ?>

                </ul>
            </div>
        </div>
    </div>
</footer>
</div>
<div class="wrapper_hide"></div>

<?php get_template_part('template-parts/menu'); ?>

<?php if ( is_front_page() || is_singular('product') ) {
    get_template_part('template-parts/one-click');
} ?>

<?php get_template_part('template-parts/cart'); ?>

<?php wp_footer(); ?>

</body>
</html>
