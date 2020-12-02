<?php
namespace content_crm\member\general;


class controller
{
	public static function routing()
	{
		\dash\redirect::to(\dash\url::this(). '/glance?'. \dash\request::fix_get());
	}
}
?>