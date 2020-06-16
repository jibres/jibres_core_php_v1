<?php
namespace content_b1\unit\remove;


class model
{
	public static function delete()
	{
		$args             = [];
		$args['whattodo'] = 'non-unit';
		$args['unit']     = null;

		$result = \lib\app\product\unit::remove($args, \dash\request::get('id'));

		\content_b1\tools::say($result);
	}

}
?>