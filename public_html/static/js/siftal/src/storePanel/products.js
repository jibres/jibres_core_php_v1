// margin (calculated as ([price - cost] / price) * 100)
function calcProductMargin()
{
  if(!$('#finalprice').length)
  {
    return;
  }

  var cost              = getElNumber($('#buyprice'));
  var price             = getElNumber($('#price'));
  var discount          = getElNumber($('#discount'));
  var discountRate      = 0;
  var vat               = 0;
  var vatRate           = 0;
  // finalPrice = price - discount
  var finalPrice        = price;
  // grossProfit = price - cost
  var grossProfit       = 0;
  // grossProfitMargin = (price - cost) / price
  var grossProfitMargin = 0;

  // calc final price
  if(discount)
  {
    finalPrice = price - discount;
    discountRate = ((discount / price) * 100).toFixed(2);
  }

  // set discount rate
  if(discountRate > 1000)
  {
    $('#discountRate').text(fitNumber(1000, false) + '+ %');
  }
  else
  {
    $('#discountRate').text(fitNumber(discountRate) + ' %');
  }

  // get vat rate
  vatRate = $('#vat').attr('data-rate');
  if(vatRate)
  {
    vatRate = parseFloat(vatRate);
  }

  // show vat value
  if(price - discount > 0)
  {
    vat = (price - discount) * vatRate;
    if(vat)
    {
      $('#vat').parent().find('label span').text(fitNumber(vat));
    }
  }

  // charge tax is enabled by user
  if($("#vat").is(":checked"))
  {
    finalPrice = finalPrice + vat;
  }

  // set finalPrice
  $('#finalprice').val(finalPrice);


return;


  // calc priceMargin and show depends on condition
  if(price && cost)
  {
    grossProfit       = price - cost;
    grossProfitMargin = (((price - cost) / price)  * 100).toFixed(2);
  }
  // change design based on change
  if(grossProfitMargin > 10)
  {
    priceMarginEl.removeClass('danger2')
    priceMarginEl.removeClass('info2')
    priceMarginEl.addClass('success2')
  }
  else if(grossProfitMargin > 0)
  {
    priceMarginEl.removeClass('danger2')
    priceMarginEl.addClass('info2')
    priceMarginEl.removeClass('success2')
  }
  else
  {
    priceMarginEl.addClass('danger2')
    priceMarginEl.removeClass('info2')
    priceMarginEl.removeClass('success2')
  }
  // set val
  if(priceMargin)
  {
    priceMarginEl.find('b').html(fitNumber(priceMargin) + ' %');
    priceMarginEl.attr('data-percent', priceMargin).slideDown('fast');
  }
  else
  {
    priceMarginEl.find('b').html('-');
    priceMarginEl.attr('data-percent', priceMargin).slideUp('fast');
  }









  // calc discount margin
  if(price && compareAtPrice)
  {
    discountMargin = (((compareAtPrice - price) / compareAtPrice)  * 100).toFixed(2);
  }
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
    discountMargin = 0;
  }
  // set val
  if(discountMargin)
  {
    discountMarginEl.html(fitNumber(discountMargin) + ' %').attr('data-percent', discountMargin);
  }
  else
  {
    discountMarginEl.html('-').attr('data-percent', discountMargin);
  }





  // calc priceMargin and show depends on condition
  if(cost && price)
  {
    profitMargin = (((price - cost) / cost)  * 100).toFixed(2);
  }
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
    profitMargin = 0;
  }
  // set val
  if(profitMargin)
  {
    profitMarginEl.find('b').html(fitNumber(profitMargin) + ' %');
    profitMarginEl.attr('data-percent', profitMargin).slideDown('fast');
  }
  else
  {
    profitMarginEl.find('b').html('-');
    profitMarginEl.attr('data-percent', profitMargin).slideUp('fast');
  }
}

