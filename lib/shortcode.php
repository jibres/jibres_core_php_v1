<?php
namespace lib;


class shortcode
{

	public static function make_clickable($_data)
	{
		if(!$_data || !is_string($_data))
		{
			return $_data;
		}

		$pattern = "/[a-z]+:\/\/\S+/";
		if(!($all_link = preg_match_all($pattern, $_data, $links)))
		{
			return $_data;
		}

		return self::make_clickable_wp($_data);
	}


	public static function make_markdown($_data)
	{
		if(!$_data || !is_string($_data))
		{
			return $_data;
		}

		$pattern = "/(\*{3})([^\*{3}]{1,500})(\*{3})/";
		$count = 0;
		while (preg_match($pattern, $_data, $split))
		{
			$count++;

			$_data = preg_replace($pattern, "<b>$2</b>", $_data);

			if($count > 500)
			{
				break;
			}
		}

		return $_data;
	}



	public static function make_clickable_wp( $text )
	{
	    $r               = '';
	    $textarr         = preg_split( '/(<[^<>]+>)/', $text, -1, PREG_SPLIT_DELIM_CAPTURE ); // Split out HTML tags.
	    $nested_code_pre = 0; // Keep track of how many levels link is nested inside <pre> or <code>.

	    foreach ( $textarr as $piece )
	    {
	        if ( preg_match( '|^<code[\s>]|i', $piece ) || preg_match( '|^<pre[\s>]|i', $piece ) || preg_match( '|^<script[\s>]|i', $piece ) || preg_match( '|^<style[\s>]|i', $piece ) )
	        {
	            $nested_code_pre++;
	        }
	        elseif ( $nested_code_pre && ( '</code>' === strtolower( $piece ) || '</pre>' === strtolower( $piece ) || '</script>' === strtolower( $piece ) || '</style>' === strtolower( $piece ) ) )
	        {
	            $nested_code_pre--;
	        }

	        if ( $nested_code_pre || empty( $piece ) || ( '<' === $piece[0] && ! preg_match( '|^<\s*[\w]{1,20}+://|', $piece ) ) )
	        {
	            $r .= $piece;
	            continue;
	        }

	        // Long strings might contain expensive edge cases...
	        if ( 10000 < strlen( $piece ) )
	        {
	            // ...break it up.
	            foreach ( _split_str_by_whitespace( $piece, 2100 ) as $chunk )
	            {
	            	// 2100: Extra room for scheme and leading and trailing paretheses.
	                if ( 2101 < strlen( $chunk ) )
	                {
	                    $r .= $chunk; // Too big, no whitespace: bail.
	                }
	                else
	                {
	                    $r .= self::make_clickable_wp( $chunk );
	                }
	            }
	        }
	        else
	        {
	            $ret = " $piece "; // Pad with whitespace to simplify the regexes.

	            $url_clickable = '~
	                ([\\s(<.,;:!?])                                # 1: Leading whitespace, or punctuation.
	                (                                              # 2: URL.
	                    [\\w]{1,20}+://                                # Scheme and hier-part prefix.
	                    (?=\S{1,2000}\s)                               # Limit to URLs less than about 2000 characters long.
	                    [\\w\\x80-\\xff#%\\~/@\\[\\]*(+=&$-]*+         # Non-punctuation URL character.
	                    (?:                                            # Unroll the Loop: Only allow puctuation URL character if followed by a non-punctuation URL character.
	                        [\'.,;:!?)]                                    # Punctuation URL character.
	                        [\\w\\x80-\\xff#%\\~/@\\[\\]*(+=&$-]++         # Non-punctuation URL character.
	                    )*
	                )
	                (\)?)                                          # 3: Trailing closing parenthesis (for parethesis balancing post processing).
	            ~xS';
	            // The regex is a non-anchored pattern and does not have a single fixed starting character.
	            // Tell PCRE to spend more time optimizing since, when used on a page load, it will probably be used several times.

	            $ret = preg_replace_callback( $url_clickable, ['self', '_make_url_clickable_cb'], $ret );

	            // $ret = preg_replace_callback( '#([\s>])((www|ftp)\.[\w\\x80-\\xff\#$%&~/.\-;:=,?@\[\]+]+)#is', '_make_web_ftp_clickable_cb', $ret );
	            $ret = preg_replace_callback( '#([\s>])([.0-9a-z_+-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,})#i', ['self', '_make_email_clickable_cb'], $ret );

	            $ret = substr( $ret, 1, -1 ); // Remove our whitespace padding.
	            $r  .= $ret;
	        }
	    }

	    // Cleanup of accidental links within links.
	    return preg_replace( '#(<a([ \r\n\t]+[^>]+?>|>))<a [^>]+?>([^>]+?)</a></a>#i', '$1$3</a>', $r );
	}


	private static function _make_email_clickable_cb( $matches )
	{
	    $email = $matches[2] . '@' . $matches[3];
	    return $matches[1] . "<a href=\"mailto:$email\">$email</a>";
	}


	private static function _make_url_clickable_cb( $matches )
	{
	    $url = $matches[2];

	    if ( ')' === $matches[3] && \dash\str::strpos( $url, '(' ) )
	    {
	        // If the trailing character is a closing parethesis, and the URL has an opening parenthesis in it,
	        // add the closing parenthesis to the URL. Then we can let the parenthesis balancer do its thing below.
	        $url   .= $matches[3];
	        $suffix = '';
	    }
	    else
	    {
	        $suffix = $matches[3];
	    }

	    // Include parentheses in the URL only if paired.
	    while ( substr_count( $url, '(' ) < substr_count( $url, ')' ) )
	    {
	        $suffix = strrchr( $url, ')' ) . $suffix;
	        $url    = substr( $url, 0, strrpos( $url, ')' ) );
	    }

    	$url = str_replace( ' ', '%20', ltrim( $url ) );
    	$url = preg_replace( '|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\[\]\\x80-\\xff]|i', '', $url );
    	$url = str_replace( ';//', '://', $url );

	    if ( empty( $url ) )
	    {
	        return $matches[0];
	    }

	    $rel = 'nofollow noopener noreferrer';

	    if(\dash\str::strpos($url, \dash\url::base()) === 0)
	    {
	    	$rel = '';
	    }

	    if($rel)
	    {
	    	$rel = " rel=\"$rel\"";
	    }

	    return $matches[1] . "<a href=\"$url\" target=\"_blank\"$rel>$url</a>" . $suffix;
	}


	public static function remove_code($_string)
	{
		while(preg_match("/\[(video)\s+(from\=)([^\[\]\s]*)\s+(code\=)([^\[\]\s]*)\]/", $_string, $split))
		{
			$_string = str_replace($split[0], ' ', $_string);
		}

		return $_string;
	}



	public static function analyze_desc_html($_data)
	{
		if(!$_data || !is_string($_data))
		{
			return $_data;
		}

		if(\dash\url::content() === 'a' || \dash\url::content() === 'cms' || \dash\url::content() === 'site')
		{
			return $_data;
		}

		$_data = self::detect_video_short_code($_data);
		$_data = self::detect_formbuilder_code($_data);
		// $_data = self::detect_button_code($_data);

		// return $_data;
		return self::make_clickable($_data);

	}


	private static function check_short_code_param(string $_element, array $_allow_args,  $_string)
	{

		$result = [];

		$_string = strval($_string);

		$args = implode('|', $_allow_args);


		$preg = "/\[\s{0,}".$_element."\s+(((".$args.")\s{0,}\=\s{0,})([^\[\]\s]*)\s{0,}){1,}\s{0,}\]/u";

		if(preg_match($preg, $_string, $split))
		{
			$code = $split[0];

			$result['detect'] = $code;

			$code_char = "/\[|\]|\s|\=/u";

			$split_by_code_char = preg_split($code_char, $code);

			$code_array = [];

			foreach ($split_by_code_char as $key => $value)
			{
				$temp = preg_replace($code_char, '', $value);

				if($temp && !$temp !== $_element)
				{
					$code_array[] = $temp;
				}
			}

			foreach ($_allow_args as $key => $value)
			{
				$key_search = array_search($value, $code_array);
				if($key_search !== false && is_numeric($key_search))
				{
					$result[$value] = a($code_array, $key_search + 1);
				}
			}
		}

		return $result;
	}


	public static function detect_video_short_code($_data)
	{

		$i = 0;

		while($split = self::check_short_code_param('video', ['code', 'from'], $_data))
		{
			$i++;

			$detect_code  = a($split, 'detect');
			$videoSrc     = a($split, 'code');
			$videoService = a($split, 'from');

			if($videoService)
			{
				switch ($videoService)
				{
					case 'aparat':
						$iframe = '<div class="shortcode aspect-w-16 aspect-h-9 rounded overflow-hidden" type="video" from="aparat">';
						$iframe .= '<iframe src="https://www.aparat.com/video/video/embed/videohash/'. $videoSrc .'/vt/frame" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>';
						$iframe .= '</div>';
						break;

					case 'youtube':
						$iframe = '<div class="shortcode aspect-w-16 aspect-h-9 rounded overflow-hidden" type="video" from="youtube">';
						$iframe .= '<iframe src="https://www.youtube.com/embed/'. $videoSrc.'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
						$iframe .= '</div>';
						break;

					case 'vimeo':
						$iframe = '<div class="shortcode aspect-w-16 aspect-h-9 rounded overflow-hidden" type="video" from="vimeo">';
						$iframe .= '<iframe src="https://player.vimeo.com/video/'. $videoSrc.'" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>';
						$iframe .= '</div>';
						break;

					case 'dailymotion':
						$iframe = '<div class="shortcode aspect-w-16 aspect-h-9 rounded overflow-hidden" type="video" from="dailymotion">';
						$iframe .= '<iframe src="https://www.dailymotion.com/embed/video/'. $videoSrc.'" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>';
						$iframe .= '</div>';
						break;

					default:
						break;
				}
			}

			$_data = str_replace($detect_code, $iframe, $_data);

			if($i > 100)
			{
				break;
			}
		}

		return $_data;
	}




	public static function detect_formbuilder_code($_data)
	{
		$i = 0;

		while($split = self::check_short_code_param('form', ['id'], $_data))
		{
			$i++;

			$form_id = a($split, 'id');

			if($form_id)
			{
				$fomr_html = \lib\app\form\generator::sitebuilder_full_html($form_id);

				$_data = str_replace(a($split, 'detect'), strval($fomr_html), $_data);
			}

			if($i > 100)
			{
				break;
			}
		}


		return $_data;
	}



	public static function detect_button_code($_data)
	{
		//[button mode=primary title=View link=https://getbootstrap.com/docs/4.0/components/buttons/  class=btn-lg]
		//[button mode=secondary title=View link=https://getbootstrap.com/docs/4.0/components/buttons/  class=btn-lg]
		$i = 0;

		while($split = self::check_short_code_param('button', ['link', 'title', 'class', 'mode'], $_data))
		{
			$i++;

			$detect_code = a($split, 'detect');
			$link        = a($split, 'link');
			$mode        = a($split, 'mode');
			$title       = a($split, 'title');
			$class       = a($split, 'class');

			$html = '<a class="btn-'. $mode. ' '.$class.'" href="'.$link.'" target="_blank">';
			{
				$html .= $title;
			}
			$html .= '</a>';

			$_data = str_replace($detect_code, $html, $_data);


			if($i > 100)
			{
				break;
			}
		}

		return $_data;
	}

}
?>