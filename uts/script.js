$(".faq-accordion").click(function () {
    const content = $(this).find(".faq-accordion-content");
    content.slideToggle(300);

    $(this).toggleClass("active");
});