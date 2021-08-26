<?php
namespace content_site\options;


class text
{

	public static function router()
	{
		\dash\allow::html();
	}


	public static function validator($_data)
	{
		\dash\temp::set('siteBuilderSetValueInText', true);

		$myhtml = \dash\validate::real_html(\dash\request::post_html());
		$myhtml = stripcslashes($myhtml);
		$new_data = ['html' => $myhtml, 'update_time' => microtime()];

		return $new_data;
	}



	public static function special_admin_html()
	{
		$section_detail = \dash\data::currentSectionDetail();

		$text_html = null;
		if(isset($section_detail['text_preview']) && $section_detail['text_preview'])
		{
			$text_html = $section_detail['text_preview'];
		}


		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{

	    	$html .= '<input type="hidden" name="not_redirect" value="1">';
	    	$html .= '<input type="hidden" name="opt_text" value="1">';
	    	$html .= '<input type="hidden" name="multioption" value="multi">';

	    	$html .= '<button class="btn-primary">Save</button>';
	    	$html .= '<textarea data-editor  name="html" class="txt ltr txt-l" rows=10>'. htmlentities($text_html) .'</textarea>';
	    }

  		$html .= '</form>';


		return $html;
	}


}
?>