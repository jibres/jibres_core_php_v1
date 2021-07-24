<?php
namespace content_a\accounting\factor\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Add new factor"). ' | '. \lib\app\tax\doc\ready::factor_type_translate(\dash\data::myType()));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '?'. \dash\request::build_query(['template' => \dash\data::myType()]));

		self::static_var();

		\dash\face::btnInsert('form1');
	}



	public static function static_var()
	{

		\dash\data::global_scriptPage('a_accounting_factor.js?v=2');

		$year = \lib\app\tax\year\get::list();
		\dash\data::accountingYear($year);

		$year_id = \dash\request::get('year_id');
		if(!$year_id)
		{
			foreach ($year as $key => $value)
			{
				if(isset($value['isdefault']) && $value['isdefault'])
				{
					$year_id = $value['id'];
					break;
				}
			}
		}

		\dash\data::detailsList(\lib\app\tax\coding\get::current_list_of('details'));


	}
}
?>