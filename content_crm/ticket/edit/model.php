<?php
namespace content_crm\ticket\edit;


class model
{
	public static function post()
	{
		$id = \dash\request::get('id');

		if(\dash\request::post('remove') === 'remove')
		{
			\dash\app\ticket\remove::remove($id);
		}
		else
		{
			$post =
			[
				'content'     => \dash\request::post_raw('content'),
			];

			\dash\app\ticket\edit::edit($post, $id);
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\content_crm\ticket\edit\view::back_link());
		}
	}
}
?>
