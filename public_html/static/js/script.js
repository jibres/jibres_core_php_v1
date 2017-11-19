

route('*', function()
{

}).once(function()
{
  runRunner();
  calcFooterValues();
  bindBtnOnFactor();
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
  calcFooterValues();
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
    let tmpCount           = parseFloat($(this).find('.count').val().toEnglish());
    let tmpPrice           = parseInt($(this).find('td:eq(3)').attr('data-val'));
    let tmpDiscount        = parseInt($(this).find('.discount').val().toEnglish());
    let tmpDiscountPercent = 0;
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

    // count of row
    calcDtCountRow += 1;
    // sum of counts
    calcDtSumCount += tmpCount;
    calcDtSumPrice += tmpPriceCol;
    calcDtSumDiscount += tmpDiscountCol;
    calcDtSumTotal += tmpFinalCol;

    // set discount percent
    tmpDiscountPercent = (tmpDiscount * 100 / tmpPrice).toFixed(2);
    if($.isNumeric(tmpDiscountPercent) && tmpDiscountPercent>0 )
    {
      $(this).find('td:eq(4) .addon').text(fitNumber(tmpDiscountPercent) + '%');
    }
    else
    {
      $(this).find('td:eq(4) .addon').text('');
    }

    // set final price
    if(tmpFinalCol === 0 && !tmpPrice)
    {
      $(this).find('td:eq(5)').text('');
    }
    else
    {
      $(this).find('td:eq(5)').text(fitNumber(tmpFinalCol));
    }

    // some conditional formating
    if(tmpPrice < tmpDiscount)
    {
      $(this).find('.discount').addClass('negative');
      $(this).find('td:eq(4)').addClass('negative');
      $(this).find('td:eq(5)').addClass('negative');
    }
    else
    {
      $(this).find('.discount').removeClass('negative');
      $(this).find('td:eq(4)').removeClass('negative');
      $(this).find('td:eq(5)').removeClass('negative');
    }

  });
  // _table.find('tfoot tr th:eq(0)').text(fitNumber(calcDtCountRow));
  _table.find('tfoot tr th:eq(2)').text(fitNumber(calcDtSumCount));
  _table.find('tfoot tr th:eq(3)').text(fitNumber(calcDtSumPrice)).attr('data-val', calcDtSumPrice);
  _table.find('tfoot tr th:eq(4)').text(fitNumber(calcDtSumDiscount));
  _table.find('tfoot tr th:eq(5)').text(fitNumber(calcDtSumTotal)).attr('data-val', calcDtSumTotal);

}



function addNewRecord_ProductList(_table, _product)
{
  if(!_table)
  {
    _table = $('.productList');
    if(_table.length < 1)
    {
      return null;
    }
  }
  var newRecord = _table.find('tbody tr:eq(0)').clone();
  var cuRow       = _table.find('tr').length - 1;
  if(_product)
  {
    // fill with product details
    console.log(_product);
    newRecord.attr('data-barcode', _product.barcode);
    newRecord.find('td:eq(0)').text(fitNumber(cuRow));
    newRecord.find('td:eq(1) input').val(_product.title);
    newRecord.find('td:eq(2) input').val(1);
    newRecord.find('td:eq(3)').text(fitNumber(_product.price)).attr('data-val', _product.price);
    newRecord.find('td:eq(4) input').val(_product.discount);
    newRecord.find('td:eq(5)').text(fitNumber(_product.finalprice)).attr('data-val', _product.finalprice);
  }
  else
  {
    // empty all inputs
    newRecord.find("input").val('');
    newRecord.find('td:eq(0)').text(fitNumber(cuRow));
    newRecord.find('td:eq(3)').text('');
    newRecord.find('td:eq(5)').text('');
  }


  // appent to end of table
  newRecord.appendTo('.productList tbody:last');
  // recalc table values
  calcFooterValues(_table);
}


function updateRecord_ProductList(_row, _key, _value)
{
  switch (_key)
  {
    case 'count':
      let currentCounter = _row.find('.count');
      currentCounter.val(parseFloat(currentCounter.val())+1);
      break;
  }

  calcFooterValues();
}


function bindBtnOnFactor()
{
  $('#addNewRecordProduct').on('click', function(){
    addNewRecord_ProductList();
  });

  $('body').on('barcode:detect', function(_e, _barcode)
  {
    insertProductViaBarcode(_barcode);
  })

  $(document).on('input', '.count', function()
  {
    recalcProductListPrices();
  });
  $(document).on('input', '.discount', function()
  {
    recalcProductListPrices();
  });

}


function insertProductViaBarcode(_barcode)
{
  let pSearchURL = "/a/product?json=true&barcode=" + _barcode;
  $.get(pSearchURL, function(_productData)
  {
    _productData      = $.parseJSON(_productData);
    let productInList = $('[data-barcode='+ _barcode +']');
    if(productInList.length)
    {
      console.log('exist');
      updateRecord_ProductList(productInList, 'count');
    }
    else
    {
      console.log('new');
      addNewRecord_ProductList(null, _productData);
    }

    // console.log(_productData);
  });
}


