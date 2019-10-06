<?php
namespace lib\app\product;

class tag
{

	public static function add($_tag, $_id)
	{
		\dash\permission::access('productAssignTag');

		$id = \dash\coding::decode($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Invalid product id"));
			return false;
		}

		if(!\dash\permission::check('cpThirdpartyTagAdd'))
		{
			$current_tag = \lib\db\productterms::get(['type' => 'tag', 'store_id' => \lib\store::id()]);
			if(is_array($current_tag))
			{
				$tag_titles = array_column($current_tag, 'title');
				$new_tag    = $_tag;
				$new_tag    = explode(',', $new_tag);
				foreach ($new_tag as $key => $value)
				{
					if(!in_array($value, $tag_titles))
					{
						\dash\notif::error(T_("Please select tag from list"), 'tag');
						return false;
					}
				}
			}
		}

		\dash\app::variable(['tag' => $_tag]);

		self::set_product_term($id, 'tag',  $_tag);

		\dash\log::set('productAddTag', ['code' => $_id, 'tag' => $_tag]);
		\dash\notif::ok(T_("Tag was saved"));
		return true;

	}


	private static function set_product_term($_post_id, $_type, $_data = [])
	{
		$have_term_to_save_log = false;

		$category = \dash\app::request('tag');
		if(!$category && $_data)
		{
			$category = $_data;
		}

		$check_all_is_cat = null;

		if(strpos($_type, 'tag') !== false)
		{
			// productterms
			// producttermusages

			$tag = $category;
			$tag = explode(',', $tag);
			$tag = array_filter($tag);
			$tag = array_unique($tag);

			$check_exist_tag = \lib\db\productterms::get_mulit_term_title($tag, $_type, \lib\store::id());

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

					array_push($all_tags_id, intval($key));
				}
			}

			$must_insert_tag = array_filter($must_insert_tag);
			$must_insert_tag = array_unique($must_insert_tag);

			if(!empty($must_insert_tag))
			{
				$multi_insert_tag = [];
				foreach ($must_insert_tag as $key => $value)
				{
					$slug = \dash\utility\filter::slug($value, null, 'persian');

					$multi_insert_tag[] =
					[
						'type'     => $_type,
						'status'   => 'enable',
						'title'    => $value,
						'slug'     => $slug,
						'url'      => $slug,
						'store_id' => \lib\store::id(),
						'creator'  => \dash\user::id(),
						// 'language' => \dash\language::current(),
					];
				}
				$have_term_to_save_log = true;
				$first_id    = \lib\db\productterms::multi_insert($multi_insert_tag);
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

				$check_all_is_cat = \lib\db\productterms::check_multi_id($category_id, $_type);

				if(count($check_all_is_cat) !== count($category_id))
				{
					\dash\notif::warn(T_("Some :type is wrong", ['type' => T_($_type)]), 'cat');
					return false;
				}
			}
		}

		$get_old_post_cat = \lib\db\producttermusages::usage($_post_id, $_type);

		$must_insert = [];
		$must_remove = [];

		if(empty($get_old_post_cat))
		{
			$must_insert = $category_id;
		}
		else
		{
			$old_category_id = array_column($get_old_post_cat, 'id');
			$old_category_id = array_map(function($_a){return intval($_a);}, $old_category_id);
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
					'productterm_id' => $value,
					'product_id'     => $_post_id,

				];
			}
			if(!empty($insert_multi))
			{
				$have_term_to_save_log = true;
				\lib\db\producttermusages::multi_insert($insert_multi);
			}
		}

		if(!empty($must_remove))
		{
			$must_remove = array_filter($must_remove);
			$must_remove = array_unique($must_remove);

			$must_remove = implode(',', $must_remove);

			\dash\log::set('removePostTerm', ['code' => $_type, 'datalink' => \dash\coding::encode($_post_id)]);
			\lib\db\producttermusages::hard_delete([ 'productterm_id' => ["IN", "($must_remove)"]]);
		}


		$new_url = null;

		if($check_all_is_cat)
		{
			$new_url = isset($check_all_is_cat[0]['url']) ? $check_all_is_cat[0]['url'] : null;
		}

		if($have_term_to_save_log)
		{
			\dash\log::set('setProductTerm', ['code' => $_type, 'datalink' => \dash\coding::encode($_post_id)]);
		}

		return $new_url;


	}
}
?>