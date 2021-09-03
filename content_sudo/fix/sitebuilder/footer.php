<?php
namespace content_sudo\fix\sitebuilder;


trait footer
{

	
	public static function conver_footer($record, &$new_record)
	{

		$new_record['folder']         = 'footer';
		$new_record['section']        = 'footer';
		$new_record['preview_key']    = 'p1';



		if(a($record, 'type') === 'f100')
		{
			$new_record['model']          = 'f1';
		}
		elseif(a($record, 'type') === 'f201')
		{
			$new_record['model']          = 'f3';
		}
		elseif(a($record, 'type') === 'f0')
		{
			$new_record['model']          = 'f0';
		}
		elseif(a($record, 'type') === 'f300')
		{
			$new_record['model']          = 'f1';
		}
		else
		{
			var_dump(func_get_args());exit;
		}

		$preview = \content_site\call_function::section_model_preview($new_record['folder'], $new_record['model'], $new_record['preview_key']);

		$preview = $preview['options'];

		if(a($record, 'text'))
		{
			$preview['copyright'] = strip_tags($record['text']);
			$preview['copyright'] = str_replace('&nbsp;', '', $preview['copyright']);
		}

		if(a($record, 'detail', 'footer_menu_1'))
		{
			$preview['menu_1'] = a($record, 'detail', 'footer_menu_1');
		}

		if(a($record, 'detail', 'footer_menu_2'))
		{
			$preview['menu_2'] = a($record, 'detail', 'footer_menu_2');
		}

		if(a($record, 'detail', 'footer_menu_3'))
		{
			$preview['menu_3'] = a($record, 'detail', 'footer_menu_3');
		}

		if(a($record, 'detail', 'footer_menu_4'))
		{
			$preview['menu_4'] = a($record, 'detail', 'footer_menu_4');
		}

		return $preview;


	}
}
?>