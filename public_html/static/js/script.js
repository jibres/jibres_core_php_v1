

route('*', function()
{

}).once(function()
{
  runRunner();
  calcFooterValues();
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
  var elRowTotal = elRow.find(':eq(5)');

  var valCount    = elRow.find('.count').val().toEnglish();
  var valPrice    = elRow.find(':eq(3)').text().toEnglish();
  var valDiscount = elRow.find('.discount').val().toEnglish();
  var valTotal    = elRowTotal.text().toEnglish();


  var calcRowTotal = valCount * (valPrice - valDiscount);
  elRowTotal.text(fitNumber(calcRowTotal));

  calcFooterValues(elTable);
}


function calcFooterValues(_table)
{
  if(!_table)
  {
    _table = $('.productList');
    if(_table.length < 1)
    {
      return null;
    }
  }
  var calcDtCountRow    = 0;
  var calcDtSumCount    = 0;
  var calcDtSumPrice    = 0;
  var calcDtSumDiscount = 0;
  var calcDtSumTotal    = 0;
  // calc total of column
  _table.find('tbody tr').each(function()
  {
    // variables
    let tmpCount       = parseFloat($(this).find('.count').val().toEnglish());
    let tmpPrice       = parseInt($(this).find('td:eq(3)').text().toEnglish());
    let tmpDiscount    = parseInt($(this).find('.discount').val().toEnglish());
    // check NaN values
    if(isNaN(tmpCount))
    {
      tmpCount = 0;
    }
    if(isNaN(tmpPrice))
    {
      tmpPrice = 0;
    }
    if(isNaN(tmpDiscount))
    {
      tmpDiscount = 0;
    }

    let tmpPriceCol    = tmpCount * tmpPrice;
    let tmpDiscountCol = tmpCount * tmpDiscount;
    let tmpFinalCol    = tmpCount * (tmpPrice - tmpDiscount);
    console.log(tmpFinalCol);

    // count of row
    calcDtCountRow += 1;
    // sum of counts
    calcDtSumCount += tmpCount;
    calcDtSumPrice += tmpPriceCol;
    calcDtSumDiscount += tmpDiscountCol;
    calcDtSumTotal += tmpFinalCol;
    $(this).find('td:eq(5)').text(fitNumber(calcDtSumTotal));

  });
  _table.find('tfoot tr th:eq(0)').text(fitNumber(calcDtCountRow));
  _table.find('tfoot tr th:eq(2)').text(fitNumber(calcDtSumCount));
  _table.find('tfoot tr th:eq(3)').text(fitNumber(calcDtSumPrice));
  _table.find('tfoot tr th:eq(4)').text(fitNumber(calcDtSumDiscount));
  _table.find('tfoot tr th:eq(5)').text(fitNumber(calcDtSumTotal));

}





