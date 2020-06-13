<?php
namespace content_b1\ticket\solved;


class model
{
	public static function put()
	{
		$id = \dash\request::get('id');
		$solved = \content_b1\tools::input_body('solved');
		$result = \content_support\ticket\show\model::save_solved($id, $solved);
		\content_b1\tools::say($result);
	}


}
?>