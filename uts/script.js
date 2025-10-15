$(".faq-accordion").click(function () {
    const content = $(this).find(".faq-accordion-content");
    content.slideToggle(1);

    $(this).toggleClass("active");
});