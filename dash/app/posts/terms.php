<?php
namespace dash\app\posts;

class terms
{



	public static function set_post_cat($_cat, $_product_id)
	{

		if(!$_cat)
		{
			$have_old_cat = \lib\db\productcategoryusage\get::usage($_product_id);
			if($have_old_cat)
			{
				\dash\temp::set('productHasChange', true);
				\lib\db\productcategoryusage\delete::hard_delete_all_product_cat($_product_id);
			}
			return false;
		}

		$have_term_to_save_log = false;

		if(is_string($_cat))
		{
			$cat = $_cat;
			$cat = explode(',', $cat);
		}
		elseif(is_array($_cat))
		{
			$cat = $_cat;
		}
		else
		{
			return false;
		}

		$cat = array_filter($cat);
		$cat = array_unique($cat);
		if(!$cat)
		{
			return false;
		}

		foreach ($cat as $key => $value)
		{
			if(!is_string($value) && !is_numeric($value))
			{
				\dash\notif::error(T_("Invalid cat format"), 'cat');
				return false;
			}
		}


		$check_exist_cat = \lib\db\productcategory\get::mulit_title($cat);

		$all_cats_id = [];

		$must_insert_cat = $cat;

		if(is_array($check_exist_cat))
		{
			$check_exist_cat = array_column($check_exist_cat, 'title', 'id');
			$check_exist_cat = array_filter($check_exist_cat);
			$check_exist_cat = array_unique($check_exist_cat);

			foreach ($check_exist_cat as $key => $value)
			{

				if(isset($value) && in_array($value, $cat))
				{
					unset($cat[array_search($value, $cat)]);
					unset($must_insert_cat[array_search($value, $must_insert_cat)]);
				}

				array_push($all_cats_id, intval($key));
			}
		}

		$must_insert_cat = array_filter($must_insert_cat);
		$must_insert_cat = array_unique($must_insert_cat);

		if(!empty($must_insert_cat))
		{
			$multi_insert_cat = [];
			foreach ($must_insert_cat as $key => $value)
			{
				if(mb_strlen($value) > 50)
				{
					\dash\notif::error(T_("Category is too long!"), 'cat');
					return false;
				}

				$slug = \dash\validate::slug($value, false);

				$multi_insert_cat[] =
				[
					'title'         => $value,
					'slug'          => $slug,
					'status'        => 'enable',
					'showonwebsite' => 1,
					// 'creator'  => \dash\user::id(),
					// 'language' => \dash\language::current(),
				];
			}
			$have_term_to_save_log = true;
			$first_id    = \lib\db\productcategory\insert::multi_insert($multi_insert_cat);
			$all_cats_id = array_merge($all_cats_id, \dash\db\config::multi_insert_id($multi_insert_cat, $first_id));
		}

		$category_id = $all_cats_id;

		$get_old_product_cat = \lib\db\productcategoryusage\get::usage($_product_id);

		$must_insert = [];
		$must_remove = [];

		if(empty($get_old_product_cat))
		{
			$must_insert = $category_id;
		}
		else
		{
			$old_category_id = array_column($get_old_product_cat, 'productcategory_id');
			$old_category_id = array_map('floatval', $old_category_id);
			$must_insert = array_diff($category_id, $old_category_id);
			$must_remove = array_diff($old_category_id, $category_id);
		}

		if(!empty($must_insert))
		{
			if(count($must_insert) > 20)
			{
				\dash\notif::error(T_("You can set maximum 20 cat to product"), 'cat');
				return false;
			}

			$insert_multi = [];
			foreach ($must_insert as $key => $value)
			{
				$insert_multi[] =
				[
					'productcategory_id' => $value,
					'product_id'    => $_product_id,

				];
			}
			if(!empty($insert_multi))
			{
				$have_term_to_save_log = true;
				\lib\db\productcategoryusage\insert::multi_insert($insert_multi);
			}
		}

		if(!empty($must_remove))
		{
			$have_term_to_save_log = true;
			$must_remove = array_filter($must_remove);
			$must_remove = array_unique($must_remove);

			$must_remove = implode(',', $must_remove);
			\lib\db\productcategoryusage\delete::hard_delete_product_category($must_remove, $_product_id);
		}


		if($have_term_to_save_log)
		{
			\dash\temp::set('productHasChange', true);
		}

		return true;

	}





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