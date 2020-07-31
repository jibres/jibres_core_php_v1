<?php
namespace lib\email;


class send
{

	public static function send($_args)
	{
		return \lib\email\sendgrid::send($_args);
	}
}
?>