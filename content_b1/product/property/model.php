<?php
namespace content_b1\product\property;


class model
{
	public static function put()
	{
		$id = \dash\request::get('id');

		$result = \lib\app\product\property::set(\content_b1\tools::input_body(), $id);

		\content_b1\tools::say($result);
	}

}
?>