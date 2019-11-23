
function handleEnterEvents()
{
	logy('welcome to enter;)');
	// on successfull load check mobile
	// run for each input
	$('input').on('input', function()
	{
		runDataRequire();
		autoSubmitVerifyCode();
	});
	allowTogglePass();
	runTimer();
	// add check handler to all data-require elements
	runDataRequire(true);
}



function autoSubmitVerifyCode()
{
	var codeEl = $('#code[name="code"]');

	if(codeEl.length)
	{
		if(codeEl.val().length === 5)
		{
			codeEl.parents('form').submit();
		}
	}
}


function runDataRequire(_firstTime)
{
	// check on start
	$("[data-require]").each(function()
	{
		var $this        = $(this);
		var requireEl    = $this.attr('data-require');
		var requireElVal = $('#'+ requireEl).val();
		var checkResult  = null;

		switch(requireEl)
		{
			case 'mobile':
				checkResult = validateMobile(requireElVal);
				break;

			case 'usercode':
				checkResult = validateUsercode(requireElVal);
				break;
		}


		// logy(checkResult);
		// if its true and okay show it
		if(checkResult)
		{
			if(!_firstTime)
			{
				$this.slideDown(300);
			}
			$this.removeClass('hide');
		}
		else
		{
			if(_firstTime)
			{
				$this.addClass('hide');
			}
			else
			{
				$this.slideUp(200, function()
				{
					$this.addClass('hide');
				});
			}
		}
	});
}





function allowTogglePass()
{
	$('#eramzNew label, #eramz label').on('click', function()
	{
		var inputEl = $(this).parent().find('input');
		var oldVal  = inputEl.attr('type');

		if(oldVal === 'password')
		{
			inputEl.attr('type', 'text');
		}
		else
		{
			inputEl.attr('type', 'password');
		}
	});
}


function runTimer()
{
	$('[data-timer]').each(function(_index, _el)
	{
		startTimer($(_el).attr('data-timer'), $(_el));
	});
}


function startTimer(duration, display)
{
	var timer      = duration, minutes, seconds;
	var myInterval = setInterval(function ()
	{
		minutes = parseInt(timer / 60, 10)
		seconds = parseInt(timer % 60, 10);

		minutes = minutes < 10 ? "0" + minutes : minutes;
		seconds = seconds < 10 ? "0" + seconds : seconds;

		display.text(minutes + ":" + seconds);


		if (--timer <= 0)
		{
			if(display.attr('data-href'))
			{
				display.attr('href', display.attr('data-href'));
			}

			if(display.attr('data-text'))
			{
				display.fadeOut(function()
				{
					$(this).text(display.attr('data-text'));
				}).fadeIn();
			}

			logy('finish');
			clearInterval(myInterval);
			// timer = duration;
		}
	}, 1000);
}



function validateUsercode(_user)
{
	if(!_user)
	{
		return null;
	}
	// convert to string for continue
	_user    = _user.toString();
	// define variables
	var numLen = _user.length;
	var result = null;
	// logy(numLen);
	// if len is true then check another filters
	if(numLen >= 5 && numLen <= 30)
	{
		result = true;
	}
	else
	{
		result = false;
	}
	return result;
}



/**
 * [validateMobile description]
 * @param  {[type]} _number [description]
 * @return {[type]}         [description]
 */
function validateMobile(_number)
{
	if(!_number)
	{
		return null;
	}
	// parse as integer to remove zero from start of number
	// _number = parseInt(_number);
	// convert to string for continue
	_number    = _number.toString();
	// define variables
	var result = true;
	var numLen = _number.length;
	// if len is true then check another filters
	if(numLen >= 7 && numLen <= 15)
	{
		// this is iranian number probably
		if(validateIranMobile(_number, true))
		{
			if($('html').attr('lang') === 'fa')
			{
				result = validateIranMobile(_number);
			}
			else
			{
				// do nothing!
				// if have problem comment below code
				result = validateIranMobile(_number);
			}
		}
	}
	else
	{
		result = false;
	}

	return result;
}


/**
 * [validateIranMobile description]
 * @param  {[type]} _number    [description]
 * @param  {[type]} _onlyCheck [description]
 * @return {[type]}            [description]
 */
function validateIranMobile(_number, _onlyCheck)
{
	var status = null
	if(_onlyCheck === true)
	{
		status = !!_number.match(/^((\+|00)?98|0)?9[0-3](\d{0,15})$/);
	}
	else
	{
		status = !!_number.match(/^((\+|00)?98|0)?9[0-3](\d{8})$/);
	}

	return status;
}

