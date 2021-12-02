<?php
namespace content_site\options\responsive;


class responsive_footer_links
{
	public static function extends_option()
	{
		return responsive_footer::extends_option();
	}

	public static function validator($_data)
	{
		$new_data = [];
		$new_data['use_as_footer_link'] = \dash\validate::enum(a($_data, 'use_as_footer_link'), false, ['enum' => ['none', 'custom', 'default']]);

		return $new_data;
	}


	public static function admin_html_default_links()
	{
		$default_menu = \dash\layout\pwa\pwa_menu::public_pwa_menu();
		$html = '';
		$html .= '<nav class="items">';
		{
	  		$html .= '<ul data-sortable>';
	  		{
	    		foreach ($default_menu as $key => $value)
	    		{
		      		$html .= '<li>';
		      		{
		      		$html .= '<a class="item f">';
			      		{
				            $img = 'Image';

			      			if(isset($value['img']) && $value['img'])
			      			{
			        			$img = $value['img'];
			      			}

			        		$img_url = \dash\utility\icon::url($img, 'major');

			        		$html .= '<img src="'. $img_url. '" alt="'. a($value, 'title'). '">';
			        		$html .= '<div class="key">'. a($value, 'title').' </div>';

			      		}
			      		$html .= '</a>';
		      		}
			    	$html .= '</li>';

	    		}
	  		}
	  		$html .= '</ul>';
		}
		$html .= '</nav>';

		return $html;
	}


	public static function admin_html()
	{
		$currentSectionDetail = \dash\data::currentSectionDetail();

		$footer_link_list = [];

		if(isset($currentSectionDetail['preview']['responsive']) && is_array($currentSectionDetail['preview']['responsive']))
		{
			$footer_link_list = $currentSectionDetail['preview']['responsive'];
		}


		$html = '';


		$html .= \content_site\options\generate::form();
		{

	  		$html .= \content_site\options\generate::opt_hidden(get_called_class());
			$html .= \content_site\options\generate::opt_hidden('child_key', 'responsive');


			$html .= '<nav class="items">';
			{
		  		$html .= '<ul data-sortable>';
		  		{
		    		foreach ($footer_link_list as $key => $value)
		    		{
			      		$html .= '<li>';
			      		{
				      		$html .= '<a class="item f" href="'. \dash\url::current(). '/responsive_footer'. \dash\request::full_get(['index' => a($value, 'index')]). '">';
				      		{
					            $html .= '<input type="hidden" name="sort_child[]" value="'.  a($value, 'index'). '">';

					            $icon = 'Image';

				      			if(isset($value['icon']) && $value['icon'])
				      			{
				        			$icon = $value['icon'];
				      			}

				        		$icon_url = \dash\utility\icon::url($icon, 'major');

				        		$html .= '<img src="'. $icon_url. '" alt="'. a($value, 'title'). '">';
				        		$html .= '<div class="key">'. a($value, 'title').' </div>';

            					if (count($footer_link_list) > 1)
            					{
              						$html .= '<img class="p-3 opacity-70 hover:bg-gray-200 sortHandle" alt="Image" data-handle src="'. \dash\utility\icon::url('DragHandle', 'minor'). '">';
              					}
              					else
              					{
				        			$html .= '<div class="go"></div>';
              					}

				      		}
				      		$html .= '</a>';
			      		}
				    	$html .= '</li>';

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