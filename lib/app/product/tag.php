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

		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		if(!$_tag)
		{
			$have_old_tag = \lib\db\producttagusage\get::usage($_product_id);
			if($have_old_tag)
			{
				\dash\temp::set('productHasChange', true);
				\lib\db\producttagusage\delete::hard_delete_all_product_tag($_product_id);
			}
			return false;
		}

		$have_term_to_save_log = false;

		if(is_string($_tag))
		{
			$tag = $_tag;
			$tag = explode(',', $tag);
		}
		elseif(is_array($_tag))
		{
			$tag = $_tag;
		}
		else
		{
			return false;
		}

		$tag = array_filter($tag);
		$tag = array_unique($tag);
		if(!$tag)
		{
			return false;
		}

		foreach ($tag as $key => $value)
		{
			if(!is_string($value) && !is_numeric($value))
			{
				\dash\notif::error(T_("Invalid tag format"), 'tag');
				return false;
			}
		}


		$check_exist_tag = \lib\db\producttag\get::mulit_title($tag);

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
				if(mb_strlen($value) > 50)
				{
					\dash\notif::error(T_("Tag is too long!"), 'tag');
					return false;
				}

				$slug = \dash\utility\filter::slug($value, null, 'persian');

				$multi_insert_tag[] =
				[
					'status'   => 'enable',
					'title'    => $value,
					'slug'     => $slug,
					'url'      => $slug,
					'creator'  => \dash\user::id(),
					// 'language' => \dash\language::current(),
				];
			}
			$have_term_to_save_log = true;
			$first_id    = \lib\db\producttag\insert::multi_insert($multi_insert_tag);
			$all_tags_id = array_merge($all_tags_id, \dash\db\config::multi_insert_id($multi_insert_tag, $first_id));
		}

		$category_id = $all_tags_id;

		$get_old_product_cat = \lib\db\producttagusage\get::usage($_product_id);

		$must_insert = [];
		$must_remove = [];

		if(empty($get_old_product_cat))
		{
			$must_insert = $category_id;
		}
		else
		{
			$old_category_id = array_column($get_old_product_cat, 'producttag_id');
			$old_category_id = array_map('intval', $old_category_id);
			$must_insert = array_diff($category_id, $old_category_id);
			$must_remove = array_diff($old_category_id, $category_id);
		}

		if(!empty($must_insert))
		{
			if(count($must_insert) > 20)
			{
				\dash\notif::error(T_("You can set maximum 20 tag to product"), 'tag');
				return false;
			}

			$insert_multi = [];
			foreach ($must_insert as $key => $value)
			{
				$insert_multi[] =
				[
					'producttag_id' => $value,
					'product_id'    => $_product_id,

				];
			}
			if(!empty($insert_multi))
			{
				$have_term_to_save_log = true;
				\lib\db\producttagusage\insert::multi_insert($insert_multi);
			}
		}

		if(!empty($must_remove))
		{
			$must_remove = array_filter($must_remove);
			$must_remove = array_unique($must_remove);

			$must_remove = implode(',', $must_remove);

			\dash\log::set('removePostTerm', ['datalink' => \dash\coding::encode($_product_id)]);
			\lib\db\producttagusage\delete::hard_delete([ 'producttag_id' => ["IN", "($must_remove)"]]);
		}


		if($have_term_to_save_log)
		{
			\dash\temp::set('productHasChange', true);
			\dash\log::set('productAddTag', ['code' => $_product_id, 'tag' => $_tag]);
		}

		return true;

	}


	public static function get($_product_id)
	{
		$detail = \lib\app\product\get::inline_get($_product_id);
		if(!$detail)
		{
			return false;
		}

		$get_usage = \lib\db\producttagusage\get::usage($_product_id);

		return $get_usage;
	}


	public static function get_tag($_tag_id)
	{
		if(!$_tag_id || !is_numeric($_tag_id))
		{
			return false;
		}

		$load = \lib\db\producttag\get::by_id($_tag_id);
		if(!$load)
		{
			return null;
		}

		return $load;
	}


	public static function list($_string, $_args = [])
	{
		$and          = [];
		$or           = [];

		$query_string = \dash\safe::forQueryString($_string);

		if($query_string)
		{
			$or['producttag.title']  = ["LIKE", "'%$query_string%'"];
		}

		$list         = \lib\db\producttag\search::list($and, $or);

		return $list;
	}


	public static function remove($_id)
	{
		$load = self::get_tag($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Tag not found"));
			return false;
		}

		$check_usage = \lib\db\producttagusage\get::check_usage_tag($_id);
		if($check_usage)
		{
			\dash\notif::error(T_("This tag use in some product and can not be removed"));
			return false;
		}

		\lib\db\producttag\delete::record($_id);
		\dash\notif::ok(T_("Tag removed"));
		return true;
	}



	public static function check($_id = null)
	{

		$title = \dash\app::request('title');
		if(!$title)
		{
			\dash\notif::error(T_("Please set the tag title"), 'title');
			return false;
		}

		if(mb_strlen($title) > 150)
		{
			\dash\notif::error(T_("Please set the tag title less than 150 character"), 'title');
			return false;
		}


		$slug = \dash\app::request('slug');

		if($slug && mb_strlen($slug) > 150)
		{
			\dash\notif::error(T_("Please set the tag slug less than 150 character"), 'slug');
			return false;
		}

		if(!$slug)
		{
			$slug = \dash\utility\filter::slug($title, null, 'persian');
		}
		else
		{
			$slug = \dash\utility\filter::slug($slug, null, 'persian');
		}

		$language = \dash\app::request('language');
		if($language && mb_strlen($language) !== 2)
		{
			\dash\notif::error(T_("Invalid parameter language"), 'language');
			return false;
		}

		if($language && !\dash\language::check($language))
		{
			\dash\notif::error(T_("Invalid parameter language"), 'language');
			return false;
		}

		$desc = \dash\app::request('desc');
		if($desc && mb_strlen($desc) > 500)
		{
			\dash\notif::error(T_("Please set the tag desc less than 500 character"), 'desc');
			return false;
		}


		$status = \dash\app::request('status');

		if($status && !in_array($status, ['enable','disable','expired','awaiting','filtered','blocked','spam','violence','pornography','other']))
		{
			\dash\notif::error(T_("Invalid status of term"));
			return false;
		}

		// check duplicate
		// lang+slug
		$check_duplicate = \lib\db\producttag\get::check_duplicate($slug, $language);

		if(isset($check_duplicate['id']))
		{
			if(intval($check_duplicate['id']) === intval($_id))
			{
				// no problem to edit it
			}
			else
			{

				\dash\notif::error(T_("Duplicate tag"), ['element' => ['slug', 'language', 'title']]);
				return false;
			}
		}


		$args             = [];
		$args['title']    = $title;
		$args['desc']     = $desc;
		$args['status']   = $status;
		$args['slug']     = $slug;
		$args['language'] = $language;
		return $args;
	}



	public static function add_tag($_args)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		\dash\app::variable($_args);

		$args = self::check();
		if(!$args)
		{
			return false;
		}

		$tag_id = \lib\db\producttag\insert::new_record($args);

		if(!$tag_id)
		{
			\dash\notif::error(T_("No way to insert tag"));
			return false;
		}

		\dash\notif::ok(T_("Tag successfully added"));
		return true;


	}



	public static function edit($_args, $_id)
	{
		if(!$_id || !is_numeric($_id))
		{
			\dash\notif::error(T_("Id not set"));
			return false;
		}

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		\dash\app::variable($_args);

		$args = self::check($_id);
		if(!$args)
		{
			return false;
		}

		\lib\db\producttag\update::update($args, $_id);

		\dash\notif::ok(T_("Tag successfully edited"));
		return true;

	}
}
?>