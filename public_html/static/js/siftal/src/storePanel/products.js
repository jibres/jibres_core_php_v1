// margin (calculated as ([price - cost] / price) * 100)
function calcProductMargin()
{
  var cost             = getElNumber($('#buyprice'));
  var price            = getElNumber($('#price'));
  var compareAtPrice   = getElNumber($('#CompareAtPrice'));
  // discount margin
  var discountMarginEl = $('.discountMargin');
  var discountMargin   = 0;
  // price margin
  var priceMarginEl    = $('.priceMargin');
  var priceMargin      = 0;
  // profit margin
  var profitMarginEl    = $('.profitMargin');
  var profitMargin      = 0;


  // calc discount margin
  if(price && compareAtPrice)
  {
    discountMargin = (((compareAtPrice - price) / compareAtPrice)  * 100).toFixed(2);
  }
  if(discountMargin)
  {
    if(discountMargin > 80)
    {
      discountMarginEl.removeClass('danger2')
      discountMarginEl.removeClass('success2')
      discountMarginEl.addClass('warn')
    }
    else if(discountMargin > 0)
    {
      discountMarginEl.removeClass('danger2')
      discountMarginEl.removeClass('warn')
      discountMarginEl.addClass('success2')
    }
    else
    {
      discountMarginEl.removeClass('success2')
      discountMarginEl.removeClass('warn')
      discountMarginEl.addClass('danger2')
      discountMargin = '-';
    }
    // set val
    discountMarginEl.find('b').html(fitNumber(discountMargin) + ' %');
    discountMarginEl.attr('data-percent', discountMargin).slideDown().removeClass('hide');
  }
  else
  {
    discountMarginEl.find('b').html('-');
    discountMarginEl.attr('data-percent', discountMargin).slideUp();
  }


  // calc priceMargin and show depends on condition
  if(cost && price)
  {
    priceMargin = (((price - cost) / price)  * 100).toFixed(2);
  }
  if(priceMargin)
  {
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
    // set val
    priceMarginEl.find('b').html(fitNumber(priceMargin) + ' %');
    priceMarginEl.attr('data-percent', priceMargin).slideDown().removeClass('hide');
  }
  else
  {
    priceMarginEl.find('b').html('-');
    priceMarginEl.attr('data-percent', priceMargin).slideUp();
  }


  // calc priceMargin and show depends on condition
  if(cost && price)
  {
    profitMargin = (((price - cost) / cost)  * 100).toFixed(2);
  }
  if(profitMargin)
  {
    if(profitMargin > 10)
    {
      profitMarginEl.removeClass('danger2')
      profitMarginEl.addClass('success2')
    }
    else if(profitMargin > 0)
    {
      profitMarginEl.removeClass('danger2')
      profitMarginEl.removeClass('success2')
    }
    else
    {
      profitMarginEl.removeClass('success2')
      profitMarginEl.addClass('danger2')
    }
    // set val
    profitMarginEl.find('b').html(fitNumber(profitMargin) + ' %');
    profitMarginEl.attr('data-percent', profitMargin).slideDown().removeClass('hide');
  }
  else
  {
    profitMarginEl.find('b').html('-');
    profitMarginEl.attr('data-percent', profitMargin).slideUp();
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

