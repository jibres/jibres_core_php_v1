<?php
namespace content_site\options\google;


class google_map_embed
{

	public static function validator($_data)
	{
		$data = \dash\validate::real_html_full(\dash\request::post_html());

		$url = null;
		if($data)
		{
			$data = strip_tags($data, '<iframe>');

			$data = stripslashes($data);

			if(preg_match("/iframe\ssrc\=\"([^\"]*)\"/", $data, $c))
			{
				$url = $c[1];

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
			}
		}

		return $url;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('google_map_embed');

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= '<input type="hidden" name="not_redirect" value="1">';
			$html .= '<input type="hidden" name="opt_google_map_embed" value="1">';
	    	$html .= '<label for="description">'. T_("Google map Embed code"). '</label>';
	    	$html .= '<textarea class="txt" name="html" rows="3">';
	    	$html .= $default;
	    	$html .= '</textarea>';
		}
  		$html .= '</form>';

		return $html;
	}

}
?>