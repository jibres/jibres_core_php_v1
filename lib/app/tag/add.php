<?php
namespace lib\app\tag;


class add
{


	public static function apply_to_all($_args)
	{
		$condition =
		[
			'tag'      => 'string_30',
		];

		$require = ['tag'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$tag_id = null;

		$check_duplicate = \lib\db\producttag\get::check_duplicate_title($data['tag']);

		if(isset($check_duplicate['id']))
		{
			$tag_id = $check_duplicate['id'];
		}
		else
		{
			$insert_args = self::check(['title' => $data['tag']]);
			if(!$insert_args || !\dash\engine\process::status())
			{
				return false;
			}

			$tag_id = \lib\db\producttag\insert::new_record($insert_args);
		}

		if(!$tag_id)
		{
			\dash\notif::error(T_("Can not add tag"));
			return false;
		}

		\lib\db\producttag\insert::apply_to_all_product($tag_id);

		\dash\notif::ok(T_("Tag added to all prodcut"));
		return true;
	}




	public static function add($_args)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if(!\dash\permission::check('productTagListAdd'))
		{
			return false;
		}


		$args = \lib\app\tag\check::variable($_args);
		if(!$args)
		{
			return false;
		}


		$args['datecreated']   = date("Y-m-d H:i:s");
		$args['status']        = 'enable';
		$args['language']      = \dash\language::current();

		$id = \lib\db\producttag\insert::new_record($args);
		if(!$id)
		{
			\dash\log::set('productTagDbErrorInsert');
			\dash\notif::error(T_("No way to insert data"));
			return false;
		}

		\dash\notif::ok(T_("Tag successfully added"));


		$result       = [];
		$result['id'] = $id;
		return $result;
	}



	public static function product_tag_plus($_cat_id, $_product_id)
	{
		$product_detail = \lib\app\product\get::get($_product_id);
		if(!$product_detail)
		{
			return false;
		}

		$load_cat = \lib\app\tag\get::get($_cat_id);
		if(!$load_cat)
		{
			return false;
		}


		$check_product_have_cat = \lib\db\producttagusage\get::check_product_have_tag($_product_id, $_cat_id);

		if($check_product_have_cat)
		{
			\dash\notif::warn(T_("This product have this tag"));
			return true;
		}
		else
		{
			$insert =
			[
				'producttag_id' => $_cat_id,
				'product_id'         => $_product_id,
			];
			\lib\db\producttagusage\insert::new_record($insert);
			\dash\notif::ok(T_("Tag added to this product"));
			return true;
		}

	}




	public static function product_add($_tag, $_product_id)
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
			\lib\db\producttagusage\delete::hard_delete_product_tag($must_remove, $_product_id);
		}


		if($have_term_to_save_log)
		{
			\dash\temp::set('productHasChange', true);
			\dash\log::set('productAddTag', ['code' => $_product_id, 'tag' => $_tag]);
		}

		return true;

	}







}
?>