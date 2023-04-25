$(document).ready(function () {

    $('.wpcf7-form-control.wpcf7-select option[value=""]').attr('disabled', true);
    $('#ut_communication_method option[value=""]').attr('disabled', true);

    $('#ut_communication_method').on('change', function(e) {
        $(this).parent().parent().addClass('littleLetter');
    });
    
    $('.wpcf7-form-control.wpcf7-select').on('change', function(e) {
        $(this).parent().parent().parent().addClass('littleLetter');
    });

    // Lazyload
    lazySizesConfig.loadMode = 1;
    $(window).on('scroll', function () {
        lazySizesConfig.loadMode = 3;
        lazySizesConfig.preloadAfterLoad = true;
    });
    // Lazyload


    if ($(window).width() < 1024) {
        $('.kyivstyle__item').slice(4).remove();
    }
    if ($(window).width() < 576) {
        $('.kyivstyle__item').slice(2).remove();
    }


    /**
     * Ajax coupon
     */
    $(".certificate_input .form_submit").on('click', function (e) {

        data = {
            action: 'coupon',
            coupon: $(".certificate_input input").val()
        };

        $.ajax({
            url: params.ajaxurl,
            data: data,
            type: 'POST',
            success: function (data) {

                if (data.return) {
                    $(".certificate_input .form_submit").hide();
                    $(".certificate_error").hide();
                    $("#cart_total").html(data.cart_total);
                    $(".certificate_input .certificate_sale").html('-' + data.discount_amount + ' грн.');
                } else {
                    $(".certificate_error").css('display', 'block').html('Сертификат "' + $(".certificate_input input").val() + '" не знайдено');
                }
            }
        });
    });


    $('.woocommerce-input-wrapper .select').closest('.woocommerce-input-wrapper').addClass('select-wrapper');

    // Input sertificate
    $('.cart_nav__items.certificate a').on('click', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        $(this).closest('.certificate').addClass('open');
        // $(this).hide();
        // $(this).siblings('.certificate_input').show();
    });

    var certificate_value;

    $('.certificate_input input').on('click', function (e) {
        e.stopImmediatePropagation();
        $('.certificate_input input').on('keyup', function () {
            certificate_value = $(this).val();
        });
    });
    $('.certificate_input input').on('focus', function () {
        $(this).closest('.certificate_input').addClass("littleLetter");
    });
    $('.certificate_input input').on('focusout', function () {
        if ($(this).val() == '') {
            $(this).closest('.certificate_input').removeClass("littleLetter");
        }
    });

    // Mask phone
    $('.phone-mask').mask("+38 (999) 999-9999", {
        autoclear: false
    });
    // Mask phone


    $('body').on('click', '.cart_nav__items.open', function (e) {
        e.stopImmediatePropagation();
        if ($('.certificate_input input').is(':not(:hidden)')) {
            if (certificate_value == undefined || certificate_value == '') {
                $('.cart_nav__items.open').removeClass('open');
            }
        }
    });


    $('.certificate_input .form_submit').on('click', function (e) {
        e.stopImmediatePropagation();
        if ($('#enter_certificate').val() != 0) {
            $('.certificate_sale').show();
        }
    });
    // Input certificate

    // Checkout

    $('body').on('wpcf7mailsent', function () {
        fbq('track', 'InitiateCheckout'); // Facebook Pixel event
        $('.one_click__form fieldset').removeClass('littleLetter');
    });

    // Facebook Pixel event ADD TO CART
    $('.card_product__info .card_product__btn').on('click', function () {
        fbq('track', 'AddToCart');
    });


    function validateSelect(e) {
        if ($('#billing_nova_poshta_region').is(':visible')) {
            if ($('#billing_nova_poshta_region').val() === '') {
                $('#billing_nova_poshta_region').addClass('validation-error');
                $('#billing_nova_poshta_region').siblings('.text-validation-error').text('');
                $('#billing_nova_poshta_region').closest('.validation-error').after('<span class="text-validation-error">Поле адреса обов\'язкове для заповнення</span>');
                e.preventDefault();
            } else {
                e.stopPropagation();
                $('#billing_nova_poshta_region').removeClass('validation-error');
                $('#billing_nova_poshta_region').siblings('.text-validation-error').remove();
            }
        }
        if ($('#billing_nova_poshta_city').is(':visible')) {
            if ($('#billing_nova_poshta_city').val() === '') {
                $('#billing_nova_poshta_city').addClass('validation-error');
                $('#billing_nova_poshta_city').siblings('.text-validation-error').text('');
                $('#billing_nova_poshta_city').closest('.validation-error').after('<span class="text-validation-error">Поле адреса обов\'язкове для заповнення</span>');
                e.preventDefault();
            } else {
                e.stopPropagation();
                $('#billing_nova_poshta_city').removeClass('validation-error');
                $('#billing_nova_poshta_city').siblings('.text-validation-error').remove();
            }
        }
        if ($('#billing_nova_poshta_warehouse').is(':visible')) {
            if ($('#billing_nova_poshta_warehouse').val() === '') {
                $('#billing_nova_poshta_warehouse').addClass('validation-error');
                $('#billing_nova_poshta_warehouse').siblings('.text-validation-error').text('');
                $('#billing_nova_poshta_warehouse').closest('.validation-error').after('<span class="text-validation-error">Поле адреса обов\'язкове для заповнення</span>');
                e.preventDefault();
            } else {
                e.stopPropagation();
                $('#billing_nova_poshta_warehouse').removeClass('validation-error');
                $('#billing_nova_poshta_warehouse').siblings('.text-validation-error').remove();
            }
        }
    }

    function validateName(e) {
        if ($('#shipping_method_0_nova_poshta_shipping_method:checked').length == 1) {
            var number_words = $('#billing_first_name').val().trim().replace(/\s+/gi, ' ').split(' ').length;
            if (number_words < 3) {
                $('#billing_first_name').addClass('validation-error');
                $('#billing_first_name').siblings('.text-validation-error').text('');
                $('#billing_first_name').closest('.validation-error').after('<span class="text-validation-error">Поле ПІБ обов\'язкове для заповнення</span>');
                e.preventDefault();
            }
            else {
                e.stopPropagation();
                $('#billing_first_name').removeClass('validation-error');
                $('#billing_first_name').siblings('.text-validation-error').remove();
            }
        } else {
            if ($('#billing_first_name').val() < 2) {
                $('#billing_first_name').addClass('validation-error');
                $('#billing_first_name').siblings('.text-validation-error').text('');
                $('#billing_first_name').closest('.validation-error').after('<span class="text-validation-error">Поле им\'я обов\'язкове для заповнення</span>');
                e.preventDefault();
            }
            else {
                e.stopPropagation();
                $('#billing_first_name').removeClass('validation-error');
                $('#billing_first_name').siblings('.text-validation-error').remove();
            }
        }
    }

    $('#billing_first_name').on('input', function (e) {
        setTimeout(function () {
            if ($('#shipping_method_0_nova_poshta_shipping_method:checked').length == 1) {
                var number_words = $('#billing_first_name').val().trim().replace(/\s+/gi, ' ').split(' ').length;
                if (number_words < 3) {
                    $('#billing_first_name').addClass('validation-error');
                    $('#billing_first_name').siblings('.text-validation-error').text('');
                    $('#billing_first_name').closest('.validation-error').after('<span class="text-validation-error">Поле ПІБ обов\'язкове для заповнення</span>');
                }
                else {
                    $('#billing_first_name').removeClass('validation-error');
                    $('#billing_first_name').siblings('.text-validation-error').remove();
                }
            } else {
                if ($('#billing_first_name').val() < 2) {
                    $('#billing_first_name').addClass('validation-error');
                    $('#billing_first_name').siblings('.text-validation-error').text('');
                    $('#billing_first_name').closest('.validation-error').after('<span class="text-validation-error">Поле им\'я обов\'язкове для заповнення</span>');
                }
                else {
                    $('#billing_first_name').removeClass('validation-error');
                    $('#billing_first_name').siblings('.text-validation-error').remove();
                }
            }
        }, 1)
    });


    $('body').on('click', '#place_order', function (e) {

        validateName(e);

        $('form.checkout').on('change', 'input[name^="shipping_method"]', function (e) {
            validateName(e);
            name_label();
        });

        if ($('#billing_phone').val() < 5) {
            $('#billing_phone').addClass('validation-error');
            $('#billing_phone').siblings('.text-validation-error').text('');
            $('#billing_phone').closest('.validation-error').after('<span class="text-validation-error">Поле телефон обов\'язкове для заповнення</span>');
            e.preventDefault();
        } else {
            e.stopPropagation();
            $('#billing_phone').removeClass('validation-error');
            $('#billing_phone').siblings('.text-validation-error').remove();
        }

        var pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var billing_email = $('#billing_email');
        if (billing_email.val().search(pattern) !== 0) {
            $('#billing_email').addClass('validation-error');
            $('#billing_email').siblings('.text-validation-error').text('');
            $('#billing_email').closest('.validation-error').after('<span class="text-validation-error">Поле Email обов\'язкове для заповнення</span>');
            e.preventDefault();
        } else {
            e.stopPropagation();
            $('#billing_email').removeClass('validation-error');
            $('#billing_email').siblings('.text-validation-error').remove();
        }
        if ($('#billing_address_1').is(':visible')) {
            if ($('#billing_address_1').val() < 3) {
                $('#billing_address_1').addClass('validation-error');
                $('#billing_address_1').siblings('.text-validation-error').text('');
                $('#billing_address_1').closest('.validation-error').after('<span class="text-validation-error">Поле адреса обов\'язкове для заповнення</span>');
                e.preventDefault();
            } else {
                e.stopPropagation();
                $('#billing_address_1').removeClass('validation-error');
                $('#billing_address_1').siblings('.text-validation-error').remove();
            }
        }

        if ($(".text-validation-error").is(":visible")) {
            $('html, body').animate({
                scrollTop: ($(".text-validation-error").eq(0).offset().top) - 86
            }, 1000);
        }


        $('body').on('keyup', '.input-text', function (e) {
            if ($('#shipping_method_0_nova_poshta_shipping_method:checked').length == 1) {
                var number_words = $('#billing_first_name').val().trim().replace(/\s+/gi, ' ').split(' ').length;
                if (number_words < 3) {
                    $('#billing_first_name').addClass('validation-error');
                    $('#billing_first_name').siblings('.text-validation-error').text('');
                    $('#billing_first_name').closest('.validation-error').after('<span class="text-validation-error">Поле ПІБ обов\'язкове для заповнення</span>');
                    e.preventDefault();
                }
                else {
                    e.stopPropagation();
                    $('#billing_first_name').removeClass('validation-error');
                    $('#billing_first_name').siblings('.text-validation-error').remove();
                }
            } else {
                if ($('#billing_first_name').val() < 2) {
                    $('#billing_first_name').addClass('validation-error');
                    $('#billing_first_name').siblings('.text-validation-error').text('');
                    $('#billing_first_name').closest('.validation-error').after('<span class="text-validation-error">Поле им\'я обов\'язкове для заповнення</span>');
                    e.preventDefault();
                }
                else {
                    e.stopPropagation();
                    $('#billing_first_name').removeClass('validation-error');
                    $('#billing_first_name').siblings('.text-validation-error').remove();
                }
            }
            if ($('#billing_phone').val().replace(/[^0-9]/g, '').length < 12) {
                $('#billing_phone').addClass('validation-error');
                $('#billing_phone').siblings('.text-validation-error').text('');
                $('#billing_phone').closest('.validation-error').after('<span class="text-validation-error">Поле телефон обов\'язкове для заповнення</span>');
                e.preventDefault();
            } else {
                e.stopPropagation();
                $('#billing_phone').removeClass('validation-error');
                $('#billing_phone').siblings('.text-validation-error').remove();
            }
            var pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            var billing_email = $('#billing_email');
            if (billing_email.val().search(pattern) !== 0) {
                $('#billing_email').addClass('validation-error');
                $('#billing_email').siblings('.text-validation-error').text('');
                $('#billing_email').closest('.validation-error').after('<span class="text-validation-error">Поле Email обов\'язкове для заповнення</span>');
                e.preventDefault();
            } else {
                e.stopPropagation();
                $('#billing_email').removeClass('validation-error');
                $('#billing_email').siblings('.text-validation-error').remove();
            }
            if ($('#billing_address_1').is(':visible')) {
                if ($('#billing_address_1').val() < 3) {
                    $('#billing_address_1').addClass('validation-error');
                    $('#billing_address_1').siblings('.text-validation-error').text('');
                    $('#billing_address_1').closest('.validation-error').after('<span class="text-validation-error">Поле адреса обов\'язкове для заповнення</span>');
                    e.preventDefault();
                } else {
                    e.stopPropagation();
                    $('#billing_address_1').removeClass('validation-error');
                    $('#billing_address_1').siblings('.text-validation-error').remove();
                }
            }
        });

        

        if ( $('.order_main__data .form-row input').hasClass('validation-error') == false ) {
            
            // Facebook Pixel event PURCHASE
            fbq('track', 'Purchase');
        }

    });


    // Checkout


    /**
     * Ajax quantity update cart
     */
    $(".cart_product__count.no-spinners").keyup(function (event) {

        if (event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40) return;

        var item_key = $(this).data("item-id");
        var quantity = parseInt($(this).val().replace(/[^0-9\.]/g, ''));
        var quantity = $(this).val().replace(/(^|\s)0/g, '');
        var item_key = $(this).parents('.cart_nav__items').find('.close_cart_product').attr('data-id');

        $(this).val(quantity);

        if (quantity > 0) {

            $(this).val(quantity);

            data = {
                action: 'quantity_update_cart',
                quantity: quantity,
                cart_item_key: item_key
            };

            $.ajax({
                url: params.ajaxurl,
                data: data,
                type: 'POST',
                beforeSend: function () {
                    $('.cart-preloader').show();
                },
                complete: function () {
                    $('.cart-preloader').hide();
                },
                success: function (data) {

                    if (data) {
                        $("#cart_total").html(data.cart_total);
                    }
                }
            });
        }
    });

    /**
     * Ajax variation cart
     */
    $(".cart_variation").change(function (event) {

        var $this = $(this);
        // var item_key     = $this.data("item-key");
        var parent_id = $this.data("parent-id");
        var variation_id = $this.val();
        var quantity = $this.parent().parent().find('.cart_product__count.no-spinners').val();
        var variation_id = $this.val();
        var variation_slug = $this.find(':selected').data('slug');
        var product_key = $this.parents('.cart_nav__items').find('.close_cart_product').attr('data-id');

        // console.log( $this.parents('.cart_nav__items').find('.close_cart_product').attr('data-id') );

        // $this.parents('.cart_nav__items').find('.close_cart_product').trigger('click');

        data = {
            action: 'variation_update_cart',
            parent_id: parent_id,
            quantity: quantity,
            variation_id: variation_id,
            // cart_item_key: item_key,
            product_key: product_key
        };

        $.ajax({
            url: params.ajaxurl,
            data: data,
            type: 'POST',
            beforeSend: function () {
                $('.cart-preloader').show();
            },
            complete: function () {
                $('.cart-preloader').hide();
            },
            success: function (data) {
                if (data) {
                    $this.parents('.cart_nav__items').find('.close_cart_product').attr('data-id', data.key)
                    $("#cart_total").html(data.cart_total);
                    $this.parents(".cart_nav__items").find('.cart_product__img img').attr('src', data.thumb);
                    console.log(data.key);
                }
            }
        });

    });

    /**
     * Load more
     */
    $('.load-more').click(function () {

        var post_ids = [];
        $('.main_reviews__items').each(function (index, el) {
            var postId = $(el).data("post-id");
            post_ids.push(postId);
        });

        data = {
            action: 'loadmore',
            post_ids: post_ids
        };

        $.ajax({
            url: params.ajaxurl,
            data: data,
            type: 'POST',
            beforeSend: function () {
                // $('.load-more').html('<img class="img-preload" src="'+params.directory_uri+'/img/load-more.gif" alt="preloader">');
            },
            complete: function () {
                // $('.load-more').html('Load more');
            },
            success: function (data) {

                if (data) {
                    $(".main_reviews").append(data);
                }

                if (parseInt(found_posts) <= parseInt(4)) {
                    $('.see_all_wrap').hide();
                } else {
                    $('.see_all_wrap').show();
                }
            }
        });
    });

    /**
     * Remove product from cart
     */
    $('.close_cart_product').click(function () {

        var this_item = $(this).parent();
        data = {
            action: 'remove_item_from_cart',
            product_id: $(this).data('id')
        };

        $.ajax({
            url: params.ajaxurl,
            data: data,
            type: 'POST',
            beforeSend: function () {
                // $('.load-more').html('<img class="img-preload" src="'+params.directory_uri+'/img/load-more.gif" alt="preloader">');
            },
            complete: function () {
                // $('.load-more').html('Load more');
            },
            success: function (data) {

                if (data) {
                    this_item.remove();
                    $("#cart_total").html(data.cart_total);

                    if (data.cart_count == 0) {
                        // background-color: #fff!important;
                        $('.full').cssBefore('opacity', '.0');
                        $('.cart_nav__items.certificate').hide();
                        $('.certificate_error').hide();
                        // $("#cart_count").hide();
                    }
                    /* else {
                     $("#cart_count").html(data.cart_count);
                     }*/

                }
            }
        });
    });

    // var homeUrl = window.location.origin;

    document.addEventListener('wpcf7mailsent', function (event) {
        // location = homeUrl + '/thanks';
        $('.contact_form fieldset').removeClass('littleLetter');

        if ( '168' == event.detail.contactFormId ) {
            location = params.thanks_url;
        }

    }, false);

    /**
     * Update checkout shipping method
     */


    // $(document).ajaxStart(function() {
    //     $('.input-text').each(function () {
    //         if ($(this).val() !== '') {
    //             $(this).closest('.form-row').addClass('littleLetter')
    //         }
    //     });
    // });

    // if ($('#shipping_method_0_nova_poshta_shipping_method:checked').length == 1) {
    //     $("#billing_first_name").keypress(function (e) {
    //         var verified = String.fromCharCode(e.which).match(/[a-zA-Z-]/);
    //         if (verified) {
    //             e.stopImmediatePropagation();
    //             e.preventDefault();
    //         }
    //     });
    // }
    // if ($('#shipping_method_0_nova_poshta_shipping_method:checked').length == 0) {
    //     $("#billing_first_name").keypress(function (e) {
    //         this.value = this.value.replace(/[^a-z\s]/gi, '');
    //     });
    // }

    function detect_delivery_type() {
        $('#billing_first_name').on('keypress', function (e) {
            if ($('#shipping_method_0_nova_poshta_shipping_method:checked').length == 1) {
                var verified = String.fromCharCode(e.which).match(/[a-zA-Z-]/);
                if (verified) {
                    e.preventDefault();
                }
            } else {
                e.stopPropagation();
            }
        });
    }

    detect_delivery_type();

    function name_label() {
        if ($('#shipping_method_0_flat_rate-1:checked').length) {
            $('#billing_first_name_field label').text('Им\'я');
        } else {
            $('#billing_first_name_field label').text('ПІБ')
        }
    }

    setTimeout(function () {
        name_label();
        if ($('body').hasClass('hide')) {
            $('body').removeClass('hide').addClass('show');
        }
        $('input[name^="shipping_method"]').trigger("change");

        $('#billing_nova_poshta_region').select2(
            {
                "language": {
                    "noResults": function(){
                        return "Немає результатів";
                    }
                }
            }
        );
        $('#billing_nova_poshta_city').select2(
            {
                "language": {
                    "noResults": function(){
                        return "Немає результатів";
                    }
                }
            }
        );
        $('#billing_nova_poshta_warehouse').select2(
            {
                "language": {
                    "noResults": function(){
                        return "Немає результатів";
                    }
                }
            }
        );

        // on first focus (bubbles up to document), open the menu
        // $(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
        //     $(this).closest(".select2-container").siblings('select:enabled').select2('open');
        // });
        
        // // steal focus during close - only capture once and stop propogation
        // $('select.select2').on('select2:closing', function (e) {
        //     $(e.target).data("select2").$selection.one('focus focusin', function (e) {
        //     e.stopPropagation();
        //     });
        // });

    }, 1000);


    $('form.checkout').on('change', 'input[name^="shipping_method"]', function (e) {

        detect_delivery_type();

        name_label();


        data = {
            action: 'calc_shipping_checkout'
        };

        setTimeout(function () {
            $.ajax({
                url: params.ajaxurl,
                data: data,
                type: 'POST',
                success: function (data) {

                    if (data) {
                        var shipping_total = data.shipping_total;
                        var totals_order = data.totals_order;
                        console.log( shipping_total );
                        $("#curr_sh_price_html").html(shipping_total);
                        $(".your_order__footer strong").html(totals_order);
                    }

                    $('#billing_nova_poshta_region').select2(
                        {
                            "language": {
                                "noResults": function(){
                                    return "Немає результатів";
                                }
                            }
                        }
                    );
                    $('#billing_nova_poshta_city').select2(
                        {
                            "language": {
                                "noResults": function(){
                                    return "Немає результатів";
                                }
                            }
                        }
                    );
                    $('#billing_nova_poshta_warehouse').select2(
                        {
                            "language": {
                                "noResults": function(){
                                    return "Немає результатів";
                                }
                            }
                        }
                    );
                    
                }
            });

        }, 2000);

        /*var val = $( this ).val();
         var input_id = $(this).attr('id');
         var curr_sh_price_html = $("label[for="+input_id+"] .woocommerce-Price-amount.amount").html();
         $("#curr_sh_price_html").html(curr_sh_price_html);

         setTimeout(function () {
         var order_total = $(".order-total .woocommerce-Price-amount.amount").html();
         $(".your_order__footer span.woocommerce-Price-amount.amount").html(order_total);
         }, 4000);

         if (val.match("^local_pickup")) {
         $('#customer_details .col-2').fadeOut();
         } else {
         $('#customer_details .col-2').fadeIn();
         }*/

    });

    // console.log( $("#billing_country").val("UA") );

});

/**
 * Function css before
 */
(function (a) {
    'use string';
    a.pseudoElements = {length: 0};
    var b = function (c) {
        if ('object' == typeof c.argument || c.argument !== void 0 && c.property !== void 0) {
            for (var d of c.elements.get()) {
                d.pseudoElements || (d.pseudoElements = {
                    styleSheet: null,
                    before: {index: null, properties: null},
                    after: {index: null, properties: null},
                    id: null
                });
                var e = function () {
                    if (null !== d.pseudoElements.id) return +d.getAttribute('data-pe--id') !== d.pseudoElements.id && d.setAttribute('data-pe--id', d.pseudoElements.id), '[data-pe--id="' + d.pseudoElements.id + '"]::' + c.pseudoElement;
                    var k = a.pseudoElements.length;
                    return a.pseudoElements.length++, d.pseudoElements.id = k, d.setAttribute('data-pe--id', k), '[data-pe--id="' + k + '"]::' + c.pseudoElement
                }();
                if (!d.pseudoElements.styleSheet) if (document.styleSheets[0]) d.pseudoElements.styleSheet = document.styleSheets[0]; else {
                    var f = document.createElement('style');
                    document.head.appendChild(f), d.pseudoElements.styleSheet = f.sheet
                }
                if (d.pseudoElements[c.pseudoElement].properties && d.pseudoElements[c.pseudoElement].index && d.pseudoElements.styleSheet.deleteRule(d.pseudoElements[c.pseudoElement].index), 'object' == typeof c.argument) {
                    if (c.argument = a.extend({}, c.argument), !d.pseudoElements[c.pseudoElement].properties && !d.pseudoElements[c.pseudoElement].index) {
                        var g = d.pseudoElements.styleSheet.rules.length || d.pseudoElements.styleSheet.cssRules.length || d.pseudoElements.styleSheet.length;
                        d.pseudoElements[c.pseudoElement].index = g, d.pseudoElements[c.pseudoElement].properties = c.argument
                    }
                    var h = '';
                    for (var i in c.argument) d.pseudoElements[c.pseudoElement].properties[i] = 'function' == typeof c.argument[i] ? c.argument[i]() : c.argument[i];
                    for (var i in d.pseudoElements[c.pseudoElement].properties) h += i + ': ' + d.pseudoElements[c.pseudoElement].properties[i] + ' !important; ';
                    d.pseudoElements.styleSheet.addRule(e, h, d.pseudoElements[c.pseudoElement].index)
                } else if (void 0 !== c.argument && void 0 !== c.property) {
                    if (!d.pseudoElements[c.pseudoElement].properties && !d.pseudoElements[c.pseudoElement].index) {
                        var g = d.pseudoElements.styleSheet.rules.length || d.pseudoElements.styleSheet.cssRules.length || d.pseudoElements.styleSheet.length;
                        d.pseudoElements[c.pseudoElement].index = g, d.pseudoElements[c.pseudoElement].properties = {}
                    }
                    d.pseudoElements[c.pseudoElement].properties[c.argument] = 'function' == typeof c.property ? c.property() : c.property;
                    var h = '';
                    for (var i in d.pseudoElements[c.pseudoElement].properties) h += i + ': ' + d.pseudoElements[c.pseudoElement].properties[i] + ' !important; ';
                    d.pseudoElements.styleSheet.addRule(e, h, d.pseudoElements[c.pseudoElement].index)
                }
            }
            return a(c.elements)
        }
        if (void 0 !== c.argument && void 0 === c.property) {
            var d = a(c.elements).get(0),
                j = window.getComputedStyle(d, '::' + c.pseudoElement).getPropertyValue(c.argument);
            return d.pseudoElements ? a(c.elements).get(0).pseudoElements[c.pseudoElement].properties[c.argument] || j : j || null
        }
        return console.error('Invalid values!'), !1
    };
    a.fn.cssBefore = function (c, d) {
        return b({elements: this, pseudoElement: 'before', argument: c, property: d})
    }, a.fn.cssAfter = function (c, d) {
        return b({elements: this, pseudoElement: 'after', argument: c, property: d})
    }
})(jQuery);
