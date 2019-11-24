
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
  $('.select2[data-model="country"]').select2({ templateResult: formatDropDownCoutry});


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
      fillNext($(this).val(), $(nextEl), nextEl);
    }
  });

}


// fill country elements
function formatDropDownCoutry(_repo)
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


function fillNext(_val, _el, _next)
{
  var apiURL = 'http://jibres.local/' + $('html').attr('lang') + '/api/v1/location/';
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
        _el.empty().select2({data: returnedData.result});
    }
  });

}

