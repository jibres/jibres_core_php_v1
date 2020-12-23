<?php
namespace dash\app\posts;


class ready
{
	public static function row($_data)
	{
		$result = [];

		if(!is_array($_data))
		{
			$_data  = [];
		}

		$result               = [];
		$result['icon_list'] = null;

		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
				case 'user_id':
				case 'parent':
				case 'term_id':
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'meta':
					$result['meta'] = null;
					if(is_array($value))
					{
						$result['meta'] = $value;
					}
					elseif(is_string($value))
					{
						$result['meta'] = json_decode($value, true);
						if(!is_array($result['meta']))
						{
							$result['meta'] = [];
						}
					}

					if(isset($result['meta']['thumb']))
					{
						$result['meta']['thumb'] = \lib\filepath::fix($result['meta']['thumb']);
						$result['thumb_image'] = $result['meta']['thumb'];
					}

					if(isset($result['meta']['gallery']['files']) && is_array($result['meta']['gallery']['files']))
					{
						foreach ($result['meta']['gallery']['files'] as $Gkey => $Gvalue)
						{
							if(isset($Gvalue['path']))
							{
								$result['meta']['gallery']['files'][$Gkey]['path'] = \lib\filepath::fix($result['meta']['gallery']['files'][$Gkey]['path']);
							}

						}
					}


					break;

				case 'gallery':
					if($value)
					{
						$result['gallery_array'] = json_decode($value, true);
						if(is_array($result['gallery_array']) && $result['gallery_array'])
						{
							$result['gallery_array'] = \dash\app\posts\gallery::load_detail($result['gallery_array']);
						}
					}
					else
					{
						$result['gallery_array'] = null;
					}
					break;

				case 'slug':
					$result[$key] = $value;
					$split = explode('/', $value);
					$parent_url = [];
					$my_parent_url = [];
					if(count($split) > 1)
					{
						foreach ($split as $index => $parent_slug)
						{
							$parent_url[] = $parent_slug;
							$my_parent_url[] = implode('/', $parent_url);
						}

						array_pop($my_parent_url);
					}

					$result['slug_raw']   = end($split);
					$result['parent_url'] = $my_parent_url;
					break;

				case 'url':
					$result[$key] = $value;
					break;


				case 'content':
					if(\dash\url::content() === 'cms')
					{
						$result[$key] = $value;
					}
					else
					{
						$result[$key] = \lib\shortcode::analyze_desc_html($value);
					}
					break;

				case 'thumb':
				case 'cover':
					if($value)
					{
						$value = \lib\filepath::fix($value);
					}
					$result[$key] = $value;
					break;

				case 'status':
					switch ($value)
					{
						case 'draft':
							$result['icon_list'] = ' detail ';
							break;

						case 'publish':
							$result['icon_list'] = ' check ok ';
							break;

						case 'deleted':
							$result['icon_list'] = ' times nok ';
							break;

						default:
							$result['icon_list'] = ' detail ';
							break;
					}
					$result[$key] = $value;
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		if(a($result, 'content') && !a($result, 'excerpt'))
		{
			$result['excerpt'] = \dash\utility\excerpt::extractRelevant($result['content']);
			$result['auto_excerpt'] = true;
		}

		if(\dash\url::content() === 'cms')
		{
			if(!a($result, 'auto_excerpt') && a($result, 'content'))
			{
				if(\dash\utility\excerpt::extractRelevant($result['content']) == a($result, 'excerpt'))
				{
					$result['auto_excerpt'] = true;
				}
			}
		}

		if(isset($result['url']))
		{
			if(\dash\engine\store::inStore())
			{
				$my_link = \lib\store::url(). '/';
			}
			else
			{
				$my_link = \dash\url::kingdom(). '/';
			}

			// only jibres have post language
			// all business have not any lanuage
			if(!\dash\engine\store::inStore())
			{
				if(isset($result['language']) && $result['language'] && !\dash\url::lang())
				{
					$my_link .=  $result['language']. '/';
				}
			}

			if(isset($result['type']) && $result['type'] === 'help')
			{
				$my_link .= 'support/';
			}


			$my_link .= $result['url'];

			$result['link'] = $my_link;
		}
		else
		{
			$result['link'] = null;
		}


		if(a($result, 'subtype') === 'video')
		{
			$result['poster'] = null;

			if(a($result, 'cover'))
			{
				$result['poster'] = $result['cover'];
			}
			elseif(a($result, 'thumb'))
			{
				$result['poster'] = $result['thumb'];
			}
		}


		if(isset($result['publishdate']) && $result['publishdate'] && isset($result['status']) && $result['status'] === 'publish')
		{
			$myTime = time() - strtotime($result['publishdate']);

			if($myTime < 0)
			{
				$result['will_be_published_on_future'] = ['message' => T_("will be published on future"), 'time' => abs($myTime), 'time_human' => \dash\utility\human::time(abs($myTime), true)];
			}
		}

		self::check_valid_subtype($result);

		return $result;
	}


	private static function check_valid_subtype(&$result)
	{
		if(\dash\url::content() !== 'cms')
		{
			return;
		}

		$result['validation_type'] =
		[
			'audio'    => false,
			'video'    => false,
			'gallery'  => true,
			'standard' => true,
		];

		if(a($result, 'gallery_array', 0, 'type') === 'audio' && is_array(a($result, 'gallery_array')) && count(a($result, 'gallery_array')) === 1)
		{
			$result['validation_type']['audio'] = true;
		}

		if(a($result, 'gallery_array', 0, 'type') === 'video' && is_array(a($result, 'gallery_array')) && count(a($result, 'gallery_array')) === 1)
		{
			$result['validation_type']['video'] = true;
		}

	}
}
?>