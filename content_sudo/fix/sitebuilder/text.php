<?php
namespace content_sudo\fix\sitebuilder;


trait text
{


	public static function conver_text($record, &$new_record)
	{
		$new_record['folder']      = 'body';
		$new_record['section']     = 'text';
		$new_record['model']       = 't1';
		$new_record['preview_key'] = 'p1';

		$preview = \content_site\call_function::section_model_preview('text', 't1', 'p1');

		$preview = $preview['options'];

		$preview['container'] = 'lg';

		if(a($record, 'title'))
		{
			$preview['heading'] = $record['title'];
		}

		$new_record['text_preview'] = a($record, 'text');

		return $preview;
	}
}
?>