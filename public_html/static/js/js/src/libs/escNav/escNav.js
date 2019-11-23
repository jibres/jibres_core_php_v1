

function escPressed()
{
	$myFocus = $(":focus");
	// if user focused on everything remove focus from it
	if($myFocus.length > 0)
	{
		// if($myFocus.is('input') || $myFocus.is('textarea') || $myFocus.is('select'))
		// {
		// 	$myFocus.trigger("blur");
		// }

		$myFocus.trigger("blur");
		return true;
	}

	// save press counter in sessionStorage
	var pressCounter = null;
	if(typeof(Storage) !== "undefined")
	{
		pressCounter = parseInt(sessionStorage.getItem("escCounter"));
		if(isNaN(pressCounter))
		{
			pressCounter = 0;
		}
		pressCounter += 1;
		sessionStorage.setItem("escCounter", pressCounter);
	}

	// detect url and try to go one level up
	var myNewAddr    = window.location.protocol + '//';
	var myHost       = window.location.host;
	var myPath       = window.location.pathname;
	var hardRedirect = null;
	if(myPath.substring(0, 1) === '/')
	{
		myPath = myPath.substring(1);
	}

	if(myPath)
	{
		var myContent = $('body').attr('data-in');
		var myPage    = $('body').attr('data-page');
		// clean value
		if(myContent === 'site')
		{
			myContent = null;
		}
		if(myPage === 'home')
		{
			myPage = null;
		}

		// try to remove path if exist
		if(myPage)
		{
			// go to site base in all condition
			myNewAddr += myHost + '/';
			if(myContent)
			{
				// go to root of this contenct
				myNewAddr += myContent;
			}
		}
		else
		{
			myNewAddr    += myHost + '/';
			hardRedirect = true;
		}

	}
	else
	{
		if(myHost.split('.').length > 2)
		{
			// we dont have path, try to remove subdomain if exist
			myNewAddr    += myHost.replace(/^[^.]+\./g, "");
			hardRedirect = true;
		}
		else
		{
			myNewAddr = null;
		}
	}

	if(myNewAddr)
	{
		if(pressCounter === 1)
		{
			// show info message
			if($('html').attr('lang') === 'fa')
			{
				notif('info', 'با فشردن مجدد دکمه اسکیپ به یک آدرس بالاتر منتقل می‌شوید');
			}
			else
			{
				notif('info', 'Press Esc key another time to go one level up');
			}
			return true;
		}

		// try to navigate to new url
		if(hardRedirect)
		{
			location.replace(myNewAddr);
		}
		else
		{
			Navigate( { url: myNewAddr });
		}
	}
	else if(typeof(Storage) !== "undefined")
	{
		sessionStorage.setItem("escCounter", 0);
	}
}

