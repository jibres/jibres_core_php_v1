<?php
namespace content_site\options\image;


class image_add2
{
	public static function specialsave($_args)
	{
		$currentSectionDetail = \dash\data::currentSectionDetail();

		if(!$currentSectionDetail || !isset($currentSectionDetail['id']))
		{
			\dash\notif::error(T_("Invalid section detail"));
			return false;
		}

		\dash\pdo::transaction();

		$currentSectionDetail = \lib\db\sitebuilder\get::by_id_lock($currentSectionDetail['id']);

		if(!$currentSectionDetail || !is_array($currentSectionDetail) || !isset($currentSectionDetail['preview']))
		{
			\dash\pdo::rollback();

			\dash\notif::error(T_("Section not found"));

			return false;
		}

		$currentSectionDetail['preview'] = json_decode($currentSectionDetail['preview'], true);


		if(isset($currentSectionDetail['preview']['image_list2']) && is_array($currentSectionDetail['preview']['image_list2']))
		{
			// ok
		}
		else
		{
			$currentSectionDetail['preview']['image_list2'] = [];
		}

		$index = md5(microtime(). rand(). time(). rand(). rand());

		$currentSectionDetail['preview']['image_list2'][] =
		[
			'index'  => $index,
			'image'     => null,
			'alt'       => T_("Image"),
			'isdefault' => true,
		];

		$preview = json_encode($currentSectionDetail['preview']);

		\lib\db\sitebuilder\update::record(['preview' => $preview], $currentSectionDetail['id']);

		\dash\pdo::commit();


		$url = \dash\url::that(). '/image_list2'. \dash\request::full_get(['index' => $index]);

		\dash\redirect::to($url);

		return;
	}


	public static function admin_html()
	{
		$currentSectionDetail = \dash\data::currentSectionDetail();

		if(!$currentSectionDetail || !isset($currentSectionDetail['id']))
		{
			\dash\notif::error(T_("Invalid section detail"));
			return false;
		}

		$allow_capacity = \content_site\body\gallery\option::allow_capacity($currentSectionDetail['id'], a($currentSectionDetail, 'preview', 'type'));

		if(!$allow_capacity)
		{
			return false;
		}


		$html = '';
		$html .= '<nav class="items">';
		{
	  		$html .= '<ul>';
	  		{
	    		$html .= '<li>';
	    		{
	    			$image_add = json_encode(['specialsave' => 'specialsave', 'opt_image_add2' => '1']);

		      		$html .= "<div class='item f' data-ajaxify data-data='$image_add'>";
		      		{
		        		$html .= '<img alt="Add" src="'. \dash\utility\icon::url('Add', 'major'). '">';
		        		$html .= '<div class="key">'. T_("Add image"). '</div>';
		        		$html .= '<div class="go"></div>';
		      		}
		      		$html .= '</div>';
	    		}
	    		$html .= '</li>';
	  		}
	  		$html .= '</ul>';
		}
		$html .= '</nav>';

		return $html;
	}

}
?>