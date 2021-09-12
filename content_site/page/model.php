<?php
namespace content_site\page;


class model
{
	public static function post()
	{
		if(\dash\request::post('set_sort_section'))
		{
			self::set_sort();
		}

		if(\dash\request::post('savepage') === 'savepage')
		{
			self::save_page();

			\dash\notif::ok(T_("Data saved"));

			\dash\notif::complete();

			\dash\notif::reloadIframe();

			\dash\redirect::pwd();

			return true;
		}
	}


	public static function save_page($_id = null)
	{

		$page_id = \dash\request::get('id');

		if(!$page_id && $_id)
		{
			$page_id = $_id;
		}

		$page_id = \dash\validate::code($page_id);
		$page_id = \dash\coding::decode($page_id);

		if(!$page_id)
		{
			\dash\notif::error(T_("Invali page id"));
			return false;
		}

		$all_section = \lib\db\sitebuilder\get::all_section($page_id);

		if($all_section)
		{
			if(self::need_pay($all_section))
			{
				$order_page = \dash\url::this(). '/factor?'. \dash\request::build_query(['id' => \dash\request::get('id')]);
				\dash\redirect::to($order_page);
				return;
			}
		}


		// fully remove deleted section
		$preview_deleted = \lib\db\sitebuilder\get::preview_deleted($page_id);

		if($preview_deleted)
		{
			foreach ($preview_deleted as $key => $value)
			{
				\content_site\call_function::before_section_remove(a($value, 'section'), a($value, 'id'));
			}
		}




		// update all body detail by preview detail
		\lib\db\sitebuilder\update::save_page($page_id);


		\dash\pdo::transaction();

		$post_detail = \dash\db\posts::pdo_get_by_id_lock($page_id);

		if(!$post_detail)
		{
			\dash\pdo::rollback();
		}
		else
		{

			$meta = [];

			if(isset($post_detail['meta']))
			{
				$meta = json_decode($post_detail['meta'], true);
				if(!is_array($meta))
				{
					$meta = [];
				}
			}

			if(isset($meta['preview']) && is_array($meta['preview']))
			{
				$meta['body'] = $meta['preview'];
			}

			$meta = json_encode($meta);

			\dash\db\posts::pdo_update(['meta' => $meta], $page_id);

			\dash\pdo::commit();
		}


		// update special detail
		if($all_section)
		{
			foreach ($all_section as $key => $value)
			{
				\content_site\call_function::after_save_page(a($value, 'section'), a($value, 'id'));
			}
		}
	}



	public static function need_pay($_all_section, $_return_factor = false)
	{
		if(!$_all_section || !is_array($_all_section))
		{
			$_all_section = [];
		}

		$need_pay    = [];
		$page_factor = [];

		foreach ($_all_section as $key => $value)
		{
			$is_premium = \content_site\call_function::section_model_premium(a($value, 'section'), a($value, 'model'));

			if($is_premium)
			{
				$feature_key                    = implode('_', ['site', a($value, 'folder'), a($value, 'section'), a($value, 'model')]);

				$payed_before                   = \lib\features\check::payed($feature_key);

				$feature_detail                 = \lib\features\get::detail($feature_key);

				$feature_detail['payed_before'] = $payed_before;

				$page_factor[]                  = $feature_detail;

				if(!$payed_before)
				{
					$need_pay[] = $is_premium;
				}
			}

			$model_options = \content_site\call_function::section_options(a($value, 'section'), a($value, 'model'), true);

			if(!is_array($model_options))
			{
				$model_options = [];
			}

			$preview       = a($value, 'preview');
			$preview       = json_decode($preview, true);

			if(!is_array($preview))
			{
				$preview = [];
			}

			foreach ($model_options as $opt)
			{
				$is_premium = \content_site\call_function::option_premium($opt, $preview);

				if($is_premium)
				{
					$feature_key = implode('_', ['site', 'options', $opt]);

					$payed_before = \lib\features\check::payed($feature_key);

					$feature_detail                 = \lib\features\get::detail($feature_key);

					$feature_detail['payed_before'] = $payed_before;

					$page_factor[]                  = $feature_detail;

					if(!$payed_before)
					{
						$need_pay[] = $is_premium;
					}
				}

			}
		}

		if($_return_factor)
		{
			return $page_factor;
		}

		return $need_pay ? true : false;

	}

	/**
	 * Set the section order
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	private static function set_sort()
	{
		$page_id = \dash\request::get('id');

		$page_id = \dash\validate::code($page_id);
		$page_id = \dash\coding::decode($page_id);
		if(!$page_id)
		{
			\dash\notif::error(T_("Invali page id"));
			return false;
		}

		$sort = \dash\request::post('sort_section');
		$sort = \dash\validate::sort($sort);
		if(!$sort)
		{
			\dash\notif::error(T_("Invalid sort arguments"));
			return false;
		}

		$sort = array_map('floatval', $sort);
		$sort = array_filter($sort);
		$sort = array_unique($sort);
		if(!$sort)
		{
			\dash\notif::error(T_("Invalid sort arguments"));
			return false;
		}

		$currentSectionList = \dash\data::currentSectionList();

		if(!is_array($currentSectionList))
		{
			$currentSectionList = [];
		}

		foreach ($currentSectionList as $key => $value)
		{
			if(a($value, 'folder') === 'header' || a($value, 'folder') === 'footer')
			{
				unset($currentSectionList[$key]);
			}

			// bug
			if(!a($value, 'folder') && !a($value, 'section') && !a($value, 'model'))
			{
				unset($currentSectionList[$key]);
			}
		}

		if(count($currentSectionList) !== count($sort))
		{
			\dash\notif::warn(T_("Some item have problem in sorting. Need load again"));
			\dash\redirect::pwd();
		}

		foreach ($currentSectionList as $key => $value)
		{
			if(isset($value['id']) && in_array(floatval($value['id']), $sort))
			{
				//ok
			}
			else
			{
				\dash\notif::warn(T_("Some item have problem in sorting. Need load again"));
				\dash\redirect::pwd();
				return;
			}
		}

		\lib\db\sitebuilder\update::set_sort($sort);

		\dash\notif::complete();

		\dash\notif::reloadIframe();

		\dash\redirect::pwd();
		return;


	}
}
?>