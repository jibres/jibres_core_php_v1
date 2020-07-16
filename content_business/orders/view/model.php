<?php
namespace content_business\orders\view;


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
