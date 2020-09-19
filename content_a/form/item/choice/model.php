<?php
namespace content_a\form\item\choice;

class model
{
	public static function post()
	{
		$form_id = \dash\request::get('id');
		$item_id = \dash\request::get('item');


		if(\dash\request::post('remove') === 'remove')
		{
			$id = \dash\request::post('id');
			\lib\app\form\choice\remove::remove($id);
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}

		if(\dash\request::post('sortable') === 'sortable')
		{
			$sort = \dash\request::post('sort');
			\lib\app\form\choice\edit::save_sort($item_id, $sort);
			return;
		}


		$post =
		[
			'title' => \dash\request::post('title'),
		];

		\lib\app\form\choice\add::add($post, $item_id, $form_id);


		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>