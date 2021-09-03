<?php
namespace content_sudo\fix\sitebuilder;


trait quote
{

	
	public static function conver_quote($record, &$new_record)
	{

		$new_record['folder']         = 'body';
		$new_record['section']        = 'quote';
		$new_record['model']          = 'quote1';
		$new_record['preview_key']    = 'p1';


		$preview = \content_site\call_function::section_model_preview('quote', $new_record['model'], $new_record['preview_key']);


		$preview = $preview['options'];

		if(a($record, 'title'))
		{
			$preview['heading'] = $record['title'];
		}

		$new_list = [];

		if(a($record, 'detail', 'list') && is_array(a($record, 'detail', 'list')))
		{
			$list = $record['detail']['list'];


			foreach ($list as $key => $value)
			{
				$load_comment = [];

				$comment_id = $value['comment_id'];

				if(is_numeric($comment_id))
				{
					$load_comment = \dash\db\comments\get::by_id($comment_id);
				}

				$new_list[] =
				[
					'index'       => md5(rand(). microtime()),
					'title'       => a($load_comment, 'title'),
					'text'        => strip_tags(a($load_comment, 'content')),
					'displayname' => a($load_comment, 'displayname'),
					'job'         => a($value, 'job'),
					'avatar'      => a($value, 'image'),
				];
			}

		}

		$preview['quote_list'] = $new_list;


		return $preview;


	}
}
?>