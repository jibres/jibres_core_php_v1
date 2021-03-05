<?php
namespace dash\waf;

class blacklist
{
	public static function dont_run_exception()
	{
		$path = \dash\url::path();
		$path = mb_strtolower($path);

		// files
		if(strpos($path, '/files') === 0)
		{
			\dash\header::status(404);
		}
		// static
		if(strpos($path, '/static') === 0)
		{
			\dash\header::status(404);
		}

		// static
		if(strpos($path, '/index.html') !== false || strpos($path, '/index.php') !== false)
		{
			\dash\header::status(404);

			// $myAddr = str_replace('/index.html', '', \dash\url::path());
			// $myAddr = str_replace('/index.php', '', $myAddr);
			// \dash\redirect::to(\dash\url::base(). $myAddr);
		}

		$directory = \dash\url::directory();
		$directory = mb_strtolower($directory); // .PHP .php .Php , ...

		// block some ext in url
		if(substr($directory, -4) === '.php')
		{
			\dash\header::status(451);
		}
		if(substr($directory, -4) === '.asp')
		{
			\dash\header::status(451);
		}
		if(substr($directory, -5) === '.aspx')
		{
			\dash\header::status(451);
		}
		if(substr($directory, -4) === '.jsp')
		{
			\dash\header::status(451);
		}
		if(substr($directory, -3) === '.js')
		{
			\dash\header::status(451);
		}
		if(substr($directory, -3) === '.do')
		{
			\dash\header::status(451);
		}
		if(substr($directory, -4) === '.git')
		{
			\dash\header::status(451);
		}
		if(substr($directory, -4) === '.env')
		{
			\dash\header::status(451);
		}
		if(substr($directory, -3) === '.sh')
		{
			\dash\header::status(451);
		}

		// check array in the path
		if(strpos($path, '[]') !== false)
		{
			\dash\header::status(451);
		}

		// favicon
		if(strpos($path, '/favicon.ico') !== false)
		{
			\dash\redirect::to(\dash\url::cdn(). '/favicons/favicon.ico');
		}
	}
}
?>
