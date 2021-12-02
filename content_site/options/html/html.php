<?php
namespace content_site\options\html;


class html
{

	public static function router()
	{
		\dash\allow::html();
	}


	public static function validator($_data)
	{
		\dash\temp::set('siteBuilderSetValueInText', true);

		$myhtml = \dash\validate::real_html_full(\dash\request::post_html());
		$myhtml = stripcslashes($myhtml);
		$new_data = ['html' => $myhtml];

		return $new_data;
	}



	public static function admin_html($_section_detail)
	{
		$text_html = null;
		if(isset($_section_detail['text_preview']) && $_section_detail['text_preview'])
		{
			$text_html = $_section_detail['text_preview'];
		}


		$html = '';
		$html .= \content_site\options\generate::form();
		{

	    	$html .= \content_site\options\generate::not_redirect();
	    	$html .= \content_site\options\generate::opt_hidden(get_called_class());
	    	$html .= \content_site\options\generate::multioption();

	    	$html .= '<textarea  name="html" class="txt ltr txt-l" rows=10>'. htmlentities($text_html) .'</textarea>';
	    }

  		$html .= \content_site\options\generate::_form();


		return $html;
	}

}
?>