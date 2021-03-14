<?php
namespace lib\app\menu;


class check
{
	public static function variable($_args)
	{

		$condition =
		[
			'title'         => 'title',
			'url'           => 'absolute_url',
			'pointer'       => ['enum' => ['homepage','products','posts','forms','tags','hashtag','socialnetwork','other', 'title', 'separator']],
			'target'        => ['enum' => ['blank']],
			'parent'        => 'id',
			'related_id'    => 'id',
			// 'parent1'    => 'id',
			// 'parent2'    => 'id',
			// 'parent3'    => 'id',
			// 'parent4'    => 'id',
			// 'parent5'    => 'id',
			'product_id'    => 'id',
			'post_id'       => 'code',
			'form_id'       => 'id',
			'tag_id'        => 'code',
			'socialnetwork' => 'socialnetwork',
			'hashtag_id'    => 'id',
			'form_id'       => 'id',
		];

		$require = [];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if($data['pointer'] === 'separator')
		{
			$data['title'] = null;
			// title is not require
		}
		else
		{
			if(!isset($data['title']))
			{
				\dash\notif::error(T_("Title is required"), 'title');
				return false;
			}
		}

		if($data['parent'])
		{
			$parent = $data['parent'];

			$load_parent = \lib\db\menu\get::by_id($parent);

			if(!isset($load_parent['id']))
			{
				\dash\notif::error(T_("Invalid id"));
				return false;
			}

			if(isset($load_parent['parent1']) && $load_parent['parent1'])
			{
				if(isset($load_parent['parent2']) && $load_parent['parent2'])
				{
					if(isset($load_parent['parent3']) && $load_parent['parent3'])
					{
						if(isset($load_parent['parent4']) && $load_parent['parent4'])
						{
							if(isset($load_parent['parent5']) && $load_parent['parent5'])
							{
								\dash\notif::error(T_("Maximum menu level is 5"));
								return false;
							}
							else
							{
								$data['parent1'] = $load_parent['parent1'];
								$data['parent2'] = $load_parent['parent2'];
								$data['parent3'] = $load_parent['parent3'];
								$data['parent4'] = $load_parent['parent4'];
								$data['parent5'] = $parent;
							}
						}
						else
						{
							$data['parent1'] = $load_parent['parent1'];
							$data['parent2'] = $load_parent['parent2'];
							$data['parent3'] = $load_parent['parent3'];
							$data['parent4'] = $parent;
						}
					}
					else
					{
						$data['parent1'] = $load_parent['parent1'];
						$data['parent2'] = $load_parent['parent2'];
						$data['parent3'] = $parent;
					}
				}
				else
				{
					$data['parent1'] = $load_parent['parent1'];
					$data['parent2'] = $parent;
				}
			}
			else
			{
				$data['parent1'] = $parent;
			}
		}
		else
		{
			$data['parent1'] = null;
			$data['parent2'] = null;
			$data['parent3'] = null;
			$data['parent4'] = null;
			$data['parent5'] = null;
		}

		switch ($data['pointer'])
		{
			case 'homepage':
				// do nothing
				break;

			case 'products':
				if(!$data['product_id'])
				{
					\dash\notif::error(T_("Please choose a product"));
					return false;
				}

				$load_product = \lib\app\product\get::get($data['product_id']);
				if(!isset($load_product['id']))
				{
					\dash\notif::error(T_("Invalid product id"));
					return false;
				}
				$data['related_id'] = $load_product['id'];

				if(isset($load_product['url']))
				{
					$data['url'] = $load_product['url'];
				}
				break;

			case 'posts':
				if(!$data['post_id'])
				{
					\dash\notif::error(T_("Please choose a post"));
					return false;
				}

				$load_post = \dash\app\posts\get::get($data['post_id']);
				if(!isset($load_post['id']))
				{
					\dash\notif::error(T_("Invalid post id"));
					return false;
				}
				$data['related_id'] = \dash\coding::decode($load_post['id']);

				if(isset($load_post['link']))
				{
					$data['url'] = $load_post['link'];
				}
				break;

			case 'forms':
				if(!$data['form_id'])
				{
					\dash\notif::error(T_("Please choose a form"));
					return false;
				}

				$load_form = \lib\app\form\form\get::get($data['form_id']);
				if(!isset($load_form['id']))
				{
					\dash\notif::error(T_("Invalid form id"));
					return false;
				}
				$data['related_id'] = $load_form['id'];

				if(isset($load_form['url']))
				{
					$data['url'] = $load_form['url'];
				}

				break;

			case 'tags':
				if(!$data['tag_id'])
				{
					\dash\notif::error(T_("Please choose a tag"));
					return false;
				}

				$load_tag = \dash\app\terms\get::get($data['tag_id']);
				if(!isset($load_tag['id']))
				{
					\dash\notif::error(T_("Invalid tag id"));
					return false;
				}
				$data['related_id'] = \dash\coding::decode($load_tag['id']);

				if(isset($load_tag['link']))
				{
					$data['url'] = $load_tag['link'];
				}

				break;

			case 'hashtag':
				if(!$data['hashtag_id'])
				{
					\dash\notif::error(T_("Please choose a hashtag"));
					return false;
				}

				$load_hashtag = \lib\app\tag\get::get($data['hashtag_id'], true);

				if(!isset($load_hashtag['id']))
				{
					\dash\notif::error(T_("Invalid hashtag id"));
					return false;
				}
				$data['related_id'] = $load_hashtag['id'];

				if(isset($load_hashtag['link']))
				{
					$data['url'] = $load_hashtag['link'];
				}
				break;

			case 'socialnetwork':
				if(!$data['socialnetwork'])
				{
					\dash\notif::error(T_("Please choose a social network"));
					return false;
				}
				$data['url'] = null;
				break;

			case 'title':
			case 'separator':
				$data['url'] = null;
				$data['related_id'] = null;
				break;

			case 'other':
				if(!$data['url'])
				{
					\dash\notif::error(T_("Please set a url"));
					return false;
				}
				break;

			default:
				// nothing
				break;
		}


		unset($data['parent']);
		unset($data['product_id']);
		unset($data['post_id']);
		unset($data['tag_id']);

		unset($data['hashtag_id']);
		unset($data['form_id']);

		return $data;
	}
}
?>