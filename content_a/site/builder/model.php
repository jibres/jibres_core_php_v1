<?php
namespace content_a\site\builder;


class model
{
	public static function post()
	{
		if(\dash\data::lineSetting())
		{

			$post = \dash\request::post();

			$save = \lib\pagebuilder\tools\edit::element($post);

			if(isset($save['url']))
			{
				\dash\redirect::to($save['url']);
			}
		}

		if(\dash\request::post('sortline') === 'sortline')
		{
			\lib\pagebuilder\tools\edit::set_sort(\dash\request::post('bodyline'));
		}
	}
}
?>