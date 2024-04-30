jQuery(document).ready(function(){
   jQuery('.nav__list > li > .nav__sub > li').each(function (index, element) {
   var currentlimobile = jQuery(this).find('.nav__sub').length;
      if (jQuery(currentlimobile).length == 1) {
         jQuery("<div class='icon'><svg width='8' height='11'><use xlink:href='#chevron'></use></svg></div>").insertBefore(jQuery(this).find('.nav__sub'))
      }; 
   });   
   jQuery('.nav__list li .icon').on('click', function(){
      jQuery(this).toggleClass('active');
      jQuery(this).next('.nav__sub').toggle();
   })
})

