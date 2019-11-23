

/**
 * run date picker for all elements in page
 * @return {[type]} [description]
 */
function runDatePicker()
{
  $('.datepicker').each(function()
  {
    var $mydatePicker      = $(this);
    var mydateOpt          = {};

    // set max length
    $mydatePicker.attr('maxlength', 10);

    // disable switch design of calendar
    mydateOpt.toolbox =
    {
      "calendarSwitch":
      {
        "enabled": false,
      },
    },

    mydateOpt.calendarType = $mydatePicker.attr('data-type');
    if(!mydateOpt.calendarType)
    {
      if($('html').attr('lang') === 'fa')
      {
        mydateOpt.calendarType = 'persian';
      }
      else
      {
        mydateOpt.calendarType = 'gregorian';
      }
    }

    // default format for current selector
    mydateOpt.format       = $mydatePicker.attr('data-format');
    if(!mydateOpt.format)
    {
      mydateOpt.format = 'YYYY/MM/DD';
    }
    // connect to another field
    if($mydatePicker.attr('data-alt'))
    {
      mydateOpt.altField   = $mydatePicker.attr('data-alt');
      mydateOpt.altFormat  = $mydatePicker.attr('data-altFormat');
    }
    // allow to set view mode
    if($mydatePicker.attr('data-view'))
    {
      // allow to change view mode
      mydateOpt.viewMode   = $mydatePicker.attr('data-view');
    }
    // show inline mode
    mydateOpt.inline       = $mydatePicker.attr('data-inline') !== undefined? true: false;

    // set some setting on as default like below settings
    // sensetive about input and read changes!
    mydateOpt.observer     = $mydatePicker.attr('data-off') !== undefined? false: true;
    // auto close after chose date
    mydateOpt.autoClose    = $mydatePicker.attr('data-open') !== undefined? false: true;
    // set position for
    mydateOpt.position     = [36,0];
    // use persian digit
    if($mydatePicker.attr('data-en') !== undefined)
    {
      mydateOpt.calendar =
      {
        "persian":
        {
          "locale": "en"
        }
      };
    }


    if($mydatePicker.val())
    {
      mydateOpt.initialValue = true;
    }
    else
    {
      mydateOpt.initialValue = false;
    }

    if(mydateOpt.inline)
    {
      mydateOpt.autoClose = false;
    }

    // // check min value
    // if($mydatePicker.attr('data-min') !== undefined)
    // {
    //   if($mydatePicker.attr('data-min') === 'now')
    //   {
    //     mydateOpt.minDate = new persianDate().unix();
    //   }
    // }

    // // check max value
    // if($mydatePicker.attr('data-max') !== undefined)
    // {
    //   if($mydatePicker.attr('data-max') === 'now')
    //   {
    //     mydateOpt.maxDate = new persianDate().unix();
    //   }
    // }

    // logy(mydateOpt);
    $mydatePicker.persianDatepicker(mydateOpt);

    // // on blur
    // $mydatePicker.on("blur", function()
    // {
    //   console.log($(':focus'));
    //   console.log($(':focus').is('input'));
    //   if($mydatePicker.pDatePicker && $(':focus').is('input'))
    //   {
    //     $mydatePicker.pDatePicker.model.view.hide();
    //   }
    // });

    $mydatePicker.on("keydown", function(_e)
    {
      console.log(_e.which);
      if(_e.which == 9)
      {
        if($mydatePicker.pDatePicker)
        {
          $mydatePicker.pDatePicker.model.view.hide();
        }
      }
    });

  });
}

