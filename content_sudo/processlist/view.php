<?php
namespace content_sudo\processlist;


class view
{
	public static function config()
	{
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::processlist(\dash\db::get('SHOW PROCESSLIST;'));
		// \dash\data::processlist(\dash\db::get('SELECT * FROM INFORMATION_SCHEMA.PROCESSLIST;'));


		// \dash\data::fullprocesslist(\dash\db::get('SHOW FULL PROCESSLIST;'));

	}
}
?>