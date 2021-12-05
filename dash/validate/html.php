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

		$allow_tag['i']      = [];
		$allow_tag['b']      = [];
		$allow_tag['p']      = [];
		$allow_tag['br']     = [];
		$allow_tag['ol']     = [];
		$allow_tag['ul']     = [];
		$allow_tag['li']     = [];
		$allow_tag['h1']     = [];
		$allow_tag['h2']     = [];
		$allow_tag['h3']     = [];
		$allow_tag['h4']     = [];
		$allow_tag['h5']     = [];
		$allow_tag['h6']     = [];
		$allow_tag['strong'] = [];

		if($_mode !== 'basic')
		{
			$allow_tag['oembed']     = ['url']; // allow video on youtue
			$allow_tag['a']          = ['href', 'target'];
			$allow_tag['pre']        = ['data-language', 'spellcheck'];
			$allow_tag['img']        = ['src', 'alt', 'height', 'width'];
			$allow_tag['table']      = [];
			$allow_tag['thead']      = [];
			$allow_tag['tbody']      = [];
			$allow_tag['tr']         = [];
			$allow_tag['td']         = [];
			$allow_tag['th']         = [];
			$allow_tag['figure']     = [];
			$allow_tag['figcaption'] = [];
			$allow_tag['blockquote'] = [];
			$allow_tag['code']       = [];
			$allow_tag['span']       = [];
		}

		if($_mode === 'full')
		{

			$allow_tag['div']      = [];
			$allow_tag['section']  = [];
			$allow_tag['article']  = [];
			$allow_tag['aside']    = [];
			$allow_tag['header']   = [];
			$allow_tag['footer']   = [];
			$allow_tag['kbd']      = [];
			$allow_tag['nav']      = [];
			$allow_tag['time']     = [];
			$allow_tag['abbr']     = [];
			$allow_tag['address']  = [];
			$allow_tag['caption']  = [];
			$allow_tag['wbr']      = [];

			$allow_tag['dl']       = [];
			$allow_tag['dt']       = [];
			$allow_tag['dd']       = [];
			$allow_tag['g']        = [];

			$allow_tag['label']    = ['for'];
			$allow_tag['style']    = ['type', 'media'];
			$allow_tag['source']   = ['src', 'type'];
			$allow_tag['option']   = ['value', 'selected'];
			$allow_tag['optgroup'] = ['label', 'disabled'];
			$allow_tag['button']   = ['form', 'disabled', 'name', 'type', 'value'];
			$allow_tag['form']     = ['name', 'action', 'autocomplete', 'enctype', 'method'];
			$allow_tag['audio']    = ['controls', 'loop', 'src', 'autoplay', 'muted', 'preload']; // check only is audio sc
			$allow_tag['select']   = ['name', 'autofocus', 'disabled', 'required', 'multiple', 'form', 'size'];
			$allow_tag['path']     = ['width', 'height', 'stroke-linecap', 'stroke-linejoin', 'stroke-width', 'd',];
			$allow_tag['textarea'] = ['label', 'disabled', 'autofocus', 'cols', 'form', 'name', 'rows', 'required'];
			$allow_tag['video']    = ['controls', 'loop', 'src', 'autoplay', 'muted', 'preload', 'poster', 'width', 'height']; // check only video in sc
			$allow_tag['svg']      = ['xmlns', 'width', 'height', 'fill','viewBox','stroke','aria-hidden', 'version', 'x', 'y'];
			$allow_tag['iframe']   = ['src', 'loading', 'height', 'width', 'allowfullscreen', 'frameborder', 'marginheight', 'marginwidth', 'scrolling']; // check src only ul
			$allow_tag['input']    = ['name', 'accept', 'autofocus', 'checked', 'disabled', 'form', 'list', 'max','maxlength', 'min','minlength', 'placeholder','readonly','type','value','required'];

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


	private static function public_attr()
	{
		return
		[
			'style',
			'class',
			'id',
			'title',
			// 'data-data',
			// 'data-confirm',
			// 'data-ajaxify',
			// 'data-kerkere',
			'data-accordion',
			'aria-labelledby',
		];

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

					$detail = array_merge($detail, self::public_attr());

					foreach ($nodeTagName->attributes as $attrName => $attrNode)
					{
					    if(substr($attrName, 0, 5) === 'data-')
					    {
					    	$detail[] = $attrName;
					    }
					}

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
						else
						{
							if($tag === 'img' && $attr === 'alt')
							{
					    		$nodeNewTagname->setAttribute('alt', '');
							}

							if($nodeTagName->hasAttribute($attr))
							{
				    			$nodeNewTagname->setAttribute($attr, '');
							}
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

		if(\dash\str::strpos($data, '<svg ') !== false)
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
			\dash\temp::set('check_img_url_path', T_("In the submitted content, a phrase was found that should only be the address of an image and we do not allow the registration of any type of address in that section!"));
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