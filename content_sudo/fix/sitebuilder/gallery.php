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


		if(a($record, 'detail', 'list') && is_array($record['detail']['list']))
		{
			$list = $record['detail']['list'];

			$menu_id = \content_site\body\gallery\option::add_menu_for_gallery($record['id']);

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

				$child_id = \content_site\body\gallery\option::add_menu_child_as_gallery_item($record['id'], $menu_id, 1, $args);

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