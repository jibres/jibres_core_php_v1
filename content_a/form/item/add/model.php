<?php
namespace content_a\form\item\add;

class model
{
	public static function post()
	{
		$form_id = \dash\request::get('id');

		$new_item =
		[
			'title'   => \dash\request::post('new_title'),
			'type'    => \dash\request::post('new_type'),
			'require' => \dash\request::post('new_require'),
		];

		$result = \lib\app\form\item\add::add($new_item, $form_id);

		if(\dash\engine\process::status())
		{
			if(isset($result['id']))
			{
				\dash\redirect::to(\dash\url::this().'/item?id='. \dash\request::get('id'). '&item='. $result['id']);
			}
			else
			{
				\dash\redirect::to(\dash\url::this().'/edit?id='. \dash\request::get('id'));
			}
		}


	}
}
?>