<?php 
global $product;

if ( $product->is_type( 'variable' ) ) {

  $attrs = $product->get_available_variations(); 
  $default_value = $product->get_default_attributes();
  ?>
  
  <div class="wrapper-home-select">
    <div class="select-wrapper select-one-click-<?php echo $post->ID; ?>">
      <select class="card_product__select" name="select">
        <option selected disabled hidden>Цвет</option>

        <?php foreach($attrs as $attr): 

          $price        = json_encode( $attr['price_html'] );
          $variation_id = $attr['variation_id'];
          $attr_slug    = $attr['attributes']['attribute_pa_color']; 

          if(isset($default_value['pa_color']) && $default_value['pa_color'] == $attr_slug){ ?>
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

<?php } ?>