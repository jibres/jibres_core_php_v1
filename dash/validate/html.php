<?php
namespace dash\validate;
/**
 * Class for validate args
 */
class html
{
	private static function allow_tag($_type = null, $_mode = null)
	{
		$allow_tag               = [];

		$allow_tag['br']         = ['allow_attr' => []];
		$allow_tag['b']          = ['allow_attr' => ['style', 'class']];
		$allow_tag['strong']     = ['allow_attr' => ['style', 'class']];
		$allow_tag['i']          = ['allow_attr' => ['style', 'class']];
		$allow_tag['p']          = ['allow_attr' => ['style', 'class']];
		$allow_tag['ol']         = ['allow_attr' => ['style', 'class']];
		$allow_tag['ul']         = ['allow_attr' => ['style', 'class']];
		$allow_tag['li']         = ['allow_attr' => ['style', 'class']];
		$allow_tag['h1']         = ['allow_attr' => ['style', 'class', 'id']];
		$allow_tag['h2']         = ['allow_attr' => ['style', 'class', 'id']];
		$allow_tag['h3']         = ['allow_attr' => ['style', 'class', 'id']];
		$allow_tag['h4']         = ['allow_attr' => ['style', 'class', 'id']];

		if($_mode !== 'basic')
		{
			$allow_tag['img']        = ['allow_attr' => ['style', 'class', 'src', 'alt']];
			$allow_tag['a']          = ['allow_attr' => ['style', 'class', 'href', 'target']];
			$allow_tag['oembed']     = ['allow_attr' => ['style', 'class', 'url']]; // allow video on youtube
			$allow_tag['table']      = ['allow_attr' => ['style', 'class']];
			$allow_tag['thead']      = ['allow_attr' => ['style', 'class']];
			$allow_tag['tbody']      = ['allow_attr' => ['style', 'class']];
			$allow_tag['tr']         = ['allow_attr' => ['style', 'class']];
			$allow_tag['td']         = ['allow_attr' => ['style', 'class']];
			$allow_tag['th']         = ['allow_attr' => ['style', 'class']];
			$allow_tag['figure']     = ['allow_attr' => ['style', 'class']];
			$allow_tag['figcaption'] = ['allow_attr' => ['style', 'class']];
			$allow_tag['blockquote'] = ['allow_attr' => ['style', 'class']];
			$allow_tag['code']       = ['allow_attr' => ['class']];
			$allow_tag['pre']        = ['allow_attr' => ['class', 'data-language', 'spellcheck']];
		}

		if($_type === 'get_string')
		{
			// php 7.3
			$allow_tag = '<'. implode('><', array_keys($allow_tag)). '>';

			// php 7.4
			// $allow_tag = array_keys($allow_tag);
			return $allow_tag;
		}

		return $allow_tag;
	}


	public static function html($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{

		// Check if there is no invalid character in _data
	    if(preg_match('/\;base64\,/', $_data))
	    {
	    	if($_notif)
			{
				\dash\notif::error(T_("Can not send base64 image in this field"), ['element' => $_element, 'code' => 1605]);
				\dash\cleanse::$status = false;
			}
			return false;
	    }

		$data = $_data;

		$data = \dash\validate\text::html_decode($data);

		if($data === false)
		{
			if($_notif)
			{
				\dash\notif::error(T_("We can not save this text!"), ['element' => $_element, 'code' => 1605]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		$data = self::analyze_html($data, $_notif, $_element, $_field_title);

		if($data === false)
		{
			if($_notif)
			{
				if(\dash\temp::get('check_img_url_path'))
				{
					\dash\notif::error(\dash\temp::get('check_img_url_path'), ['element' => $_element, 'code' => 1605]);
				}
				else
				{
					\dash\notif::error(T_("Something in html is wrong!"), ['element' => $_element, 'code' => 1605]);
				}
				\dash\cleanse::$status = false;
			}
			return false;
		}

		if(isset($_meta['html_basic']) && $_meta['html_basic'])
		{
	    	$allow_tag = self::allow_tag('get_string', 'basic');
		}
		else
		{
			$allow_tag = self::allow_tag('get_string');
		}

		$data = strip_tags($data, $allow_tag);

		$data = trim($data);

		return $data;
	}


	public static function html_basic($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$_meta['html_basic'] = true;

		return self::html($_data, $_notif, $_element, $_field_title, $_meta);
	}


	private static function analyze_html($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = $_data;

		$utf8_meta = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
		$data      = $utf8_meta. $data;

		// NEED GET RAW DATA
		$data = stripslashes($data);

		$allow_tag = self::allow_tag();

		foreach ($allow_tag as $tag => $detail)
		{

			$doc = new \DOMDocument('1.0', 'UTF-8');

			@$doc->loadHTML($data, LIBXML_HTML_NODEFDTD | LIBXML_NONET | LIBXML_BIGLINES);

			$nodes = $doc->getElementsByTagName($tag);

			if($nodes->length)
			{
				foreach( $nodes as $nodeTagName )
				{
					$nodeNewTagname = $doc->createElement($tag, self::DOMinnerHTML($nodeTagName));

					foreach ($detail['allow_attr'] as $attr)
					{

						$attr_value        = $nodeTagName->getAttribute($attr);
						if(isset($attr_value) && $attr_value)
						{
							if($attr === 'src')
							{
								// check only image can load in src
								if(!self::must_be_image_url($attr_value))
								{
									return false;
								}
							}
							elseif($attr === 'url')
							{
								// url only use in oembed and this tag only use for youtube video
								if(!self::must_be_youtube_url($attr_value))
								{
									return false;
								}
							}
					    	$nodeNewTagname->setAttribute($attr, $attr_value);
						}
					}

				    $nodeTagName->parentNode->replaceChild($nodeNewTagname, $nodeTagName);
				}
			}

			$doc->normalizeDocument();

			$new_html = $doc->saveHTML();

			$data = $new_html;

		}

		$data = htmlspecialchars_decode($data);
		$data = preg_replace("/\n/", ' ', $data);
		$data = preg_replace("/\s{2,}/", ' ', $data);

		$data = \dash\db::safe($data);

		return $data;
	}


	private static function DOMinnerHTML($element)
	{
	    $innerHTML = "";
	    $children  = $element->childNodes;

	    foreach ($children as $child)
	    {
	        $innerHTML .= $element->ownerDocument->saveHTML($child);
	    }

	    return $innerHTML;
	}

	/**
	* Clean img tag
	*/
	private static function clean_img(&$doc)
	{
		foreach( $doc->getElementsByTagName("img") as $nodeImg )
		{
			$src        = $nodeImg->getAttribute('src');
			$nodeNewImg = @$doc->createElement("img", $nodeImg->nodeValue);
		    @$nodeNewImg->setAttribute('src', $src);
		    @$nodeImg->parentNode->replaceChild($nodeNewImg, $nodeImg);
		}
	}


	/**
	 * Check the url only image url
	 * by extension .jpg .png .webp .gif .jpeg
	 *
	 * @param      <type>   $_url   The url
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	private static function must_be_image_url($_url)
	{
		if(!is_string($_url))
		{
			return false;
		}

		$analyze_url = \dash\validate\url::parseUrl($_url);

		if(!isset($analyze_url['root']) || !isset($analyze_url['path']))
		{
			\dash\temp::set('check_img_url_path', T_("Invalid url!"));
			return false;
		}

		if(!preg_match("/\.(jpg|png|gif|webp|jpeg)$/", $analyze_url['path']))
		{
			\dash\temp::set('check_img_url_path', T_("Invalid image url!"));
			return false;
		}

		$allow_upload_provider =
		[
			'talambar',
			'arvanstorage',
			'digitaloceanspaces',
			'amazonaws',
		];

		if(!in_array($analyze_url['root'], $allow_upload_provider))
		{
			\dash\temp::set('check_img_url_path', T_("We can not support this image url!"));
			return false;
		}

		return true;
	}



	private static function  must_be_youtube_url($_url)
	{
		if(!is_string($_url))
		{
			return false;
		}

		if(substr($_url, 0, 20) === 'https://youtube.com/')
		{
			return true;
		}

		if(substr($_url, 0, 24) === 'https://www.youtube.com/')
		{
			return true;
		}

		return false;

	}
}
?>