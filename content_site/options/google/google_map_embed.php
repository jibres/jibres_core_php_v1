<?php
namespace content_site\options\google;


class google_map_embed
{

	public static function validator($_data)
	{
		$url = null;

		$data = a($_data, 'html');

		if(\dash\request::post_html() !== $data)
		{
			$data = \dash\validate::real_html_full(\dash\request::post_html());

			$data = strip_tags($data, '<iframe>');

			$data = stripslashes($data);

			if(preg_match("/iframe\ssrc\=\"([^\"]*)\"/", $data, $c))
			{
				$url = $c[1];
			}
		}
		else
		{
			$url = $data;
		}

		$check = \dash\validate\url::parseUrl($url);

		if(isset($check['root']) && $check['root'] === 'google' && isset($check['tld']) && $check['tld'] === 'com')
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("Can not support this url on google map Embed"));
			return false;
		}

		return $url;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('google_map_embed');

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::not_redirect();
			$html .= \content_site\options\generate::opt_hidden(__CLASS__);
	    	$html .= '<label for="description">'. T_("Google map Embed code"). '</label>';
	    	$html .= '<textarea class="txt" name="html" rows="3" id="description">';
	    	$html .= $default;
	    	$html .= '</textarea>';
		}
  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>