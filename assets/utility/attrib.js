let Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 12000
});
(function ($) {
  // alert
    if ($('.toast').data('icon') !== '') {
      Toast.fire({
        icon: $('.toast').data('icon'),
        title: $('.toast').data('title'),
      })
    } 
    // active link
    $('.active.submenu').parents().closest('li.nav-item.has-treeview').addClass('menu-open').find('a:first').addClass('active');

    $.extend({
      playSound: function () {
          return $(`<audio class="sound-player" autoplay="autoplay" style="display:none;">
                      <source src="${arguments[0]}"/>
                      <embed src="${arguments[0]}"hidden="true" autostart="true" loop="false"/>
                    </audio>`
                ).appendTo('body');
      },
      stopSound: function () {
          $(".sound-player").remove();
      }
    });
})(jQuery)

/*

*/ 

function currency(Num) {
  return new Intl.NumberFormat('en-EN', { maximumSignificantDigits: 9 }).format(Num);
}
function currencyToNum(curent){
  return curent.replace(/[,]|[.]/g,'');
}