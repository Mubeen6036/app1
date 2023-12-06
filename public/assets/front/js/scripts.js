jQuery(document).ready(function() {
    jQuery(".mobile-menu-btn").click(function() {
        jQuery('body').toggleClass("menu-open");
    });
    faqList = jQuery(".faqs li").length;
    x = 5;
    var total_show_faq = x;
    jQuery('.faqs li:lt(' + x + ')').show();
    jQuery('.loadMore a').click(function() {
        x = (x + 5 <= faqList) ? x + 5 : faqList;
        jQuery('.faqs li:lt(' + x + ')').fadeIn();
        if (faqList / x == 1) {
            $('.loadMore').hide();
        } else {
            $('.loadMore').show();
        }
    });
    jQuery(".faq-heading").click(function() {
        jQuery(this).toggleClass("active");
        jQuery(this).parent('.faq').find('.faq-content').slideToggle();
    });
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        //>=, not <=
        if (scroll >= 10) {
            jQuery('body').addClass("fixed-nav");
        } else {
            jQuery('body').removeClass("fixed-nav");
        }
    });
});
$(".show-advance-filter").click(function() {
    jQuery('.advance-filters').show();
});
$(".close-advance-filter").click(function() {
    jQuery('.advance-filters').hide();
});
$('#help-support-form').submit(function(e) {
    e.preventDefault();
    if ($('#help-support-form').parsley().validate() == false) {
        return false;
    }
    $('.submit_btn').attr('disabled', true);
    $('.submit_btn').html('Submitting...');
    $.ajax({
        url: "https://abcdsdf.com/save_contact_us_ajax",
        data: $('#help-support-form').serialize(),
        cache: false,
        success: function(response) {
            $('.submit_btn').attr('disabled', false);
            $('.submit_btn').html('Submit');
            var ress = JSON.parse(response);
            if (ress.success) {
                $('#help-support-form')[0].reset();
                $('.form-input').removeClass('parsley-success');
                $('.error').html('<div class="alert alert-success" role="alert">' + ress.message + '</div>');
            } else {
                $('.error').html('<div class="alert alert-danger" role="alert">' + ress.message + '</div>');
            }
        }
    });
});
jQuery(window).ready(function() {
    jQuery(".search-input-label").click(function() {
        jQuery('.search-popup').addClass("active");
        jQuery('.product-search-field').focus();
    });
    jQuery(".search-close").click(function() {
        jQuery('.search-popup').removeClass("active");
    });
});
//search
jQuery("#search").keyup(function() {
    $('.search-quick-links').html('');
    var search = $(this).val();
    var len = search.length;
    if (len != 0) {
        $.ajax({
            url: 'http://157.230.149.187/ifacc/search',
            data: {
                search: search,
            },
            cache: false,
            success: function(response) {
                $('.search-quick-links').html(response);
                // console.log(response);
            }
        });
    } else {
        $('.search-quick-links').html('');
    }
});
//advance search of header