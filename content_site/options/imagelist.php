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
			        		$html .= '<img src="'. \dash\utility\icon::url('Image', 'major'). '">';
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