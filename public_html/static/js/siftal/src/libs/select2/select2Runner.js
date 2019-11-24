
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

  select2Country();
  select2Province();

  $(document).on('focus', '.select2.select2-container', function (e)
  {
    // only open on original attempt - close focus event should not fire open
    if (e.originalEvent && $(this).find(".select2-selection--single").length > 0)
    {
      $(this).siblings('select:enabled').select2('open');
    }
  });

}



function select2Country()
{
  $('.select2-country').select2(
  {
    templateResult: formatDropDownCoutry
  });

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
}



function select2CountryOld2()
{
  $('.select2-country').one('focus', function(e)
  {
    var self = $(this);
    var loadingTxt = self.attr('data-loading');
    var defaultOptEl = self.find('option:eq(0)');
    if(!loadingTxt)
    {
      loadingTxt = 'Data is being loaded...';
    }
    var defaultTxt = self.attr('data-opt1', defaultOptEl.text());

    // Text to let user know data is being loaded for long requests.
    defaultOptEl.text(loadingTxt);
    $.ajax({
      url: 'http://jibres.local/' + $('html').attr('lang') + '/api/v1/location/country',
      data: {},
      dataType: 'json',
      success: function(returnedData)
      {
          // Clear the notification text of the option.
          defaultOptEl.text(defaultTxt.attr('data-opt1'));
          // Initialize the Select2 with the data returned from the AJAX.
          self.select2(
          {
            data: returnedData.result,
            templateResult: formatDropDownCoutry
          });
          // Open the Select2.
          self.select2('open');
      }
    });
    // Blur the select to register the text change of the option.
    self.blur();
  });

  function formatDropDownCoutry(_repo)
  {
    if(_repo.loading)
    {
      return _repo.text;
    }
    // fill lines
    var $container = $(
      "<div class='f align-center'>" +
        "<div class='c1 pRa10'><img src='" + _repo.flag + "' alt='"+ _repo.name + "' /></div>" +
        "<div class='c'>" + _repo.text + "</div>" +
        "<div class='cauto os pLa10'>" + _repo.name + "</div>" +
      "</div>"
    );
    console.log(_repo);
    if(!_repo.id)
    {
      $container = _repo.text;
    }

    return $container;
  }
}













function select2CountryOld()
{
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
              url: 'http://jibres.local' + '/' + $('html').attr('lang') + '/api/v1/location/country',
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
    templateResult: formatDropDownCoutry
  });


  function formatDropDownCoutry(_repo)
  {
    if(_repo.loading)
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
}

