<?php
namespace content_site\options\image;


class image_list
{
	public static function specialsave($_data)
	{
		$sortgallery = a($_data, 'sortgallery');
		if(!is_array($sortgallery))
		{
			\dash\notif::error(T_("Invalid gallery sort"));
			return false;
		}

		$menu_id = \content_site\body\gallery\option::get_master_menu_id(\dash\request::get('sid'));

		\lib\app\menu\edit::sort_raw($sortgallery, $menu_id);

		if(\dash\engine\process::status())
		{
			\dash\notif::clean();
			\content_site\utility::need_redirect(true);
		}

	}

	public static function admin_html()
	{
		$currentSectionDetail = \dash\data::currentSectionDetail();

		$image_list = \content_site\body\gallery\option::gallery_items(a($currentSectionDetail, 'id'));


		$break_image_list = null;

		$option = \content_site\call_function::section_options('gallery', \dash\data::currentSectionDetail_model());

		if(isset($option['break_image_list']) && is_numeric($option['break_image_list']))
		{
			$break_image_list = intval($option['break_image_list']);
		}


		$html = '';


		$html .= '<form method="post" autocomplete="off" data-patch>';
		{

	  		$html .= '<input type="hidden" name="opt_image_list" value="1">';
	  		$html .= \content_site\options\generate::specialsave();;

			$html .= '<nav class="items">';
			{
		  		$html .= '<ul data-sortable>';
		  		{
		    		foreach ($image_list as $key => $value)
		    		{
			      		$html .= '<li>';
			      		{
				      		$html .= '<a class="item f" href="'. \dash\url::that(). '/image_list'. \dash\request::full_get(['index' => a($value, 'id')]). '">';
				      		{
					            $html .= '<input type="hidden" name="sortgallery[]" value="'.  a($value, 'id'). '">';

				      			if(isset($value['file']) && $value['file'])
				      			{
				        			$file_url = \dash\fit::img(\lib\filepath::fix($value['file']));
				      			}
				      			else
				      			{
				        			$file_url = \dash\utility\icon::url('Image', 'major');
				      			}

				        		$html .= '<img src="'. $file_url. '" alt="'. a($value, 'title'). '">';
				        		$html .= '<div class="key">'. a($value, 'title').' </div>';

            					if (count($image_list) > 1)
            					{
              						$html .= '<img class="p-5 opacity-70 hover:bg-gray-200" data-handle src="'. \dash\utility\icon::url('DragHandle', 'minor'). '">';
              					}
              					else
              					{
				        			$html .= '<div class="go"></div>';
              					}

				      		}
				      		$html .= '</a>';
			      		}
				    	$html .= '</li>';

				    	if($break_image_list && $key + 1 === $break_image_list)
				    	{
				    		$html .= '</ul>';
				    		$html .= '</nav>';
				    		$html .= '<nav class="items">';
							$html .= '<ul data-sortable>';
				    	}
		    		}
		  		}
		  		$html .= '</ul>';
			}
			$html .= '</nav>';
		}
		$html .= '</form>';


		return $html;
	}

}
?>