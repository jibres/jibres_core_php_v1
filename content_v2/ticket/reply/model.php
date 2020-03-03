<?php
namespace content_v2\ticket\reply;


class model
{
	public static function post()
	{
		$id = \dash\request::get('id');
		// $via     = 'api';
		$via     = null;
		$content = \content_v2\tools::input_body('content');
		$result = \content_support\ticket\show\model::answer_save($id, $content, $_type = 'ticket', $_send_message = false);
		\content_v2\tools::say($result);
	}



}
?>