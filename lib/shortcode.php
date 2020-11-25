<?php
namespace lib;


class shortcode
{


	public static function analyze_desc_html($_data)
	{
		if(!$_data || !is_string($_data))
		{
			return $_data;
		}

		if(\dash\url::content() === 'a')
		{
			return $_data;
		}

		while(preg_match("/\[(video)\s+(from\=)([^\[\]\s]*)\s+(code\=)([^\[\]\s]*)\]/", $_data, $split))
		{
			if($split[3] === 'aparat')
			{
				$iframe = '<div class="shortcode" type="video" from="aparat">';
				$iframe .= '<iframe src="https://www.aparat.com/video/video/embed/videohash/'. $split[5] .'/vt/frame" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>';
				$iframe .= '</div>';
				$_data = str_replace($split[0], $iframe, $_data);
			}
			elseif($split[3] === 'youtube')
			{
				$iframe = '<div class="shortcode" type="video" from="youtube">';
				$iframe .= '<iframe src="https://www.youtube.com/embed/'. $split[5].'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
				$iframe .= '</div>';
				$_data = str_replace($split[0], $iframe, $_data);
			}
		}


		return $_data;
	}

}
?>