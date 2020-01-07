// margin (calculated as ([price - cost] / price) * 100)
function calcProductMargin()
{
  if(!$('#finalPrice').length)
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
  // get money value
  var moneyUnit           = $('#moneyUnit').text();
  // useful elements
  var grossProfitEl       = $('.grossProfitMargin');
  var discountEl          = $('#discount').parent();
  var finalPriceEl        = $('#finalPrice');
  var finalPriceMsgEl     = $('#finalPrice').parents('.msg');

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
  // $('#finalPrice').parent().parent().find('label span').text(fitNumber(finalPriceTxt, false));
  finalPriceEl.text(fitNumber(finalPrice));

  if(price && cost)
  {
    grossProfit       = finalPrice - cost;
    grossProfitMargin = ((finalPrice - cost) / cost)  * 100;
    grossProfitMargin = parseFloat(grossProfitMargin.toFixed(2))
  }

  // set val
  if(grossProfitMargin)
  {
    if(grossProfitMargin > 100000)
    {
      grossProfitEl.find('.c').html('+ ∞');
    }
    else if(grossProfitMargin < 0)
    {
      grossProfitEl.find('.c').html('- ∞');
    }
    else
    {
      grossProfitEl.find('.c').html(fitNumber(grossProfitMargin) + '%');
    }
    grossProfitEl.find('.cauto').html(fitNumber(grossProfit) + ' ' + moneyUnit);
    grossProfitEl.attr('data-percent', grossProfitMargin).slideDown('fast');
  }
  else
  {
    grossProfitEl.find('.c').html('-');
    grossProfitEl.find('.cauto').html('-');
    grossProfitEl.attr('data-percent', grossProfitMargin).slideUp('fast');
  }

  // change design based on change
  if(grossProfitMargin > 10)
  {
    grossProfitEl.find('.msg').removeClass('danger2')
    grossProfitEl.find('.msg').removeClass('info2')
    grossProfitEl.find('.msg').addClass('success2')
  }
  else if(grossProfitMargin > 0)
  {
    grossProfitEl.find('.msg').removeClass('danger2')
    grossProfitEl.find('.msg').addClass('info2')
    grossProfitEl.find('.msg').removeClass('success2')
  }
  else
  {
    grossProfitEl.find('.msg').addClass('danger2')
    grossProfitEl.find('.msg').removeClass('info2')
    grossProfitEl.find('.msg').removeClass('success2')
  }

  // check discount and percent
  if(discountRate > 80 && discountRate < 500)
  {
    discountEl.removeClass('danger2');
    discountEl.removeClass('warn2');
    discountEl.removeClass('info2');
    discountEl.addClass('success2');
  }
  else if(discountRate > 0)
  {
    discountEl.removeClass('danger2');
    discountEl.removeClass('warn2');
    discountEl.addClass('info2');
    discountEl.removeClass('success2');
  }
  else if(discountRate == 0)
  {
    discountEl.removeClass('danger2');
    discountEl.removeClass('warn2');
    discountEl.removeClass('info2');
    discountEl.removeClass('success2');
  }
  else
  {
    discountEl.addClass('danger2');
    discountEl.removeClass('warn2');
    discountEl.removeClass('info2');
    discountEl.removeClass('success2');
  }


  // all check for final price
  if(finalPrice === 0)
  {
    finalPriceMsgEl.removeClass('danger');
    finalPriceMsgEl.removeClass('warn');
    finalPriceMsgEl.removeClass('success');
  }
  else if(finalPrice < 0)
  {
    finalPriceMsgEl.addClass('danger');
    finalPriceMsgEl.removeClass('warn');
    finalPriceMsgEl.removeClass('success');
  }
  else if(finalPrice <= cost)
  {
    finalPriceMsgEl.removeClass('danger');
    finalPriceMsgEl.addClass('warn');
    finalPriceMsgEl.removeClass('success');
  }
  else
  {
    finalPriceMsgEl.removeClass('danger');
    finalPriceMsgEl.removeClass('warn');
    finalPriceMsgEl.addClass('success');
  }

}
