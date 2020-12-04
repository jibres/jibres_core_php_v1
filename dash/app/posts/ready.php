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

		return $result;

	}
}
?>