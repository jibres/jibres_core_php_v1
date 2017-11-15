

route('*', function()
{

}).once(function()
{
  runRunner();
});




function recalcPricePercents()
{
  if(!window.location.pathname === '/a/product/add')
  {
    return;
  }
  // declare variables
  var ElFinalprice = $('#finalprice');
  var buy          = parseInt($('#buyprice').val());
  var sell         = parseInt($('#price').val());
  var discount     = parseInt($('#discount').val());
  var finalPrice   = 0;

  var impureIntrestRate = 0;
  var pureIntrestRate   = 0;
  var discountRate      = 0;
  // check and set NAN value
  if(isNaN(buy))
  {
    buy = 0;
  }
  if(isNaN(sell))
  {
    sell = 0;
  }
  if(isNaN(discount))
  {
    discount = 0;
  }
  // console.log(buy);
  // console.log(sell);
  // console.log(discount);

  // impureIntrestRate
  if(buy && sell)
  {
    impureIntrestRate = ((sell * 100 / buy) - 100).toFixed(2);
  }
  $('#price').parent().find('.addon').text(fitNumber(impureIntrestRate) + '%');

  // Discount Rate
  if(discount && sell)
  {
    discountRate = discount * 100 / sell;
  }
  $('#discount').parent().find('.addon').text(fitNumber(discountRate) + '%');

  console.log($('#finalprice').parents('.hide'));
  // final price
  if(sell)
  {
    finalPrice = sell - discount;
    $('#finalprice').val(finalPrice);
    $('#finalprice').parents('.hide').fadeIn().removeClass('hide');
  }

}


function runRunner()
{
  $('[data-run-input]').each(function()
  {

    $(this).on('input', function(_e)
    {
      callFunc($(this).attr('data-run-input'));
    });
  });

  $('[data-run-change]').each(function()
  {

    $(this).on('change', function(_e)
    {
      callFunc($(this).attr('data-run-change'));
    });
  });
}






