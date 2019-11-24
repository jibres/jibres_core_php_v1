
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
  $('.select2').select2();

  var apiLang = '/' +$('html').attr('lang');

  // init select2 for country
  $('.select2-country').select2({
    ajax:
    {
      url: 'http://jibres.local' + apiLang + '/api/v1/location/country',
      dataType: 'json',
      cache: true,
      // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
      processResults: function (_data)
      {
        if(_data && _data.result)
        {
          return {results: _data.result};
        }
        return null;
      }
    },
    templateResult: formatDropDownOneLine
  });


  function formatDropDownOneLine (_repo)
  {
    if (_repo.loading)
    {
      return _repo.text;
    }

    var $container = $(
      "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__avatar'><img src='" + _repo.owner.avatar_url + "' /></div>" +
        "<div class='select2-result-repository__meta'>" +
          "<div class='select2-result-repository__title'></div>" +
          "<div class='select2-result-repository__description'></div>" +
          "<div class='select2-result-repository__statistics'>" +
            "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> </div>" +
            "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> </div>" +
            "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> </div>" +
          "</div>" +
        "</div>" +
      "</div>"
    );

    $container.find(".select2-result-repository__title").text(_repo.full_name);
    $container.find(".select2-result-repository__description").text(_repo.description);
    $container.find(".select2-result-repository__forks").append(_repo.forks_count + " Forks");
    $container.find(".select2-result-repository__stargazers").append(_repo.stargazers_count + " Stars");
    $container.find(".select2-result-repository__watchers").append(_repo.watchers_count + " Watchers");

    return $container;
  }



  $(document).on('focus', '.select2.select2-container', function (e)
  {
    // only open on original attempt - close focus event should not fire open
    if (e.originalEvent && $(this).find(".select2-selection--single").length > 0)
    {
      $(this).siblings('select:enabled').select2('open');
    }
  });

}

