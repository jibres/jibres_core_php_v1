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

		if(empty($_data))
		{
			return [];
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

				case 'gallery':
					$result[$key] = $value;
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

				case 'seorank':
					if(!$value)
					{
						$value = 0;
					}
					$result[$key]   = $value;
					$result['seo_rank_star'] = \dash\seo::star_html(round(($value * 5 / 100)));
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
							$result['tstatus'] = T_("Draft");
							$result['icon_list'] = ' detail ';
							break;

						case 'publish':
							$result['tstatus'] = T_("Published");
							$result['icon_list'] = ' check ok ';
							break;

						case 'deleted':
							$result['tstatus'] = T_("Trash");
							$result['icon_list'] = ' times nok ';
							break;

						case 'pending_review':
							$result['tstatus'] = T_("Pending Review");
							$result['icon_list'] = ' detail nok ';
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

		if(isset($result['url']) && $result['url'])
		{
			$my_link .= $result['url'];
		}
		else
		{
			$my_link .= 'n/';

			if(isset($result['id']) && $result['id'])
			{
				$my_link .= $result['id'];
			}

			if(isset($result['slug']) && $result['slug'])
			{
				$my_link .= '/'.$result['slug'];
			}
		}

		$result['link'] = $my_link;


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

		$publishdate_message = null;
		if(isset($result['publishdate']) && $result['publishdate'])
		{
			$myTime = time() - strtotime($result['publishdate']);
			if($myTime < 0)
			{
				$publishdate_message = T_("Post will be published at :val", ['val' => \dash\fit::date_time($result['publishdate'])]);
			}
			else
			{
				$publishdate_message = T_("Post published at :val", ['val' => \dash\fit::date_time($result['publishdate'])]);
			}
		}
		else
		{
			$publishdate_message = T_("Post will be published at when status set on publish");
		}
		$result['publishdate_message'] = $publishdate_message;






		if(isset($result['will_be_published_on_future']) && isset($result['status']) && $result['status'] === 'publish' && \dash\url::content() !== 'cms' && !\dash\request::get('preview'))
		{
			$result['content']       = $result['will_be_published_on_future']['message'];
			$result['gallery_array'] = [];
			$result['gallery']       = null;
			$result['thumb']         = null;
			$result['title']         = null;
			$result['subtitle']      = null;
			$result['cover']         = null;
			$result['comment']       = 'close';
		}


		// set seo title
		$result['post_title'] = null;

		if(isset($result['seotitle']) && $result['seotitle'])
		{
			$result['post_title'] = $result['seotitle'];
		}
		elseif(isset($result['title']))
		{
			$result['post_title'] = $result['title']. ' | '. \dash\face::hereTitle();
		}


		// unset some private variable in api
		if(\dash\temp::get('isApi'))
		{
			unset($result['icon_list']);
			unset($result['meta']);
			unset($result['special']);
			unset($result['auto_excerpt']);
			unset($result['language']);
			unset($result['post_title']);
			unset($result['gallery']);
			unset($result['publishdate_message']);
			unset($result['tstatus']);
			unset($result['seo_rank_star']);

		}

		return $result;
	}
}
?>