<?php 
global $product;

if ( $product->is_type( 'variable' ) ) {

  $currency = get_woocommerce_currency_symbol();
  $attrs = $product->get_available_variations(); 
  $default_value = $product->get_default_attributes();
  ?>

  <div class="select-wrapper">
	  <select class="card_product__select" name="select">

	  <?php
	  	if ( $product->get_id() == 5728 ) { 
          echo "<option selected disabled>Размер</option>"; //чехол Faces
	  	} elseif ( $product->get_id() == 5766 ) { 
          echo "<option selected disabled>Размер</option>"; //чехол Flowers
	  	} elseif ( $product->get_id() == 5778 ) { 
          echo "<option selected disabled>Размер</option>"; //чехол Black
        } elseif ( $product->get_id() == 5976 ) { 
          echo "<option selected disabled>Размер</option>"; //чехол We Bad
        } elseif ( $product->get_id() == 6399 ) { 
          echo "<option selected disabled>Размер</option>"; //чехол Sale 30%
	  	} elseif ( $product->get_id() == 418 ) { 
          echo "<option selected disabled>Дизайн</option>"; //кошельки
	  	} elseif ( $product->get_id() == 283 ) { 
          echo "<option selected disabled>Цвет обложки</option>"; //БДД
	  	} elseif ( $product->get_id() == 96 ) { 
          echo "<option selected disabled>Язык</option>"; //МБ
	  	} elseif ( $product->get_id() == 966 ) { 
          echo "<option selected disabled>Цвет обложки</option>"; //Тревел бук
	  	} else echo "<option selected disabled>Цвет</option>";

      foreach($attrs as $attr): 

        if (!empty($attr['price_html'])) {
          $price = json_encode( $attr['price_html'] );
        } else {
          $price = json_encode( $attr['display_price'] . ' ' . $currency );
        }
        $variation_id = $attr['variation_id'];
        $attr_slug    = $attr['attributes']['attribute_pa_color']; 

        if ( (isset($default_value['pa_color']) && $default_value['pa_color'] == $attr_slug) && !( isset($_GET['color']) && $_GET['color'] == $attr_slug ) ) { ?>

          <option value="<?php echo $attr_slug; ?>" data-thumb="<?php echo $attr['image']['url']; ?>" data-variation-id="<?php echo $variation_id; ?>" data-price='<?php echo $price; ?>' selected>

        <?php } elseif ( isset($_GET['color']) && $_GET['color'] == $attr_slug ) { ?>

          <option value="<?php echo $attr_slug; ?>" data-thumb="<?php echo $attr['image']['url']; ?>" data-variation-id="<?php echo $variation_id; ?>" data-price='<?php echo $price; ?>' selected>

        <?php } else { ?>

          <option value="<?php echo $attr_slug; ?>" data-thumb="<?php echo $attr['image']['url']; ?>" data-variation-id="<?php echo $variation_id; ?>" data-price='<?php echo $price; ?>'>

        <?php } ?>

          <?php echo get_attr_name_by_slug($attr_slug); ?>
        </option>

      <?php endforeach; ?>

    </select>
  </div>

<?php } ?>
