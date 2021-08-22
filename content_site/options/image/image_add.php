<?php
namespace content_site\options\image;


class image_add
{

	public static function specialsave($_args)
	{
		$currentSectionDetail = \dash\data::currentSectionDetail();

		if(!$currentSectionDetail || !isset($currentSectionDetail['id']))
		{
			\dash\notif::error(T_("Invalid section detail"));
			return false;
		}

		$id = \content_site\body\gallery\option::append_gallery_item($currentSectionDetail['id'], a($currentSectionDetail, 'preview', 'type'));
		if(!$id)
		{
			return false;
		}

		\dash\notif::reloadIframe();

		$url = \dash\url::that(). '/image_list'. \dash\request::full_get(['index' => $id]);

		\dash\redirect::to($url);

		return;
	}


	/**
	 * Generate random key
	 * use in this function and in gallery to add default image
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
	    			$image_add = json_encode(['specialsave' => 'specialsave', 'opt_image_add' => '1']);

		      		$html .= "<div class='item f' data-ajaxify data-data='$image_add'>";
		      		{
		        		$html .= '<img src="'. \dash\utility\icon::url('Add', 'major'). '">';
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