<?php
namespace content_v2\ticket\solved;


class model
{
	public static function put()
	{
		$id = \dash\request::get('id');
		$solved = \content_v2\tools::input_body('solved');
		$result = \content_support\ticket\show\model::save_solved($id, $solved);
		\content_v2\tools::say($result);
	}


}
?>