/*!
* jquery.counterup.js 1.0
*
* Copyright 2013, Benjamin Intal http://gambit.ph @bfintal
* Released under the GPL v2 License
*
* Date: Nov 26, 2013
*/
(function( $ ){
  "use strict";

  $.fn.counterUp = function( options )
  {

    // Defaults
    var settings = $.extend(
    {
        'time': 10000,
        'delay': 50
    }, options);

    return this.each(function()
    {

        // Store the object
        var $this = $(this);
        var $settings = settings;

        var counterUpper = function()
        {
            var nums          = [];
            var num           = $this.text();
            if($this.attr('data-counter'))
            {
                num = $this.attr('data-counter');
            }
            else
            {
                // try to convert to en numbers
                num = num.toEnglish();
            }
            var isComma       = /[0-9]+,[0-9]+/.test(num);
            num               = num.replace(/,/g, '');
            var isInt         = /^[0-9]+$/.test(num);
            var isFloat       = /^[0-9]+\.[0-9]+$/.test(num);
            var decimalPlaces = isFloat ? (num.split('.')[1] || []).length : 0;
            var divisions     = $settings.time / $settings.delay;

            // Generate list of incremental numbers to display
            for (var i = divisions; i >= 1; i--)
            {

                // Preserve as int if input was int
                var newNum = parseInt(num / divisions * i);

                // Preserve float if input was float
                if (isFloat)
                {
                    newNum = parseFloat(num / divisions * i).toFixed(decimalPlaces);
                }

                // Preserve commas if input had commas
                if (isComma)
                {
                    while (/(\d+)(\d{3})/.test(newNum.toString()))
                    {
                        newNum = newNum.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
                    }
                }

                nums.unshift(newNum);
            }

            $this.data('counterup-nums', nums);
            $this.text(fitNumber('0', false));

            // Updates the number until we're done
            var f = function()
            {
                // try to fix bug if el is not exist
                var counterUpNums = $this.data('counterup-nums');
                if(!counterUpNums)
                {
                    return null;
                }

                counterUpNums = fitNumber(counterUpNums.shift(), false);
                $this.text(counterUpNums);


                if ($this.data('counterup-nums').length)
                {
                    setTimeout($this.data('counterup-func'), $settings.delay);
                }
                else
                {
                    delete $this.data('counterup-nums');
                    $this.data('counterup-nums', null);
                    $this.data('counterup-func', null);
                }
            };
            $this.data('counterup-func', f);

            // Start the count up
            setTimeout($this.data('counterup-func'), $settings.delay);
        };

        // Perform counts when the element gets into view
        counterUpper();
        // $this.waypoint(counterUpper, { offset: '100%', triggerOnce: true });
    });

  };

})( jQuery );