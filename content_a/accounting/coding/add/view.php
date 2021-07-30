<?php
namespace content_a\accounting\coding\add;


class view
{
	public static function config()
	{
		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());

		$type = \dash\request::get('type');
		\dash\data::parentList(\lib\app\tax\coding\get::parent_list($type));

		self::static_var();
	}


	public static function static_var()
	{
		$title = '';

		if(\dash\data::editMode())
		{
			$title .=  T_("Edit accounting coding");
		}
		else
		{
			$title .=  T_("Add new accounting coding");
		}

		$title .= ' - '.  T_(ucfirst(\dash\data::myType()));

		\dash\face::title($title);

		$view_id = null;
		if(\dash\request::get('view'))
		{
			$view_id = \dash\request::get('view');
		}
		elseif(\dash\request::get('id'))
		{
			$view_id = \dash\request::get('id');
		}

		if($view_id)
		{
			$load_detail = \lib\app\tax\coding\get::get($view_id);
			\dash\data::loadDetail($load_detail);
		}

		if(\dash\request::get('parent'))
		{
			$parent_id = \dash\request::get('parent');
			$load_parent = \lib\app\tax\coding\get::get($parent_id);
			\dash\data::parentDetail($load_parent);
		}

		$dataTableAll = \lib\app\tax\coding\search::list_tree(['open_all' => false, 'view_id' => $view_id]);
		\dash\data::dataTableAll($dataTableAll);

		$otherList = [];
		switch (\dash\data::myType())
		{
			case 'group':
				$otherList = \lib\app\tax\coding\get::list_of('group');
				break;

			default:
				# code...
				break;
		}

		\dash\data::otherList($otherList);


		if(\dash\language::current() === 'fa')
		{
			$myTitle = null;
			switch(\dash\request::get('from'))
			{
				case 'default_cost_vat':
					$myTitle = 'مالیات بر ارزش افزوده خرید';
					break;

				case 'default_cost_tax':
					$myTitle = "عوارض بر ارزش افزوده خرید";
					break;
				case 'default_income_vat':
					$myTitle = "مالیات بر ارزش افزوده درآمد";
					break;
				case 'default_income_tax':
					$myTitle = "مالیات بر ارزش افزوده درآمد";
					break;
				case 'default_cost_payer':
					$myTitle = "تنخواه";
					break;
				case 'default_cost_bank':
					$myTitle = "حساب بانکی پیشفرض";
					break;
				case 'default_partner':
					$myTitle = "جاری شرکا پیشفرض";
					break;

				case 'default_bank_profit':
					$myTitle = "سود بانکی";
					break;
				// default:
				// 	$myTitle = null;
				// 	break;
			}

			\dash\data::myTitle($myTitle);
		}

	}
}
?>
