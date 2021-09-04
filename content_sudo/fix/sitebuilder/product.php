<?php
namespace content_sudo\fix\sitebuilder;


trait product
{

	
	public static function conver_product($record, &$new_record)
	{

		$new_record['folder']         = 'body';
		$new_record['section']        = 'product';

		if(a($record, 'puzzle', 'puzzle_type') === 'puzzle')
		{
			$new_record['model']          = 'p2';
			$new_record['preview_key']    = 'p1';
			// magicbox
			$preview = \content_site\call_function::section_model_preview($new_record['section'], $new_record['model'], $new_record['preview_key']);
		}
		else
		{
			$new_record['model']          = 'p3';
			$new_record['preview_key']    = 'p1';
			$preview = \content_site\call_function::section_model_preview($new_record['section'], $new_record['model'], $new_record['preview_key']);
			// rail
		}

		$preview = $preview['options'];

		$preview['container'] = 'xl';

		if(a($record, 'title'))
		{
			$preview['heading'] = $record['title'];
		}

		switch (a($record, 'detail', 'type'))
		{
			case 'randomproduct':
			case 'bestselling':
				$preview['product_order'] = 'random';
				break;

			case 'latestproduct':
			default:
				$preview['product_order'] = 'newest';
				break;
		}

		$preview['product_tag'] = null;

		if(a($record, 'detail', 'cat_id'))
		{
			$preview['product_tag'] = $record['detail']['cat_id'];
		}

		$preview['count'] = 15;

		$preview['btn_viewall_check'] = false;



		return $preview;


	}
}
?>