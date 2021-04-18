<?php
namespace content_a\pagebuilder\home;


class model
{
	public static function post()
	{
		if(\dash\data::lineSetting())
		{

			$post = \dash\request::post();

			$save = \lib\pagebuilder\line\edit::element($post);

			if(isset($save['url']))
			{
				\dash\redirect::to($save['url']);
			}
		}

		if(\dash\request::post('sortline') === 'sortline')
		{
			\lib\pagebuilder\line\edit::set_sort(\dash\request::post('bodyline'));
		}
	}
}
?>