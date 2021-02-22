<?php
namespace dash\validate;
/**
 * Class for validate args
 */
class html
{
	private static function allow_tag($_type = null, $_mode = null)
	{
		$allow_tag = '<b><strong><i><p><br><ul><ol><li><h1><h2><h3><h4>';

		$allow_tag               = [];

		$allow_tag['b']          = ['allow_attr' => ['style']];
		$allow_tag['strong']     = ['allow_attr' => ['style']];
		$allow_tag['i']          = ['allow_attr' => ['style']];
		$allow_tag['p']          = ['allow_attr' => ['style']];
		$allow_tag['br']         = ['allow_attr' => []];
		$allow_tag['ol']         = ['allow_attr' => ['style']];
		$allow_tag['ul']         = ['allow_attr' => ['style']];
		$allow_tag['li']         = ['allow_attr' => ['style']];
		$allow_tag['h1']         = ['allow_attr' => ['style']];
		$allow_tag['h2']         = ['allow_attr' => ['style']];
		$allow_tag['h3']         = ['allow_attr' => ['style']];
		$allow_tag['h4']         = ['allow_attr' => ['style']];

		if($_mode !== 'basic')
		{
			$allow_tag['a']          = ['allow_attr' => ['href', 'style', 'target']];
			$allow_tag['table']      = ['allow_attr' => ['style']];
			$allow_tag['thead']      = ['allow_attr' => ['style']];
			$allow_tag['tbody']      = ['allow_attr' => ['style']];
			$allow_tag['tr']         = ['allow_attr' => ['style']];
			$allow_tag['td']         = ['allow_attr' => ['style']];
			$allow_tag['th']         = ['allow_attr' => ['style']];
			$allow_tag['figure']     = ['allow_attr' => ['style']];
			$allow_tag['figcaption'] = ['allow_attr' => ['style']];
			$allow_tag['img']        = ['allow_attr' => ['style', 'src']];
			$allow_tag['oembed']     = ['allow_attr' => ['style']];
			$allow_tag['blockquote'] = ['allow_attr' => ['style']];
		}

		if($_type === 'get_string')
		{
			$allow_tag = array_keys($allow_tag);
			$allow_tag = '<'. implode('><', $allow_tag). '>';
			return $allow_tag;
		}

		return $allow_tag;
	}


	public static function html($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = $_data;
		// php 7.3

		$data = self::analyze_html($data, $_notif, $_element, $_field_title);

		$allow_tag = self::allow_tag('get_string');

		$data = strip_tags($data, $allow_tag);


		return $data;
	}


	public static function html_basic($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = $_data;

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

	    $allow_tag = self::allow_tag('get_string', 'basic');

		$data = self::analyze_html($data, $_notif, $_element, $_field_title);

		$data = strip_tags($data, $allow_tag);


		return $data;
	}


	private static function analyze_html($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		if(!\dash\url::isLocal())
		{
			return $_data;
		}

		try
		{
			$utf8_meta = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';

			$doc = new \DOMDocument('1.0', 'UTF-8');

			@$doc->loadHTML($utf8_meta. $_data, LIBXML_HTML_NODEFDTD);

			self::clean_img($doc);

			$new_html = $doc->saveHTML();

			$new_html = trim($new_html);

			return $new_html;

		}
		catch (\Exception $e)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Can not analyze html"));
				\dash\cleanse::$status = false;
			}
			return false;
		}
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