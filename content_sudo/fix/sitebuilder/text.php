<?php
namespace content_sudo\fix\sitebuilder;


trait text
{

	
	public static function conver_text($record, &$new_record)
	{

		var_dump(func_get_args());exit;
		$new_record['folder']         = 'body';
		$new_record['section']        = 'blog';
		$new_record['model']          = 'b2';
		$new_record['preview_key']    = 'p1';


		$preview = \content_site\call_function::section_model_preview('blog', 'b2', 'p1');

		$preview = $preview['options'];

		if(a($record, 'title'))
		{
			$preview['heading'] = $record['title'];
		}

		if(a($record, 'puzzle', 'limit'))
		{
			$limit = $record['puzzle']['limit'];
			$range = \content_site\options\count\count_post::this_range();
			if(!in_array($limit, $range))
			{
				if($limit < 10)
				{
					$limit = 10;
				}
				else
				{
					$limit = 30;
				}
			}

			$preview['count'] = $limit;
		}

		if(a($record, 'infoposition', 'code') === 'bottom')
		{
			$preview['magicbox_title_position'] = 'outside';
			$preview['link_color']              = 'dark';
		}

		$preview['btn_viewall_check'] = 0;

		if(a($record, 'detail', 'tag_id'))
		{
			$preview['post_tag'] = $record['detail']['tag_id'];
		}

		return $preview;


	}
}
?>