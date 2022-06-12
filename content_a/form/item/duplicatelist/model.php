<?php
namespace content_a\form\item\duplicatelist;

class model
{
	public static function post()
	{
		$form_id = \dash\request::get('id');
		$item_id = \dash\request::get('item');


		if(\dash\request::post('remove') === 'remove')
		{
			$value = \dash\request::post('value');

			\lib\app\form\item\edit::remove_from_uniquelist($value, $item_id, $form_id);

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}


		$duplicateitem = \dash\request::post('duplicateitem');

		\lib\app\form\item\edit::edit_uniquelist($duplicateitem, $item_id, $form_id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>