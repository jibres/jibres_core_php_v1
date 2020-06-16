<?php
namespace content_b1\company\remove;


class model
{
	public static function delete()
	{
		$args             = [];
		$args['whattodo'] = 'non-company';
		$args['company']     = null;

		$result = \lib\app\product\company::remove($args, \dash\request::get('id'));

		\content_b1\tools::say($result);
	}

}
?>