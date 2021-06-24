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

		$html .= '<nav class="items">';
		{
	  		$html .= '<ul>';
	  		{
	    		foreach ($currentSectionDetail['preview']['imagelist'] as $key => $value)
	    		{
		      		$html .= '<li>';
		      		{
			      		$html .= '<a class="item f" href="'. \dash\url::that(). '/imagelist'. \dash\request::full_get(['index' => a($value, 'index')]). '">';
			      		{
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
			        		$html .= '<div class="go"></div>';
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

}
?>