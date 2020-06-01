<?php
namespace content_a\fund;


class model
{
	public static function post()
	{
		\lib\app\fund\login::set(\dash\request::post('fund'));
	}


}
?>
