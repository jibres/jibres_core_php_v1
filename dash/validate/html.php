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

		$allow_tag['br']     = [];
		$allow_tag['b']      = ['style', 'class', 'id', 'title'];
		$allow_tag['strong'] = ['style', 'class', 'id', 'title'];
		$allow_tag['i']      = ['style', 'class', 'id', 'title'];
		$allow_tag['p']      = ['style', 'class', 'id', 'title'];
		$allow_tag['ol']     = ['style', 'class', 'id', 'title'];
		$allow_tag['ul']     = ['style', 'class', 'id', 'title'];
		$allow_tag['li']     = ['style', 'class', 'id', 'title'];
		$allow_tag['h1']     = ['style', 'class', 'id', 'title'];
		$allow_tag['h2']     = ['style', 'class', 'id', 'title'];
		$allow_tag['h3']     = ['style', 'class', 'id', 'title'];
		$allow_tag['h4']     = ['style', 'class', 'id', 'title'];
		$allow_tag['h5']     = ['style', 'class', 'id', 'title'];
		$allow_tag['h6']     = ['style', 'class', 'id', 'title'];

		if($_mode !== 'basic')
		{
			$allow_tag['img']        = ['style', 'class', 'id', 'title', 'src', 'alt'];
			$allow_tag['a']          = ['style', 'class', 'id', 'title', 'href', 'target'];
			$allow_tag['oembed']     = ['style', 'class', 'id', 'title', 'url']; // allow video on youtue
			$allow_tag['table']      = ['style', 'class', 'id', 'title' ];
			$allow_tag['thead']      = ['style', 'class', 'id', 'title' ];
			$allow_tag['tbody']      = ['style', 'class', 'id', 'title' ];
			$allow_tag['tr']         = ['style', 'class', 'id', 'title' ];
			$allow_tag['td']         = ['style', 'class', 'id', 'title' ];
			$allow_tag['th']         = ['style', 'class', 'id', 'title' ];
			$allow_tag['figure']     = ['style', 'class', 'id', 'title' ];
			$allow_tag['figcaption'] = ['style', 'class', 'id', 'title' ];
			$allow_tag['blockquote'] = ['style', 'class', 'id', 'title' ];
			$allow_tag['code']       = ['style', 'class', 'id', 'title' ];
			$allow_tag['pre']        = ['style', 'class', 'id', 'title', 'data-language', 'spellcheck'];
		}

		if($_mode === 'full')
		{
			$allow_tag['style']    = ['type', 'media'];

			$allow_tag['div']      = ['style', 'class', 'id', 'title'];
			$allow_tag['section']  = ['style', 'class', 'id', 'title'];
			$allow_tag['article']  = ['style', 'class', 'id', 'title'];
			$allow_tag['aside']    = ['style', 'class', 'id', 'title'];
			$allow_tag['header']   = ['style', 'class', 'id', 'title'];
			$allow_tag['footer']   = ['style', 'class', 'id', 'title'];
			$allow_tag['kbd']      = ['style', 'class', 'id', 'title'];
			$allow_tag['nav']      = ['style', 'class', 'id', 'title'];
			$allow_tag['time']     = ['style', 'class', 'id', 'title'];
			$allow_tag['abbr']     = ['style', 'class', 'id', 'title'];
			$allow_tag['address']  = ['style', 'class', 'id', 'title'];
			$allow_tag['caption']  = ['style', 'class', 'id', 'title'];
			$allow_tag['wbr']      = ['style', 'class', 'id', 'title'];

			$allow_tag['dl']       = ['style', 'class', 'id', 'title'];
			$allow_tag['dt']       = ['style', 'class', 'id', 'title'];
			$allow_tag['dd']       = ['style', 'class', 'id', 'title'];


			$allow_tag['label']    = ['style', 'class', 'id', 'title', 'for'];
			$allow_tag['select']   = ['style', 'class', 'id', 'title', 'name', 'autofocus', 'disabled', 'required', 'multiple', 'form', 'size'];
			$allow_tag['audio']    = ['style', 'class', 'id', 'title', 'controls', 'loop', 'src', 'autoplay', 'muted', 'preload']; // check only is audio sc
			$allow_tag['video']    = ['style', 'class', 'id', 'title', 'controls', 'loop', 'src', 'autoplay', 'muted', 'preload', 'poster', 'width', 'height']; // check only video in sc
			$allow_tag['source']   = ['style', 'class', 'id', 'title', 'src', 'type'];
			$allow_tag['button']   = ['style', 'class', 'id', 'title', 'form', 'disabled', 'name', 'type', 'value'];
			$allow_tag['form']     = ['style', 'class', 'id', 'title', 'name', 'action', 'autocomplete', 'enctype', 'method'];
			$allow_tag['iframe']   = ['style', 'class', 'id', 'title', 'src', 'loading', 'height', 'width', 'allowfullscreen', 'frameborder', 'marginheight', 'marginwidth', 'scrolling']; // check src only ul
			$allow_tag['option']   = ['style', 'class', 'id', 'title', 'value', 'selected'];
			$allow_tag['optgroup'] = ['style', 'class', 'id', 'title', 'label', 'disabled'];
			$allow_tag['textarea'] = ['style', 'class', 'id', 'title', 'label', 'disabled', 'autofocus', 'cols', 'form', 'name', 'rows', 'required'];
			$allow_tag['input']    = ['style', 'class', 'id', 'title', 'name', 'accept', 'autofocus', 'checked', 'disabled', 'form', 'list', 'max','maxlength', 'min','minlength', 'placeholder','readonly','type','value','required'];
			$allow_tag['svg']      = ['xmlns', 'style', 'class', 'id', 'title','width', 'height', 'fill','viewBox','stroke','aria-hidden'];
			$allow_tag['path']     = ['style', 'class', 'id', 'title','width', 'height', 'stroke-linecap', 'stroke-linejoin', 'stroke-width', 'd',];

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

		$data = self::analyze_html($data, $_notif, $_element, $_field_title, $_meta);


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


	private static function analyze_html($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = $_data;

		$utf8_meta = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
		$data      = $utf8_meta. $data;

		// NEED GET RAW DATA
		$data = stripslashes($data);

		$allow_tag = self::allow_tag(null, 'full');

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

					foreach ($detail as $attr)
					{
						$attr_value        = $nodeTagName->getAttribute($attr);
						if(isset($attr_value) && $attr_value)
						{
							if($attr === 'src')
							{
								if(isset($_meta['html_full']) && $_meta['html_full'])
								{
									// no check any thing in src
								}
								else
								{
									// check only image can load in src
									if(!self::must_be_image_url($attr_value))
									{
										return false;
									}
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

			$new_html = htmlspecialchars_decode($new_html);

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
		$data = preg_replace("/\>\s{1,}\</", '><', $data);
		$data = str_replace('> <', '><', $data);

		if(strpos($data, '<svg ') !== false)
		{
			$data = str_replace('<svg ', '<svg xmlns="http://www.w3.org/2000/svg" ', $data);
		}

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