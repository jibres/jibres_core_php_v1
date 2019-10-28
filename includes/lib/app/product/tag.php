<?php
namespace lib\app\product;

class tag
{

	public static function add($_tag, $_product_id)
	{
		if(!\dash\permission::check('productAssignTag'))
		{
			return false;
		}

		$have_term_to_save_log = false;

		$tag = $_tag;
		$tag = explode(',', $tag);
		$tag = array_filter($tag);
		$tag = array_unique($tag);

		if(!$tag)
		{
			return false;
		}

		$check_exist_tag = \lib\db\producttag\tag::get_mulit_title($tag);

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
					'status'   => 'enable',
					'title'    => $value,
					'slug'     => $slug,
					'url'      => $slug,
					'creator'  => \lib\userstore::id(),
					// 'language' => \dash\language::current(),
				];
			}
			$have_term_to_save_log = true;
			$first_id    = \lib\db\producttag\tag::multi_insert($multi_insert_tag);
			$all_tags_id = array_merge($all_tags_id, \dash\db\config::multi_insert_id($multi_insert_tag, $first_id));
		}

		$category_id = $all_tags_id;

		$get_old_post_cat = \lib\db\producttag\tagusage::usage($_product_id);

		$must_insert = [];
		$must_remove = [];

		if(empty($get_old_post_cat))
		{
			$must_insert = $category_id;
		}
		else
		{
			$old_category_id = array_column($get_old_post_cat, 'id');
			$old_category_id = array_map('intval', $old_category_id);
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
					'product_id'     => $_product_id,

				];
			}
			if(!empty($insert_multi))
			{
				$have_term_to_save_log = true;
				\lib\db\producttag\tagusage::multi_insert($insert_multi);
			}
		}

		if(!empty($must_remove))
		{
			$must_remove = array_filter($must_remove);
			$must_remove = array_unique($must_remove);

			$must_remove = implode(',', $must_remove);

			\dash\log::set('removePostTerm', ['code' => $_type, 'datalink' => \dash\coding::encode($_product_id)]);
			\lib\db\producttag\tagusage::hard_delete([ 'productterm_id' => ["IN", "($must_remove)"]]);
		}


		if($have_term_to_save_log)
		{
			\dash\log::set('productAddTag', ['code' => $_product_id, 'tag' => $_tag]);
		}

		return true;

	}


	public static function get($_product_id)
	{

	}
}
?>