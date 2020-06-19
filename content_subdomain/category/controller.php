<?php
namespace content_subdomain\category;


class controller
{
	public static function routing()
	{
		$dir = \dash\url::dir();
		if(isset($dir[0]) && $dir[0] === 'category')
		{
			unset($dir[0]);
		}

		if($dir)
		{
			$url = implode('/', $dir);

			$url = urldecode($url);

			$load = \lib\app\category\get::by_url($url);
			if(!$load)
			{
				\dash\header::status(404, T_("Invalid category url"));
			}
			\dash\data::dataRow($load);
			\dash\open::get();
		}
	}
}
?>
