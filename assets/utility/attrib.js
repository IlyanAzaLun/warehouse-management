(function ($) {

  // alert
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 12000
    });
    if ($('.toast').data('icon') !== '') {
      Toast.fire({
        icon: $('.toast').data('icon'),
        title: $('.toast').data('title'),
      })
    } 
    
    // active link
    $('.active.submenu').parents().closest('li.nav-item.has-treeview').addClass('menu-open').find('a:first').addClass('active');


})(jQuery)

function currency(Num) {
  return new Intl.NumberFormat('en-EN', { maximumSignificantDigits: 3 }).format(Num);
}
function currencyToNum(curent){
  return curent.replace(/[,]|[.]/g,'');
}