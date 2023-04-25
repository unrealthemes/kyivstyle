<?php
/**
 * Template name: Checkout
 */

get_header(); ?>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

        <main class="site_content">
            <div class="order_wrap">
                <div class="container checkout-container">
                    <div class="order_wrap__title">
                        <h1 class="order_wrap__head"><?php the_title(); ?></h1>

                        <?php if (!isset($_GET['key']) && !isset($_GET['order'])) : ?>
                          <p class="order_wrap__subhead">Всі поля обов'язкові для заповнення</p>
                        <?php endif; ?>
                        
                    </div>
                    <div class="order_main">
                        <?php the_content(); ?>
                        <!-- <form class="order_main__data">
                  <h3 class="data_head">?????? ??????</h3>
                  <label>
                    <span>??? ???????</span>
                    <input type="text" name="orderName" required="">
                  </label>
                  <label>
                    <span>???????</span>
                    <input inputmode="numeric" pattern="[0-9]*" type="text" name="orderPhone" required="">
                  </label>
                  <label class="bb">
                    <span>Email</span>
                    <input type="email" name="orderMail" required="">
                  </label>
                  <h3 class="data_head">????????</h3>
                  <div class="radio">
                    <input type="radio" name="post" id="radio1" checked="">
                    <label for="radio1">????????? ???????? ?? ?????<i>???????, 50 ???</i></label>
                  </div>
                  <label>
                    <span>?????</span>
                    <input type="text" name="orderAdress" required="">
                  </label>
                  <div class="radio">
                    <input type="radio" name="post" id="radio2">
                    <label for="radio2">????? ????? ?? ???????<i>1-2 ???, ???????? 35 ???.</i></label>
                  </div>
                  <label class="bb">
                    <span>?????, ????? ?????????</span>
                    <input type="text" name="city" required="">
                  </label>
                  <h3 class="data_head">??????</h3>
                  <div class="radio">
                    <input type="radio" id="radio3" name="money" checked="">
                    <label for="radio3">????????? ??? ?????????<i>????????? ? ????????? ???</i></label>
                  </div>
                  <div class="radio">
                    <input type="radio" id="radio4" name="money">
                    <label for="radio4">?????????? ??????<i>1-2 ???, ???????? 35 ???.</i></label>
                  </div>
                  <label class="bb area-label"><span>??????????? ? ??????</span>
                    <textarea></textarea>
                  </label>
                  <p class="text_info">???? ?? ?????? ???????? ????? ?????????????? ????????, ????? ??? PayPal, ?????? ?????? ? ??., ??????? ??? ? ???????????, ? ?? ? ???? ???????? ??? ????????? ???????.</p>
                </form>
                <div id="vueToggle" class="order_main__info">
                  <div class="vue-wrap"></div> 
                  <div class="your_order__head">
                    <h5>??? ?????
                      <svg id="Capa_1" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 240.823 240.823" xml:space="preserve" class=""><g><path id="Chevron_Right" d="M57.633,129.007L165.93,237.268c4.752,4.74,12.451,4.74,17.215,0c4.752-4.74,4.752-12.439,0-17.179l-99.707-99.671l99.695-99.671c4.752-4.74,4.752-12.439,0-17.191c-4.752-4.74-12.463-4.74-17.215,0L57.621,111.816C52.942,116.507,52.942,124.327,57.633,129.007z"></path></g></svg>
                    </h5>
                  </div> 
                  <ul id="orderClick" class="your_order">
                    <li class="your_order__items">
                      <div class="your_order__img">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/sketch_mini.jpg" alt="img">
                      </div> 
                      <div class="your_order__info">
                        <h6 class="info__head">???????? ???????</h6>
                        <span class="info__color">????????????</span>
                        <span class="info__mass">1 ??.</span>
                        <span class="info__amount">295 ???.</span>
                      </div>
                    </li> 
                    <li class="your_order__items">
                      <div class="your_order__img">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/sketch_mini1.jpg" alt="img"></div> 
                        <div class="your_order__info">
                          <h6 class="info__head">???????? ???????</h6>
                          <span class="info__color">????????????</span>
                          <span class="info__mass">1 ??.</span>
                          <span class="info__amount">295 ???.</span>
                        </div>
                      </li> 
                      <li class="your_order__sertificate">
                        <span>??????????: (???? ????)</span>
                        <span>-100 ???.</span>
                      </li> 
                      <li class="your_order__send">
                        <span>????????:</span>
                        <span>50 ???.</span>
                      </li> 
                      <li class="your_order__footer">
                        <span>? ??????:</span>
                        <span>960 ???.</span>
                      </li>
                    </ul>
                  </div>
                              </div>
                              <button type="submit" name="orderSubmit" id="orderSubmit">??????????? ?????</button>
                            </div> -->
                    </div>
                </div>
            </div>
        </main>

    <?php endwhile; ?>

<?php endif; ?>

<?php get_footer();