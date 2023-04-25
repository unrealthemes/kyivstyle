<div class="product_wrap">
  <!-- <div class="container quick">
    <div class="btn_quick_buy">
      <h5 class="btn_quick_buy__head">Швидке замовлення в 1 клік</h5>
      <p class="btn_quick_buy__text">Треба вказати тільки ім'я та телефон,<br> решту ми уточннимо за телефоном</p>
      <a class="btn_quick_buy__close" href="#"><i class="x"></i></a>
    </div>
  </div> -->
  <div class="container">
    <ul class="product__wrap">

      <?php
      $page_id = ut_get_page_id_by_template('template-home.php');
      $products  = carbon_get_post_meta( $page_id, 'all_products_home' );

      foreach ( $products as $_product ) :

          global $product; 
          $GLOBALS['product'] = wc_get_product($_product['id']); 

          if ( $product->is_type( 'variable' ) && get_post_meta( $product->get_id(), '_dnot_display_all_variations', true ) != 'yes' ) :

            get_template_part( 'template-parts/home/product-variable-display' );

          elseif ( $product->is_type( 'variable' ) && get_post_meta( $product->get_id(), '_dnot_display_all_variations', true ) == 'yes' ) :

            get_template_part( 'template-parts/home/product-variable-not-display' );
          else :
            get_template_part( 'template-parts/home/product', 'simple' );
          endif;

        endforeach;  
        ?>

    </ul>
  </div>
</div>