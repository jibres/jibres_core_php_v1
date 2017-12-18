

/**
 * [bindShortkey description]
 * @return {[type]} [description]
 */
function bindShortkey()
{
  $(document).keydown(function(_e) { event_corridor.call(this, _e)});
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
  // console.log(mytxt);


  switch(mytxt)
  {
    // ---------------------------------------------------------- Enter
    case '13':              // Enter
      break;

    case '13ctrl':          // ctrl + Enter
    case '106':             // *
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
    // ---------------------------------------------------------- Up
    case '38':              // up
      if(check_factor())
      {
        var aa = $('table.productList tbody tr').length;
        $('table.productList tbody tr').attr('data-selected', '');
        console.log(aa);
      }
      console.log('up');
      break;


    // ---------------------------------------------------------- Page Down
    case '34':              // PageDown
    // ---------------------------------------------------------- Down
    case '40':              // down
      break;


    // ---------------------------------------------------------- End
    case '35':              // End
      break;


    // ---------------------------------------------------------- Home
    case '36':              // Home
      break;


    // ---------------------------------------------------------- Left
    case '37':              // left
      break;


    // ---------------------------------------------------------- Right
    case '39':              // right
      break;

    // ---------------------------------------------------------- BackSpace
    case '8':               // Back Space
    // ---------------------------------------------------------- Delete
    case '46':              // delete
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

    case '107':             // plus +
    case '187shift':        // plus +
      break;

    case '109':             // minus -
    case '189shift':        // minus -
      break;

    case '110':             // .
    case '190':             // .
      break;

    case '112':             // f1
      break;

    case '113':             // f2
      break;

    case '115':             // f4
      if(check_factor())
      {
        $("#save_next").click();
      }
      break;

    case '119':             // f8
      if(check_factor())
      {
        $("#save_print").click();
      }
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


function check_factor()
{
  if($('body').attr('data-page') === 'sell_add')
  {
    return true;
  }

  return false;
}


