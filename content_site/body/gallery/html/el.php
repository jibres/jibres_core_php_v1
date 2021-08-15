<?php
namespace content_site\body\gallery\html;


class el
{

	public static function img($_data, $_class, $_link = true)
	{
		$html = '';

		if(a($_data, 'link') && $_link)
		{
			$html .= '<a href="'. $_data['link']. '"';
			if(a($_data, 'target'))
			{
				$html .= ' target="_blank"';
			}
			$html .= '>';
		}

		$url = a($_data, 'image');
		if(!$url)
		{
			$url = \dash\app::static_image_url();
		}
		else
		{
			$url = \lib\filepath::fix($url);
		}

		$html .= '<img src="'. $url. '" alt="'. a($_data, 'caption'). '" class="'. $_class. '">';

		if(a($_data, 'link') && $_link)
		{
			$html .= '</a>';
		}

		return $html;
	}


	public static function img_nolink($_data, $_class)
	{
		return self::img($_data, $_class, false);
	}
}
?>