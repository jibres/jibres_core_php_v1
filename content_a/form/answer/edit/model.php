<?php
namespace content_a\form\answer\edit;


class model extends \content_business\f\home\model
{
	public static function edit_mode()
	{
		return true;
	}

	public static function post()
	{
		if(\dash\request::post('remove_file') === 'remove_file' && \dash\request::post('answer_detail_id'))
		{
			\lib\app\form\answer\remove::answer_detail_by_type('file', \dash\request::post('answer_detail_id'));
			return;
		}

		parent::post();
	}

}
?>
