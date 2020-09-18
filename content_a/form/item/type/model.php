<?php
namespace content_a\form\item\type;

class model
{
	public static function post()
	{
		$form_id = \dash\request::get('id');
		$item_id = \dash\request::get('item');
		$post =
		[
			'type' => \dash\request::post('type'),
		];

		\lib\app\form\item\edit::edit($post, $item_id, $form_id);


		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this().'/item?'. \dash\request::fix_get());
		}

	}
}
?>