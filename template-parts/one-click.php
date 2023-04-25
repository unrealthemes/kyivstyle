<div class="one_click_wrap">
  <div class="wrap_edit">
      <span class="x close_one_click"></span>
      <ul class="one_click">
        <li class="one_click__items">
          <img class="one_click__img lazyload" data-src="<?php echo get_template_directory_uri(); ?>/img/preloader.gif" alt="img">
        </li>
        <li class="one_click__items">
          <h5 class="one_click__name"></h5>
        </li>
        <li class="one_click__items one_click__select">
          <div class="select-wrapper">
              <select class="card_product__select"></select>
          </div>
        </li>
        <li class="one_click__items">
          <span class="card_product__price"></span>
        </li>
        <li class="one_click__items">

          <?php echo do_shortcode('[contact-form-7 id="168" title="Купить в один клик" html_class="form-with-animation one_click__form"]'); ?>

        </li>
    </ul>
  </div>
</div>