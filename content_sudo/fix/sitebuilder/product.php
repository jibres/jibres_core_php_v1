<?php
namespace content_sudo\fix\sitebuilder;


trait product
{

	
	public static function conver_product($record, &$new_record)
	{

		$new_record['folder']         = 'body';
		$new_record['section']        = 'product';
		$new_record['model']          = 'p1';
		$new_record['preview_key']    = 'p1';

		if(a($record, 'puzzle', 'puzzle_type') === 'puzzle')
		{
			// magicbox
			$preview = \content_site\call_function::section_model_preview('product', 'p1', 'p1');
		}
		else
		{
			$preview = \content_site\call_function::section_model_preview('product', 'p3', 'p1');
			// rail
		}

		$preview = $preview['options'];

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