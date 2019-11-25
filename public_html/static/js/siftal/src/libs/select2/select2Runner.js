
function select2Runner()
{
  if($('html').attr('lang') === 'fa')
  {
    $.fn.select2.defaults.set("language", "fa");
  }
  if($('body').attr('dir') === 'rtl')
  {
    $.fn.select2.defaults.set("dir", "rtl");
  }
  // set minimum to show search
  $.fn.select2.defaults.set("minimumResultsForSearch", "6");

  // init simple select2
  $('.select2:not([data-model])').select2();
  $('.select2[data-model="country"]').select2({ templateResult: select2FormatDropDownCoutry});


  $(document).on('focus', '.select2.select2-container', function (e)
  {
    // only open on original attempt - close focus event should not fire open
    if (e.originalEvent && $(this).find(".select2-selection--single").length > 0)
    {
      $(this).siblings('select:enabled').select2('open');
    }
  });

  $(document).on('change', '.select2[data-next]', function (e)
  {
    var nextEl = $(this).attr('data-next');
    if(nextEl)
    {
      select2FillNext($(this).val(),nextEl);
    }
  });
  // fill default value
  select2FillDefault();
}


// fill country elements
function select2FormatDropDownCoutry(_repo)
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
        "<div class='c1 pRa10'><img src='http://jibres.local/static/img/flags/png100px/" + _repo.id.toLowerCase() + ".png' alt='"+ _repo.text + "' /></div>" +
        "<div class='c'>" + _repo.text + "</div>" +
      "</div>"
    );
  }

  return $container;
}


function select2FillNext(_val, _next, _default)
{
  var apiURL = 'http://jibres.local/' + $('html').attr('lang') + '/api/v1/location/';
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

        _el.empty().select2({data: serverResult});
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

function select2FillDefault()
{

  $('.select2[data-next-default]').each(function(_el)
  {
    var myDefault = $(this).attr('data-next-default');
    var myNextEl  = $(this).attr('data-next');
    var myVal     = $(this).val();

    if(myVal && myNextEl && myDefault)
    {
      select2FillNext(myVal, myNextEl, myDefault);
    }
  });
}
