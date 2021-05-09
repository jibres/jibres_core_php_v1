<?php
namespace content_su\homepage;


class view
{
	public static function config()
	{
		\dash\face::title("Homepage Number");

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		if(\dash\request::get('refresh') === 'refresh')
		{
			\lib\app\statistics\homepage::refresh();
		}

		$result = [];
		$result['file'] = \lib\app\statistics\homepage::get_file();
		$result['get'] = \lib\app\statistics\homepage::get();
		\dash\data::homepageDetail($result);


	}


}
?>