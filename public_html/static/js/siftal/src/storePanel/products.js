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
    priceMargin = (((price - cost) / price)  * 100).toFixed(2);
  }
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

