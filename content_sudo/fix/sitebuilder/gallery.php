<?php
namespace content_sudo\fix\sitebuilder;


trait gallery
{

	
	public static function conver_gallery($record, &$new_record)
	{
		$new_record['folder']         = 'body';
		$new_record['section']        = 'gallery';
		$new_record['model']          = 'g2';
		$new_record['preview_key']    = 'p1';


		$preview = \content_site\call_function::section_model_preview('gallery', 'g2', 'p1');

		$preview = $preview['options'];

		$old_preview_key =  a($record, 'puzzle', 'puzzle_type'). ' -- '. a($record, 'puzzle', 'slider_type'). ' -- ' .a($record, 'puzzle', 'code');

		// self::counter($old_preview_key);

		switch ($old_preview_key)
		{
			case 'slider -- simple -- 1+3+4':
			case 'slider -- simple -- 2+2':
			case 'slider -- simple -- 2+2+4':
			case 'slider -- simple -- ':
				// one slider
				break;


			case ' --  -- ':
			case 'slider -- special -- 4+4':
			case 'slider -- special -- ':
				// like supersaeed.jibres.ir
				// master slider of alot business
				break;



			case 'puzzle -- special -- ':
			case 'puzzle -- special -- 2+4+4':
			case 'puzzle -- special -- 6':
			case 'puzzle -- special -- 4':
			case 'puzzle -- simple -- 6':
			case 'puzzle -- simple -- 2+3':
			case 'puzzle -- special -- 4+4':
			case 'puzzle -- special -- 2+2':
			case 'puzzle -- special -- 1+3+4':
			case 'puzzle -- special -- 2+3+3':
			case 'puzzle -- simple -- 2+3+3':
			case 'puzzle -- simple -- ':
			default:

				// magicbox 2+3...
				break;
		}


		if($old_preview_key === 1)
		{
			var_dump(\dash\temp::get("CurrentBusiness"));
			var_dump($record);exit;
		}

		return;

		if(a($record, 'detail', 'list') && is_array($record['detail']['list']))
		{
			$list = $record['detail']['list'];

			// $menu_id = \content_site\body\gallery\option::add_menu_for_gallery($record['id']);

			foreach ($list as $key => $value)
			{
				$url = \dash\validate::absolute_url(a($value, 'url'), false);

				$args =
				[
					'file'    => a($value, 'image'),
					'url'     => $url ? $url : null,
					'pointer' => 'other',
					'title'   => a($value, 'alt'),
					'sort'    => a($value, 'sort'),
				];

				if(!$url)
				{
					unset($args['pointer']);
					unset($args['url']);
					// $args['pointer'] = 'homepage';
				}

				if(!$args['title'])
				{
					unset($args['title']);
				}

				// $child_id = \content_site\body\gallery\option::add_menu_child_as_gallery_item($record['id'], $menu_id, 1, $args);

				if(!$child_id)
				{
					\dash\notif::api('ss');
					self::counter('error:cannnot add menu_id');
				}
			}

		}


		return $preview;


	}
}
?>