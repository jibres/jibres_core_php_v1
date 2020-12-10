<?php
namespace dash\app\posts;

class terms
{




	public static function set_post_term($_post_id, $_type, $_related = 'posts', $_data = [])
	{

		$have_term_to_save_log = false;

		// set default
		if($_related === null)
		{
			$_related = 'posts';
		}

		$category = $_data;

		$check_all_is_cat = null;

		if(strpos($_type, 'tag') !== false)
		{
			$tag = $category;
			if(is_string($tag))
			{
				$tag = explode(',', $tag);
				$tag = array_filter($tag);
				$tag = array_unique($tag);
			}

			if(!is_array($tag))
			{
				$tag = [];
			}

			$check_exist_tag = \dash\db\terms::get_mulit_term_title($tag, $_type);

			$all_tags_id = [];

			$must_insert_tag = $tag;

			if(is_array($check_exist_tag))
			{
				$check_exist_tag = array_column($check_exist_tag, 'title', 'id');
				$check_exist_tag = array_filter($check_exist_tag);
				$check_exist_tag = array_unique($check_exist_tag);

				foreach ($check_exist_tag as $key => $value)
				{

					if(isset($value) && in_array($value, $tag))
					{
						unset($tag[array_search($value, $tag)]);
						unset($must_insert_tag[array_search($value, $must_insert_tag)]);
					}

					array_push($all_tags_id, floatval($key));
				}
			}

			$must_insert_tag = array_filter($must_insert_tag);
			$must_insert_tag = array_unique($must_insert_tag);

			if(!empty($must_insert_tag))
			{
				$multi_insert_tag = [];
				foreach ($must_insert_tag as $key => $value)
				{
					$slug = \dash\validate::slug($value, false);

					$multi_insert_tag[] =
					[
						'type'      => $_type,
						'status'    => 'enable',
						'title'     => $value,
						'slug'      => $slug,
						'url'       => $slug,
						'user_id'   => \dash\user::id(),
						'language'  => \dash\language::current(),

					];
				}
				$have_term_to_save_log = true;
				$first_id    = \dash\db\terms::multi_insert($multi_insert_tag);
				$all_tags_id = array_merge($all_tags_id, \dash\db\config::multi_insert_id($multi_insert_tag, $first_id));
			}

			$category_id = $all_tags_id;
		}
		else
		{
			$category_id = [];

			if($category && is_array($category))
			{
				$category_id = array_map(function($_a){return \dash\coding::decode($_a);}, $category);
				$category_id = array_filter($category_id);
				$category_id = array_unique($category_id);
				if($category_id)
				{
					$check_all_is_cat = \dash\db\terms::check_multi_id($category_id, $_type);
					if(is_array($check_all_is_cat) && is_array($category_id))
					{
						if(count($check_all_is_cat) !== count($category_id))
						{
							\dash\notif::warn(T_("Some :type is wrong", ['type' => T_($_type)]), 'cat');
							return false;
						}
					}
				}
			}
		}

		$get_old_post_cat = \dash\db\termusages::usage($_post_id, $_type, $_related);

		$must_insert = [];
		$must_remove = [];

		if(empty($get_old_post_cat))
		{
			$must_insert = $category_id;
		}
		else
		{
			$old_category_id = array_column($get_old_post_cat, 'id');
			$old_category_id = array_map(function($_a){return floatval($_a);}, $old_category_id);
			$must_insert = array_diff($category_id, $old_category_id);
			$must_remove = array_diff($old_category_id, $category_id);
		}

		if(!empty($must_insert))
		{
			$insert_multi = [];
			foreach ($must_insert as $key => $value)
			{
				$insert_multi[] =
				[
					'term_id'    => $value,
					'related_id' => $_post_id,
					'related'    => $_related,
					'type'       => $_type,
				];
			}
			if(!empty($insert_multi))
			{
				$have_term_to_save_log = true;
				\dash\db\termusages::insert_multi($insert_multi);
			}
		}

		if($_type === 'cat')
		{
			// j([$must_remove, $must_insert]);
		}

		if(!empty($must_remove))
		{
			$must_remove = array_filter($must_remove);
			$must_remove = array_unique($must_remove);

			$must_remove = implode(',', $must_remove);

			\dash\log::set('removePostTerm', ['code' => $_type, 'datalink' => \dash\coding::encode($_post_id)]);
			\dash\db\termusages::hard_delete(['related_id' => $_post_id, 'related' => $_related, 'term_id' => ["IN", "($must_remove)"]]);
		}


		$new_url = null;

		if($check_all_is_cat)
		{
			$new_url = isset($check_all_is_cat[0]['url']) ? $check_all_is_cat[0]['url'] : null;
		}

		if($have_term_to_save_log)
		{
			\dash\log::set('setPostTerm', ['code' => $_type]);
		}

		return $new_url;


	}



}
?>