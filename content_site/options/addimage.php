<?php
namespace content_site\options;


class addimage
{

	public static function specialsave($_args)
	{
		$currentSectionDetail = \dash\data::currentSectionDetail();

		if(!$currentSectionDetail || !isset($currentSectionDetail['id']))
		{
			\dash\notif::error(T_("Invalid section detail"));
			return false;
		}

		if(isset($currentSectionDetail['preview']['imagelist']) && is_array($currentSectionDetail['preview']['imagelist']))
		{
			// ok
		}
		else
		{
			$currentSectionDetail['preview']['imagelist'] = [];
		}

		$imagekey = md5(rand(). \dash\user::id(). microtime(). rand());

		$currentSectionDetail['preview']['imagelist'][] =
		[
			'imagekey'  => $imagekey,
			'image'     => null,
			'alt'       => T_("Image"),
			'isdefault' => true,
		];

		$preview = json_encode($currentSectionDetail['preview']);

		\content_site\update_record::patch_field($currentSectionDetail['id'], 'preview', $preview);

		$url = \dash\url::that(). '/imagelist'. \dash\request::full_get(['image' => $imagekey]);

		\dash\redirect::to($url);

		return;
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
	    			$addimage = json_encode(['specialsave' => 'specialsave', 'option' => 'addimage']);

		      		$html .= "<div class='item f' data-ajaxify data-data='$addimage'>";
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