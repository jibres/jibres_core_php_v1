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

		\dash\pdo::transaction();

		$currentSectionDetail = \lib\db\pagebuilder\get::by_id_lock($currentSectionDetail['id']);

		if(!$currentSectionDetail || !is_array($currentSectionDetail) || !isset($currentSectionDetail['preview']))
		{
			\dash\pdo::rollback();

			\dash\notif::error(T_("Section not found"));

			return false;
		}

		$currentSectionDetail['preview'] = json_decode($currentSectionDetail['preview'], true);


		if(isset($currentSectionDetail['preview']['image_list']) && is_array($currentSectionDetail['preview']['image_list']))
		{
			// ok
		}
		else
		{
			$currentSectionDetail['preview']['image_list'] = [];
		}

		$index = self::generate_random_key();

		$currentSectionDetail['preview']['image_list'][] =
		[
			'index'  => $index,
			'image'     => null,
			'alt'       => T_("Image"),
			'isdefault' => true,
		];

		$preview = json_encode($currentSectionDetail['preview']);

		\dash\pdo\query_template::update('pagebuilder', ['preview' => $preview], $currentSectionDetail['id']);

		\dash\pdo::commit();

		\dash\notif::reloadIframe();

		$url = \dash\url::that(). '/image_list'. \dash\request::full_get(['index' => $index]);

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