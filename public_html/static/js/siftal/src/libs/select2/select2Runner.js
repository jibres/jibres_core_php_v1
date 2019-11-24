
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
  $('.select2-country').one('focus', function(e)
  {
    var self = $(this);

    // Text to let user know data is being loaded for long requests.
    self.find('option:eq(0)').text('Data is being loaded...');
    $.ajax({
      url: 'http://jibres.local' + '/' + $('html').attr('lang') + '/api/v1/location/country',
      data: {},
      dataType: 'json',
      success: function(returnedData)
      {
          // Clear the notification text of the option.
          self.find('option:eq(0)').text('');
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
      $(this).blur();
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

