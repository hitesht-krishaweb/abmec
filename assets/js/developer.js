jQuery(document).ready(function () {
  jQuery(".nav__list > li > .nav__sub > li").each(function (index, element) {
    var currentlimobile = jQuery(this).find(".nav__sub").length;
    if (jQuery(currentlimobile).length == 1) {
      jQuery(
        "<div class='icon'><svg width='8' height='11'><use xlink:href='#chevron'></use></svg></div>"
      ).insertBefore(jQuery(this).find(".nav__sub"));
    }
  });
  jQuery(".nav__list li .icon").on("click", function () {
    jQuery(this).toggleClass("active");
    jQuery(this).next(".nav__sub").toggle();
  });

  jQuery(document).on("click", ".read-more-wrap .read-more-btn", function () {
    // jQuery(".read-more-wrap .read-more-btn").click(function () {
    jQuery(this).toggleClass("active");
    jQuery(this).siblings(".read-more-content").slideToggle();
  });

  jQuery(".year-month-continer .mobile-show").click(function () {
    jQuery(this).toggleClass("active");
    jQuery(".toggle-month-wrap").slideToggle(); // toggle collapse
  });

  jQuery(".year-month-continer .month-listing ul li a").click(function () {
    jQuery(".year-month-continer .mobile-show").removeClass("active");
    jQuery(".toggle-month-wrap").slideUp();
  });
});
