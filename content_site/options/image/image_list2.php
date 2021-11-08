<?php
namespace content_site\options\image;


class image_list2
{

	public static function admin_html()
	{
		$currentSectionDetail = \dash\data::currentSectionDetail();

		$image_list = [];

		if(isset($currentSectionDetail['preview']['image_list2']) && is_array($currentSectionDetail['preview']['image_list2']))
		{
			$image_list = $currentSectionDetail['preview']['image_list2'];
		}


		$html = '';


		$html .= \content_site\options\generate::form();
		{

	  		$html .= \content_site\options\generate::opt_hidden(__CLASS__);
			$html .= \content_site\options\generate::opt_hidden('child_key', 'image_list2');


			$html .= '<nav class="items">';
			{
		  		$html .= '<ul data-sortable>';
		  		{
		    		foreach ($image_list as $key => $value)
		    		{
			      		$html .= '<li>';
			      		{
				      		$html .= '<a class="item f" href="'. \dash\url::that(). '/image_list2'. \dash\request::full_get(['index' => a($value, 'index')]). '">';
				      		{
					            $html .= '<input type="hidden" name="sort_child[]" value="'.  a($value, 'index'). '">';

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
              						$html .= '<img class="p-5 opacity-70 hover:bg-gray-200 sortHandle" alt="Image" data-handle src="'. \dash\utility\icon::url('DragHandle', 'minor'). '">';
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