<?php
namespace content_a\setting\fund;


class model
{
	public static function post()
	{

		$post          = [];

		$post['title'] = \dash\request::post('title');
		$post['desc']  = \dash\request::post('desc');
		$post['pos']   = \dash\request::post('pos');

		if(\dash\data::editMode())
		{
			if(\dash\request::post('remove') === 'remove')
			{
				$result = \lib\app\fund\remove::remove(\dash\request::get('id'));
			}
			else
			{
				$result = \lib\app\fund\edit::edit($post, \dash\request::get('id'));
			}

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that());
			}
		}
		else
		{
			$result = \lib\app\fund\add::add($post);

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}


	}
}
?>