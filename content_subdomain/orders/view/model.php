<?php
namespace content_subdomain\orders\view;


class model
{
	public static function post()
	{
		if(\dash\request::post('set_status') === 'cancel')
		{
			\lib\app\factor\edit::user_cancel(\dash\request::get('id'));
		}
	}
}
?>
