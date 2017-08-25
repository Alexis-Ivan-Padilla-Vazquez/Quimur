$(function(){
    /*Jobs list*/
   $('#jobs-list tr').bind({
      mouseenter: function() {
          $(this).addClass('hover');
      },
      mouseleave: function() {
          $(this).removeClass('hover');
      },
      click: function () {
          var linkUrl = $('a',this).attr('href');
          window.location = linkUrl;
      }
   });
})
