<?php
namespace content_business\profile\address;


class controller
{
	public static function routing()
	{
		\dash\redirect::to_login();

		$id = \dash\validate::code(\dash\request::get('addressid'));
		if($id)
		{
			$dataRow = \dash\app\address::get_my_address($id);
			if(!isset($dataRow['user_id']))
			{
				\dash\header::status(404, T_("Invalid address id"));
			}

			\dash\data::dataRowAddress($dataRow);
		}

	}
}
?>
