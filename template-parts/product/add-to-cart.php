<?php global $product; ?>

<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>

  <?php
  woocommerce_quantity_input( array(
    'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
    'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
    'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
  ) ); ?>

  <?php if ( $product->is_type( 'variable' ) ) { ?>
    <input type="hidden" name="add-to-cart" value="<?php echo $product->get_id(); ?>">
    <input type="hidden" name="product_id" value="<?php echo $product->get_id(); ?>">
    <input type="hidden" name="variation_id" class="variation_id" value="">
    <?php $disabled_attr = 'disabled'; ?>
  <?php } else { ?>
    <?php $disabled_attr = ''; ?>
  <?php } ?>

  <button data-quantity="<?php echo $product->get_stock_quantity(); ?>" type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="main-btn card_product__btn" <?php echo $disabled_attr; ?>>
  	<?php echo esc_html( $product->single_add_to_cart_text() ); ?>
	</button>
  
</form>
