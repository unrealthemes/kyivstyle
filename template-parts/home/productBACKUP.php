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

      $start = microtime(true);

      global $stub;
      $product_color_default;
      $products  = carbon_get_post_meta( $post->ID, 'all_products_home' );

      foreach($products as $_product) :

          // global $woocommerce, $product;
          $product    = wc_get_product( $_product['id'] );
          $attributes = wc_get_product_terms( $_product['id'], 'pa_color' );
          $currency   = get_woocommerce_currency_symbol();
          $price      = get_post_meta( $_product['id'], '_regular_price', true);
          $img_hover  = carbon_get_post_meta( $_product['id'], 'hover_img_product' );

          if ( $product->is_type( 'variable' ) && get_post_meta( $product->get_id(), '_dnot_display_all_variations', true ) != 'yes' ) {

            $available_variations = $product->get_available_variations();

            foreach ($available_variations as $key => $value) { 

              $img_hover_id = get_post_meta( $value['variation_id'], '_upload_hover_id', true );

              if (!empty($value['price_html'])) {
                $main_price = $value['price_html'];
              } else {
                $main_price = $value['display_price'] . ' ' . $currency;
              } ?>

              <li id="<?php echo $value['variation_id']; ?>" class="product_item" data-attr="product_1">
                <div class="product__img__wrap">
                  <a class="product__img__link" href="<?php echo get_the_permalink($_product['id']).'?color='.$value['attributes']['attribute_pa_color']; ?>">

                    <?php if (!empty($value['image']['url'])) :
                      $data_thumb = $value['image']['url']; ?> 

                      <img class="product__img lazyload" src="<?php echo $stub; ?>" data-src="<?php echo $data_thumb; ?>">

                    <?php elseif (!empty(get_the_post_thumbnail_url($_product['id'], 'medium_large'))) : 
                      $data_thumb = get_the_post_thumbnail_url($_product['id'], 'medium_large'); ?>

                      <img class="product__img lazyload" src="<?php echo $stub; ?>" data-src="<?php echo $data_thumb; ?>" >

                    <?php else :
                      $data_thumb = "";
                    endif; ?>

                    <?php if ( !empty($img_hover_id) ) : 
                        $img_hover_src = wp_get_attachment_image_src( $img_hover_id, 'medium_large' ); ?>
                        <img class="product__img product__img__hover lazyload" src="<?php echo $stub; ?>" data-src="<?php echo $img_hover_src[0]; ?>" alt="img2">
                    <?php elseif (!empty($img_hover)) : 
                        $img_hover = wp_get_attachment_image_src( $img_hover, 'medium_large' ); ?>
                        <img class="product__img product__img__hover lazyload" src="<?php echo $stub; ?>" data-src="<?php echo $img_hover[0]; ?>" alt="img2">
                    <?php endif; ?>

                  </a>

                  <?php
                  $attrs = $product->get_available_variations();

                  if (!empty($attrs)) { ?>

                    <div class="wrapper-home-select">
                      <div class="select-wrapper select-one-click-<?php echo $value['variation_id']; ?>"> 
                        <select class="card_product__select" name="select">

                        <?php 
                        if ( $product->get_id() == 5728 ) { 
                            echo "<option selected disabled>Розмір</option>"; //чехол Faces
                        } elseif ( $product->get_id() == 5766 ) { 
                            echo "<option selected disabled>Розмір</option>"; //чехол Flowers
                        } elseif ( $product->get_id() == 5778 ) { 
                            echo "<option selected disabled>Розмір</option>"; //чехол Black
                        } elseif ( $product->get_id() == 5976 ) { 
				            echo "<option selected disabled>Розмір</option>"; //чехол We Bad
				        } elseif ( $product->get_id() == 6399 ) { 
				            echo "<option selected disabled>Розмір</option>"; //чехол Sale 30%
                        } elseif ( $product->get_id() == 418 ) { 
                            echo "<option selected disabled>Дизайн</option>"; //кошельки
                        } elseif ( $product->get_id() == 283 ) { 
                            echo "<option selected disabled>Колір обкладинки</option>"; //БДД
                        } elseif ( $product->get_id() == 96 ) { 
                            echo "<option selected disabled>Мова</option>"; //МБ
                        } elseif ( $product->get_id() == 966 ) { 
                            echo "<option selected disabled>Колір обкладинки</option>"; //Тревел бук
                        } else echo "<option selected disabled>Колір</option>";

                        foreach($attrs as $attr):

                          if (!empty($attr['price_html'])) {
                            $price = json_encode( $attr['price_html'] );
                          } else {
                            $price = json_encode( $attr['display_price'] . ' ' . $currency );
                          }
                          $variation_id = $attr['variation_id'];
                          $attr_slug    = $attr['attributes']['attribute_pa_color'];

                          if($value['attributes']['attribute_pa_color'] == $attr_slug){ ?>
                              <option value="<?php echo $attr_slug; ?>" data-variation-id="<?php echo $variation_id; ?>" data-price='<?php echo $price; ?>' data-thumb="<?php echo $attr['image']['url']; ?>" selected>
                          <?php } else { ?>
                              <option value="<?php echo $attr_slug; ?>" data-variation-id="<?php echo $variation_id; ?>" data-price='<?php echo $price; ?>' data-thumb="<?php echo $attr['image']['url']; ?>">
                          <?php } ?>

                            <?php echo get_attr_name_by_slug($attr_slug); ?>
                            </option>

                        <?php endforeach; ?>

                        </select>
                      </div>
                    </div>

                  <?php }

                  $preorder = get_post_meta( $_product['id'], '_ywpo_preorder' );

                  if (isset($preorder[0])) {
                    $preorder = $preorder[0];
                  } else {
                    $preorder = 'no';
                  } ?>

                  <button
                    class="product__btn"
                    name="btn_send"
                    data-product_id="<?php echo $_product['id']; ?>"
                    data-variation_id="<?php echo $value['variation_id']; ?>"
                    data-preorder="<?php echo $preorder; ?>"
                    data-text="Купити в 1 клік"
                    data-title="<?php echo get_the_title($_product['id']); ?>"
                    data-url="<?php echo get_the_permalink($_product['id']).'?color='.$value['attributes']['attribute_pa_color']; ?>"
                    data-price='<?php echo json_encode( $main_price ); ?>'
                    data-select="select-one-click-<?php echo $value['variation_id']; ?>"
                    data-thumb="<?php echo $data_thumb; ?>"
                  ></button>

                </div>
                <a class="product__info" href="<?php echo get_the_permalink($_product['id']).'?color='.$value['attributes']['attribute_pa_color']; ?>">
                  <p class="product__name"><?php echo get_the_title($_product['id']); ?></p>
                  <p class="product__low">
                    <span class="product__color"><?php echo get_attr_name_by_slug( $value['attributes']['attribute_pa_color'] ); ?></span>
                    <?php if ( !empty(get_attr_name_by_slug( $value['attributes']['attribute_pa_color'] )) || !empty($main_price) ) { ?>
                      —
                    <?php } ?>
                    <span class="product__price"><?php echo $main_price; ?></span>
                  </p>
                </a>
                <p 
                  class="product__low btn_click"
                  data-product_id="<?php echo $_product['id']; ?>"
                  data-variation_id="<?php echo $value['variation_id']; ?>"
                  data-preorder="<?php echo $preorder; ?>"
                  data-text="Купити в 1 клік"
                  data-title="<?php echo get_the_title($_product['id']); ?>"
                  data-url="<?php echo get_the_permalink($_product['id']).'?color='.$value['attributes']['attribute_pa_color']; ?>"
                  data-price='<?php echo json_encode( $main_price ); ?>'
                  data-select="select-one-click-<?php echo $value['variation_id']; ?>"
                  data-thumb="<?php echo $data_thumb; ?>"
                >
                  <span>КУПИТИ В 1 КЛІК</span>
                </p>
              </li>

          <?php
            }

          } else if ( $product->is_type( 'variable' ) && get_post_meta( $product->get_id(), '_dnot_display_all_variations', true ) == 'yes' ) { 
          ?>
            
            <li id="<?php echo $_product['id']; ?>" class="product_item" data-attr="product_1">
              <div class="product__img__wrap">
                <a class="product__img__link" href="<?php echo get_the_permalink($_product['id']); ?>">

                  <?php if (!empty(get_the_post_thumbnail_url($_product['id'], 'medium_large'))):
                      $image_alt = get_post_meta($_product['id'], '_wp_attachment_image_alt', true); ?>

                      <img class="product__img lazyload"  src="<?php echo $stub; ?>" data-src="<?php echo get_the_post_thumbnail_url($_product['id'], 'medium_large'); ?>" alt="<?php echo $image_alt; ?>">

                  <?php endif; ?>

                  <?php if(!empty($img_hover)): 
                      $img_hover = wp_get_attachment_image_src( $img_hover, 'medium_large' ); ?>
                      <img class="product__img product__img__hover lazyload" src="<?php echo $stub; ?>" data-src="<?php echo $img_hover[0]; ?>" alt="img2">
                  <?php else: ?>
                    <img class="product__img product__img__hover lazyload" src="<?php echo $stub; ?>" data-src="<?php echo get_template_directory_uri(); ?>/img/blocnot_hover.jpg" alt="img2">
                  <?php endif; ?>

                </a>

                <?php if ( $product->is_type( 'variable' ) ) {

                  $attrs = $product->get_available_variations();
                  $default_value = $product->get_default_attributes(); 

                  if (!empty($attrs)) { ?>

                    <div class="wrapper-home-select">
                      <div class="select-wrapper select-one-click-<?php echo $_product['id']; ?>">
                        <select class="card_product__select" name="select">

                        <?php 
                        if ( $product->get_id() == 5728 ) { 
                            echo "<option selected disabled>Розмір</option>"; //чехол Faces
                        } elseif ( $product->get_id() == 5766 ) { 
                            echo "<option selected disabled>Розмір</option>"; //чехол Flowers
                        } elseif ( $product->get_id() == 5778 ) { 
                            echo "<option selected disabled>Розмір</option>"; //чехол Black
                        } elseif ( $product->get_id() == 5976 ) { 
				            echo "<option selected disabled>Розмір</option>"; //чехол We Bad
				        } elseif ( $product->get_id() == 6399 ) { 
				            echo "<option selected disabled>Розмір</option>"; //чехол Sale 30%
                        } elseif ( $product->get_id() == 418 ) { 
                            echo "<option selected disabled>Дизайн</option>"; //кошельки
                        } elseif ( $product->get_id() == 283 ) { 
                            echo "<option selected disabled>Колір обкладинки</option>"; //БДД
                        } elseif ( $product->get_id() == 96 ) { 
                            echo "<option selected disabled>Мова</option>"; //МБ
                        } elseif ( $product->get_id() == 966 ) { 
                            echo "<option selected disabled>Колір обкладинки</option>"; //Тревел бук
                        } else echo "<option selected disabled>Колір</option>";

                        foreach($attrs as $attr):

                           $price        = json_encode( $attr['price_html'] );
                           $variation_id = $attr['variation_id'];
                           $attr_slug    = $attr['attributes']['attribute_pa_color'];

                           if(isset($default_value['pa_color']) && $default_value['pa_color'] == $attr_slug){
                             $product_color_default = get_attr_name_by_slug($attr_slug); ?>
                              <option value="<?php echo $attr_slug; ?>" data-variation-id="<?php echo $variation_id; ?>" data-price='<?php echo $price; ?>' selected>
                          <?php } else { ?>
                              <option value="<?php echo $attr_slug; ?>" data-variation-id="<?php echo $variation_id; ?>" data-price='<?php echo $price; ?>'>
                          <?php } ?>

                            <?php echo get_attr_name_by_slug($attr_slug); ?>
                            </option>

                        <?php endforeach; ?>

                        </select>
                      </div>
                    </div>

                  <?php }
                }

                $preorder = get_post_meta( $_product['id'], '_ywpo_preorder' );

                if (isset($preorder[0])) {
                  $preorder = $preorder[0];
                } else {
                  $preorder = 'no';
                } ?>

                <button
                  class="product__btn"
                  name="btn_send"
                  data-product_id="<?php echo $_product['id']; ?>"
                  data-variation_id=""
                  data-preorder="<?php echo $preorder; ?>"
                  data-text="Купити в 1 клік"
                  data-title="<?php echo get_the_title($_product['id']); ?>"
                  data-url="<?php echo get_the_permalink($_product['id']); ?>"
                  data-price='<?php echo json_encode( $product->get_price_html() ); ?>'
                  data-select="select-one-click-<?php echo $_product['id']; ?>"
                  data-thumb="<?php echo get_the_post_thumbnail_url($_product['id'], 'medium_large'); ?>"
                ></button>

              </div>
              <a class="product__info" href="<?php echo get_the_permalink($_product['id']); ?>">
                <p class="product__name"><?php echo get_the_title($_product['id']); ?></p>
                <p class="product__low">

                  <?php if ( !empty( get_post_meta( $product->get_id(), '_common_product_name', true ) ) ) : ?>

                    <span class="product__color"><?php echo get_post_meta( $product->get_id(), '_common_product_name', true ); ?> — </span>
                    <span class="product__price"><?php echo wc_price( $product->get_variation_price('min') ); ?></span>

                    <?php $product_color_default = null; 
                  else: ?>
                    <span class="product__price"><?php echo $product->get_price_html(); ?></span>
                  <?php endif; ?>

                </p>
              </a>
              <p 
                  class="product__low btn_click"
                  data-product_id="<?php echo $_product['id']; ?>"
                  data-variation_id=""
                  data-preorder="<?php echo $preorder; ?>"
                  data-text="Купити в 1 клік"
                  data-title="<?php echo get_the_title($_product['id']); ?>"
                  data-url="<?php echo get_the_permalink($_product['id']); ?>"
                  data-price='<?php echo json_encode( $product->get_price_html() ); ?>'
                  data-select="select-one-click-<?php echo $_product['id']; ?>"
                  data-thumb="<?php echo get_the_post_thumbnail_url($_product['id'], 'medium_large'); ?>"
                >
                  <span>КУПИТИ В 1 КЛІК</span>
                </p>
            </li>

          <?php
          } else { 
          ?>
            <li id="<?php echo $_product['id']; ?>" class="product_item" data-attr="product_1">
              <div class="product__img__wrap">
                <a class="product__img__link" href="<?php echo get_the_permalink($_product['id']); ?>">

                  <?php if (!empty(get_the_post_thumbnail_url($_product['id'], 'medium_large'))):
                      $image_alt = get_post_meta($_product['id'], '_wp_attachment_image_alt', true); ?>

                      <img class="product__img lazyload"  src="<?php echo $stub; ?>" data-src="<?php echo get_the_post_thumbnail_url($_product['id'], 'medium_large'); ?>" alt="<?php echo $image_alt; ?>">

                  <?php endif; ?>

                  <?php if(!empty($img_hover)): 
                      $img_hover = wp_get_attachment_image_src( $img_hover, 'medium_large' ); ?>
                      <img class="product__img product__img__hover lazyload" src="<?php echo $stub; ?>" data-src="<?php echo $img_hover[0]; ?>" alt="img2">
                  <?php else: ?>
                    <img class="product__img product__img__hover lazyload" src="<?php echo $stub; ?>" data-src="<?php echo get_template_directory_uri(); ?>/img/blocnot_hover.jpg" alt="img2">
                  <?php endif; ?>

                </a>

                <?php if ( $product->is_type( 'variable' ) ) {

                  $attrs = $product->get_available_variations();
                  $default_value = $product->get_default_attributes(); 

                  if (!empty($attrs)) { ?>

                    <div class="wrapper-home-select">
                      <div class="select-wrapper select-one-click-<?php echo $_product['id']; ?>">
                        <select class="card_product__select" name="select">

                        <?php 
                        if ( $product->get_id() == 5728 ) { 
                            echo "<option selected disabled>Розмір</option>"; //чехол Faces
                        } elseif ( $product->get_id() == 5766 ) { 
                            echo "<option selected disabled>Розмір</option>"; //чехол Flowers
                        } elseif ( $product->get_id() == 5778 ) { 
                            echo "<option selected disabled>Розмір</option>"; //чехол Black
                        } elseif ( $product->get_id() == 5976 ) { 
				            echo "<option selected disabled>Розмір</option>"; //чехол We Bad
				        } elseif ( $product->get_id() == 6399 ) { 
				            echo "<option selected disabled>Розмір</option>"; //чехол Sale 30%
                        } elseif ( $product->get_id() == 418 ) { 
                            echo "<option selected disabled>Дизайн</option>"; //кошельки
                        } elseif ( $product->get_id() == 283 ) { 
                            echo "<option selected disabled>Колір обкладинки</option>"; //БДД
                        } elseif ( $product->get_id() == 96 ) { 
                            echo "<option selected disabled>Мова</option>"; //МБ
                        } elseif ( $product->get_id() == 966 ) { 
                            echo "<option selected disabled>Колір обкладинки</option>"; //Тревел бук
                        } else echo "<option selected disabled>Колір</option>";

                        foreach($attrs as $attr):

                           $price        = json_encode( $attr['price_html'] );
                           $variation_id = $attr['variation_id'];
                           $attr_slug    = $attr['attributes']['attribute_pa_color'];

                           if(isset($default_value['pa_color']) && $default_value['pa_color'] == $attr_slug){
                             $product_color_default = get_attr_name_by_slug($attr_slug); ?>
                              <option value="<?php echo $attr_slug; ?>" data-variation-id="<?php echo $variation_id; ?>" data-price='<?php echo $price; ?>' selected>
                          <?php } else { ?>
                              <option value="<?php echo $attr_slug; ?>" data-variation-id="<?php echo $variation_id; ?>" data-price='<?php echo $price; ?>'>
                          <?php } ?>

                            <?php echo get_attr_name_by_slug($attr_slug); ?>
                            </option>

                        <?php endforeach; ?>

                        </select>
                      </div>
                    </div>

                  <?php }
                }

                $preorder = get_post_meta( $_product['id'], '_ywpo_preorder' );

                if (isset($preorder[0])) {
                  $preorder = $preorder[0];
                } else {
                  $preorder = 'no';
                } ?>

                <button
                  class="product__btn"
                  name="btn_send"
                  data-product_id="<?php echo $_product['id']; ?>"
                  data-variation_id=""
                  data-preorder="<?php echo $preorder; ?>"
                  data-text="Купити в 1 клік"
                  data-title="<?php echo get_the_title($_product['id']); ?>"
                  data-url="<?php echo get_the_permalink($_product['id']); ?>"
                  data-price='<?php echo json_encode( $product->get_price_html() ); ?>'
                  data-select="select-one-click-<?php echo $_product['id']; ?>"
                  data-thumb="<?php echo get_the_post_thumbnail_url($_product['id'], 'medium_large'); ?>"
                ></button>

              </div>
              <a class="product__info" href="<?php echo get_the_permalink($_product['id']); ?>">
                <p class="product__name"><?php echo get_the_title($_product['id']); ?></p>
                <p class="product__low">

                  <?php if ( isset($product_color_default) ) : ?>

                    <span class="product__color"><?php echo $product_color_default; ?></span>
                    <span class="product__price"><?php echo json_decode($price); ?></span>

                    <?php $product_color_default = null; 
                  else: ?>
                    <span class="product__price"><?php echo $product->get_price_html(); ?></span>
                  <?php endif; ?>

                </p>
              </a>
              <p 
                  class="product__low btn_click"
                  data-product_id="<?php echo $_product['id']; ?>"
                  data-variation_id=""
                  data-preorder="<?php echo $preorder; ?>"
                  data-text="Купити в 1 клік"
                  data-title="<?php echo get_the_title($_product['id']); ?>"
                  data-url="<?php echo get_the_permalink($_product['id']); ?>"
                  data-price='<?php echo json_encode( $product->get_price_html() ); ?>'
                  data-select="select-one-click-<?php echo $_product['id']; ?>"
                  data-thumb="<?php echo get_the_post_thumbnail_url($_product['id'], 'medium_large'); ?>"
                >
                  <span>КУПИТИ В 1 КЛІК</span>
                </p>
            </li>
          <?php }

        endforeach;  
        
        $time = microtime(true) - $start; 

        echo '<pre>';
        print_r( $time );
        echo '</pre>';
        ?>

    </ul>
  </div>
</div>