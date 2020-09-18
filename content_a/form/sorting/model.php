<?php
namespace content_a\form\sorting;

class model
{
	public static function post()
	{

		$form_id = \dash\request::get('id');

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