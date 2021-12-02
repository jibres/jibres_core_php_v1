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

		\content_site\body\gallery\option::sort_gallery_items($sortgallery);


	}

	public static function admin_html()
	{
		$currentSectionDetail = \dash\data::currentSectionDetail();

		$image_list = \content_site\body\gallery\option::gallery_items(a($currentSectionDetail, 'id'), true);


		$break_image_list = null;

		$option = \content_site\call_function::section_options('gallery', \dash\data::currentSectionDetail_model());

		if(isset($option['break_image_list']) && is_numeric($option['break_image_list']))
		{
			$break_image_list = intval($option['break_image_list']);
		}


		$html = '';


		$html .= \content_site\options\generate::form();
		{

	  		$html .= \content_site\options\generate::opt_hidden(get_called_class());
	  		$html .= \content_site\options\generate::specialsave();;

			$html .= '<nav class="items long">';
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
				        			$file_detail = \lib\filepath::get_detail($value['file']);

			        				switch (a($file_detail, 'type'))
			        				{
			        					case 'image':
			        						$file_url = \dash\fit::img(\lib\filepath::fix($value['file']));
			        						break;

			        					case 'video':
			        						if(a($value, 'video_poster'))
			        						{
			        							$file_url = \dash\fit::img(\lib\filepath::fix($value['video_poster']));
			        						}
			        						else
			        						{
			        							$file_url = \dash\utility\icon::url('Film',  'bootstrap');
			        						}
			        						break;

			        					default:
			        						$file_url = \dash\utility\icon::url('Image', 'major');
			        						break;
			        				}

				      			}
				      			else
				      			{
				        			$file_url = \dash\utility\icon::url('Image', 'major');
				      			}

				        		$html .= '<img src="'. $file_url. '" alt="'. a($value, 'title'). '">';
				        		$html .= '<div class="key">'. a($value, 'title').' </div>';

            					if (count($image_list) > 1)
            					{
              						$html .= '<img class="p-2 opacity-70 hover:bg-gray-200 sortHandle" alt="Image" data-handle src="'. \dash\utility\icon::url('DragHandle', 'minor'). '">';
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
				    		$html .= '<nav class="items long">';
							$html .= '<ul data-sortable>';
				    	}
		    		}
		  		}
		  		$html .= '</ul>';
			}
			$html .= '</nav>';
		}
		$html .= \content_site\options\generate::_form();


		return $html;
	}

}
?>