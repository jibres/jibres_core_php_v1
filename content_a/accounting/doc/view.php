<?php
namespace content_a\accounting\doc;


class view
{
	public static function config($_args = [])
	{
		\dash\face::title(T_('Accounting Documents'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		// back
		\dash\data::action_text(T_('Add doc'));
		\dash\data::action_link(\dash\url::that(). '/add');


		// \dash\face::btnPreview(\dash\url::that(). '/printall');


		\dash\face::btnInsert('formreset');
		\dash\face::btnInsertText(T_("Reset"));

		\dash\data::userToggleSidebar(false);

		\dash\face::btnExport(\dash\url::current(). '?'. \dash\request::fix_get(['export' => 1]));


		$year = \lib\app\tax\year\get::list();
		\dash\data::accountingYear($year);

		$args = [];

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

		\dash\data::myYearId($year_id);


		$args['contain']   = \dash\request::get('contain');

		$startdate         = \dash\request::get('startdate');
		$startdate         = \dash\validate::date($startdate, false);
		$enddate           = \dash\request::get('enddate');
		$enddate           = \dash\validate::date($enddate, false);

		$args['year_id']   = $year_id;
		$args['startdate'] = $startdate ? $startdate : null;
		$args['enddate']   = $enddate ? $enddate : null;
		$args['month']     = \dash\request::get('month');

		$args = array_merge($args, $_args);

		if(\dash\request::get('status'))
		{
			$args['status'] = \dash\request::get('status');
		}

		if(\dash\request::get('export'))
		{
			$args['export'] = true;
		}

		$dataTable = \lib\app\tax\doc\search::list(\dash\validate::search_string(), $args);

		if(\dash\request::get('export'))
		{
			$export_name = "Accounting_document_list";
			foreach ($dataTable as $key => $value)
			{
				unset($dataTable[$key]['gallery_array']);
				unset($dataTable[$key]['gallery']);
			}

			\dash\utility\export::csv(['name' => $export_name, 'data' => $dataTable]);
		}

		\dash\data::dataTable($dataTable);

	}
}
?>
