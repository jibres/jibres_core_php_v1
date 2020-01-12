
function slickRunner()
{
  if($('html').attr('lang') === 'fa')
  {
    $('[data-slick]').slick({rtl: true});
  }
  else
  {
    $('[data-slick]').slick();
  }
}
