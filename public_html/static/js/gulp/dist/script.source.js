

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
      navigateonFactorAddInputs('up', _e);
      break;


    // ---------------------------------------------------------- Page Down
    case '34':              // PageDown
      break;


    // ---------------------------------------------------------- Down
    case '40':              // down
      navigateonFactorAddInputs('down', _e);
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
        var myPage     = $('body').attr('data-page');
        var factorUrl  = '/a/sale?from='+ myPage;
        var factorType = $('body').attr('data-page');
        if($('html').attr('lang') !== undefined)
        {
          factorUrl = $('html').attr('lang')+ factorUrl;
        }
        // navigate to add new factor page
        // Navigate({ url: factorUrl });
        if(factorType === 'sale' && check_factor())
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
          if(myPage === 'chap_receipt')
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

    case '113shift':        // shift+f2
      prevFactor();
      break;

    case '113ctrlshift':        // shift+f2
      prevFactor(undefined, true);
      break;


    case '114':             // f3
    case '114ctrl':         // f3 + ctrl
    case '70ctrl':          // f3 + ctrl
logy($('input.search'));
logy($('input.search').length);

      if($('input[type=search]').length === 1)
      {
        $('input[type=search]').trigger("focus");
        _e.preventDefault();
      }
      else if($('select input.search').length === 2)
      {
        $('input.search').trigger("focus");
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


//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNob3J0a2V5LmpzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsImZpbGUiOiJzY3JpcHQuc291cmNlLmpzIiwic291cmNlc0NvbnRlbnQiOlsiXHJcblxyXG4vKipcclxuICogW2JpbmRTaG9ydGtleSBkZXNjcmlwdGlvbl1cclxuICogQHJldHVybiB7W3R5cGVdfSBbZGVzY3JpcHRpb25dXHJcbiAqL1xyXG5mdW5jdGlvbiBiaW5kU2hvcnRrZXkoKVxyXG57XHJcbiAgJChkb2N1bWVudCkub24oXCJrZXlkb3duXCIsIGZ1bmN0aW9uKF9lKSB7IGV2ZW50X2NvcnJpZG9yLmNhbGwodGhpcywgX2UpfSk7XHJcbiAgLy8gJCgndWwgbGknLCBleHBsb3JlcikuY2xpY2soZnVuY3Rpb24oZSkgICAgeyBldmVudF9jb3JyaWRvcihlLCBlLmN1cnJlbnRUYXJnZXQsICdjbGljaycpOyAgICB9KTtcclxufVxyXG5cclxuLyoqXHJcbiAqIGNvcnJpZG9yIG9mIGFsbCBldmVudHMgb24ga2V5Ym9hcmQgYW5kIG1vdXNlXHJcbiAqIEBwYXJhbSAge1t0eXBlXX0gZSAgICAgdGhlIGVsZW1lbnQgdGhhdCBldmVudCBkb2luZyBvbiB0aGF0XHJcbiAqIEBwYXJhbSAge1t0eXBlXX0gX3NlbGYgc2VwZXJhdGVkIGVsZW1lbnQgZm9yIGRvaW5nIGpvYnMgb24gaXRcclxuICogQHBhcmFtICB7W3R5cGVdfSBfa2V5ICB0aGUga2V5IHByZXNzZWQgb3IgY2xpY2sgb3IgYW5vdGhlciBldmVudHNcclxuICogQHJldHVybiB7W3R5cGVdfSAgICAgICB2b2lkIGZ1bmMgbm90IHJldHVybmluZyB2YWx1ZSEgb25seSBkb2luZyBqb2JcclxuICovXHJcbmZ1bmN0aW9uIGV2ZW50X2NvcnJpZG9yKF9lLCBfc2VsZiwgX2tleSlcclxue1xyXG4gIGlmKCFfa2V5KVxyXG4gIHtcclxuICAgIF9rZXkgPSBfZS53aGljaDtcclxuICB9XHJcblxyXG4gIF9zZWxmID0gJChfc2VsZik7XHJcbiAgdmFyIGN0cmwgICA9IF9lLmN0cmxLZXkgID8gJ2N0cmwnICA6ICcnO1xyXG4gIHZhciBzaGlmdCAgPSBfZS5zaGlmdEtleSA/ICdzaGlmdCcgOiAnJztcclxuICB2YXIgYWx0ICAgID0gX2UuYWx0S2V5ICAgPyAnYWx0JyAgIDogJyc7XHJcbiAgdmFyIG15dHh0ICA9IFN0cmluZyhfa2V5KSArIGN0cmwgKyBhbHQgKyBzaGlmdDtcclxuICB2YXIga2V5cCAgID0gU3RyaW5nLmZyb21DaGFyQ29kZShfa2V5KTtcclxuXHJcbiAgLy8gbG9neShteXR4dCwgJ2luZm8nKTtcclxuICBzd2l0Y2gobXl0eHQpXHJcbiAge1xyXG4gICAgLy8gLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSBFbnRlclxyXG4gICAgY2FzZSAnMTMnOiAgICAgICAgICAgICAgLy8gRW50ZXJcclxuICAgICAgYnJlYWs7XHJcblxyXG4gICAgY2FzZSAnMTNjdHJsJzogICAgICAgICAgLy8gY3RybCArIEVudGVyXHJcbiAgICAgIGJyZWFrO1xyXG5cclxuXHJcbiAgICAvLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tIEVzY2FwZVxyXG4gICAgY2FzZSAnMjcnOiAgICAgICAgICAgICAgLy9Fc2NhcGVcclxuICAgICAgYnJlYWs7XHJcblxyXG5cclxuICAgIC8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0gU3BhY2VcclxuICAgIGNhc2UgJzMyJzogICAgICAgICAgICAgIC8vIHNwYWNlXHJcbiAgICBjYXNlICczMnNoaWZ0JzogICAgICAgICAvLyBzcGFjZSArIHNoaWZ0XHJcbiAgICBjYXNlICczMmN0cmwnOiAgICAgICAgICAvLyBzcGFjZSArIGN0cmxcclxuICAgIGNhc2UgJzMyY3RybHNoaWZ0JzogICAgIC8vIHNwYWNlICsgY3RybCArIHNoaWZ0XHJcblxyXG4gICAgICBicmVhaztcclxuXHJcblxyXG4gICAgLy8gLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSBQYWdlIFVwXHJcbiAgICBjYXNlICczMyc6ICAgICAgICAgICAgICAvLyBQYWdlVVBcclxuICAgICAgYnJlYWs7XHJcblxyXG5cclxuICAgIC8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0gVXBcclxuICAgIGNhc2UgJzM4JzogICAgICAgICAgICAgIC8vIHVwXHJcbiAgICAgIG5hdmlnYXRlb25GYWN0b3JBZGRJbnB1dHMoJ3VwJywgX2UpO1xyXG4gICAgICBicmVhaztcclxuXHJcblxyXG4gICAgLy8gLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSBQYWdlIERvd25cclxuICAgIGNhc2UgJzM0JzogICAgICAgICAgICAgIC8vIFBhZ2VEb3duXHJcbiAgICAgIGJyZWFrO1xyXG5cclxuXHJcbiAgICAvLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tIERvd25cclxuICAgIGNhc2UgJzQwJzogICAgICAgICAgICAgIC8vIGRvd25cclxuICAgICAgbmF2aWdhdGVvbkZhY3RvckFkZElucHV0cygnZG93bicsIF9lKTtcclxuICAgICAgYnJlYWs7XHJcblxyXG5cclxuICAgIC8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0gRW5kXHJcbiAgICBjYXNlICczNSc6ICAgICAgICAgICAgICAvLyBFbmRcclxuICAgICAgYnJlYWs7XHJcblxyXG5cclxuICAgIC8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0gSG9tZVxyXG4gICAgY2FzZSAnMzYnOiAgICAgICAgICAgICAgLy8gSG9tZVxyXG4gICAgICBicmVhaztcclxuXHJcblxyXG4gICAgLy8gLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSBMZWZ0XHJcbiAgICBjYXNlICczNyc6ICAgICAgICAgICAgICAvLyBsZWZ0XHJcbiAgICAgIG5hdmlnYXRlb25GYWN0b3JBZGRJbnB1dHMoJ2xlZnQnKTtcclxuICAgICAgYnJlYWs7XHJcblxyXG5cclxuICAgIC8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0gUmlnaHRcclxuICAgIGNhc2UgJzM5JzogICAgICAgICAgICAgIC8vIHJpZ2h0XHJcbiAgICAgIG5hdmlnYXRlb25GYWN0b3JBZGRJbnB1dHMoJ3JpZ2h0Jyk7XHJcbiAgICAgIGJyZWFrO1xyXG5cclxuICAgIC8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0gQmFja1NwYWNlXHJcbiAgICBjYXNlICc4JzogICAgICAgICAgICAgICAvLyBCYWNrIFNwYWNlXHJcbiAgICAgIGJyZWFrO1xyXG5cclxuICAgIC8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0gRGVsZXRlXHJcbiAgICBjYXNlICc0Nic6ICAgICAgICAgICAgICAvLyBkZWxldGVcclxuICAgICAgaWYoY2hlY2tfZmFjdG9yKCkpXHJcbiAgICAgIHtcclxuICAgICAgICBjbGVhckRyb3Bkb3duKCQoJy5kcm9wZG93bi5iYXJDb2RlJykpO1xyXG5cclxuICAgICAgICB2YXIgc2VsZWN0ZWRSb3dFbCA9IGdldFNlbGVjdGVkUm93KHRydWUpO1xyXG4gICAgICAgIGlmKHNlbGVjdGVkUm93RWwpXHJcbiAgICAgICAge1xyXG4gICAgICAgICAgLy8gdmFyIG5leHRTZWxlY3RlZFJvdyA9IHNlbGVjdGVkUm93RWwucHJldigpO1xyXG4gICAgICAgICAgc2VsZWN0ZWRSb3dFbC5yZW1vdmUoKTtcclxuICAgICAgICAgICQoJy5kcm9wZG93bi5iYXJDb2RlIGlucHV0LnNlYXJjaCcpLnZhbCgnJykudHJpZ2dlcihcImZvY3VzXCIpO1xyXG4gICAgICAgICAgLy8gbmF2aWdhdGlvbkZhY3RvckFkZFNldFNlbGVjdGVkKG5leHRTZWxlY3RlZFJvdywgdHJ1ZSk7XHJcbiAgICAgICAgICBjYWxjRm9vdGVyVmFsdWVzKCk7XHJcbiAgICAgICAgICBfZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgIH1cclxuICAgICAgfVxyXG4gICAgICBicmVhaztcclxuXHJcblxyXG4gICAgLy8gLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSBzaG9ydGN1dFxyXG4gICAgY2FzZSAnNjVjdHJsJzogICAgICAgICAgLy8gYSArIGN0cmxcclxuICAgICAgYnJlYWs7XHJcblxyXG4gICAgY2FzZSAnNjhzaGlmdCc6ICAgICAgICAgLy8gZCArIHNoaWZ0XHJcbiAgICAgIGJyZWFrO1xyXG5cclxuICAgIGNhc2UgJzcwJzogICAgICAgICAgICAgIC8vIGZcclxuICAgICAgYnJlYWs7XHJcblxyXG4gICAgY2FzZSAnNzJzaGlmdCc6ICAgICAgICAgLy8gaCArIHNoaWZ0IChIb21lIHBhZ2UpXHJcbiAgICAgIGJyZWFrO1xyXG5cclxuICAgIGNhc2UgJzU2c2hpZnQnOiAgICAgICAgIC8vICogfCBzaGlmdCArIDhcclxuICAgIGNhc2UgJzEwNic6ICAgICAgICAgICAgIC8vICpcclxuICAgICAgaWYoY2hlY2tfZmFjdG9yKCkpXHJcbiAgICAgIHtcclxuICAgICAgICB2YXIgUm93Q291bnRFbCA9IGdldFNlbGVjdGVkUm93KCk7XHJcbiAgICAgICAgaWYoUm93Q291bnRFbClcclxuICAgICAgICB7XHJcbiAgICAgICAgICB2YXIgUm93Q291bnRFbCA9IFJvd0NvdW50RWwuZmluZCgnaW5wdXQuY291bnQnKTtcclxuICAgICAgICAgIFJvd0NvdW50RWwudHJpZ2dlcihcInNlbGVjdFwiKTtcclxuICAgICAgICB9XHJcbiAgICAgICAgICAvLyBfZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICB9XHJcbiAgICAgIGJyZWFrO1xyXG5cclxuICAgIGNhc2UgJzEwNyc6ICAgICAgICAgICAgIC8vIHBsdXMgK1xyXG4gICAgY2FzZSAnMTg3c2hpZnQnOiAgICAgICAgLy8gcGx1cyArXHJcbiAgICAgIGlmKGNoZWNrX2ZhY3RvcigpKVxyXG4gICAgICB7XHJcbiAgICAgICAgaWYoJChcIjpmb2N1c1wiKS5wYXJlbnRzKCcuZHJvcGRvd24nKS5maW5kKCcjcHJvZHVjdFNlYXJjaCcpKVxyXG4gICAgICAgIHtcclxuICAgICAgICAgICQoJy5kcm9wZG93bi5iYXJDb2RlIGlucHV0LnNlYXJjaCcpLnRyaWdnZXIoXCJzZWxlY3RcIik7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIGVsc2VcclxuICAgICAgICB7XHJcbiAgICAgICAgICAkKCcuZHJvcGRvd24uYmFyQ29kZSBpbnB1dC5zZWFyY2gnKS50cmlnZ2VyKFwic2VsZWN0XCIpO1xyXG4gICAgICAgICAgX2UucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgICAgYnJlYWs7XHJcblxyXG4gICAgY2FzZSAnMTA5JzogICAgICAgICAgICAgLy8gbWludXMgLVxyXG4gICAgY2FzZSAnMTg5c2hpZnQnOiAgICAgICAgLy8gbWludXMgLVxyXG4gICAgICBpZihjaGVja19mYWN0b3IoKSlcclxuICAgICAge1xyXG4gICAgICAgIHZhciBSb3dEaXNjb3VudEVsID0gZ2V0U2VsZWN0ZWRSb3coKTtcclxuICAgICAgICBpZihSb3dEaXNjb3VudEVsKVxyXG4gICAgICAgIHtcclxuICAgICAgICAgIHZhciBSb3dEaXNjb3VudEVsID0gUm93RGlzY291bnRFbC5maW5kKCdpbnB1dC5kaXNjb3VudCcpO1xyXG4gICAgICAgICAgUm93RGlzY291bnRFbC50cmlnZ2VyKFwic2VsZWN0XCIpO1xyXG4gICAgICAgIH1cclxuICAgICAgICAvLyBfZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICB9XHJcbiAgICAgIGJyZWFrO1xyXG5cclxuICAgIGNhc2UgJzExMCc6ICAgICAgICAgICAgIC8vIC5cclxuICAgIGNhc2UgJzE5MCc6ICAgICAgICAgICAgIC8vIC5cclxuICAgICAgYnJlYWs7XHJcblxyXG4gICAgY2FzZSAnMTExJzogICAgICAgICAgICAgLy8gZGl2aWRlciBvbiBudW1wYWRcclxuICAgIGNhc2UgJzE5MSc6ICAgICAgICAgICAgIC8vIGRpdmlkZXJcclxuICAgICAgaWYoY2hlY2tfZmFjdG9yKCkpXHJcbiAgICAgIHtcclxuICAgICAgICBpZigkKFwiOmZvY3VzXCIpLnBhcmVudHMoJy5kcm9wZG93bicpLmZpbmQoJyNwcm9kdWN0U2VhcmNoJykpXHJcbiAgICAgICAge1xyXG4gICAgICAgICAgJCgnLmRyb3Bkb3duLmJhckNvZGUgaW5wdXQuc2VhcmNoJykudHJpZ2dlcihcInNlbGVjdFwiKTtcclxuICAgICAgICB9XHJcbiAgICAgICAgZWxzZVxyXG4gICAgICAgIHtcclxuICAgICAgICAgICQoJy5kcm9wZG93bi5iYXJDb2RlIGlucHV0LnNlYXJjaCcpLnRyaWdnZXIoXCJzZWxlY3RcIik7XHJcbiAgICAgICAgICBfZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgIH1cclxuICAgICAgfVxyXG4gICAgICBicmVhaztcclxuXHJcbiAgICBjYXNlICcxMTInOiAgICAgICAgICAgICAvLyBmMVxyXG4gICAgICBicmVhaztcclxuXHJcbiAgICBjYXNlICcxMTMnOiAgICAgICAgICAgICAvLyBmMlxyXG4gICAgICAgIC8vIHByZXZlbnQgYW55IG90aGVyIGNoYW5nZVxyXG4gICAgICAgIF9lLnByZXZlbnREZWZhdWx0KCk7XHJcblxyXG4gICAgICAgIC8vIHNldCBmYWN0b3IgdXJsXHJcbiAgICAgICAgdmFyIG15UGFnZSAgICAgPSAkKCdib2R5JykuYXR0cignZGF0YS1wYWdlJyk7XHJcbiAgICAgICAgdmFyIGZhY3RvclVybCAgPSAnL2Evc2FsZT9mcm9tPScrIG15UGFnZTtcclxuICAgICAgICB2YXIgZmFjdG9yVHlwZSA9ICQoJ2JvZHknKS5hdHRyKCdkYXRhLXBhZ2UnKTtcclxuICAgICAgICBpZigkKCdodG1sJykuYXR0cignbGFuZycpICE9PSB1bmRlZmluZWQpXHJcbiAgICAgICAge1xyXG4gICAgICAgICAgZmFjdG9yVXJsID0gJCgnaHRtbCcpLmF0dHIoJ2xhbmcnKSsgZmFjdG9yVXJsO1xyXG4gICAgICAgIH1cclxuICAgICAgICAvLyBuYXZpZ2F0ZSB0byBhZGQgbmV3IGZhY3RvciBwYWdlXHJcbiAgICAgICAgLy8gTmF2aWdhdGUoeyB1cmw6IGZhY3RvclVybCB9KTtcclxuICAgICAgICBpZihmYWN0b3JUeXBlID09PSAnc2FsZScgJiYgY2hlY2tfZmFjdG9yKCkpXHJcbiAgICAgICAge1xyXG4gICAgICAgICAgLy8gaWYgd2UgYXJlIGluIGNoZWNrIHVybCwgZmlyc3QgY2hlY2sgdGhpcyBvbmUgaXMgZW1wdHkgb3Igbm90XHJcbiAgICAgICAgICBpZihxdHlGYWN0b3JUYWJsZUl0ZW1zKCkgPT0gMClcclxuICAgICAgICAgIHtcclxuICAgICAgICAgICAgdmFyIG1zZyA9ICQoJyNmYWN0b3JBZGQnKS5hdHRyKCdkYXRhLW1zZ05ld0Vycm9yJyk7XHJcbiAgICAgICAgICAgIG5vdGlmKCd3YXJuJywgbXNnLCBudWxsLCBudWxsLCB7XCJkaXNwbGF5TW9kZVwiOiAyfSk7XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgICBlbHNlXHJcbiAgICAgICAgICB7XHJcbiAgICAgICAgICAgIHdpbmRvdy5vcGVuKGZhY3RvclVybCArICcmZXh0cmE9dHJ1ZScsICdfYmxhbmsnKTtcclxuICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgICAgZWxzZVxyXG4gICAgICAgIHtcclxuICAgICAgICAgIGlmKG15UGFnZSA9PT0gJ2NoYXBfcmVjZWlwdCcpXHJcbiAgICAgICAgICB7XHJcbiAgICAgICAgICAgIE5hdmlnYXRlKHsgdXJsOiBmYWN0b3JVcmwgfSk7XHJcbiAgICAgICAgICAgIC8vIGxvY2F0aW9uLnJlcGxhY2UoZmFjdG9yVXJsKTtcclxuICAgICAgICAgIH1cclxuICAgICAgICAgIGVsc2VcclxuICAgICAgICAgIHtcclxuICAgICAgICAgICAgd2luZG93Lm9wZW4oZmFjdG9yVXJsLCAnX2JsYW5rJyk7XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICBicmVhaztcclxuXHJcbiAgICBjYXNlICcxMTNzaGlmdCc6ICAgICAgICAvLyBzaGlmdCtmMlxyXG4gICAgICBwcmV2RmFjdG9yKCk7XHJcbiAgICAgIGJyZWFrO1xyXG5cclxuICAgIGNhc2UgJzExM2N0cmxzaGlmdCc6ICAgICAgICAvLyBzaGlmdCtmMlxyXG4gICAgICBwcmV2RmFjdG9yKHVuZGVmaW5lZCwgdHJ1ZSk7XHJcbiAgICAgIGJyZWFrO1xyXG5cclxuXHJcbiAgICBjYXNlICcxMTQnOiAgICAgICAgICAgICAvLyBmM1xyXG4gICAgY2FzZSAnMTE0Y3RybCc6ICAgICAgICAgLy8gZjMgKyBjdHJsXHJcbiAgICBjYXNlICc3MGN0cmwnOiAgICAgICAgICAvLyBmMyArIGN0cmxcclxubG9neSgkKCdpbnB1dC5zZWFyY2gnKSk7XHJcbmxvZ3koJCgnaW5wdXQuc2VhcmNoJykubGVuZ3RoKTtcclxuXHJcbiAgICAgIGlmKCQoJ2lucHV0W3R5cGU9c2VhcmNoXScpLmxlbmd0aCA9PT0gMSlcclxuICAgICAge1xyXG4gICAgICAgICQoJ2lucHV0W3R5cGU9c2VhcmNoXScpLnRyaWdnZXIoXCJmb2N1c1wiKTtcclxuICAgICAgICBfZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICB9XHJcbiAgICAgIGVsc2UgaWYoJCgnc2VsZWN0IGlucHV0LnNlYXJjaCcpLmxlbmd0aCA9PT0gMilcclxuICAgICAge1xyXG4gICAgICAgICQoJ2lucHV0LnNlYXJjaCcpLnRyaWdnZXIoXCJmb2N1c1wiKTtcclxuICAgICAgICBfZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICB9XHJcbiAgICAgIGJyZWFrO1xyXG5cclxuICAgIGNhc2UgJzExNSc6ICAgICAgICAgICAgIC8vIGY0XHJcblxyXG4gICAgICBicmVhaztcclxuXHJcbiAgICBjYXNlICcxMTgnOiAgICAgICAgICAgICAvLyBmN1xyXG4gICAgICBpZihjaGVja19mYWN0b3IoKSlcclxuICAgICAge1xyXG4gICAgICAgIHNob3J0a2V5X3RvZ2dsZURpc2NvdW50KCk7XHJcbiAgICAgICAgX2UucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgfVxyXG4gICAgICBicmVhaztcclxuXHJcbiAgICBjYXNlICcxMTknOiAgICAgICAgICAgICAvLyBmOFxyXG5cclxuICAgICAgYnJlYWs7XHJcblxyXG4gICBjYXNlICcxMjJzaGlmdCc6ICAgICAgICAgLy8gZjExICsgc2hpZnRcclxuICAgICAgYnJlYWs7XHJcblxyXG4gICBjYXNlICcxMjMnOiAgICAgICAgICAgICAgLy8gZjEyXHJcbiAgICAgIGJyZWFrO1xyXG5cclxuICAgIC8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0gbW91c2VcclxuICAgIGNhc2UgJ2NsaWNrJzogICAgICAgICAgIC8vIGNsaWNrXHJcbiAgICAgIGJyZWFrO1xyXG5cclxuICAgIGNhc2UgJ3JpZ2h0Y2xpY2snOiAgICAgICAgLy8gRG91YmxlIGNsaWNrXHJcbiAgICAgIGJyZWFrO1xyXG5cclxuICAgIGRlZmF1bHQ6ICAgICAgICAgICAgICAgIC8vIGV4aXQgdGhpcyBoYW5kbGVyIGZvciBvdGhlciBrZXlzXHJcbiAgICAgIHJldHVybjtcclxuICB9XHJcbn1cclxuXHJcblxyXG5mdW5jdGlvbiBnZXRTZWxlY3RlZFJvdyhfY29uZmlybSlcclxue1xyXG4gIGlmKGNoZWNrX2ZhY3RvcigpKVxyXG4gIHtcclxuICAgIHZhciBhYSA9ICQoJ3RhYmxlLnByb2R1Y3RMaXN0IHRib2R5IHRyJykubGVuZ3RoO1xyXG4gICAgaWYoYWEgPiAwKVxyXG4gICAge1xyXG4gICAgICB2YXIgc2VsZWN0ZWRSb3dFbCA9ICQoJ3RhYmxlLnByb2R1Y3RMaXN0IHRib2R5IHRyW2RhdGEtc2VsZWN0ZWRdJyk7XHJcbiAgICAgIGlmKHNlbGVjdGVkUm93RWwubGVuZ3RoID09IDEpXHJcbiAgICAgIHtcclxuXHJcbiAgICAgICAgLy8gc2VsZWN0ZWRSb3cgPSBzZWxlY3RlZFJvd0VsLmluZGV4KCk7XHJcbiAgICAgIH1cclxuICAgICAgZWxzZVxyXG4gICAgICB7XHJcbiAgICAgICAgaWYoX2NvbmZpcm0pXHJcbiAgICAgICAge1xyXG4gICAgICAgICAgJCgndGFibGUucHJvZHVjdExpc3QgdGJvZHkgdHI6ZXEoMCknKS5hdHRyKCdkYXRhLXNlbGVjdGVkJywgJ3dhcm4nKTtcclxuICAgICAgICAgIHJldHVybiBmYWxzZTtcclxuICAgICAgICB9XHJcbiAgICAgICAgZWxzZVxyXG4gICAgICAgIHtcclxuICAgICAgICAgIHNlbGVjdGVkUm93RWwgPSAkKCd0YWJsZS5wcm9kdWN0TGlzdCB0Ym9keSB0cjplcSgwKScpXHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcbiAgICAgIHJldHVybiBzZWxlY3RlZFJvd0VsO1xyXG4gICAgfVxyXG4gIH1cclxuICByZXR1cm4gbnVsbDtcclxufVxyXG5cclxuZnVuY3Rpb24gY2hlY2tfZmFjdG9yKClcclxue1xyXG4gIGlmKCQoJyNmYWN0b3JBZGQnKS5sZW5ndGggPiAwKVxyXG4gIHtcclxuICAgIHJldHVybiB0cnVlO1xyXG4gIH1cclxuXHJcbiAgcmV0dXJuIGZhbHNlO1xyXG59XHJcblxyXG5cclxuIl19
