

function pushState()
{
  // $(function()
  // {

  // });
  runRunner();
  calcFooterValues();
  recalcPricePercents();
  simplePrint();
  typeTitles();
}

$(function()
{
  // run once on ready
  bindBtnOnFactor();
  // bind shortkey on each page
  callFunc('bindShortkey')
});





function recalcPricePercents()
{
  if((window.location.pathname).indexOf('/a/product') < 0 || $('#price').length === 0)
  {
    return;
  }

  // declare variables
  var elFinalPriceBox = $('#finalprice').parent().parent();
  var buy             = parseInt($('#buyprice').val().toEnglish());
  var sale            = parseInt($('#price').val().toEnglish());
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
  if(isNaN(sale))
  {
    sale = 0;
  }
  if(isNaN(discount))
  {
    discount = 0;
  }

  // impureIntrestRate
  if(buy && sale)
  {
    impureIntrestRate = ((sale * 100 / buy) - 100).toFixed(2);
    pureIntrestRate   = (((sale - discount) * 100 / buy) - 100).toFixed(2);
  }
  $('#price').parent().find('.addon').text(fitNumber(impureIntrestRate) + '%');

  // Discount Rate
  if(discount && sale)
  {
    discountRate = (discount * 100 / sale).toFixed(2);
  }
  $('#discount').parent().find('.addon').text(fitNumber(discountRate) + '%');

  // final price
  finalPrice = sale - discount;
  $('#finalprice').val(finalPrice);
  elFinalPriceBox.find('.addon').text(fitNumber(pureIntrestRate) + '%');
  if(sale)
  {
    elFinalPriceBox.removeClass('hide').hide().slideDown();
  }
  else
  {
    // elFinalPriceBox.slideUp();
  }

  // conditional check
  var elPrice      = $('#price').parents('.input');
  var elDiscount   = $('#discount').parents('.input');
  var elFinalPrice = $('#finalprice').parents('.input');

  // all check for price
  // if price is not normal and under buy price, impure under zero
  if(impureIntrestRate < 0)
  {
    elPrice.addClass('warning');
  }
  else
  {
    elPrice.removeClass('warning');
  }
  // if discount is more than 100% of sale price
  if(discount === 0)
  {
    elDiscount.removeClass('error');
    elDiscount.removeClass('warning');
  }
  else if(discountRate > 100)
  {
    elDiscount.addClass('error');
    elDiscount.removeClass('warning');
  }
  else if(sale - discount < buy)
  {
    elDiscount.removeClass('error');
    elDiscount.addClass('warning');
  }
  else
  {
    elDiscount.removeClass('error');
    elDiscount.removeClass('warning');
  }

  // all check for final price
  if(finalPrice === 0)
  {
    elFinalPrice.removeClass('error');
    elFinalPrice.removeClass('warning');
    elFinalPrice.removeClass('ok');
  }
  else if(finalPrice < 0)
  {
    elFinalPrice.addClass('error');
    elFinalPrice.removeClass('warning');
    elFinalPrice.removeClass('ok');
  }
  else if(finalPrice < buy)
  {
    elFinalPrice.removeClass('error');
    elFinalPrice.addClass('warning');
    elFinalPrice.removeClass('ok');
  }
  else
  {
    elFinalPrice.removeClass('error');
    elFinalPrice.removeClass('warning');
    elFinalPrice.addClass('ok');
  }
}


function runRunner()
{
  $('[data-run-input]').each(function()
  {
    $(this).off('input');
    $(this).on('input', function(_e)
    {
      callFunc($(this).attr('data-run-input'), $(this));
    });
  });

  $('[data-run-change]').each(function()
  {

    $(this).off('change');
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
      // return null;
    }
  }
  var calcDtCountRow        = 0;
  var calcDtSumCount        = 0;
  var calcDtSumPrice        = 0;
  var calcDtSumDiscount     = 0;
  var calcDtDiscountPercent = 0;
  var calcDtSumTotal        = 0;
  // calc total of column
  _table.find('tbody tr').each(function()
  {
    // variables
    var tmpCount           = parseFloat($(this).find('.count').val().toEnglish());
    var tmpPrice           = parseInt($(this).find('td:eq(3)').attr('data-val'));
    var tmpDiscount        = parseInt($(this).find('.discount').val().toEnglish());
    var tmpDiscountPercent = 0;
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
    if(tmpPrice < tmpDiscount)
    {
      $(this).find('.discount').val(0);
      tmpDiscount = 0;
    }

    var tmpPriceCol    = tmpCount * tmpPrice;
    var tmpDiscountCol = tmpCount * tmpDiscount;
    var tmpFinalCol    = tmpCount * (tmpPrice - tmpDiscount);

    // count of row
    calcDtCountRow    += 1;
    // sum of counts
    calcDtSumCount    += tmpCount;
    calcDtSumPrice    += tmpPriceCol;
    calcDtSumDiscount += tmpDiscountCol;
    calcDtSumTotal    += tmpFinalCol;

    // set discount percent
    tmpDiscountPercent = (tmpDiscount * 100 / tmpPrice).toFixed(2);
    if($.isNumeric(tmpDiscountPercent) && tmpDiscountPercent>0 )
    {
      $(this).find('td:eq(4) .addon').text(fitNumber(tmpDiscountPercent) + '%');
      $(this).find('td:eq(4) input').attr('title', fitNumber(tmpDiscountPercent) + ' %');
    }
    else
    {
      $(this).find('td:eq(4) input').attr('title', '00');
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

  // remove decimal value from total price
  // in future get option from store setting to round this value
  calcDtSumPrice    = Math.round(calcDtSumPrice);
  calcDtSumDiscount = Math.round(calcDtSumDiscount);
  calcDtSumTotal    = Math.round(calcDtSumTotal);

  // calc discount percent
  if(calcDtSumDiscount > 0)
  {
    calcDtDiscountPercent = (calcDtSumDiscount / calcDtSumPrice * 100).toFixed(2);
  }


  // show or hide priceBox
  if(calcDtCountRow > 0)
  {
    showWithFade($('.priceBox'));
  }
  else
  {
    setTimeout(function()
    {
      $('.priceBox').slideUp();
    }, 700);
  }

  $('.priceBox .final span').text(fitNumber(calcDtSumTotal)).attr('data-val', calcDtSumTotal);
  $(".priceBox .final").shrink(60);
  $('.priceBox .desc').text(wordifyTomans(calcDtSumTotal));
  $('.priceBox .item span').text(fitNumber(calcDtCountRow)).attr('data-val', calcDtCountRow);
  $('.priceBox .count span').text(fitNumber(calcDtSumCount)).attr('data-val', calcDtSumCount);
  $('.priceBox .sum span').text(fitNumber(calcDtSumPrice)).attr('data-val', calcDtSumPrice);
  $('.priceBox .discountPercent span').text(fitNumber(calcDtDiscountPercent)+ "%").attr('data-val', calcDtDiscountPercent);
  $('.priceBox .discount span').text(fitNumber(calcDtSumDiscount)).attr('data-val', calcDtSumDiscount);

  if(calcDtCountRow === calcDtSumCount || calcDtSumCount === 0)
  {
    $('.priceBox .count').slideUp();
  }
  else
  {
    $('.priceBox .count').slideDown();
  }
  if(calcDtSumDiscount === 0)
  {
    if($('.priceBox .discount').attr('data-wodiscount') === undefined)
    {
      $('.priceBox .discountPercent').slideUp('fast');
      $('.priceBox .discount').slideUp('fast');
    }
    else
    {
      $('.priceBox .discountPercent').slideDown();
      $('.priceBox .discount').slideDown();
    }
  }
  else
  {
    $('.priceBox .discountPercent').slideDown();
    $('.priceBox .discount').slideDown();
  }
  // show fadein box
  if(calcDtCountRow > 0)
  {
    showWithFade($('.NextBox'));
  }
  else
  {
   $('.NextBox').fadeOut('fast');
  }

    // $('.priceBox .final span').text('-');
}







function bindBtnOnFactor()
{
  $('body').on('barcode:detect', function(_e, _barcode)
  {
    if($('#productSearch').length < 1)
    {
      return null;
    }
    $('#productSearch').val('');
    productBarcodeFinded(_barcode)
    // set focus to productSearch field
    $('#productSearch').parent().find('input.search').val('').trigger("focus");
  })
  $(document).on('focus', '#factorAdd table input', function()
  {
    var myTr = $(this).parents('tr');
    if(myTr.attr('data-selected') === undefined)
    {
      navigationFactorAddSetSelected(myTr);
    }
  });

  $(document).on('blur', '#factorAdd table input', function()
  {
    $(this).parents('tr').attr('data-selected', null);
  });

  $(document).on('input', '.count', function()
  {
    recalcProductListPrices();
  });

  $(document).on('click', '.priceBox .discount', function()
  {
    shortkey_toggleDiscount();
  });

  $(document).on('input', '.discount', function()
  {
    recalcProductListPrices();
  });

  // add event to handle dropdown selected value
  $('body').on('dropdown:selected:datalist', function(_e, _selectedProduct)
  {
    // console.log(_selectedProduct);
    if(_selectedProduct)
    {
      addFindedProduct(_selectedProduct);
    }
    else
    {
      logy('datalist is not exist');
    }

  });
}



function checkProductExist(_key, _value)
{
  // try to find this product with barcode
  switch(_key)
  {
    case 'barcode':
      var productInList = $('table tbody [data-barcode='+ _value +']');
      // if not finded in barcode, search in barcode2
      if(!productInList.length)
      {
        productInList = $('table tbody [data-barcode2='+ _value +']');
      }
      // if finded try to increase number of this product
      if(productInList.length)
      {
        return productInList;
      }
      break;

    case 'id':
      var productInList = $('table tbody [data-id='+ _value +']');
      // if finded try to increase number of this product
      if(productInList.length)
      {
        return productInList;
      }
      break;
  }
  // not finded
  return false;
}


/**
 * check conditions after finding barcode
 * @param  {[type]} _barcode [description]
 * @return {[type]}          [description]
 */
function productBarcodeFinded(_barcode)
{
  var existRecord = checkProductExist('barcode', _barcode);
  if(existRecord)
  {
    updateRecord_ProductList(existRecord, 'count');
  }
  else
  {
    searchForProduct('barcode', _barcode);
  }
}


/**
 * try to search on server
 * @param  {[type]} _key   [description]
 * @param  {[type]} _value [description]
 * @return {[type]}        [description]
 */
function searchForProduct(_key, _value)
{
  // if is not barcode and not finde02902749
  // d, search and if find, add or update
  var pSearchURL = "/a/factor/add?json=true&list=product&" + _key + "=" + _value;
  $.get(pSearchURL, function(_productData)
  {
    var myMsg;
    pData = clearJson(_productData);
    if(_productData && _productData.result && _productData.result.message)
    {
      myMsg = _productData.result.message;
    }

    // if have error show error message
    if(myMsg)
    {
      addFindedProduct(null, myMsg, _value);
    }
    else
    {
      addFindedProduct(pData);
    }
  });
}



/**
 * final function to add record of product
 * @param {[type]} _product [description]
 */
function addFindedProduct(_product, _msg, _searchedValue)
{
  if(_product)
  {
    if(_product.id)
    {
      var existRecord = checkProductExist('id', _product.id);
      if(existRecord)
      {
        updateRecord_ProductList(existRecord, 'count');
      }
      else
      {
        addNewRecord_ProductList(null, _product);
      }
    }
    else
    {
      var msg = 'error in products.';
      notif('error', msg);
    }
  }
  else
  {
    if(_msg)
    {
      notif('warn', _msg, null, null, {position:'center', displayMode: 1});
    }
    else
    {
      notif('warn', 'product is not detected', null, null, {position:'center', displayMode: 2});
    }

    beep('ProductNotExist');
    // show custom message if product not fount
    // if(productNotExistList)
    // productNotExistList.[_searchedValue] = 1;
    // console.log(_searchedValue);
    // console.log(productNotExistList);
  }
}

var productNotExistList;


//All arguments are optional:

//duration of the tone in milliseconds. Default is 500
//frequency of the tone in hertz. default is 440
//volume of the tone. Default is 1, off is 0.
//type of tone. Possible values are sine, square, sawtooth, triangle, and custom. Default is sine.
//callback to use on end of tone
function beep(_msg, duration, frequency, volume, type, callback)
{
  //if you have another AudioContext class use that one, as some browsers have a limit
  try
  {
    var audioCtx = new (window.AudioContext || window.webkitAudioContext || window.audioContext);
  }
  catch(err)
  {
    logy(err.message);
  }
  if(audioCtx)
  {
    var oscillator = audioCtx.createOscillator();
    var gainNode   = audioCtx.createGain();

    oscillator.connect(gainNode);
    gainNode.connect(audioCtx.destination);

    if (volume){gainNode.gain.value           = volume;};
    if (frequency){oscillator.frequency.value = frequency;}
    if (type){oscillator.type                 = type;}
    if (callback){oscillator.onended          = callback;}

    oscillator.start();
    setTimeout(function(){oscillator.stop()}, (duration ? duration : 500));
  }
  else
  {
    logy('close some tabs!');
  }

  _msg =  '/static/sounds/'+ _msg +'.mp4';

  var audio = new Audio(_msg);
  audio.play();
  // try to create sys beep
  sysBeep();
};

function sysBeep()
{
  logy('\u0007');
}



/**
 * update record and increase number of exist record
 * @param  {[type]} _row   [description]
 * @param  {[type]} _key   [description]
 * @param  {[type]} _value [description]
 * @return {[type]}        [description]
 */
function updateRecord_ProductList(_row, _key, _value)
{
  switch (_key)
  {
    case 'count':
      var currentCounter = _row.find('.count');
      currentCounter.val(parseFloat(currentCounter.val())+1);
      break;
  }

  $('#productSearch').val('');
  calcFooterValues();
}


/**
 * add record to table of products
 * @param {[type]} _table   [description]
 * @param {[type]} _product [description]
 * @param {[type]} _append  [description]
 */
function addNewRecord_ProductList(_table, _product, _append)
{
  if(!_table)
  {
    _table = $('.productList');
    if(_table.length < 1)
    {
      return null;
    }
  }
  showWithFade(_table.parents('.cbox'));


  var trEmpty   = '<tr>';
  trEmpty       += '<td></td>';
  trEmpty       += '<td></td>';
  trEmpty       += '<td></td>';
  trEmpty       += '<td></td>';
  trEmpty       += '<td></td>';
  trEmpty       += '<td></td>';
  trEmpty       += '</tr>';
  var newRecord = $(trEmpty);
  var cuRow     = _table.find('tr').length;
  // set row number
  newRecord.find('td:eq(0)').text(fitNumber(cuRow));
  if(_product)
  {
    var htmlPName     = _product.title + '<input type="hidden" name="products[]" class="hidden" value="' + _product.id + '">';
    var htmlPCount    = '<input class="input count" type="tel" name="count[]" autocomplete="off" min=0 max=10000000000 step="any" value=1>';
    var htmlPDiscount = '<div class="input discountCn">';
    htmlPDiscount    += '<input class="discount" type="tel" name="discount[]" autocomplete="off" title="%" min=0 max=10000000000';
    if(_product.discount)
    {
      var removeDiscount = !(_table.attr('data-woDiscount') !== undefined);
      if(removeDiscount)
      {
        htmlPDiscount += ' value="' + _product.discount + '"';
      }
      // set data-discount on all condition
      htmlPDiscount += ' data-discount="' + _product.discount + '"';
    }
    htmlPDiscount    += '>';
    htmlPDiscount    += '<span class="addon small">0%</span>'+ '</div>';

    // fill with product details
    // logy(_product);
    newRecord.attr('data-id', _product.id);
    newRecord.attr('data-barcode', _product.barcode);
    newRecord.attr('data-barcode2', _product.barcode2);
    newRecord.find('td:eq(1)').html(htmlPName);
    newRecord.find('td:eq(2)').html(htmlPCount);
    newRecord.find('td:eq(3)').text(fitNumber(_product.price)).attr('data-val', _product.price);
    newRecord.find('td:eq(4)').html(htmlPDiscount);
    newRecord.find('td:eq(5)').text(fitNumber(_product.finalprice)).attr('data-val', _product.finalprice);
  }
  else
  {
    // empty all inputs
    newRecord.find("input").val('');
    newRecord.find('td:eq(3)').text('');
    newRecord.find('td:eq(5)').text('');
  }

  if(_append)
  {
    // appent to end of table
    newRecord.appendTo('.productList tbody');
  }
  else
  {
    // prepent to start of table
    newRecord.prependTo('.productList tbody');
  }
  // run tippy again for discount
  runTippy();

  calcFooterValues(_table);
}


function qtyFactorTableItems()
{
  NoRecordExist = $('#factorAdd table tbody tr').length;
  return NoRecordExist;
}


function showWithFade(_el)
{
  if(_el.hasClass('hide'))
  {
    _el.removeClass('hide').hide();
  }
  _el.fadeIn();
}


function navigateonFactorAddInputs(_type)
{
  if(!check_factor())
  {
    return false;
  }
  // check focus
  var $focus = $(":focus");

  if(($focus.parents('.productList ').length !== 1))
  {
    // outside of table
    return false;
  }

  var currentTd  = $focus.parents('td');
  var currentTr  = $focus.parents('tr');

  // var currentRow = $('#factorAdd .productList tbody').index(currentTr);
  var currentRow = currentTr.index();
  var maxRow     = $('#factorAdd .productList tbody tr').length -1;
  var nextRow    = currentRow;
  var nextField  = 'count';
  // check input group
  if($focus.is('.count'))
  {
    nextField = 'count';
  }
  else if($focus.is('.discount'))
  {
    nextField = 'discount';
  }

  switch(_type)
  {
    case 'up':
      nextRow -= 1;
      break;

    case 'down':
      nextRow += 1;
      break;

    case 'left':
    case 'right':

      if(nextField == 'count')
      {
        nextField = 'discount';
      }
      else if(nextField == 'discount')
      {
        nextField = 'count';
      }
      break;
  }

  if(nextRow < 0)
  {
    // end
    nextRow = maxRow;
  }
  else if(nextRow > maxRow)
  {
    nextRow = 0;
  }

  var nextRowEl      = $('#factorAdd .productList tbody tr:eq('+ nextRow +')');
  var nextRowInputEl = nextRowEl.find('input.'+ nextField);
  navigationFactorAddSetSelected(nextRowEl);

  setTimeout(function()
  {
    nextRowInputEl.select();
  }, 10);
}


function navigationFactorAddSetSelected(_tr, _focus)
{
  if(!_tr || _tr.length === 0)
  {
    _tr = $('#factorAdd .productList tbody tr:eq(0)');
  }

  // remove other selecred
  $('#factorAdd .productList tbody tr').attr('data-selected', null);
  // add selected to specefic one
  _tr.attr('data-selected', '');
  if(_focus === true)
  {
    _tr.find('.input.count').select();
  }
}


function shortkey_toggleDiscount(_status)
{
  var priceDiscountEl = $('.priceBox .discount');
  var removeDiscount = !(priceDiscountEl.attr('data-woDiscount') !== undefined);
  if(removeDiscount)
  {
    priceDiscountEl.attr('data-woDiscount', '');
    $('.productList thead th:eq(4)').addClass('negative').attr('data-woDiscount', '');
  }
  else
  {
    priceDiscountEl.attr('data-woDiscount', null);
    $('.productList thead th:eq(4)').removeClass('negative').attr('data-woDiscount', null);
  }

  $('.productList input.discount').each(function()
  {
    if(removeDiscount)
    {
      var currentVal = parseInt($(this).val());
      if(!$.isNumeric(currentVal))
      {
        currentVal = null;
      }
      $(this).attr('data-discount', currentVal);
      $(this).val('');
    }
    else
    {
      var savedDiscount = $(this).attr('data-discount');
      if($.isNumeric(savedDiscount))
      {
        $(this).val(savedDiscount);
      }
    }
  });
  // recalc values
  calcFooterValues();
  recalcPricePercents();
}



function shortkey_print(_el)
{
  if($("#sale_clicked_btn").length)
  {
    $("#sale_clicked_btn").attr('value', 'save_print');
    $("#sale_clicked_btn").parents('form').submit();
  }
  logy('printing...');
}


function simplePrint()
{
    printTimeout = setTimeout(function()
    {
      if (window.location.href.indexOf("print=auto") > -1)
      {
        window.print();
        logy('open print...');
      }

    }, 50);
}


// Persian Wordifier
// Version: 1.0
// Author: Salman Arab Ameri
// Publish: 2014-03-11
// with use of ideas in http://www.dotnettips.info/post/626/%D8%AA%D8%A8%D8%AF%DB%8C%D9%84-%D8%B9%D8%AF%D8%AF-%D8%A8%D9%87-%D8%AD%D8%B1%D9%88%D9%81

var wordifyfa = function (num, level)
{
  'use strict';
  if (num === null)
  {
    return "";
  }
  num = Math.round(num);
  // convert negative number to positive and get wordify value
  if (num<0) {
    num = num * -1;
    return "منفی " + wordifyfa(num, level);
  }
    if (num === 0) {
        if (level === 0) {
            return "صفر";
    } else {
            return "";
    }
  }
  var result = "",
    yekan = [" یک ", " دو ", " سه ", " چهار ", " پنج ", " شش ", " هفت ", " هشت ", " نه "],
    dahgan = [" بیست ", " سی ", " چهل ", " پنجاه ", " شصت ", " هفتاد ", " هشتاد ", " نود "],
    sadgan = [" یکصد ", " دویست ", " سیصد ", " چهارصد ", " پانصد ", " ششصد ", " هفتصد ", " هشتصد ", " نهصد "],
    dah = [" ده ", " یازده ", " دوازده ", " سیزده ", " چهارده ", " پانزده ", " شانزده ", " هفده ", " هیجده ", " نوزده "];
    if (level > 0) {
        result += " و ";
        level -= 1;
    }
    if (num < 10)
    {
        var myNum = yekan[Math.floor(num - 1)];
        if(myNum)
        {
          result += yekan[Math.floor(num - 1)];
        }
        // result += yekan[num - 1];
    } else if (num < 20) {
        result += dah[num - 10];
    } else if (num < 100) {
        result += dahgan[parseInt(num / 10, 10) - 2] +  wordifyfa(num % 10, level + 1);
    } else if (num < 1000) {
        result += sadgan[parseInt(num / 100, 10) - 1] + wordifyfa(num % 100, level + 1);
    } else if (num < 1000000) {
        result += wordifyfa(parseInt(num / 1000, 10), level) + " هزار " + wordifyfa(num % 1000, level + 1);
    } else if (num < 1000000000) {
        result += wordifyfa(parseInt(num / 1000000, 10), level) + " میلیون " + wordifyfa(num % 1000000, level + 1);
    } else if (num < 1000000000000) {
        result += wordifyfa(parseInt(num / 1000000000, 10), level) + " میلیارد " + wordifyfa(num % 1000000000, level + 1);
    } else if (num < 1000000000000000) {
        result += wordifyfa(parseInt(num / 1000000000000, 10), level) + " تریلیارد " + wordifyfa(num % 1000000000000, level + 1);
    }
  return result;

};

var wordifyRials = function (num)
{
  'use strict';
    return wordifyfa(num, 0) + " ریال";
};

var wordifyTomans = function (num)
{
  'use strict';
    return wordifyfa(num, 0) + " تومان";
};

var wordifyRialsInTomans = function (num)
{
  'use strict';
    if (num >= 10) {
        num = parseInt(num / 10, 10);
    } else if (num<=-10) {
        num = parseInt(num/10,10);
    } else {
    num=0;
  }

    return wordifyfa(num, 0) + " تومان";
};

if (typeof module !== 'undefined' && module.exports) {
  module.exports.wordifyfa = wordifyfa;
  module.exports.wordifyRials = wordifyRials;
  module.exports.wordifyRialsInTomans = wordifyRialsInTomans;
}


(function($) {
    $.fn.shrink = function(maxFontSize)
    {
        maxFontSize = parseInt(maxFontSize, 10);
        return this.each(function()
        {
            var ourText = $("span", this),
                parent = ourText.parent(),
                maxHeight = parent.height(),
                maxWidth = parent.width()-20,
                fontSize = parseInt(ourText.css("fontSize"), 10),
                // multiplier = maxWidth/(ourText.width()-15),
                multiplier = maxWidth/ourText.width(),
                newSize = (fontSize*(multiplier-0.1));
            ourText.css(
                "fontSize",
                (maxFontSize > 0 && newSize > maxFontSize) ?
                    maxFontSize :
                    newSize
            );
        });
    };
})(jQuery);



/*!
 *
 *   typed.js - A JavaScript Typing Animation Library
 *   Author: Matt Boldt <me@mattboldt.com>
 *   Version: v2.0.6
 *   Url: https://github.com/mattboldt/typed.js
 *   License(s): MIT
 *
 */
(function(t,e){"object"==typeof exports&&"object"==typeof module?module.exports=e():"function"==typeof define&&define.amd?define([],e):"object"==typeof exports?exports.Typed=e():t.Typed=e()})(this,function(){return function(t){function e(n){if(s[n])return s[n].exports;var i=s[n]={exports:{},id:n,loaded:!1};return t[n].call(i.exports,i,i.exports,e),i.loaded=!0,i.exports}var s={};return e.m=t,e.c=s,e.p="",e(0)}([function(t,e,s){"use strict";function n(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(e,"__esModule",{value:!0});var i=function(){function t(t,e){for(var s=0;s<e.length;s++){var n=e[s];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(t,n.key,n)}}return function(e,s,n){return s&&t(e.prototype,s),n&&t(e,n),e}}(),r=s(1),o=s(3),a=function(){function t(e,s){n(this,t),r.initializer.load(this,s,e),this.begin()}return i(t,[{key:"toggle",value:function(){this.pause.status?this.start():this.stop()}},{key:"stop",value:function(){this.typingComplete||this.pause.status||(this.toggleBlinking(!0),this.pause.status=!0,this.options.onStop(this.arrayPos,this))}},{key:"start",value:function(){this.typingComplete||this.pause.status&&(this.pause.status=!1,this.pause.typewrite?this.typewrite(this.pause.curString,this.pause.curStrPos):this.backspace(this.pause.curString,this.pause.curStrPos),this.options.onStart(this.arrayPos,this))}},{key:"destroy",value:function(){this.reset(!1),this.options.onDestroy(this)}},{key:"reset",value:function(){var t=arguments.length<=0||void 0===arguments[0]||arguments[0];clearInterval(this.timeout),this.replaceText(""),this.cursor&&this.cursor.parentNode&&(this.cursor.parentNode.removeChild(this.cursor),this.cursor=null),this.strPos=0,this.arrayPos=0,this.curLoop=0,t&&(this.insertCursor(),this.options.onReset(this),this.begin())}},{key:"begin",value:function(){var t=this;this.typingComplete=!1,this.shuffleStringsIfNeeded(this),this.insertCursor(),this.bindInputFocusEvents&&this.bindFocusEvents(),this.timeout=setTimeout(function(){t.currentElContent&&0!==t.currentElContent.length?t.backspace(t.currentElContent,t.currentElContent.length):t.typewrite(t.strings[t.sequence[t.arrayPos]],t.strPos)},this.startDelay)}},{key:"typewrite",value:function(t,e){var s=this;this.fadeOut&&this.el.classList.contains(this.fadeOutClass)&&(this.el.classList.remove(this.fadeOutClass),this.cursor&&this.cursor.classList.remove(this.fadeOutClass));var n=this.humanizer(this.typeSpeed),i=1;return this.pause.status===!0?void this.setPauseStatus(t,e,!0):void(this.timeout=setTimeout(function(){e=o.htmlParser.typeHtmlChars(t,e,s);var n=0,r=t.substr(e);if("^"===r.charAt(0)&&/^\^\d+/.test(r)){var a=1;r=/\d+/.exec(r)[0],a+=r.length,n=parseInt(r),s.temporaryPause=!0,s.options.onTypingPaused(s.arrayPos,s),t=t.substring(0,e)+t.substring(e+a),s.toggleBlinking(!0)}if("`"===r.charAt(0)){for(;"`"!==t.substr(e+i).charAt(0)&&(i++,!(e+i>t.length)););var u=t.substring(0,e),l=t.substring(u.length+1,e+i),c=t.substring(e+i+1);t=u+l+c,i--}s.timeout=setTimeout(function(){s.toggleBlinking(!1),e===t.length?s.doneTyping(t,e):s.keepTyping(t,e,i),s.temporaryPause&&(s.temporaryPause=!1,s.options.onTypingResumed(s.arrayPos,s))},n)},n))}},{key:"keepTyping",value:function(t,e,s){0===e&&(this.toggleBlinking(!1),this.options.preStringTyped(this.arrayPos,this)),e+=s;var n=t.substr(0,e);this.replaceText(n),this.typewrite(t,e)}},{key:"doneTyping",value:function(t,e){var s=this;this.options.onStringTyped(this.arrayPos,this),this.toggleBlinking(!0),this.arrayPos===this.strings.length-1&&(this.complete(),this.loop===!1||this.curLoop===this.loopCount)||(this.timeout=setTimeout(function(){s.backspace(t,e)},this.backDelay))}},{key:"backspace",value:function(t,e){var s=this;if(this.pause.status===!0)return void this.setPauseStatus(t,e,!0);if(this.fadeOut)return this.initFadeOut();this.toggleBlinking(!1);var n=this.humanizer(this.backSpeed);this.timeout=setTimeout(function(){e=o.htmlParser.backSpaceHtmlChars(t,e,s);var n=t.substr(0,e);if(s.replaceText(n),s.smartBackspace){var i=s.strings[s.arrayPos+1];i&&n===i.substr(0,e)?s.stopNum=e:s.stopNum=0}e>s.stopNum?(e--,s.backspace(t,e)):e<=s.stopNum&&(s.arrayPos++,s.arrayPos===s.strings.length?(s.arrayPos=0,s.options.onLastStringBackspaced(),s.shuffleStringsIfNeeded(),s.begin()):s.typewrite(s.strings[s.sequence[s.arrayPos]],e))},n)}},{key:"complete",value:function(){this.options.onComplete(this),this.loop?this.curLoop++:this.typingComplete=!0}},{key:"setPauseStatus",value:function(t,e,s){this.pause.typewrite=s,this.pause.curString=t,this.pause.curStrPos=e}},{key:"toggleBlinking",value:function(t){if(this.cursor&&!this.pause.status&&this.cursorBlinking!==t){this.cursorBlinking=t;
var e=t?"infinite":0;this.cursor.style.animationIterationCount=e}}},{key:"humanizer",value:function(t){return Math.round(Math.random()*t/2)+t}},{key:"shuffleStringsIfNeeded",value:function(){this.shuffle&&(this.sequence=this.sequence.sort(function(){return Math.random()-.5}))}},{key:"initFadeOut",value:function(){var t=this;return this.el.className+=" "+this.fadeOutClass,this.cursor&&(this.cursor.className+=" "+this.fadeOutClass),setTimeout(function(){t.arrayPos++,t.replaceText(""),t.strings.length>t.arrayPos?t.typewrite(t.strings[t.sequence[t.arrayPos]],0):(t.typewrite(t.strings[0],0),t.arrayPos=0)},this.fadeOutDelay)}},{key:"replaceText",value:function(t){this.attr?this.el.setAttribute(this.attr,t):this.isInput?this.el.value=t:"html"===this.contentType?this.el.innerHTML=t:this.el.textContent=t}},{key:"bindFocusEvents",value:function(){var t=this;this.isInput&&(this.el.addEventListener("focus",function(e){t.stop()}),this.el.addEventListener("blur",function(e){t.el.value&&0!==t.el.value.length||t.start()}))}},{key:"insertCursor",value:function(){this.showCursor&&(this.cursor||(this.cursor=document.createElement("span"),this.cursor.className="typed-cursor",this.cursor.innerHTML=this.cursorChar,this.el.parentNode&&this.el.parentNode.insertBefore(this.cursor,this.el.nextSibling)))}}]),t}();e["default"]=a,t.exports=e["default"]},function(t,e,s){"use strict";function n(t){return t&&t.__esModule?t:{"default":t}}function i(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(e,"__esModule",{value:!0});var r=Object.assign||function(t){for(var e=1;e<arguments.length;e++){var s=arguments[e];for(var n in s)Object.prototype.hasOwnProperty.call(s,n)&&(t[n]=s[n])}return t},o=function(){function t(t,e){for(var s=0;s<e.length;s++){var n=e[s];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(t,n.key,n)}}return function(e,s,n){return s&&t(e.prototype,s),n&&t(e,n),e}}(),a=s(2),u=n(a),l=function(){function t(){i(this,t)}return o(t,[{key:"load",value:function(t,e,s){if("string"==typeof s?t.el=document.querySelector(s):t.el=s,t.options=r({},u["default"],e),t.isInput="input"===t.el.tagName.toLowerCase(),t.attr=t.options.attr,t.bindInputFocusEvents=t.options.bindInputFocusEvents,t.showCursor=!t.isInput&&t.options.showCursor,t.cursorChar=t.options.cursorChar,t.cursorBlinking=!0,t.elContent=t.attr?t.el.getAttribute(t.attr):t.el.textContent,t.contentType=t.options.contentType,t.typeSpeed=t.options.typeSpeed,t.startDelay=t.options.startDelay,t.backSpeed=t.options.backSpeed,t.smartBackspace=t.options.smartBackspace,t.backDelay=t.options.backDelay,t.fadeOut=t.options.fadeOut,t.fadeOutClass=t.options.fadeOutClass,t.fadeOutDelay=t.options.fadeOutDelay,t.isPaused=!1,t.strings=t.options.strings.map(function(t){return t.trim()}),"string"==typeof t.options.stringsElement?t.stringsElement=document.querySelector(t.options.stringsElement):t.stringsElement=t.options.stringsElement,t.stringsElement){t.strings=[],t.stringsElement.style.display="none";var n=Array.prototype.slice.apply(t.stringsElement.children),i=n.length;if(i)for(var o=0;o<i;o+=1){var a=n[o];t.strings.push(a.innerHTML.trim())}}t.strPos=0,t.arrayPos=0,t.stopNum=0,t.loop=t.options.loop,t.loopCount=t.options.loopCount,t.curLoop=0,t.shuffle=t.options.shuffle,t.sequence=[],t.pause={status:!1,typewrite:!0,curString:"",curStrPos:0},t.typingComplete=!1;for(var o in t.strings)t.sequence[o]=o;t.currentElContent=this.getCurrentElContent(t),t.autoInsertCss=t.options.autoInsertCss,this.appendAnimationCss(t)}},{key:"getCurrentElContent",value:function(t){var e="";return e=t.attr?t.el.getAttribute(t.attr):t.isInput?t.el.value:"html"===t.contentType?t.el.innerHTML:t.el.textContent}},{key:"appendAnimationCss",value:function(t){if(t.autoInsertCss&&t.showCursor&&t.fadeOut){var e=document.createElement("style");e.type="text/css";var s="";t.showCursor&&(s+="\n        .typed-cursor{\n          opacity: 1;\n          animation: typedjsBlink 0.7s infinite;\n          -webkit-animation: typedjsBlink 0.7s infinite;\n                  animation: typedjsBlink 0.7s infinite;\n        }\n        @keyframes typedjsBlink{\n          50% { opacity: 0.0; }\n        }\n        @-webkit-keyframes typedjsBlink{\n          0% { opacity: 1; }\n          50% { opacity: 0.0; }\n          100% { opacity: 1; }\n        }\n      "),t.fadeOut&&(s+="\n        .typed-fade-out{\n          opacity: 0;\n          transition: opacity .25s;\n          -webkit-animation: 0;\n                  animation: 0;\n        }\n      "),0!==e.length&&(e.innerHTML=s,document.body.appendChild(e))}}}]),t}();e["default"]=l;var c=new l;e.initializer=c},function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var s={strings:["These are the default values...","You know what you should do?","Use your own!","Have a great day!"],stringsElement:null,typeSpeed:0,startDelay:0,backSpeed:0,smartBackspace:!0,shuffle:!1,backDelay:700,fadeOut:!1,fadeOutClass:"typed-fade-out",fadeOutDelay:500,loop:!1,loopCount:1/0,showCursor:!0,cursorChar:"|",autoInsertCss:!0,attr:null,bindInputFocusEvents:!1,contentType:"html",onComplete:function(t){},preStringTyped:function(t,e){},onStringTyped:function(t,e){},onLastStringBackspaced:function(t){},onTypingPaused:function(t,e){},onTypingResumed:function(t,e){},onReset:function(t){},onStop:function(t,e){},onStart:function(t,e){},onDestroy:function(t){}};e["default"]=s,t.exports=e["default"]},function(t,e){"use strict";function s(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(e,"__esModule",{value:!0});var n=function(){function t(t,e){for(var s=0;s<e.length;s++){var n=e[s];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(t,n.key,n)}}return function(e,s,n){return s&&t(e.prototype,s),n&&t(e,n),e}}(),i=function(){function t(){s(this,t)}return n(t,[{key:"typeHtmlChars",value:function(t,e,s){if("html"!==s.contentType)return e;var n=t.substr(e).charAt(0);if("<"===n||"&"===n){var i="";for(i="<"===n?">":";";t.substr(e+1).charAt(0)!==i&&(e++,!(e+1>t.length)););e++}return e}},{key:"backSpaceHtmlChars",value:function(t,e,s){if("html"!==s.contentType)return e;var n=t.substr(e).charAt(0);if(">"===n||";"===n){var i="";for(i=">"===n?"<":"&";t.substr(e-1).charAt(0)!==i&&(e--,!(e<0)););e--}return e}}]),t}();e["default"]=i;var r=new i;e.htmlParser=r}])});
//# sourceMappingURL=typed.min.js.map

function typeTitles()
{
  if($('.typed').length < 1)
  {
    return;
  }
  var typed = new Typed('.typed',
  {
    stringsElement: '#typed-strings',
    // loop: true,
    typeSpeed: 30,
    backSpeed: 70,
    backDelay: 1000,
    startDelay: 500,
  });
}

