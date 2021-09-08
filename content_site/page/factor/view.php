<?php
namespace content_site\page\factor;


class view extends \content_site\page\view
{
	public static function config()
	{
		parent::config();


		\dash\data::include_adminPanelBuilder(true);

		\dash\face::title(T_('Page factor'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). \dash\request::full_get());

		//factor detail
		\dash\data::pageFactor(self::page_factor());

		$my_jibres_budget = \lib\jpi\budget::me();

		\dash\data::myBudget($my_jibres_budget);


	}



	public static function page_factor()
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
			$page_factor = [];

			foreach ($all_section as $key => $value)
			{
				$is_premium = \content_site\call_function::section_model_premium(a($value, 'section'), a($value, 'model'));

				if($is_premium)
				{
					$feature_key = implode('_', ['site', a($value, 'folder'), a($value, 'section'), a($value, 'model')]);

					$feature_detail = \lib\features\get::detail($feature_key);

					$page_factor[] = $feature_detail;
				}
			}
		}


		return $page_factor;

	}
}
?>