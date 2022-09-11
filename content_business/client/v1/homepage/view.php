<?php

namespace content_business\client\v1\homepage;

class view
{

	public static function config()
	{
		$result = self::loadHomepage();

		\dash\code::jsonBoom($result);
	}


	private static function loadHomepage() : array
	{
		$result = [];

		$homepage_id = \content_site\homepage::id();
		if(!$homepage_id)
		{
			$result = [];
		}
		else
		{

			$post_detail = \dash\db\posts\get::by_id_type($homepage_id, 'pagebuilder');
			if(!$post_detail || !is_array($post_detail))
			{
				$post_detail = [];
			}

			$list = [];

			if(isset($post_detail['id']) && $post_detail['id'])
			{
				$list = \lib\db\sitebuilder\get::line_list($post_detail['id']);
			}


			$readyList = [];
			foreach ($list as $section)
			{
				$readyList[] = self::readySection($section);
			}
			$post_detail          = self::readyPost($post_detail);
			$result['pageDetail'] = $post_detail;
			$result['items']      = $readyList;
			// $result['items']      = $list;

		}

		return $result;
	}


	private static function readyPost(array $_post_detail) : array
	{
		$post_detail = [];
		foreach ($_post_detail as $field => $value)
		{
			switch ($field)
			{

				case 'id':
					$post_detail[$field] = \dash\coding::encode($value);
					break;


				case 'title':
					$post_detail[$field] = $value;
					break;

				case 'meta':
					$meta = [];
					if($value)
					{
						$meta = json_decode($value, true);
						if(!is_array($meta))
						{
							$meta = [];
						}
					}

					unset($meta['preview']);

					if(isset($meta['body']))
					{
						$meta = $meta['body'];
					}

					$post_detail['meta'] = $meta;
					break;

				default:
					// do nothing
					break;
			}
		}

		return $post_detail;
	}


	private static function readySection(array $_section) : array
	{
		$section = [];
		foreach ($_section as $field => $value)
		{
			switch ($field)
			{

				case 'id':
					$section[$field] = ($value);
					break;

				case 'folder':
				case 'section':
				case 'model':
				case 'preview_key':
				case 'text':
				case 'device':
				case 'mobile':
				case 'os':
				case 'title':
					$section[$field] = $value;
					break;

				case 'body':
					$body = [];
					if($value)
					{
						$body = json_decode($value, true);
						if(!is_array($body))
						{
							$body = [];
						}
					}


					$section['body'] = $body;
					break;

				default:
					// do nothing
					break;
			}
		}

		return $section;
	}


}