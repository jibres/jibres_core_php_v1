<?php
namespace content_crm\member;


class master
{
	public static function view()
	{
		\dash\data::back_text(T_("Back"));
		\dash\data::back_link(\dash\url::this(). '/glance?id='. \dash\request::get('id'));

	}


	public static function load()
	{
		\dash\permission::access('manageUsers');

		$id = \dash\request::get('id');
		$load = \dash\app\user::get($id);
		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::dataRowMember($load);
	}
}
?>