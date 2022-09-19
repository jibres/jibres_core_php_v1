<?php
namespace content_a\form\item\duplicatelist;

use dash\number;

class model
{
	public static function post()
	{
		$form_id = \dash\request::get('id');
		$item_id = \dash\request::get('item');

		if(\dash\request::post('import') === 'file')
		{
			$data = \dash\upload\quick::read_file('duplicatelist');

			if(!$data)
			{
				\dash\notif::error(T_("No data was received!"));
				return false;
			}

			if(is_string($data))
			{

				\lib\app\form\item\edit::edit_uniquelist($data, $item_id, $form_id, true);

				if(\dash\engine\process::status())
				{
					\dash\redirect::pwd();
				}
			}
			else
			{
				\dash\notif::error(T_("No valid data received"));
				return false;
			}
		}


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
		$duplicateitem = \dash\number::clean($duplicateitem);

		\lib\app\form\item\edit::edit_uniquelist($duplicateitem, $item_id, $form_id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>