

/**
 * [bindShortkey description]
 * @return {[type]} [description]
 */
function bindShortkey()
{
  $(document).on("keydown", function(_e) { event_corridor.call(this, _e)});
  // $('ul li', explorer).click(function(e)    { event_corridor(e, e.currentTarget, 'click');    });
}

/**
 * corridor of all events on keyboard and mouse
 * @param  {[type]} e     the element that event doing on that
 * @param  {[type]} _self seperated element for doing jobs on it
 * @param  {[type]} _key  the key pressed or click or another events
 * @return {[type]}       void func not returning value! only doing job
 */
function event_corridor(_e, _self, _key)
{
  if(!_key)
  {
    _key = _e.which;
  }

  _self = $(_self);
  var ctrl   = _e.ctrlKey  ? 'ctrl'  : '';
  var shift  = _e.shiftKey ? 'shift' : '';
  var alt    = _e.altKey   ? 'alt'   : '';
  var mytxt  = String(_key) + ctrl + alt + shift;
  var keyp   = String.fromCharCode(_key);

  // logy(mytxt, 'info');
  switch(mytxt)
  {
    // ---------------------------------------------------------- Enter
    case '13':              // Enter
      break;

    case '13ctrl':          // ctrl + Enter
      break;


    // ---------------------------------------------------------- Escape
    case '27':              //Escape
      break;


    // ---------------------------------------------------------- Space
    case '32':              // space
    case '32shift':         // space + shift
    case '32ctrl':          // space + ctrl
    case '32ctrlshift':     // space + ctrl + shift

      break;


    // ---------------------------------------------------------- Page Up
    case '33':              // PageUP
      break;


    // ---------------------------------------------------------- Up
    case '38':              // up
      navigateonFactorAddInputs('up');
      break;


    // ---------------------------------------------------------- Page Down
    case '34':              // PageDown
      break;


    // ---------------------------------------------------------- Down
    case '40':              // down
      navigateonFactorAddInputs('down');
      break;


    // ---------------------------------------------------------- End
    case '35':              // End
      break;


    // ---------------------------------------------------------- Home
    case '36':              // Home
      break;


    // ---------------------------------------------------------- Left
    case '37':              // left
      navigateonFactorAddInputs('left');
      break;


    // ---------------------------------------------------------- Right
    case '39':              // right
      navigateonFactorAddInputs('right');
      break;

    // ---------------------------------------------------------- BackSpace
    case '8':               // Back Space
      break;

    // ---------------------------------------------------------- Delete
    case '46':              // delete
      if(check_factor())
      {
        clearDropdown($('.dropdown.barCode'));

        var selectedRowEl = getSelectedRow(true);
        if(selectedRowEl)
        {
          // var nextSelectedRow = selectedRowEl.prev();
          selectedRowEl.remove();
          $('.dropdown.barCode input.search').val('').trigger("focus");
          // navigationFactorAddSetSelected(nextSelectedRow, true);
          calcFooterValues();
          _e.preventDefault();
        }
      }
      break;


    // ---------------------------------------------------------------------- shortcut
    case '65ctrl':          // a + ctrl
      break;

    case '68shift':         // d + shift
      break;

    case '70':              // f
      break;

    case '72shift':         // h + shift (Home page)
      break;

    case '56shift':         // * | shift + 8
    case '106':             // *
      if(check_factor())
      {
        var RowCountEl = getSelectedRow();
        if(RowCountEl)
        {
          var RowCountEl = RowCountEl.find('input.count');
          RowCountEl.trigger("select");
        }
          // _e.preventDefault();
      }
      break;

    case '107':             // plus +
    case '187shift':        // plus +
      if(check_factor())
      {
        if($(":focus").parents('.dropdown').find('#productSearch'))
        {
          $('.dropdown.barCode input.search').trigger("select");
        }
        else
        {
          $('.dropdown.barCode input.search').trigger("select");
          _e.preventDefault();
        }
      }
      break;

    case '109':             // minus -
    case '189shift':        // minus -
      if(check_factor())
      {
        var RowDiscountEl = getSelectedRow();
        if(RowDiscountEl)
        {
          var RowDiscountEl = RowDiscountEl.find('input.discount');
          RowDiscountEl.trigger("select");
        }
        // _e.preventDefault();
      }
      break;

    case '110':             // .
    case '190':             // .
      break;

    case '111':             // divider on numpad
    case '191':             // divider
      if(check_factor())
      {
        if($(":focus").parents('.dropdown').find('#productSearch'))
        {
          $('.dropdown.barCode input.search').trigger("select");
        }
        else
        {
          $('.dropdown.barCode input.search').trigger("select");
          _e.preventDefault();
        }
      }
      break;

    case '112':             // f1
      break;

    case '113':             // f2
        // prevent any other change
        _e.preventDefault();

        // set factor url
        var myPage    = $('body').attr('data-page');
        var factorUrl = '/a/factor/add?from='+ myPage;
        if($('html').attr('lang') !== undefined)
        {
          factorUrl = $('html').attr('lang')+ factorUrl;
        }
        // navigate to add new factor page
        // Navigate({ url: factorUrl });
        if(check_factor())
        {
          // if we are in check url, first check this one is empty or not
          if(qtyFactorTableItems() == 0)
          {
            var msg = $('#factorAdd').attr('data-msgNewError');
            notif('warn', msg, null, null, {"displayMode": 2});
          }
          else
          {
            window.open(factorUrl + '&extra=true', '_blank');
          }
        }
        else
        {
          if(myPage === 'factor_fishprint')
          {
            Navigate({ url: factorUrl });
            // location.replace(factorUrl);
          }
          else
          {
            window.open(factorUrl, '_blank');
          }
        }

      break;


    case '114':             // f3
    case '114ctrl':         // f3 + ctrl
    case '70ctrl':          // f3 + ctrl
      if($('input[type=search]').length === 1)
      {
        $('input[type=search]').trigger("focus");
        _e.preventDefault();
      }
      break;

    case '115':             // f4

      break;

    case '118':             // f7
      if(check_factor())
      {
        shortkey_toggleDiscount();
        _e.preventDefault();
      }
      break;

    case '119':             // f8

      break;

   case '122shift':         // f11 + shift
      break;

   case '123':              // f12
      break;

    // ---------------------------------------------------------------------- mouse
    case 'click':           // click
      break;

    case 'rightclick':        // Double click
      break;

    default:                // exit this handler for other keys
      return;
  }
}


function getSelectedRow(_confirm)
{
  if(check_factor())
  {
    var aa = $('table.productList tbody tr').length;
    if(aa > 0)
    {
      var selectedRowEl = $('table.productList tbody tr[data-selected]');
      if(selectedRowEl.length == 1)
      {

        // selectedRow = selectedRowEl.index();
      }
      else
      {
        if(_confirm)
        {
          $('table.productList tbody tr:eq(0)').attr('data-selected', 'warn');
          return false;
        }
        else
        {
          selectedRowEl = $('table.productList tbody tr:eq(0)')
        }
      }
      return selectedRowEl;
    }
  }
  return null;
}

function check_factor()
{
  if($('#factorAdd').length > 0)
  {
    return true;
  }

  return false;
}


