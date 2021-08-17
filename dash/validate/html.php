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

		$allow_tag['br']     = ['allow_attr' => []];
		$allow_tag['b']      = ['allow_attr' => ['style', 'class', 'id', 'title']];
		$allow_tag['strong'] = ['allow_attr' => ['style', 'class', 'id', 'title']];
		$allow_tag['i']      = ['allow_attr' => ['style', 'class', 'id', 'title']];
		$allow_tag['p']      = ['allow_attr' => ['style', 'class', 'id', 'title']];
		$allow_tag['ol']     = ['allow_attr' => ['style', 'class', 'id', 'title']];
		$allow_tag['ul']     = ['allow_attr' => ['style', 'class', 'id', 'title']];
		$allow_tag['li']     = ['allow_attr' => ['style', 'class', 'id', 'title']];
		$allow_tag['h1']     = ['allow_attr' => ['style', 'class', 'id', 'title']];
		$allow_tag['h2']     = ['allow_attr' => ['style', 'class', 'id', 'title']];
		$allow_tag['h3']     = ['allow_attr' => ['style', 'class', 'id', 'title']];
		$allow_tag['h4']     = ['allow_attr' => ['style', 'class', 'id', 'title']];
		$allow_tag['h5']     = ['allow_attr' => ['style', 'class', 'id', 'title']];
		$allow_tag['h6']     = ['allow_attr' => ['style', 'class', 'id', 'title']];

		if($_mode !== 'basic')
		{
			$allow_tag['img']        = ['allow_attr' => ['style', 'class', 'id', 'title', 'src', 'alt']];
			$allow_tag['a']          = ['allow_attr' => ['style', 'class', 'id', 'title', 'href', 'target']];
			$allow_tag['oembed']     = ['allow_attr' => ['style', 'class', 'id', 'title', 'url']]; // allow video on youtube
			$allow_tag['table']      = ['allow_attr' => ['style', 'class', 'id', 'title' ]];
			$allow_tag['thead']      = ['allow_attr' => ['style', 'class', 'id', 'title' ]];
			$allow_tag['tbody']      = ['allow_attr' => ['style', 'class', 'id', 'title' ]];
			$allow_tag['tr']         = ['allow_attr' => ['style', 'class', 'id', 'title' ]];
			$allow_tag['td']         = ['allow_attr' => ['style', 'class', 'id', 'title' ]];
			$allow_tag['th']         = ['allow_attr' => ['style', 'class', 'id', 'title' ]];
			$allow_tag['figure']     = ['allow_attr' => ['style', 'class', 'id', 'title' ]];
			$allow_tag['figcaption'] = ['allow_attr' => ['style', 'class', 'id', 'title' ]];
			$allow_tag['blockquote'] = ['allow_attr' => ['style', 'class', 'id', 'title' ]];
			$allow_tag['code']       = ['allow_attr' => ['style', 'class', 'id', 'title' ]];
			$allow_tag['pre']        = ['allow_attr' => ['style', 'class', 'id', 'title', 'data-language', 'spellcheck']];
		}

		if($_mode === 'full')
		{
			$allow_tag['div']      = ['allow_attr' => ['style', 'class', 'id', 'title']];
			$allow_tag['section']  = ['allow_attr' => ['style', 'class', 'id', 'title']];
			$allow_tag['article']  = ['allow_attr' => ['style', 'class', 'id', 'title']];
			$allow_tag['aside']    = ['allow_attr' => ['style', 'class', 'id', 'title']];
			$allow_tag['header']   = ['allow_attr' => ['style', 'class', 'id', 'title']];
			$allow_tag['footer']   = ['allow_attr' => ['style', 'class', 'id', 'title']];
			$allow_tag['kbd']      = ['allow_attr' => ['style', 'class', 'id', 'title']];
			$allow_tag['nav']      = ['allow_attr' => ['style', 'class', 'id', 'title']];
			$allow_tag['time']     = ['allow_attr' => ['style', 'class', 'id', 'title']];
			$allow_tag['abbr']     = ['allow_attr' => ['style', 'class', 'id', 'title']];
			$allow_tag['address']  = ['allow_attr' => ['style', 'class', 'id', 'title']];
			$allow_tag['caption']  = ['allow_attr' => ['style', 'class', 'id', 'title']];
			$allow_tag['wbr']      = ['allow_attr' => ['style', 'class', 'id', 'title']];

			$allow_tag['label']    = ['allow_attr' => ['style', 'class', 'id', 'title', 'for']];

			$allow_tag['select']   = ['allow_attr' => ['style', 'class', 'id', 'title', 'name', 'autofocus', 'disabled', 'required', 'multiple', 'form', 'size']];

			$allow_tag['audio']    = ['allow_attr' => ['style', 'class', 'id', 'title', 'controls', 'loop', 'src', 'autoplay', 'muted', 'preload']]; // check only is audio src

			$allow_tag['video']    = ['allow_attr' => ['style', 'class', 'id', 'title', 'controls', 'loop', 'src', 'autoplay', 'muted', 'preload', 'poster', 'width', 'height']]; // check only video in src

			$allow_tag['source']   = ['allow_attr' => ['style', 'class', 'id', 'title', 'src', 'type']];

			$allow_tag['button']   = ['allow_attr' => ['style', 'class', 'id', 'title', 'form', 'disabled', 'name', 'type', 'value']];

			$allow_tag['form']     = ['allow_attr' => ['style', 'class', 'id', 'title', 'name', 'action', 'autocomplete', 'enctype', 'method']];

			$allow_tag['iframe']   = ['allow_attr' => ['style', 'class', 'id', 'title', 'src', 'loading', 'height', 'width', 'allowfullscreen']]; // check src only url

			$allow_tag['option']   = ['allow_attr' => ['style', 'class', 'id', 'title', 'value', 'selected']];

			$allow_tag['optgroup'] = ['allow_attr' => ['style', 'class', 'id', 'title', 'label', 'disabled']];

			$allow_tag['textarea'] = ['allow_attr' => ['style', 'class', 'id', 'title', 'label', 'disabled', 'autofocus', 'cols', 'form', 'name', 'rows', 'required']];

			$allow_tag['input']    = ['allow_attr' => ['style', 'class', 'id', 'title', 'name', 'accept', 'autofocus', 'checked', 'disabled', 'form', 'list', 'max', 'maxlength', 'min', 'minlength', 'placeholder', 'readonly', 'type', 'value', 'required']];

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
		elseif(isset($_meta['html_full']) && $_meta['html_full'])
		{
	    	$allow_tag = self::allow_tag('get_string', 'full');
		}
		else
		{
			$allow_tag = self::allow_tag('get_string');
		}

		$data = strip_tags($data, $allow_tag);

		$data = trim($data);

		$data = \dash\safe::persian_char($data);

		return $data;
	}


	public static function html_basic($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$_meta['html_basic'] = true;

		return self::html($_data, $_notif, $_element, $_field_title, $_meta);
	}


	public static function html_full($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$_meta['html_full'] = true;

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

		$analyze_content = [];

		foreach ($allow_tag as $tag => $detail)
		{

			$doc = new \DOMDocument('1.0', 'UTF-8');

			@$doc->loadHTML($data, LIBXML_HTML_NODEFDTD | LIBXML_NONET | LIBXML_BIGLINES);

			$nodes = $doc->getElementsByTagName($tag);

			if($nodes->length)
			{

				foreach( $nodes as $nodeTagName )
				{
					if(!isset($analyze_content['tag_counter'][$tag]))
					{
						$analyze_content['tag_counter'][$tag] = 0;
					}

					$analyze_content['tag_counter'][$tag]++;

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

		if(\dash\temp::get('analyzeCotentImageUrl'))
		{
			$analyze_content['image_url'] = \dash\temp::get('analyzeCotentImageUrl');

			if(is_array($analyze_content['image_url']))
			{
				$analyze_content['image_count'] = count($analyze_content['image_url']);
			}
		}

		if(\dash\temp::get('analyzeCotentVideoUrl'))
		{
			$analyze_content['video_url'] = \dash\temp::get('analyzeCotentVideoUrl');

			if(isset($analyze_content['image_url']) && is_array($analyze_content['image_url']))
			{
				$analyze_content['image_count'] = count($analyze_content['image_url']);
			}
		}

		\dash\temp::set('analyzeCotent', $analyze_content);

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
			\dash\temp::set('check_img_url_path', T_("We can not support this image host url!"));
			return false;
		}

		\dash\temp::append('analyzeCotentImageUrl', $_url);

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
			\dash\temp::append('analyzeCotentVideoUrl', $_url);
			return true;
		}

		if(substr($_url, 0, 24) === 'https://www.youtube.com/')
		{
			\dash\temp::append('analyzeCotentVideoUrl', $_url);
			return true;
		}

		return false;

	}
}
?>