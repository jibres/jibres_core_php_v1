<?php
namespace content_business\tag;


class controller
{
	public static function routing()
	{
		$dir = \dash\url::dir();
		if(isset($dir[0]) && $dir[0] === 'tag')
		{
			unset($dir[0]);
		}

		if($dir)
		{
			$url = implode('/', $dir);

			$url = urldecode($url);

			$load = \lib\app\tag\get::by_url($url);
			if(!$load)
			{
				\dash\header::status(404, T_("Invalid tag url"));
			}
			\dash\data::dataRow($load);
			\dash\open::get();
		}
	}
}
?>
