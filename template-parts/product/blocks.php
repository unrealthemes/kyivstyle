<?php 
global $product, $stub; 

?>

<div class="select_wrap">
  <div class="container container-sm">
    <ul class="main_select">

    <?php $items = carbon_get_post_meta( $post->ID, 'rep_product' ); ?>

    <?php foreach($items as $item): 

      $src = wp_get_attachment_image_url( $item['img_delivery'], 'full' ); ?>

      <!--
        Для чехлов выводим только картинки, без текста
        И с другими стилями (3 столбца вместо 6)
      -->
      <?php if(($post->ID == 5778) || ($post->ID == 7292) || ($post->ID == 7242)
           || ($post->ID == 5976) || ($post->ID == 5766) || ($post->ID == 5728)): ?>

        <li class="main_select__items_sleeve">
          <div class="main_select__links">
            <div class="main_select__img_sleeve">
        
              <?php if(!empty($src)): ?>
                <img class="lazyload" src="<?php echo $stub; ?>" data-src="<?php echo $src; ?>" alt="img">
              <?php endif; ?>
        
            </div>
          </div>
        </li>
      
      <?php else : ?>
      <!--
        Оригинальный код для остальных продуктов, кроме чехлов
      -->
        <li class="main_select__items">
          <div class="main_select__links">
            <div class="main_select__img">
  
              <?php if(!empty($src)): ?>
                <img class="lazyload" src="<?php echo $stub; ?>" data-src="<?php echo $src; ?>" alt="img">
              <?php endif; ?>
  
            </div>
  
                <h5 class="main_select__head"><?php echo $item['title_rep_product']; ?></h5>
                <p class="main_select__text"><?php
	          	      $page_cont = wpautop($item['desc_rep_product']);
			  	      $added_class = str_replace('<p>', '<p class="main_select__text">', $page_cont);
				      echo $added_class;
                ?></p>
          </div>
        </li>

      <?php endif; ?>
      <!--
        Конец условия по чехлам
      -->

    <?php endforeach; ?>

    </ul>
  </div>
</div>