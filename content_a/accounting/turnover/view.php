<?php
namespace content_a\accounting\turnover;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Turnover'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


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

		if($year_id)
		{
			$args['year_id'] = $year_id;
		}

		\dash\data::myYearId($year_id);

		$args['contain']   = \dash\request::get('contain');
		$args['group']     = \dash\request::get('group');
		$args['total']     = \dash\request::get('total');
		$args['assistant'] = \dash\request::get('assistant');
		$args['details']   = \dash\request::get('details');

		if(\dash\request::get('status') === 'draft')
		{
			$args['status_unverify'] = true;
		}
		else
		{
			$args['status_verify'] = true;
		}

		$startdate              = \dash\request::get('startdate');
		$startdate              = \dash\validate::date($startdate, false);
		$enddate                = \dash\request::get('enddate');
		$enddate                = \dash\validate::date($enddate, false);

		$args['startdate']      = $startdate ? $startdate : null;
		$args['enddate']        = $enddate ? $enddate : null;
		$args['summary_detail'] = true;

		if(\dash\request::get('export'))
		{
			$args['summary_detail'] = false;
			$args['export']         = true;
		}

		$dataTable = \lib\app\tax\docdetail\search::list(\dash\request::get('q'), $args);
		\dash\data::dataTable($dataTable);


		if(\dash\request::get('status') !== 'draft')
		{
			$args_draft                   = $args;
			unset($args_draft['status_verify']);
			unset($args_draft['export']);

			$args_draft['status_unverify'] = true;
			$args_draft['pagination']     = false;
			$args_draft['limit']          = 1;
			$args_draft['summary_detail'] = false;


			$dataTableDraft = \lib\app\tax\docdetail\search::list(\dash\request::get('q'), $args_draft);
			\dash\data::dataTableDraft($dataTableDraft);
		}


		if(\dash\request::get('export'))
		{
			$export_name = "Accounting_turnover";
			foreach ($dataTable as $key => $value)
			{
				unset($dataTable[$key]['string_id']);
			}

			\dash\utility\export::csv(['name' => $export_name, 'data' => $dataTable]);
		}

		$summary_detail = \lib\app\tax\docdetail\search::summary_detail();
		\dash\data::summaryDetail($summary_detail);

		\dash\data::groupList(\lib\app\tax\coding\get::current_list_of('group'));
		\dash\data::totalList(\lib\app\tax\coding\get::current_list_of('total', \dash\request::get('group')));
		\dash\data::assistantList(\lib\app\tax\coding\get::current_list_of('assistant', \dash\request::get('group'), \dash\request::get('total')));
		\dash\data::detailsList(\lib\app\tax\coding\get::current_list_of('details', \dash\request::get('group'), \dash\request::get('total'), \dash\request::get('assistant')));

	}
}
?>
