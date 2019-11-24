
function cleaveRunner()
{
  $('input[data-format]').each(function()
  {
    var myFormat = $(this).attr('data-format');
    var opt = {};

    switch ($(this).attr('data-format'))
    {
      case "number":
        opt.numeral = true;
        break;

      case "int":
        opt.numeral = true,
        opt.numeralDecimalScale = 0
        break;

      case "toman":
        opt.  numeral = true;
        opt.  prefix = ' تومان';
        break;

      case "date":
        opt.date = true;
        opt.datePattern = ['Y', 'm', 'd'];
        break;

      case "time":
        opt.time = true;
        opt.timePattern = ['h', 'm'];
        break;

      case "creditCard":
        opt.creditCard = true;
        break;


      case "phone":
        opt.numericOnly = true;
        opt.blocks = [0, 3, 0, 3, 4];
        opt.delimiters = ["(", ")", " ", "-"];
        break;

      case "phone-14":
        opt.numericOnly = true;
        opt.blocks = [0, 2, 0, 3, 0, 3, 4];
        opt.delimiters = ["+", " ", "(", ")", " ", "-"];
        break;

      case "phone-ir":
        opt.phone = true;
        opt.phoneRegionCode = 'IR';
        break;

      case "phone-us":
        opt.phone = true;
        opt.phoneRegionCode = 'IR';
        break;

      default:
        opt.numeral = true;
        break;
    }

    new Cleave($(this), opt);
  });

}
