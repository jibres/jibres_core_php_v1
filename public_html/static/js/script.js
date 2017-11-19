

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
  var elFinalPriceBox = $('#finalprice').parent().parent();
  var buy             = parseInt($('#buyprice').val().toEnglish());
  var sell            = parseInt($('#price').val().toEnglish());
  var discount        = parseInt($('#discount').val().toEnglish());
  var finalPrice      = 0;

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

  // impureIntrestRate
  if(buy && sell)
  {
    impureIntrestRate = ((sell * 100 / buy) - 100).toFixed(2);
    pureIntrestRate   = (((sell - discount) * 100 / buy) - 100).toFixed(2);
  }
  $('#price').parent().find('.addon').text(fitNumber(impureIntrestRate) + '%');

  // Discount Rate
  if(discount && sell)
  {
    discountRate = (discount * 100 / sell).toFixed(2);
  }
  $('#discount').parent().find('.addon').text(fitNumber(discountRate) + '%');

  // final price
  finalPrice = sell - discount;
  $('#finalprice').val(finalPrice);
  elFinalPriceBox.find('.addon').text(fitNumber(pureIntrestRate) + '%');
  if(sell)
  {
    elFinalPriceBox.slideDown().removeClass('hide');
  }
  else
  {
    // elFinalPriceBox.slideUp();
  }
}


function runRunner()
{
  $('[data-run-input]').each(function()
  {

    $(this).on('input', function(_e)
    {
      callFunc($(this).attr('data-run-input'), $(this));
    });
  });

  $('[data-run-change]').each(function()
  {

    $(this).on('change', function(_e)
    {
      callFunc($(this).attr('data-run-change'), $(this));
    });
  });
}


function recalcProductListPrices(_this)
{
  var elRow      = _this.parents('tr');
  var elTable    = _this.parents('table');
  var elRowTotal = elRow.find('[data-total]');

  var valCount    = elRow.find('[data-count] input').val().toEnglish();
  var valPrice    = elRow.find('[data-price]').text().toEnglish();
  var valDiscount = elRow.find('[data-discount] input').val().toEnglish();
  var valTotal    = elRowTotal.text().toEnglish();


  var calcTotal = valCount * (valPrice - valDiscount);
  elRowTotal.text(fitNumber(calcTotal));

}




