<?php
/**
 * Template name: Contacts
 */

get_header(); ?>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

        <main class="site_content">
            <div class="contacts_wrap">
                <div class="container container-sm">
                    <div class="contacts_main">
                        <h2 class="contacts_main__head"><?php the_title(); ?></h2>
                        <ul class="contacts">
                            <li class="contacts_info">
                                <div class="contacts_info_item">
                                    <h5 class="contacts__heading"><?php echo carbon_get_post_meta($post->ID, 'title_top_block_contacts'); ?></h5>
                                    <a class="contacts__phone"
                                       href="tel:<?php echo carbon_get_post_meta($post->ID, 'phone_top_block_contacts'); ?>"><?php echo carbon_get_post_meta($post->ID, 'phone_top_block_contacts'); ?></a>
                                    <a class="contacts__mail"
                                       href="mailto:<?php echo carbon_get_post_meta($post->ID, 'mail_top_block_contacts'); ?>"><?php echo carbon_get_post_meta($post->ID, 'mail_top_block_contacts'); ?></a>
                                </div>
                                <div class="contacts_info_item">
                                    <h5 class="contacts__heading"><?php echo carbon_get_post_meta($post->ID, 'title_bottom_block_contacts'); ?></h5>
                                    <a class="contacts__phone"
                                       href="tel:<?php echo carbon_get_post_meta($post->ID, 'phone_bottom_block_contacts'); ?>"><?php echo carbon_get_post_meta($post->ID, 'phone_bottom_block_contacts'); ?></a>
                                    <a class="contacts__mail"
                                       href="mailto:<?php echo carbon_get_post_meta($post->ID, 'mail_bottom_block_contacts'); ?>"><?php echo carbon_get_post_meta($post->ID, 'mail_bottom_block_contacts'); ?></a>
                                </div>
                            </li>
                            <li class="contacts_form">
                                <h5 class="contacts_form__head"><?php echo carbon_get_post_meta($post->ID, 'title_form_contacts'); ?></h5>
                                <?php echo do_shortcode(carbon_get_post_meta($post->ID, 'shortcode_form_contacts')); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </main>

    <?php endwhile; ?>

<?php endif; ?>

<?php get_footer();