
function selectRunner()
{
  if($('html').attr('lang') === 'fa')
  {
    $.fn.select22.defaults.set("language", "fa");
  }
  if($('body').attr('dir') === 'rtl')
  {
    $.fn.select22.defaults.set("dir", "rtl");
  }
  // set minimum to show search
  $.fn.select22.defaults.set("minimumResultsForSearch", "6");

  // init simple select22
  $('.select22:not([data-model])').select22();
  $('.select22[data-model="country"]').select22({ templateResult2: select22FormatDropDownCoutry, templateSelection: select22FormatDropDownCoutry });


  $(document).on('focus', '.select22.select22-container', function (e)
  {
    // only open on original attempt - close focus event should not fire open
    if (e.originalEvent && $(this).find(".select22-selection--single").length > 0)
    {
      $(this).siblings('select:enabled').select22('open');
    }
  });

  $(document).on('change', '.select22', function (_e)
  {
    var nextEl = $(this).attr('data-next');
    if(nextEl)
    {
      select22FillNext($(this).val(), nextEl);
    }
    // open option as link
    if($(this).attr('data-link') !== undefined)
    {
      var selectedVal = $(this).val();
      // we are link inside value, so open link
      if(selectedVal.indexOf('http') === 0)
      {
        Navigate({ url: selectedVal });
      }
    }

  });

$('.select22').on("select2:selecting", function(e, a) {
   // what you would like to happen
    console.log(e);
    console.log(a);
});
$(".select22").on("select2:select", function (e) {
    console.log(e.params.data.id);
});

  // fill default value
  select22FillDefault();
}


// fill country elements
function select22FormatDropDownCoutry(_repo)
{
  if(_repo.loading)
  {
    return _repo.text;
  }
  // fill lines
  var $container = _repo.text;
  if(_repo.id)
  {
    $container = $(
      "<div class='f align-center'>" +
        "<div class='c1 pRa10'><img src='" + $('meta[name="jibres:site"]').attr('content') + "/static/img/flags/png100px/" + _repo.id.toLowerCase() + ".png' alt='"+ _repo.text + "' /></div>" +
        "<div class='c'>" + _repo.text + "</div>" +
      "</div>"
    );
  }

  return $container;
}


function select22FillNext(_val, _next, _default)
{
  var apiURL = $('meta[name="jibres:api"]').attr('content') + 'v1/location/';
  var _el = $(_next);
  if(_next === '#city')
  {
    apiURL += 'city?province=' + _val;
  }
  else if(_next === '#province')
  {
    apiURL += 'province?country=' + _val;
  }

  $.ajax({
    url: apiURL,
    dataType: 'json',
    success: function(returnedData)
    {
      if(returnedData && returnedData.result && returnedData.result.length)
      {
        var serverResult = returnedData.result;
        if(_default)
        {
          $.each(serverResult, function (_el)
          {
            if(this.id == _default)
            {
              this.selected = true;
            }
          });
        }

        _el.empty().select22({data: serverResult});
        _el.parents('[data-status]').slideDown('fast');
      }
      else
      {
        _el.empty();
        _el.parents('[data-status]').slideUp('fast');
        // close subchild if exist
        var nextOne = $(_el.attr('data-next'));
        if(nextOne.length)
        {
          nextOne.parents('[data-status]').slideUp('fast');
        }
      }
    }
  });

}

function select22FillDefault()
{

  $('.select22[data-next-default]').each(function(_el)
  {
    var myDefault = $(this).attr('data-next-default');
    var myNextEl  = $(this).attr('data-next');
    var myVal     = $(this).val();

    if(myVal && myNextEl && myDefault)
    {
      select22FillNext(myVal, myNextEl, myDefault);
    }
  });
}
