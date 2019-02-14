

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


//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNob3J0a2V5LmpzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsImZpbGUiOiJzdG9yZVBhbmVsLnNyYy5qcyIsInNvdXJjZXNDb250ZW50IjpbIlxyXG5cclxuLyoqXHJcbiAqIFtiaW5kU2hvcnRrZXkgZGVzY3JpcHRpb25dXHJcbiAqIEByZXR1cm4ge1t0eXBlXX0gW2Rlc2NyaXB0aW9uXVxyXG4gKi9cclxuZnVuY3Rpb24gYmluZFNob3J0a2V5KClcclxue1xyXG4gICQoZG9jdW1lbnQpLm9uKFwia2V5ZG93blwiLCBmdW5jdGlvbihfZSkgeyBldmVudF9jb3JyaWRvci5jYWxsKHRoaXMsIF9lKX0pO1xyXG4gIC8vICQoJ3VsIGxpJywgZXhwbG9yZXIpLmNsaWNrKGZ1bmN0aW9uKGUpICAgIHsgZXZlbnRfY29ycmlkb3IoZSwgZS5jdXJyZW50VGFyZ2V0LCAnY2xpY2snKTsgICAgfSk7XHJcbn1cclxuXHJcbi8qKlxyXG4gKiBjb3JyaWRvciBvZiBhbGwgZXZlbnRzIG9uIGtleWJvYXJkIGFuZCBtb3VzZVxyXG4gKiBAcGFyYW0gIHtbdHlwZV19IGUgICAgIHRoZSBlbGVtZW50IHRoYXQgZXZlbnQgZG9pbmcgb24gdGhhdFxyXG4gKiBAcGFyYW0gIHtbdHlwZV19IF9zZWxmIHNlcGVyYXRlZCBlbGVtZW50IGZvciBkb2luZyBqb2JzIG9uIGl0XHJcbiAqIEBwYXJhbSAge1t0eXBlXX0gX2tleSAgdGhlIGtleSBwcmVzc2VkIG9yIGNsaWNrIG9yIGFub3RoZXIgZXZlbnRzXHJcbiAqIEByZXR1cm4ge1t0eXBlXX0gICAgICAgdm9pZCBmdW5jIG5vdCByZXR1cm5pbmcgdmFsdWUhIG9ubHkgZG9pbmcgam9iXHJcbiAqL1xyXG5mdW5jdGlvbiBldmVudF9jb3JyaWRvcihfZSwgX3NlbGYsIF9rZXkpXHJcbntcclxuICBpZighX2tleSlcclxuICB7XHJcbiAgICBfa2V5ID0gX2Uud2hpY2g7XHJcbiAgfVxyXG5cclxuICBfc2VsZiA9ICQoX3NlbGYpO1xyXG4gIHZhciBjdHJsICAgPSBfZS5jdHJsS2V5ICA/ICdjdHJsJyAgOiAnJztcclxuICB2YXIgc2hpZnQgID0gX2Uuc2hpZnRLZXkgPyAnc2hpZnQnIDogJyc7XHJcbiAgdmFyIGFsdCAgICA9IF9lLmFsdEtleSAgID8gJ2FsdCcgICA6ICcnO1xyXG4gIHZhciBteXR4dCAgPSBTdHJpbmcoX2tleSkgKyBjdHJsICsgYWx0ICsgc2hpZnQ7XHJcbiAgdmFyIGtleXAgICA9IFN0cmluZy5mcm9tQ2hhckNvZGUoX2tleSk7XHJcblxyXG4gIC8vIGxvZ3kobXl0eHQsICdpbmZvJyk7XHJcbiAgc3dpdGNoKG15dHh0KVxyXG4gIHtcclxuICAgIC8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0gRW50ZXJcclxuICAgIGNhc2UgJzEzJzogICAgICAgICAgICAgIC8vIEVudGVyXHJcbiAgICAgIGJyZWFrO1xyXG5cclxuICAgIGNhc2UgJzEzY3RybCc6ICAgICAgICAgIC8vIGN0cmwgKyBFbnRlclxyXG4gICAgICBicmVhaztcclxuXHJcblxyXG4gICAgLy8gLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSBFc2NhcGVcclxuICAgIGNhc2UgJzI3JzogICAgICAgICAgICAgIC8vRXNjYXBlXHJcbiAgICAgIGJyZWFrO1xyXG5cclxuXHJcbiAgICAvLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tIFNwYWNlXHJcbiAgICBjYXNlICczMic6ICAgICAgICAgICAgICAvLyBzcGFjZVxyXG4gICAgY2FzZSAnMzJzaGlmdCc6ICAgICAgICAgLy8gc3BhY2UgKyBzaGlmdFxyXG4gICAgY2FzZSAnMzJjdHJsJzogICAgICAgICAgLy8gc3BhY2UgKyBjdHJsXHJcbiAgICBjYXNlICczMmN0cmxzaGlmdCc6ICAgICAvLyBzcGFjZSArIGN0cmwgKyBzaGlmdFxyXG5cclxuICAgICAgYnJlYWs7XHJcblxyXG5cclxuICAgIC8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0gUGFnZSBVcFxyXG4gICAgY2FzZSAnMzMnOiAgICAgICAgICAgICAgLy8gUGFnZVVQXHJcbiAgICAgIGJyZWFrO1xyXG5cclxuXHJcbiAgICAvLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tIFVwXHJcbiAgICBjYXNlICczOCc6ICAgICAgICAgICAgICAvLyB1cFxyXG4gICAgICBuYXZpZ2F0ZW9uRmFjdG9yQWRkSW5wdXRzKCd1cCcsIF9lKTtcclxuICAgICAgYnJlYWs7XHJcblxyXG5cclxuICAgIC8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0gUGFnZSBEb3duXHJcbiAgICBjYXNlICczNCc6ICAgICAgICAgICAgICAvLyBQYWdlRG93blxyXG4gICAgICBicmVhaztcclxuXHJcblxyXG4gICAgLy8gLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSBEb3duXHJcbiAgICBjYXNlICc0MCc6ICAgICAgICAgICAgICAvLyBkb3duXHJcbiAgICAgIG5hdmlnYXRlb25GYWN0b3JBZGRJbnB1dHMoJ2Rvd24nLCBfZSk7XHJcbiAgICAgIGJyZWFrO1xyXG5cclxuXHJcbiAgICAvLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tIEVuZFxyXG4gICAgY2FzZSAnMzUnOiAgICAgICAgICAgICAgLy8gRW5kXHJcbiAgICAgIGJyZWFrO1xyXG5cclxuXHJcbiAgICAvLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tIEhvbWVcclxuICAgIGNhc2UgJzM2JzogICAgICAgICAgICAgIC8vIEhvbWVcclxuICAgICAgYnJlYWs7XHJcblxyXG5cclxuICAgIC8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0gTGVmdFxyXG4gICAgY2FzZSAnMzcnOiAgICAgICAgICAgICAgLy8gbGVmdFxyXG4gICAgICBuYXZpZ2F0ZW9uRmFjdG9yQWRkSW5wdXRzKCdsZWZ0Jyk7XHJcbiAgICAgIGJyZWFrO1xyXG5cclxuXHJcbiAgICAvLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tIFJpZ2h0XHJcbiAgICBjYXNlICczOSc6ICAgICAgICAgICAgICAvLyByaWdodFxyXG4gICAgICBuYXZpZ2F0ZW9uRmFjdG9yQWRkSW5wdXRzKCdyaWdodCcpO1xyXG4gICAgICBicmVhaztcclxuXHJcbiAgICAvLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tIEJhY2tTcGFjZVxyXG4gICAgY2FzZSAnOCc6ICAgICAgICAgICAgICAgLy8gQmFjayBTcGFjZVxyXG4gICAgICBicmVhaztcclxuXHJcbiAgICAvLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tIERlbGV0ZVxyXG4gICAgY2FzZSAnNDYnOiAgICAgICAgICAgICAgLy8gZGVsZXRlXHJcbiAgICAgIGlmKGNoZWNrX2ZhY3RvcigpKVxyXG4gICAgICB7XHJcbiAgICAgICAgY2xlYXJEcm9wZG93bigkKCcuZHJvcGRvd24uYmFyQ29kZScpKTtcclxuXHJcbiAgICAgICAgdmFyIHNlbGVjdGVkUm93RWwgPSBnZXRTZWxlY3RlZFJvdyh0cnVlKTtcclxuICAgICAgICBpZihzZWxlY3RlZFJvd0VsKVxyXG4gICAgICAgIHtcclxuICAgICAgICAgIC8vIHZhciBuZXh0U2VsZWN0ZWRSb3cgPSBzZWxlY3RlZFJvd0VsLnByZXYoKTtcclxuICAgICAgICAgIHNlbGVjdGVkUm93RWwucmVtb3ZlKCk7XHJcbiAgICAgICAgICAkKCcuZHJvcGRvd24uYmFyQ29kZSBpbnB1dC5zZWFyY2gnKS52YWwoJycpLnRyaWdnZXIoXCJmb2N1c1wiKTtcclxuICAgICAgICAgIC8vIG5hdmlnYXRpb25GYWN0b3JBZGRTZXRTZWxlY3RlZChuZXh0U2VsZWN0ZWRSb3csIHRydWUpO1xyXG4gICAgICAgICAgY2FsY0Zvb3RlclZhbHVlcygpO1xyXG4gICAgICAgICAgX2UucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgICAgYnJlYWs7XHJcblxyXG5cclxuICAgIC8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0gc2hvcnRjdXRcclxuICAgIGNhc2UgJzY1Y3RybCc6ICAgICAgICAgIC8vIGEgKyBjdHJsXHJcbiAgICAgIGJyZWFrO1xyXG5cclxuICAgIGNhc2UgJzY4c2hpZnQnOiAgICAgICAgIC8vIGQgKyBzaGlmdFxyXG4gICAgICBicmVhaztcclxuXHJcbiAgICBjYXNlICc3MCc6ICAgICAgICAgICAgICAvLyBmXHJcbiAgICAgIGJyZWFrO1xyXG5cclxuICAgIGNhc2UgJzcyc2hpZnQnOiAgICAgICAgIC8vIGggKyBzaGlmdCAoSG9tZSBwYWdlKVxyXG4gICAgICBicmVhaztcclxuXHJcbiAgICBjYXNlICc1NnNoaWZ0JzogICAgICAgICAvLyAqIHwgc2hpZnQgKyA4XHJcbiAgICBjYXNlICcxMDYnOiAgICAgICAgICAgICAvLyAqXHJcbiAgICAgIGlmKGNoZWNrX2ZhY3RvcigpKVxyXG4gICAgICB7XHJcbiAgICAgICAgdmFyIFJvd0NvdW50RWwgPSBnZXRTZWxlY3RlZFJvdygpO1xyXG4gICAgICAgIGlmKFJvd0NvdW50RWwpXHJcbiAgICAgICAge1xyXG4gICAgICAgICAgdmFyIFJvd0NvdW50RWwgPSBSb3dDb3VudEVsLmZpbmQoJ2lucHV0LmNvdW50Jyk7XHJcbiAgICAgICAgICBSb3dDb3VudEVsLnRyaWdnZXIoXCJzZWxlY3RcIik7XHJcbiAgICAgICAgfVxyXG4gICAgICAgICAgLy8gX2UucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgfVxyXG4gICAgICBicmVhaztcclxuXHJcbiAgICBjYXNlICcxMDcnOiAgICAgICAgICAgICAvLyBwbHVzICtcclxuICAgIGNhc2UgJzE4N3NoaWZ0JzogICAgICAgIC8vIHBsdXMgK1xyXG4gICAgICBpZihjaGVja19mYWN0b3IoKSlcclxuICAgICAge1xyXG4gICAgICAgIGlmKCQoXCI6Zm9jdXNcIikucGFyZW50cygnLmRyb3Bkb3duJykuZmluZCgnI3Byb2R1Y3RTZWFyY2gnKSlcclxuICAgICAgICB7XHJcbiAgICAgICAgICAkKCcuZHJvcGRvd24uYmFyQ29kZSBpbnB1dC5zZWFyY2gnKS50cmlnZ2VyKFwic2VsZWN0XCIpO1xyXG4gICAgICAgIH1cclxuICAgICAgICBlbHNlXHJcbiAgICAgICAge1xyXG4gICAgICAgICAgJCgnLmRyb3Bkb3duLmJhckNvZGUgaW5wdXQuc2VhcmNoJykudHJpZ2dlcihcInNlbGVjdFwiKTtcclxuICAgICAgICAgIF9lLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcbiAgICAgIGJyZWFrO1xyXG5cclxuICAgIGNhc2UgJzEwOSc6ICAgICAgICAgICAgIC8vIG1pbnVzIC1cclxuICAgIGNhc2UgJzE4OXNoaWZ0JzogICAgICAgIC8vIG1pbnVzIC1cclxuICAgICAgaWYoY2hlY2tfZmFjdG9yKCkpXHJcbiAgICAgIHtcclxuICAgICAgICB2YXIgUm93RGlzY291bnRFbCA9IGdldFNlbGVjdGVkUm93KCk7XHJcbiAgICAgICAgaWYoUm93RGlzY291bnRFbClcclxuICAgICAgICB7XHJcbiAgICAgICAgICB2YXIgUm93RGlzY291bnRFbCA9IFJvd0Rpc2NvdW50RWwuZmluZCgnaW5wdXQuZGlzY291bnQnKTtcclxuICAgICAgICAgIFJvd0Rpc2NvdW50RWwudHJpZ2dlcihcInNlbGVjdFwiKTtcclxuICAgICAgICB9XHJcbiAgICAgICAgLy8gX2UucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgfVxyXG4gICAgICBicmVhaztcclxuXHJcbiAgICBjYXNlICcxMTAnOiAgICAgICAgICAgICAvLyAuXHJcbiAgICBjYXNlICcxOTAnOiAgICAgICAgICAgICAvLyAuXHJcbiAgICAgIGJyZWFrO1xyXG5cclxuICAgIGNhc2UgJzExMSc6ICAgICAgICAgICAgIC8vIGRpdmlkZXIgb24gbnVtcGFkXHJcbiAgICBjYXNlICcxOTEnOiAgICAgICAgICAgICAvLyBkaXZpZGVyXHJcbiAgICAgIGlmKGNoZWNrX2ZhY3RvcigpKVxyXG4gICAgICB7XHJcbiAgICAgICAgaWYoJChcIjpmb2N1c1wiKS5wYXJlbnRzKCcuZHJvcGRvd24nKS5maW5kKCcjcHJvZHVjdFNlYXJjaCcpKVxyXG4gICAgICAgIHtcclxuICAgICAgICAgICQoJy5kcm9wZG93bi5iYXJDb2RlIGlucHV0LnNlYXJjaCcpLnRyaWdnZXIoXCJzZWxlY3RcIik7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIGVsc2VcclxuICAgICAgICB7XHJcbiAgICAgICAgICAkKCcuZHJvcGRvd24uYmFyQ29kZSBpbnB1dC5zZWFyY2gnKS50cmlnZ2VyKFwic2VsZWN0XCIpO1xyXG4gICAgICAgICAgX2UucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgICAgYnJlYWs7XHJcblxyXG4gICAgY2FzZSAnMTEyJzogICAgICAgICAgICAgLy8gZjFcclxuICAgICAgYnJlYWs7XHJcblxyXG4gICAgY2FzZSAnMTEzJzogICAgICAgICAgICAgLy8gZjJcclxuICAgICAgICAvLyBwcmV2ZW50IGFueSBvdGhlciBjaGFuZ2VcclxuICAgICAgICBfZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG5cclxuICAgICAgICAvLyBzZXQgZmFjdG9yIHVybFxyXG4gICAgICAgIHZhciBteVBhZ2UgICAgID0gJCgnYm9keScpLmF0dHIoJ2RhdGEtcGFnZScpO1xyXG4gICAgICAgIHZhciBmYWN0b3JVcmwgID0gJy9hL3NhbGU/ZnJvbT0nKyBteVBhZ2U7XHJcbiAgICAgICAgdmFyIGZhY3RvclR5cGUgPSAkKCdib2R5JykuYXR0cignZGF0YS1wYWdlJyk7XHJcbiAgICAgICAgaWYoJCgnaHRtbCcpLmF0dHIoJ2xhbmcnKSAhPT0gdW5kZWZpbmVkKVxyXG4gICAgICAgIHtcclxuICAgICAgICAgIGZhY3RvclVybCA9ICQoJ2h0bWwnKS5hdHRyKCdsYW5nJykrIGZhY3RvclVybDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLy8gbmF2aWdhdGUgdG8gYWRkIG5ldyBmYWN0b3IgcGFnZVxyXG4gICAgICAgIC8vIE5hdmlnYXRlKHsgdXJsOiBmYWN0b3JVcmwgfSk7XHJcbiAgICAgICAgaWYoZmFjdG9yVHlwZSA9PT0gJ3NhbGUnICYmIGNoZWNrX2ZhY3RvcigpKVxyXG4gICAgICAgIHtcclxuICAgICAgICAgIC8vIGlmIHdlIGFyZSBpbiBjaGVjayB1cmwsIGZpcnN0IGNoZWNrIHRoaXMgb25lIGlzIGVtcHR5IG9yIG5vdFxyXG4gICAgICAgICAgaWYocXR5RmFjdG9yVGFibGVJdGVtcygpID09IDApXHJcbiAgICAgICAgICB7XHJcbiAgICAgICAgICAgIHZhciBtc2cgPSAkKCcjZmFjdG9yQWRkJykuYXR0cignZGF0YS1tc2dOZXdFcnJvcicpO1xyXG4gICAgICAgICAgICBub3RpZignd2FybicsIG1zZywgbnVsbCwgbnVsbCwge1wiZGlzcGxheU1vZGVcIjogMn0pO1xyXG4gICAgICAgICAgfVxyXG4gICAgICAgICAgZWxzZVxyXG4gICAgICAgICAge1xyXG4gICAgICAgICAgICB3aW5kb3cub3BlbihmYWN0b3JVcmwgKyAnJmV4dHJhPXRydWUnLCAnX2JsYW5rJyk7XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICAgIGVsc2VcclxuICAgICAgICB7XHJcbiAgICAgICAgICBpZihteVBhZ2UgPT09ICdjaGFwX3JlY2VpcHQnKVxyXG4gICAgICAgICAge1xyXG4gICAgICAgICAgICBOYXZpZ2F0ZSh7IHVybDogZmFjdG9yVXJsIH0pO1xyXG4gICAgICAgICAgICAvLyBsb2NhdGlvbi5yZXBsYWNlKGZhY3RvclVybCk7XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgICBlbHNlXHJcbiAgICAgICAgICB7XHJcbiAgICAgICAgICAgIHdpbmRvdy5vcGVuKGZhY3RvclVybCwgJ19ibGFuaycpO1xyXG4gICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgYnJlYWs7XHJcblxyXG4gICAgY2FzZSAnMTEzc2hpZnQnOiAgICAgICAgLy8gc2hpZnQrZjJcclxuICAgICAgcHJldkZhY3RvcigpO1xyXG4gICAgICBicmVhaztcclxuXHJcbiAgICBjYXNlICcxMTNjdHJsc2hpZnQnOiAgICAgICAgLy8gc2hpZnQrZjJcclxuICAgICAgcHJldkZhY3Rvcih1bmRlZmluZWQsIHRydWUpO1xyXG4gICAgICBicmVhaztcclxuXHJcblxyXG4gICAgY2FzZSAnMTE0JzogICAgICAgICAgICAgLy8gZjNcclxuICAgIGNhc2UgJzExNGN0cmwnOiAgICAgICAgIC8vIGYzICsgY3RybFxyXG4gICAgY2FzZSAnNzBjdHJsJzogICAgICAgICAgLy8gZjMgKyBjdHJsXHJcbmxvZ3koJCgnaW5wdXQuc2VhcmNoJykpO1xyXG5sb2d5KCQoJ2lucHV0LnNlYXJjaCcpLmxlbmd0aCk7XHJcblxyXG4gICAgICBpZigkKCdpbnB1dFt0eXBlPXNlYXJjaF0nKS5sZW5ndGggPT09IDEpXHJcbiAgICAgIHtcclxuICAgICAgICAkKCdpbnB1dFt0eXBlPXNlYXJjaF0nKS50cmlnZ2VyKFwiZm9jdXNcIik7XHJcbiAgICAgICAgX2UucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgfVxyXG4gICAgICBlbHNlIGlmKCQoJ3NlbGVjdCBpbnB1dC5zZWFyY2gnKS5sZW5ndGggPT09IDIpXHJcbiAgICAgIHtcclxuICAgICAgICAkKCdpbnB1dC5zZWFyY2gnKS50cmlnZ2VyKFwiZm9jdXNcIik7XHJcbiAgICAgICAgX2UucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgfVxyXG4gICAgICBicmVhaztcclxuXHJcbiAgICBjYXNlICcxMTUnOiAgICAgICAgICAgICAvLyBmNFxyXG5cclxuICAgICAgYnJlYWs7XHJcblxyXG4gICAgY2FzZSAnMTE4JzogICAgICAgICAgICAgLy8gZjdcclxuICAgICAgaWYoY2hlY2tfZmFjdG9yKCkpXHJcbiAgICAgIHtcclxuICAgICAgICBzaG9ydGtleV90b2dnbGVEaXNjb3VudCgpO1xyXG4gICAgICAgIF9lLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgIH1cclxuICAgICAgYnJlYWs7XHJcblxyXG4gICAgY2FzZSAnMTE5JzogICAgICAgICAgICAgLy8gZjhcclxuXHJcbiAgICAgIGJyZWFrO1xyXG5cclxuICAgY2FzZSAnMTIyc2hpZnQnOiAgICAgICAgIC8vIGYxMSArIHNoaWZ0XHJcbiAgICAgIGJyZWFrO1xyXG5cclxuICAgY2FzZSAnMTIzJzogICAgICAgICAgICAgIC8vIGYxMlxyXG4gICAgICBicmVhaztcclxuXHJcbiAgICAvLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tIG1vdXNlXHJcbiAgICBjYXNlICdjbGljayc6ICAgICAgICAgICAvLyBjbGlja1xyXG4gICAgICBicmVhaztcclxuXHJcbiAgICBjYXNlICdyaWdodGNsaWNrJzogICAgICAgIC8vIERvdWJsZSBjbGlja1xyXG4gICAgICBicmVhaztcclxuXHJcbiAgICBkZWZhdWx0OiAgICAgICAgICAgICAgICAvLyBleGl0IHRoaXMgaGFuZGxlciBmb3Igb3RoZXIga2V5c1xyXG4gICAgICByZXR1cm47XHJcbiAgfVxyXG59XHJcblxyXG5cclxuZnVuY3Rpb24gZ2V0U2VsZWN0ZWRSb3coX2NvbmZpcm0pXHJcbntcclxuICBpZihjaGVja19mYWN0b3IoKSlcclxuICB7XHJcbiAgICB2YXIgYWEgPSAkKCd0YWJsZS5wcm9kdWN0TGlzdCB0Ym9keSB0cicpLmxlbmd0aDtcclxuICAgIGlmKGFhID4gMClcclxuICAgIHtcclxuICAgICAgdmFyIHNlbGVjdGVkUm93RWwgPSAkKCd0YWJsZS5wcm9kdWN0TGlzdCB0Ym9keSB0cltkYXRhLXNlbGVjdGVkXScpO1xyXG4gICAgICBpZihzZWxlY3RlZFJvd0VsLmxlbmd0aCA9PSAxKVxyXG4gICAgICB7XHJcblxyXG4gICAgICAgIC8vIHNlbGVjdGVkUm93ID0gc2VsZWN0ZWRSb3dFbC5pbmRleCgpO1xyXG4gICAgICB9XHJcbiAgICAgIGVsc2VcclxuICAgICAge1xyXG4gICAgICAgIGlmKF9jb25maXJtKVxyXG4gICAgICAgIHtcclxuICAgICAgICAgICQoJ3RhYmxlLnByb2R1Y3RMaXN0IHRib2R5IHRyOmVxKDApJykuYXR0cignZGF0YS1zZWxlY3RlZCcsICd3YXJuJyk7XHJcbiAgICAgICAgICByZXR1cm4gZmFsc2U7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIGVsc2VcclxuICAgICAgICB7XHJcbiAgICAgICAgICBzZWxlY3RlZFJvd0VsID0gJCgndGFibGUucHJvZHVjdExpc3QgdGJvZHkgdHI6ZXEoMCknKVxyXG4gICAgICAgIH1cclxuICAgICAgfVxyXG4gICAgICByZXR1cm4gc2VsZWN0ZWRSb3dFbDtcclxuICAgIH1cclxuICB9XHJcbiAgcmV0dXJuIG51bGw7XHJcbn1cclxuXHJcbmZ1bmN0aW9uIGNoZWNrX2ZhY3RvcigpXHJcbntcclxuICBpZigkKCcjZmFjdG9yQWRkJykubGVuZ3RoID4gMClcclxuICB7XHJcbiAgICByZXR1cm4gdHJ1ZTtcclxuICB9XHJcblxyXG4gIHJldHVybiBmYWxzZTtcclxufVxyXG5cclxuXHJcbiJdfQ==
