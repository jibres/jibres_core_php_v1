<?php
namespace lib\app\website\body;

class remove
{


	public static function line($_line_id)
	{
		$line_id = \dash\validate::code($_line_id);
		$line_id = \dash\coding::decode($line_id);
		if(!$line_id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$get_line = \lib\db\setting\get::platform_cat_id('website', 'homepage', $line_id);

		$founded_line = [];

		if(isset($get_line['value']))
		{
			$founded_line = json_decode($get_line['value'], true);
		}

		if(!$founded_line)
		{
			\dash\notif::error(T_("Invalid body line key"));
			return false;
		}


		\lib\db\setting\delete::record($line_id);

		\dash\notif::ok(T_("Body line removed"));

		\lib\app\website\generator::remove_catch();


	}


}
?>