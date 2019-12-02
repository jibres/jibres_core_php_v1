
function JsBarcodeRunner()
{
  $('.barcodePrev').each(function(_el, _a)
  {
    drawBarcodeSvg(this, 0);
  });
  bindBarcodeToRedraw();
}


function bindBarcodeToRedraw()
{
  $('.barCode').on('input', function(e)
  {
    if($(this).attr('id'))
    {
      var svgBox = $('.barcodePrev[data-val="#'+ $(this).attr('id') +'"]');
      if(svgBox && svgBox.length)
      {
        drawBarcodeSvg(svgBox);
      }
    }
  });

  // work with barcode trigger
  $('body').on('barcode:detect', function(_e, _barcode)
  {
    var $focused = $(':focus');
    if($focused.is('.barCode') && $focused.attr('id'))
    {
      var svgBox = $('.barcodePrev[data-val="#'+ $focused.attr('id') +'"]');
      drawBarcodeSvg(svgBox);
    }
  });

  $('body').on('barcode:remove', function(_e, _barcode, _el)
  {
    var $focused = $(':focus');
    if($focused.is('.barCode') && $focused.attr('id'))
    {
      var svgBox = $('.barcodePrev[data-val="#'+ $focused.attr('id') +'"]');
      drawBarcodeSvg(svgBox);
    }
  });
}


function drawBarcodeSvg(_this, _time)
{
  if(_this.length < 1)
  {
    return;
  }
  var $myCodeElName = $(_this).attr('data-val');
  var $myCodeEl     = $($myCodeElName);
  var myCode        = 'Jibres';
  if($myCodeEl.length)
  {
    // get code
    if($myCodeEl.is('input'))
    {
      myCode = $myCodeEl.val();
    }
    else
    {
      myCode = $myCodeEl.attr('data-val');
    }
  }

  var flagImg = $myCodeEl.parents('.input').find('span img');
  flagDetectAndSet(myCode, flagImg);


  // console.log(_this);
    if(typeof drawTimeout == undefined)
    {
      var drawTimeout = 0;
    }
    else
    {
      clearTimeout(drawTimeout);
    }
    if(_time === undefined)
    {
      _time = 100;
    }

    drawTimeout = setTimeout(function()
    {
    var drawOpt   = { height: 40}
    var displayValue = false;


    if($(_this).attr('data-height'))
    {
      drawOpt.height = $(_this).attr('data-height');
      // get height
    }

    if($(_this).attr('data-hideValue') !== undefined)
    {
      drawOpt.displayValue = false;
    }

    // try to draw barcode
    if(myCode)
    {
      if(findBarcodeFormat(myCode))
      {
        drawOpt.format = findBarcodeFormat(myCode);
      }
      // console.log(findBarcodeFormat(myCode)+ ' is format of '+ myCode );
      JsBarcode($(_this).get(0), myCode, drawOpt);
    }
    else
    {
      drawOpt.lineColor = '#ccc;'
      // remove barcode with default design
      JsBarcode($(_this).get(0), "Jibres", drawOpt);
    }


    }, _time);
}


function findBarcodeFormat(_code)
{
  const allFormats =
  [
    'EAN13', 'UPC', 'EAN8', 'EAN5', 'EAN2',
    'CODE128', 'CODE128A', 'CODE128B', 'CODE128C',
    'CODE39',
    'ITF14',
    'MSI', 'MSI10', 'MSI11', 'MSI1010', 'MSI1110',
    'pharmacode',
    'codabar'
  ];

  const validFormats = allFormats
    .map(format => {
      let value;
      JsBarcode({}, _code, {
        format: format,
        valid: (valid) => {
          if (valid) value = format;
        },
      });
      return value;
    })
    .filter(format => !!format);

  if(validFormats.length > 0)
  {
    return validFormats[0];
  }
}

function flagDetectAndSet(_code, _flagImg)
{
  var flagDetected = barcode_country(_code).toLowerCase();
  if(flagDetected)
  {
    var imgSrc = $('meta[name="jibres:site"]').attr('content') + "/static/img/flags/svg/" + flagDetected + ".svg";
    _flagImg.attr('src', imgSrc).attr('alt', flagDetected).attr('title', flagDetected);
    _flagImg.parent().removeClass('none');
  }
  else
  {
    _flagImg.parent().addClass('none');
  }

}

