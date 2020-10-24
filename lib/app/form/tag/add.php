<?php
namespace lib\app\form\tag;


class add
{

	public static function add($_args)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if(!\dash\permission::check('formTagListAdd'))
		{
			return false;
		}


		$args = \lib\app\form\tag\check::variable($_args);
		if(!$args)
		{
			return false;
		}


		$args['datecreated']   = date("Y-m-d H:i:s");
		$args['status']        = 'enable';
		$args['language']      = \dash\language::current();

		$id = \lib\db\form_tag\insert::new_record($args);
		if(!$id)
		{
			\dash\log::set('formTagDbErrorInsert');
			\dash\notif::error(T_("No way to insert data"));
			return false;
		}

		\dash\notif::ok(T_("Tag successfully added"));


		$result       = [];
		$result['id'] = $id;
		return $result;
	}





	public static function answer_add($_tag, $_answer_id, $_form_id)
	{
		if(!\dash\permission::check('formAssignTag'))
		{
			return false;
		}

		$_answer_id = \dash\validate::id($_answer_id);
		if(!$_answer_id)
		{
			\dash\notif::error(T_("Answer id is required"));
			return false;
		}

		$load_form = \lib\app\form\form\get::get($_form_id);

		if(!$load_form)
		{
			return false;
		}


		if(!$_tag)
		{
			$have_old_tag = \lib\db\form_tagusage\get::usage($_answer_id);
			if($have_old_tag)
			{
				\lib\db\form_tagusage\delete::hard_delete_all_answer_tag($_answer_id);
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


		$check_exist_tag = \lib\db\form_tag\get::mulit_title($tag);

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
			$first_id    = \lib\db\form_tag\insert::multi_insert($multi_insert_tag);
			$all_tags_id = array_merge($all_tags_id, \dash\db\config::multi_insert_id($multi_insert_tag, $first_id));
		}

		$category_id = $all_tags_id;

		$get_old_answer_tag = \lib\db\form_tagusage\get::usage($_answer_id);

		$must_insert = [];
		$must_remove = [];

		if(empty($get_old_answer_tag))
		{
			$must_insert = $category_id;
		}
		else
		{
			$old_category_id = array_column($get_old_answer_tag, 'form_tag_id');
			$old_category_id = array_map('intval', $old_category_id);
			$must_insert = array_diff($category_id, $old_category_id);
			$must_remove = array_diff($old_category_id, $category_id);
		}

		if(!empty($must_insert))
		{
			if(count($must_insert) > 20)
			{
				\dash\notif::error(T_("You can set maximum 20 tag to answer"), 'tag');
				return false;
			}

			$insert_multi = [];
			foreach ($must_insert as $key => $value)
			{
				$insert_multi[] =
				[
					'form_tag_id' => $value,
					'answer_id'   => $_answer_id,
					'form_id'     => $_form_id,

				];
			}
			if(!empty($insert_multi))
			{
				$have_term_to_save_log = true;
				\lib\db\form_tagusage\insert::multi_insert($insert_multi);
			}
		}

		if(!empty($must_remove))
		{
			$have_term_to_save_log = true;
			$must_remove = array_filter($must_remove);
			$must_remove = array_unique($must_remove);

			$must_remove = implode(',', $must_remove);

			\lib\db\form_tagusage\delete::hard_delete_answer_tag($must_remove, $_answer_id);
		}


		if($have_term_to_save_log)
		{
			\dash\log::set('formAddTag', ['code' => $_answer_id, 'tag' => $_tag]);
		}


		return true;

	}







}
?>