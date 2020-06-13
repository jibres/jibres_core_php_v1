<?php
namespace content_b1\ticket\status;


class model
{
	public static function put()
	{
		$id = \dash\request::get('id');
		$status = \content_b1\tools::input_body('status');
		$result = \content_support\ticket\show\model::change_status($id, $status);
		\content_b1\tools::say($result);
	}
}
?>