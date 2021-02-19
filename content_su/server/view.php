<?php
namespace content_su\server;


class view
{
	public static function config()
{
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());
		\dash\data::server(\dash\server::get());
	}
}
?>