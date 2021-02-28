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
		$allow_tag['h1']         = ['allow_attr' => ['style', 'class']];
		$allow_tag['h2']         = ['allow_attr' => ['style', 'class']];
		$allow_tag['h3']         = ['allow_attr' => ['style', 'class']];
		$allow_tag['h4']         = ['allow_attr' => ['style', 'class']];

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


	public static function html($_data, $_notif = false, $_element = null, $_field_title = null)
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

		$data = self::analyze_html($data, $_notif, $_element, $_field_title);

		$allow_tag = self::allow_tag('get_string');

		$data = strip_tags($data, $allow_tag);

		$data = trim($data);

		return $data;
	}


	public static function html_basic($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = self::html(...func_get_args());

		if(!$data)
		{
			return $data;
		}

	    $allow_tag = self::allow_tag('get_string', 'basic');

		$data = strip_tags($data, $allow_tag);

		$data = trim($data);

		return $data;
	}


	private static function analyze_html($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		if(!\dash\url::isLocal())
		{
			return $_data;
		}

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
}
?>