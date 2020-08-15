<?php
namespace lib\app\product;

class tag
{

	public static function all_tag()
	{
		$result = \lib\db\producttag\get::all_tag();
		return $result;
	}

	public static function add($_tag, $_product_id)
	{
		if(!\dash\permission::check('productAssignTag'))
		{
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

				$slug = \dash\validate::slug($value, false);
				$slug = str_replace('-', '_', $slug);

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
			$have_term_to_save_log = true;
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


	public static function load_product_by_tag($_tag)
	{
		$_tag = \dash\validate::string($_tag);
		if(!$_tag)
		{
			return false;
		}

		$_tag     = urldecode($_tag);
		$load_tag = \lib\db\producttag\get::by_slug($_tag);
		return $load_tag;
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
		$_tag_id = \dash\validate::id($_tag_id);
		if(!$_tag_id)
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

		$query_string = \dash\validate::search($_string);

		if($query_string)
		{
			$or[]  = "producttag.title LIKE '%$query_string%'";
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



	public static function check($_args, $_id = null)
	{
		$condition =
		[
			'title'    => 'title',
			'slug'     => 'slug',
			'language' => 'language',
			'desc'     => 'desc',
			'status'   => ['enum' => ['enable','disable','expired','awaiting','filtered','blocked','spam','violence','pornography','other']],
		];

		$require = ['title'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(!$data['slug'])
		{
			$data['slug'] = \dash\validate::slug($data['title'], false);
		}

		$data['slug'] = str_replace('-', '_', $data['slug']);

		// check duplicate
		// lang+slug
		$check_duplicate = \lib\db\producttag\get::check_duplicate($data['slug'], $data['language']);

		if(isset($check_duplicate['id']))
		{
			if(floatval($check_duplicate['id']) === floatval($_id))
			{
				// no problem to edit it
			}
			else
			{

				\dash\notif::error(T_("Duplicate tag"), ['element' => ['slug', 'language', 'title']]);
				return false;
			}
		}

		return $data;
	}



	public static function add_tag($_args)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}


		$args = self::check($_args);
		if(!$args)
		{
			return false;
		}

		if(!\dash\get::index($args, 'status'))
		{
			$args['status'] = 'enable';
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
		$_id = \dash\validate::id($_id);
		if(!$_id)
		{
			\dash\notif::error(T_("Id not set"));
			return false;
		}

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}



		$args = self::check($_args, $_id);
		if(!$args)
		{
			return false;
		}

		if(!\dash\get::index($args, 'status'))
		{
			$args['status'] = 'enable';
		}

		\lib\db\producttag\update::update($args, $_id);

		\dash\notif::ok(T_("Tag successfully edited"));
		return true;

	}
}
?>