<?php
namespace lib\app\menu;


class check
{
	public static function variable($_args, $_force = false)
	{

		$condition =
		[
			'title'         => 'title',
			'url'           => 'absolute_url',
			'pointer'       => ['enum' => ['homepage','products','posts','pages', 'pagebuilder', 'file','menu','forms','tags','hashtag','socialnetwork','other','title','separator','selffile']],
			'target'        => ['enum' => ['blank']],
			'parent'        => 'id',
			'related_id'    => 'id',
			'sort'          => 'int',
			// 'parent1'    => 'id',
			// 'parent2'    => 'id',
			// 'parent3'    => 'id',
			// 'parent4'    => 'id',
			// 'parent5'    => 'id',
			'product_id'    => 'id',
			'post_id'       => 'code',
			'page_id'       => 'code',
			'form_id'       => 'id',
			'tag_id'        => 'id',
			'socialnetwork' => 'socialnetwork',
			'hashtag_id'    => 'code',

			'for'           => ['enum' => ['menu', 'gallery']],
			'for_id'        => 'id',
			'file'          => 'string',
			'description'   => 'desc',
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
				if(!$_force)
				{
					\dash\notif::error(T_("Title is required"), 'title');
					return false;
				}
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
				if($data['product_id'])
				{
					$load_product = \lib\app\product\get::get($data['product_id']);
					if(isset($load_product['id']))
					{
						$data['related_id'] = $load_product['id'];

						if(isset($load_product['url']))
						{
							$data['url'] = $load_product['url'];
						}
					}
					elseif(!$_force)
					{
						\dash\notif::error(T_("Invalid product id"));
						return false;
					}
				}
				elseif(!$_force)
				{
					\dash\notif::error(T_("Please choose a product"));
					return false;
				}
				break;

			case 'pages':
				$data['post_id'] = $data['page_id'];
				// break; // nobreak!
			case 'posts':
				if($data['post_id'])
				{
					$load_post = \dash\app\posts\get::get($data['post_id']);
					if(isset($load_post['id']))
					{
						$data['related_id'] = \dash\coding::decode($load_post['id']);

						if(isset($load_post['link']))
						{
							$data['url'] = $load_post['link'];
						}
					}
					elseif(!$_force)
					{
						\dash\notif::error(T_("Invalid post id"));
						return false;
					}
				}
				elseif(!$_force)
				{
					\dash\notif::error(T_("Please choose a post"));
					return false;
				}
				break;

			case 'forms':
				if($data['form_id'])
				{
					$load_form = \lib\app\form\form\get::get($data['form_id']);
					if(isset($load_form['id']))
					{
						$data['related_id'] = $load_form['id'];

						if(isset($load_form['url']))
						{
							$data['url'] = $load_form['url'];
						}
					}
					elseif(!$_force)
					{
						\dash\notif::error(T_("Invalid form id"));
						return false;
					}
				}
				elseif(!$_force)
				{
					\dash\notif::error(T_("Please choose a form"));
					return false;
				}
				break;

			case 'tags':
				if($data['tag_id'])
				{
					$load_tag = \lib\app\category\get::get($data['tag_id']);
					if(isset($load_tag['id']))
					{
						$data['related_id'] = $load_tag['id'];

						if(isset($load_tag['url']))
						{
							$data['url'] = $load_tag['url'];
						}
					}
					elseif(!$_force)
					{
						\dash\notif::error(T_("Invalid hashtag id"));
						return false;
					}
				}
				elseif(!$_force)
				{
					\dash\notif::error(T_("Please choose a tag"));
					return false;
				}
				break;

			case 'hashtag':
				if($data['hashtag_id'])
				{
					$load_hashtag = \dash\app\terms\get::get($data['hashtag_id']);

					if(isset($load_hashtag['id']))
					{
						$data['related_id'] = \dash\coding::decode($load_hashtag['id']);

						if(isset($load_hashtag['link']))
						{
							$data['url'] = $load_hashtag['link'];
						}
					}
					elseif(!$_force)
					{
						\dash\notif::error(T_("Invalid hashtag id"));
						return false;
					}
				}
				elseif(!$_force)
				{
					\dash\notif::error(T_("Please choose a tag"));
					return false;
				}

				break;


			case 'socialnetwork':
				if($data['socialnetwork'])
				{
					$data['url'] = null;
				}
				elseif(!$_force)
				{
					\dash\notif::error(T_("Please choose a social network"));
					return false;
				}
				break;

			case 'title':
			case 'separator':
				$data['url'] = null;
				$data['related_id'] = null;
				break;

			case 'other':
				if($data['url'])
				{
					// ok
				}
				elseif(!$_force)
				{
					\dash\notif::error(T_("Please set a url"));
					return false;
				}
				break;

			case 'selffile':
				// nothing
				break;

			default:
				// nothing
				break;
		}


		unset($data['parent']);
		unset($data['product_id']);
		unset($data['post_id']);
		unset($data['page_id']);
		unset($data['tag_id']);

		unset($data['hashtag_id']);
		unset($data['form_id']);

		return $data;
	}
}
?>