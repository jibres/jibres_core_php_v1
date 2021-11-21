<?php
namespace lib\db\social_posts;

class update
{
	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('social_posts', $_args, $_id);
	}
}
?>