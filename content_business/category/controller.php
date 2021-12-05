<?php
namespace content_business\category;


class controller
{
	public static function routing()
	{
		$dir = \dash\url::dir();
		if(isset($dir[0]) && $dir[0] === 'category')
		{
			unset($dir[0]);
		}

		$myCategoryList = [];

		if($dir)
		{
			$url = implode('/', $dir);

			$url = \dash\str::urldecode($url);

			$load = \lib\app\category\get::by_url($url);

			if(!$load)
			{
				\dash\header::status(404, T_("Invalid category url"));
			}
			\dash\data::dataRow($load);
			\dash\open::get();
		}
		else
		{
			if(\dash\request::get('id'))
			{
				$id = \dash\validate::id(\dash\request::get('id'));
				if($id)
				{
					$load = \lib\app\category\get::get_force($id);
					if(a($load, 'url'))
					{
						\dash\redirect::to($load['url']);
					}
				}
			}

			$myCategoryList = \lib\app\category\search::site_list();
		}

		\dash\data::categoryDataTable($myCategoryList);
	}
}
?>
