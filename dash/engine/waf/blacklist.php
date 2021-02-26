<?php
namespace dash\engine\waf;

class blacklist
{
	public static function dont_run_exception()
	{
		// files
		if(strpos(\dash\url::path(), '/files') === 0)
		{
			\dash\header::status(404);
		}
		// static
		if(strpos(\dash\url::path(), '/static') === 0)
		{
			\dash\header::status(404);
		}

		// static
		if(strpos(\dash\url::path(), '/index.html') !== false || strpos(\dash\url::path(), '/index.php') !== false)
		{
			\dash\header::status(404);

			// $myAddr = str_replace('/index.html', '', \dash\url::path());
			// $myAddr = str_replace('/index.php', '', $myAddr);
			// \dash\redirect::to(\dash\url::base(). $myAddr);
		}
		// favicon
		if(strpos(\dash\url::path(), '/favicon.ico') !== false)
		{
			\dash\redirect::to(\dash\url::cdn(). '/favicons/favicon.ico');
		}
	}
}
?>
