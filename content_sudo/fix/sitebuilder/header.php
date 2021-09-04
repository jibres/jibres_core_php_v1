<?php
namespace content_sudo\fix\sitebuilder;


trait header
{

	
	public static function conver_header($record, &$new_record)
	{



		$new_record['folder']         = 'header';
		$new_record['section']        = 'header';
		$new_record['preview_key']    = 'p1';


		if(a($record, 'type') === 'h100')
		{
			$new_record['model']          = 'h3';
		}
		elseif(a($record, 'type') === 'h300')
		{
			$new_record['model']          = 'h1';
		}
		elseif(a($record, 'type') === 'h0')
		{
			$new_record['model']          = 'h0';
		}
		else
		{
			var_dump(func_get_args());exit;
		}


		$preview = \content_site\call_function::section_model_preview($new_record['folder'], $new_record['model'], $new_record['preview_key']);

		$preview = $preview['options'];

		$preview['container'] = 'lg';

		if(a($record, 'detail', 'header_menu_1'))
		{
			$preview['menu_1'] = $record['detail']['header_menu_1'];
		}

		if(a($record, 'detail', 'header_menu_2'))
		{
			$preview['menu_2'] = $record['detail']['header_menu_2'];
		}


		if(a($record, 'detail', 'announcement', 'status'))
		{
			$preview['announcement_check'] = true;
			$preview['announcement_link']  =
			[
				'url'     => a($record, 'detail', 'announcement', 'url'),
				'pointer' => 'other',
			];

  			$preview['announcement_description'] = a($record, 'detail', 'announcement', 'text');
		}

		if(a($record, 'detail', 'logo'))
		{
			$preview['use_as_logo'] = 'custom_logo';
			$preview['logo'] = $record['detail']['logo'];
		}

		if($new_record['model'] === 'h3' && \lib\store::detail('nosale'))
		{
			$preview['link_search']    = false;
			$preview['link_enter']     = false;
			$preview['link_cart']      = false;
		}

		return $preview;


	}
}
?>