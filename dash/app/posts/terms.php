<?php
namespace dash\app\posts;

class terms
{



	public static function save_post_term($_data, $_post_id, $_type)
	{
		if(!$_data)
		{
			$have_old_cat = \dash\db\termusages\get::usage($_post_id, $_type);
			if($have_old_cat)
			{
				\dash\db\termusages\delete::hard_delete_all_cat($_post_id, $_type);
			}
			return null;
		}


		if(is_string($_data))
		{
			$cat = $_data;
			$cat = explode(',', $cat);
		}
		elseif(is_array($_data))
		{
			$cat = $_data;
		}
		else
		{
			return null;
		}

		$cat = array_filter($cat);
		$cat = array_unique($cat);
		if(!$cat)
		{
			return null;
		}

		foreach ($cat as $key => $value)
		{
			if(!is_string($value) && !is_numeric($value))
			{
				\dash\notif::error(T_("Invalid cat format"), 'cat');
				return false;
			}
		}


		$check_exist_cat = \dash\db\terms::mulit_title($cat, $_type);

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
					\dash\notif::error(T_("Tag or Category is too long!"), 'cat');
					return false;
				}

				$multi_insert_cat[] =
				[
					'title'    => $value,
					'type'     => $_type,
				];
			}

			$new_ids    = \dash\app\terms\add::multiple($multi_insert_cat);

			if(!\dash\engine\process::status())
			{
				return false;
			}

			$all_cats_id = array_merge($all_cats_id, $new_ids);
		}

		$category_id = $all_cats_id;

		$get_old_post_cat = \dash\db\termusages\get::usage($_post_id, $_type);


		$must_insert = [];
		$must_remove = [];

		if(empty($get_old_post_cat))
		{
			$must_insert = $category_id;
		}
		else
		{
			$old_category_id = array_column($get_old_post_cat, 'term_id');
			$old_category_id = array_map('floatval', $old_category_id);
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
					'term_id' => $value,
					'type'    => $_type,
					'post_id' => $_post_id,

				];
			}
			if(!empty($insert_multi))
			{
				\dash\db\termusages\insert::multi_insert($insert_multi);
			}
		}

		if(!empty($must_remove))
		{
			$must_remove = array_filter($must_remove);
			$must_remove = array_unique($must_remove);

			$must_remove = implode(',', $must_remove);
			\dash\db\termusages\delete::hard_delete_category($must_remove, $_post_id);
		}

		if($_type === 'cat')
		{
			// load first category url
			$url = \dash\db\termusages\get::first_category_url($_post_id);

			if($url && is_string($url))
			{
				return $url;
			}
			else
			{
				// no category founded
				return null;
			}
		}

		return true;

	}
}
?>