$(document).ready(function (e) {
    if (window.location.pathname.match("manage-faq")) {
        if (window.location.search.startsWith("?id")) {
            $(".faq-form").slideToggle(300);
            setTimeout(function () {
                // Cek apakah elemen #feature-form ada
                var $featureForm = $('#faq-form');

                if ($featureForm.length) {
                    $('html, body').animate({
                        scrollTop: $featureForm.offset().top
                    }, 400);
                }
            }, 400);
        }
    }

    if (window.location.pathname.match("manage-feature")) {
        if (window.location.search.startsWith("?id")) {
            $(".feature-form").slideToggle(300);
            setTimeout(function () {
                // Cek apakah elemen #feature-form ada
                var $featureForm = $('#feature-form');

                if ($featureForm.length) {
                    $('html, body').animate({
                        scrollTop: $featureForm.offset().top
                    }, 400);
                }
            }, 400);
        }
    }

    $(".faq-accordion").click(function () {
        const content = $(this).find(".faq-accordion-content");
        content.slideToggle(300);

        $(this).toggleClass("active");
    });

    $('#create-faq').on('click', function (e) {
        $(".faq-form").slideDown(300);
    });

    $('#create-feature').on('click', function (e) {
        $(".feature-form").slideDown(300);
        setTimeout(function () {
            // Cek apakah elemen #feature-form ada
            var $featureForm = $('#feature-form');

            if ($featureForm.length) {
                $('html, body').animate({
                    scrollTop: $featureForm.offset().top
                }, 400);
            }
        }, 400);
    });

    $('#create-feature').on('click', function (e) {
        $(".feature-form").slideDown(300);
        setTimeout(function () {
            // Cek apakah elemen #feature-form ada
            var $featureForm = $('#feature-form');

            if ($featureForm.length) {
                $('html, body').animate({
                    scrollTop: $featureForm.offset().top
                }, 400);
            }
        }, 400);
    });

    $('#cancel-faq').on('click', function (e) {
        if (location.search.startsWith("?id")) {
            window.location.href = './manage-faq.php';
        }
        $(".faq-form").slideUp(300);
    });

    $('#cancel-feature').on('click', function (e) {
        if (location.search.startsWith("?id")) {
            window.location.href = './manage-feature.php';
        }
        $(".feature-form").slideUp(300);
    });
});


