<?php
namespace content_site\options\checklist;


class checklist_add
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


		if(isset($currentSectionDetail['preview']['checklist_list']) && is_array($currentSectionDetail['preview']['checklist_list']))
		{
			// ok
		}
		else
		{
			$currentSectionDetail['preview']['checklist_list'] = [];
		}

		// check max count by call maximum_capacity of checklist\b1

		$maximum_capacity = 50;

		if(count($currentSectionDetail['preview']['checklist_list']) > $maximum_capacity)
		{
			\dash\notif::error(T_("Maximum capacity of this section is full"));
			return false;
		}

		$index = static::generate_random_key();

		$currentSectionDetail['preview']['checklist_list'][] =
		[
			'index'  => $index,
			'checklist'     => null,
			'alt'       => T_("Image"),
			'isdefault' => true,
		];

		$preview = json_encode($currentSectionDetail['preview']);

		\lib\db\sitebuilder\update::record(['preview' => $preview], $currentSectionDetail['id']);

		\dash\pdo::commit();

		\dash\notif::reloadIframe();

		$url = \dash\url::that(). '/checklist_list'. \dash\request::full_get(['index' => $index]);

		\dash\redirect::to($url);

		return;
	}


	/**
	 * Generate random key
	 * use in this function and in checklist to add default checklist
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function generate_random_key()
	{
		return md5(rand(). \dash\user::id(). microtime(). rand(). time());
	}


	public static function admin_html()
	{
		$html = '';
		$html .= '<nav class="items">';
		{
	  		$html .= '<ul>';
	  		{
	    		$html .= '<li>';
	    		{
	    			$checklist_add = json_encode(['specialsave' => 'specialsave', 'opt_checklist_add' => '1']);

		      		$html .= "<div class='item f' data-ajaxify data-data='$checklist_add'>";
		      		{
		        		$html .= '<img src="'. \dash\utility\icon::url('Add', 'major'). '">';
		        		$html .= '<div class="key">'. T_("Add New item"). '</div>';
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