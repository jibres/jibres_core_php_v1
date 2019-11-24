
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
    cacheDataSource: [],
    query: function(query)
    {
        self = this;
        // var key = query.term;
        var cachedData = self.cacheDataSource;

        if(cachedData)
        {
            query.callback({results: cachedData.result});
            return;
        }
        else
        {
            $.ajax({
              url: 'http://jibres.local' + apiLang + '/api/v1/location/country',
              // data: { q : query.term },
              dataType: 'json',
              type: 'GET',
              success: function(data)
              {
                self.cacheDataSource = data;
                query.callback({results: data.result});
              }
            })
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
      "<div class='f'>" +
        "<div class='c1 pRa10'><img src='" + _repo.flag + "' alt='"+ _repo.name + "' /></div>" +
        "<div class='c'>" + _repo.text + "</div>" +
        "<div class='cauto os pLa10'>" + _repo.name + "</div>" +
      "</div>"
    );

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

