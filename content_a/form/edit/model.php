<?php
namespace content_a\form\edit;

class model
{
	public static function post()
	{
		$form_id = \dash\request::get('id');

		// if(\dash\request::post('removeitem') === 'removeitem')
		// {
		// 	\lib\app\form\item\remove::remove(\dash\request::post('id'));

		// 	if(\dash\engine\process::status())
		// 	{
		// 		// \dash\redirect::pwd();
		// 	}
		// 	return;
		// }



		$post =
		[
			'title'      => \dash\request::post('title'),
			// 'slug'       => \dash\request::post('slug'),
			// 'status'     => \dash\request::post('status'),
			// 'desc'       => \dash\request::post('desc') ? $_POST['desc'] : null,
			// 'endmessage' => \dash\request::post('endmessage'),
			// 'redirect'   => \dash\request::post('redirect'),

		];


		$result = \lib\app\form\form\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\notif::clean();
		}

		$form_id = \dash\request::get('id');

		$new_item =
		[
			'title'   => \dash\request::post('new_title'),
			'type'    => \dash\request::post('new_type'),
			'require' => \dash\request::post('new_require'),
		];


		if($new_item['title'])
		{
			\lib\app\form\item\add::add($new_item, $form_id);
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}

			return;
		}


		$sort = \dash\request::post('sort');

		if(!is_array($sort))
		{
			$sort = [];
		}

		\lib\app\form\item\edit::save_sort($sort, $form_id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>