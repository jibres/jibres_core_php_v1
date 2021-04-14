<?php
namespace content_a\pagebuilder\home;


class model
{
	public static function post()
	{
		if(\dash\data::lineSetting())
		{

			$child    = \dash\url::child();

			$subchild = \dash\url::subchild();

			$id   = \dash\request::get('id');

			$post = \dash\request::post();

			$save = \lib\app\pagebuilder\line\edit::element($child, $subchild, $id, $post);

			if(isset($save['url']))
			{
				\dash\redirect::to($save['url']);
			}
		}
	}
}
?>