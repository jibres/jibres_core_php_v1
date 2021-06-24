<?php
namespace content_site\options;


class imagelist
{

	public static function admin_html()
	{
		$currentSectionDetail = \dash\data::currentSectionDetail();

		if($currentSectionDetail && isset($currentSectionDetail['preview']['imagelist']) && is_array($currentSectionDetail['preview']['imagelist']))
		{
			// ok
		}
		else
		{
			return null;
		}


		$html = '';


		$html .= '<form method="post" autocomplete="off">';
		{

	  		$html .= '<input type="hidden" name="set_sort_child" value="1">';
	  		$html .= '<input type="hidden" name="child_key" value="imagelist">';

			$html .= '<nav class="items">';
			{
		  		$html .= '<ul data-sortable>';
		  		{
		    		foreach ($currentSectionDetail['preview']['imagelist'] as $key => $value)
		    		{
			      		$html .= '<li>';
			      		{
				      		$html .= '<a class="item f" href="'. \dash\url::that(). '/imagelist'. \dash\request::full_get(['index' => a($value, 'index')]). '">';
				      		{
					            $html .= '<input type="hidden" name="sort_child[]" value="'.  a($value, 'index'). '">';

				      			if(isset($value['file']) && $value['file'])
				      			{
				        			$file_url = \lib\filepath::fix($value['file']);
				      			}
				      			else
				      			{
				        			$file_url = \dash\utility\icon::url('Image', 'major');
				      			}

				        		$html .= '<img src="'. $file_url. '">';
				        		$html .= '<div class="key">'. a($value, 'alt').' </div>';

            					if (count($currentSectionDetail['preview']['imagelist']) > 1)
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
		$html .= '</form>';


		return $html;
	}

}
?>