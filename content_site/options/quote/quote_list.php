<?php
namespace content_site\options\quote;


class quote_list
{

	public static function admin_html()
	{
		$currentSectionDetail = \dash\data::currentSectionDetail();

		if($currentSectionDetail && isset($currentSectionDetail['preview']['quote_list']) && is_array($currentSectionDetail['preview']['quote_list']))
		{
			// ok
		}
		else
		{
			return null;
		}


		$html = '';


		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::opt_hidden('set_sort_child');
			$html .= \content_site\options\generate::opt_hidden('child_key', 'quote_list');


			$html .= '<nav class="items">';
			{
		  		$html .= '<ul data-sortable>';
		  		{
		    		foreach ($currentSectionDetail['preview']['quote_list'] as $key => $value)
		    		{
			      		$html .= '<li>';
			      		{
				      		$html .= '<a class="item f" href="'. \dash\url::that(). '/quote_list'. \dash\request::full_get(['index' => a($value, 'index')]). '">';
				      		{
					            $html .= '<input type="hidden" name="sort_child[]" value="'.  a($value, 'index'). '">';

				      			if(isset($value['avatar']) && $value['avatar'])
				      			{
				        			$file_url = \lib\filepath::fix($value['avatar']);
				      			}
				      			else
				      			{
				        			$file_url = \dash\utility\icon::url('Image', 'major');
				      			}

				        		$html .= '<img src="'. $file_url. '" alt="'. a($value, 'title'). '">';
				        		$html .= '<div class="key">'. a($value, 'title').' </div>';

            					if (count($currentSectionDetail['preview']['quote_list']) > 1)
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