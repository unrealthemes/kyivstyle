<nav class="slide_menu">
  <div class="wrap_edit">

    <ul class="menu menu-nav">
      <li class="menu__list__closed">
          <span class="x" href="#"></span>
      </li>
<!--      <li class="menu__items phone_wrap">-->
<!--        <a class="phone" href="tel:tel:--><?php //echo carbon_get_theme_option( 'phone_header' ); ?><!--">-->
<!--          --><?php //echo carbon_get_theme_option( 'phone_header' ); ?>
<!--          <svg class="svg-inline--fa fa-mobile-alt fa-w-10" aria-hidden="true" data-prefix="fas" data-icon="mobile-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">-->
<!--            <path fill="currentColor" d="M272 0H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h224c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48zM160 480c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm112-108c0 6.6-5.4 12-12 12H60c-6.6 0-12-5.4-12-12V60c0-6.6 5.4-12 12-12h200c6.6 0 12 5.4 12 12v312z"></path>-->
<!--          </svg>-->
<!--          <!-- <i class="fas fa-mobile-alt"></i> -->
<!--        </a>-->
<!--      </li>-->
    </ul>

    <?php if( has_nav_menu('menu-1') ){ 
      wp_nav_menu( array(
          'theme_location' => 'menu-1',
          'container'      => false,
          'items_wrap'     => '<ul class="menu menu_medium">%3$s</ul>',
      ) ); 
    } ?>

    <?php if( has_nav_menu('menu-2') ){ 
      wp_nav_menu( array(
          'theme_location' => 'menu-2',
          'container'      => false,
          'items_wrap'     => '<ul class="menu menu_light">%3$s</ul>',
      ) ); 
    } ?>

    <ul class="menu menu-social">
      <li class="menu__items">
        <ul class="social">
          <?php $items = carbon_get_theme_option( 'rep_social_header' ); 
            foreach((array)$items as $item): ?>

              <li class="social__links">
                <?php if(isset($item['icons_rep_social_header']) && !empty($item['icons_rep_social_header'])): ?>
                  <a class="soc <?php echo $item['icons_rep_social_header']['value']; ?>" href="<?php echo $item['url_rep_social_header']; ?>">
                      <i class="<?php echo $item['icons_rep_social_header']['class']; ?>"></i>
                  </a>
                <?php endif; ?>
              </li>

            <?php endforeach; ?>
        </ul>

      </li>
    </ul>
  </div>
</nav>