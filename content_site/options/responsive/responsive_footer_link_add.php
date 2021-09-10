<?php
namespace content_site\options\responsive;


class responsive_footer_link_add
{
	public static function extends_option()
	{
		return responsive_footer::extends_option();
	}

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


		if(isset($currentSectionDetail['preview']['responsive']) && is_array($currentSectionDetail['preview']['responsive']))
		{
			// ok
		}
		else
		{
			$currentSectionDetail['preview']['responsive'] = [];
		}

		$index = md5(microtime(). rand(). time(). rand(). rand());

		$currentSectionDetail['preview']['responsive'][] =
		[
			'index' => $index,
			'link'  => [],
			'title' => T_("Home"),
			'icon'  => 'Home',

		];

		if(count($currentSectionDetail['preview']['responsive']) > 5)
		{
			\dash\pdo::rollback();
			\dash\notif::error(T_("Maximum capacity of footer links is full"));
			return false;

		}

		$preview = json_encode($currentSectionDetail['preview']);

		\lib\db\sitebuilder\update::record(['preview' => $preview], $currentSectionDetail['id']);

		\dash\pdo::commit();


		$url = \dash\url::that(). '/responsive/responsive_footer'. \dash\request::full_get(['index' => $index]);

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

		if(isset($currentSectionDetail['preview']['responsive']) && is_array($currentSectionDetail['preview']['responsive']))
		{
			// ok
		}
		else
		{
			$currentSectionDetail['preview']['responsive'] = [];
		}

		if(count($currentSectionDetail['preview']['responsive']) >= 5)
		{
			return '';
		}


		$html = '';
		$html .= '<nav class="items">';
		{
	  		$html .= '<ul>';
	  		{
	    		$html .= '<li>';
	    		{
	    			$image_add = json_encode(['specialsave' => 'specialsave', 'opt_responsive_footer_link_add' => '1']);

		      		$html .= "<div class='item f' data-ajaxify data-data='$image_add'>";
		      		{
		        		$html .= '<img alt="Add" src="'. \dash\utility\icon::url('Add', 'major'). '">';
		        		$html .= '<div class="key">'. T_("Add footer links"). '</div>';
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