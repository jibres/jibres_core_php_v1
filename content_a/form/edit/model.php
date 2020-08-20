<?php
namespace content_a\form\edit;

class model
{
	public static function post()
	{
		$post =
		[
			'title' => \dash\request::post('title'),
			'slug' => \dash\request::post('slug'),
		];

		$result = \lib\app\form\form\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\notif::clean();
		}

		$form_id = \dash\request::get('id');

		$new_item =
		[
			'title'    => \dash\request::post('new_title'),
			'type'     => \dash\request::post('new_type'),
			'require' => \dash\request::post('new_required'),
		];

		if(!empty(array_filter($new_item)))
		{
			\lib\app\form\item\add::add($new_item, $form_id);
		}



		\dash\redirect::pwd();
	}
}
?>