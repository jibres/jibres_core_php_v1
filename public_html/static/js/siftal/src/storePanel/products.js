// margin (calculated as ([price - cost] / price) * 100)
function calcPriceMargin()
{
  var cost             = getElNumber($('#buyprice'));
  var price            = getElNumber($('#price'));
  var compareAtPrice   = getElNumber($('#CompareAtPrice'));
  // price margin
  var priceMarginEl    = $('.priceMargin');
  var priceMargin      = 0;
  // discount margin
  var discountMarginEl = $('.discountMargin');
  var discountMargin   = 0;

  // cala priceMargin and show depends on condition
  if(cost && price)
  {
    priceMargin = (((price - cost) / price)  * 100).toFixed(2);
  }
  if(priceMargin)
  {
    priceMarginEl.find('b').html(fitNumber(priceMargin) + ' %');
    priceMarginEl.attr('data-percent', priceMargin).slideDown().removeClass('hide');
    if(priceMargin > 10)
    {
      priceMarginEl.removeClass('danger2')
      priceMarginEl.addClass('success2')
    }
    else if(priceMargin > 0)
    {
      priceMarginEl.removeClass('danger2')
      priceMarginEl.removeClass('success2')
    }
    else
    {
      priceMarginEl.removeClass('success2')
      priceMarginEl.addClass('danger2')
    }
  }
  else
  {
    priceMarginEl.find('b').html('-');
    priceMarginEl.attr('data-percent', priceMargin).slideUp();
  }



  if(price && compareAtPrice)
  {
    discountMargin = (((compareAtPrice - price) / compareAtPrice)  * 100).toFixed(2);
  }
  console.log(price);
  console.log(compareAtPrice);
  console.log(discountMargin);
  if(discountMargin)
  {
    discountMarginEl.find('b').html(fitNumber(discountMargin) + ' %');
    discountMarginEl.attr('data-percent', discountMargin).slideDown().removeClass('hide');
    if(discountMargin > 10)
    {
      discountMarginEl.removeClass('danger2')
      discountMarginEl.addClass('success2')
    }
    else if(discountMargin > 0)
    {
      discountMarginEl.removeClass('danger2')
      discountMarginEl.removeClass('success2')
    }
    else
    {
      discountMarginEl.removeClass('success2')
      discountMarginEl.addClass('danger2')
    }
  }
  else
  {
    discountMarginEl.find('b').html('-');
    discountMarginEl.attr('data-percent', discountMargin).slideUp();
  }
}

function recalcPricePercentsOld()
{
  // if((window.location.pathname).indexOf('/a/product') < 0 || $('#price').length === 0)
  // {
  //   return;
  // }

  if(!$('#finalprice').length)
  {
    return;
  }
  // declare variables
  var elFinalPriceBox = $('#finalprice').parent().parent();
  var buy             = getElNumber($('#buyprice'));
  var sale            = getElNumber($('#price'));
  var discount        = getElNumber($('#discount'));
  var finalPrice      = 0;

  var impureIntrestRate = 0;
  var pureIntrestRate   = 0;
  var discountRate      = 0;

  // impureIntrestRate
  if(buy && sale)
  {
    impureIntrestRate = ((sale * 100 / buy) - 100).toFixed(2);
    pureIntrestRate   = (((sale - discount) * 100 / buy) - 100).toFixed(2);
  }
  // $('#price').parent().find('.addon').text(fitNumber(impureIntrestRate) + '%');

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
  $('.finalPriceToman').text(wordifyTomans(finalPrice))
  if(sale)
  {
    if(elFinalPriceBox.hasClass('hide'))
    {
      elFinalPriceBox.removeClass('hide').slideDown();
    }
    else
    {
      elFinalPriceBox.slideDown();
    }
  }
  else
  {
    elFinalPriceBox.slideUp();
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

