// margin (calculated as ([price - cost] / price) * 100)
function calcProductMargin()
{
  if(!$('#finalprice').length)
  {
    return;
  }

  var cost                = getElNumber($('#buyprice'));
  var price               = getElNumber($('#price'));
  var discount            = getElNumber($('#discount'));
  var discountRate        = 0;
  var vat                 = 0;
  var vatRate             = 0;
  // finalPrice           = price - discount
  var finalPrice          = price;
  var finalPriceTxt       = price;
  // grossProfit          = price - cost
  var grossProfit         = 0;
  // grossProfitMargin    = (price - cost) / price
  var grossProfitMargin   = 0;
  // useful elements
  var grossProfitMarginEl = $('.grossProfitMargin');
  var moneyUnit           = $('#finalprice').attr('data-unit');

  // calc final price
  if(discount)
  {
    finalPrice = price - discount;
    finalPriceTxt +=  " - " + discount;
    discountRate = ((discount / price) * 100).toFixed(2);
  }

  // set discount rate
  if(discountRate > 1000)
  {
    $('#discountRate').text('+ ∞');
  }
  else if(discountRate < 0)
  {
    $('#discountRate').text('- ∞');
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
    vat = ((price - discount) * vatRate).toFixed(2);
    vat = parseFloat(vat);
    if(vat)
    {
      $('#vat').parent().find('label span').text(fitNumber(vat));
    }
  }

  // charge tax is enabled by user
  if($("#vat").is(":checked"))
  {
    finalPrice = finalPrice + vat;
    finalPriceTxt +=  " + " + vat;
  }

  // set finalPrice
  // $('#finalprice').parent().parent().find('label span').text(fitNumber(finalPriceTxt, false));
  $('#finalprice').val(finalPrice);

  if(cost)
  {
    grossProfit       = finalPrice - cost;
    grossProfitMargin = ((finalPrice - cost) / cost)  * 100;
    // grossProfitMargin = parseFloat(grossProfitMargin.toFixed(2))
    console.log(finalPrice);
    console.log(cost);
    console.log(grossProfit);
    console.log(grossProfitMargin);
  }

  // set val
  if(grossProfitMargin)
  {
    grossProfitMarginEl.find('.c').html(fitNumber(grossProfitMargin) + '%');
    grossProfitMarginEl.find('.cauto').html(fitNumber(grossProfit) + ' ' + moneyUnit);
    grossProfitMarginEl.attr('data-percent', grossProfitMargin).slideDown('fast');
  }
  else
  {
    grossProfitMarginEl.find('.c').html('-');
    grossProfitMarginEl.find('.cauto').html('-');
    grossProfitMarginEl.attr('data-percent', grossProfitMargin).slideUp('fast');
  }

  // change design based on change
  if(grossProfitMargin > 10)
  {
    grossProfitMarginEl.find('.msg').removeClass('danger2')
    grossProfitMarginEl.find('.msg').removeClass('info2')
    grossProfitMarginEl.find('.msg').addClass('success2')
  }
  else if(grossProfitMargin > 0)
  {
    grossProfitMarginEl.find('.msg').removeClass('danger2')
    grossProfitMarginEl.find('.msg').addClass('info2')
    grossProfitMarginEl.find('.msg').removeClass('success2')
  }
  else
  {
    grossProfitMarginEl.find('.msg').addClass('danger2')
    grossProfitMarginEl.find('.msg').removeClass('info2')
    grossProfitMarginEl.find('.msg').removeClass('success2')
  }




return;

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

