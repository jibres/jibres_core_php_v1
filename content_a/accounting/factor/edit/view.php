<?php
namespace content_a\accounting\factor\edit;


class view
{
	public static function config()
	{
		$dataRow = \dash\data::dataRow();

		$myTitle = T_('Accounting Document Number'). ' '. a($dataRow, 'tax_document', 'number');
		if(a($dataRow, 'tax_document', 'desc'))
		{
			$myTitle .= ' [ '. a($dataRow, 'tax_document', 'desc'). ' ]';
		}
		$myTitle .= ' | '. \lib\app\tax\doc\ready::factor_type_translate(\dash\data::myType());
		\dash\face::title($myTitle);

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '?'. \dash\request::build_query(['template' => \dash\data::myType()]));


		\content_a\accounting\factor\add\view::static_var();


		$docIsLock = a($dataRow, 'tax_document', 'status') === 'lock';

		if($docIsLock)
		{
			\dash\face::btnInsertText(T_("Unlock"));
			\dash\face::btnInsert('form2');
		}
		else
		{
			\dash\face::btnSave('form1');
		}

		// duplicate btn
		$duplicateLinkArgs =
		[
			'type'          => \dash\data::myType(),
			'put_on'        => a($dataRow, 'fill_value', 'put_on', 'details_id'),
			'thirdparty'    => a($dataRow, 'fill_value', 'thirdparty', 'details_id'),
			'pay_from'      => a($dataRow, 'fill_value', 'pay_from', 'details_id'),
			'bank'          => a($dataRow, 'fill_value', 'bank', 'details_id'),
			'bank_profit'   => a($dataRow, 'fill_value', 'bank_profit', 'details_id'),
			'date'          => \dash\fit::date_en(a($dataRow, 'tax_document', 'date')),
			'total'         => round(a($dataRow, 'tax_document', 'total')),
			'totaldiscount' => round(a($dataRow, 'tax_document', 'totaldiscount')),
			'totalvat'      => round(a($dataRow, 'tax_document', 'totalvat')),
		];

		$duplicateLink = \dash\url::that(). '/add?';
		$duplicateLink .= \dash\request::build_query($duplicateLinkArgs);
		\dash\face::btnDuplicate($duplicateLink);

		// save btn
		\dash\face::btnNew(\dash\url::that(). '/add?type='. \dash\data::myType());
		\dash\face::btnExport(\dash\url::current(). \dash\request::full_get(['export' => 1]));

		// view document btn
		\dash\face::btnView(\dash\url::this(). '/doc/edit?id='. \dash\request::get('id'));



		if(\dash\request::get('export'))
		{
			$export =
			[

				'number'        => a($dataRow, 'tax_document', 'number'),
				'date'          => a($dataRow, 'tax_document', 'date'),
				// 'desc'          => a($dataRow, 'tax_document', 'desc'),
				'status'        => a($dataRow, 'tax_document', 'status'),
				// 'year_id'       => a($dataRow, 'tax_document', 'year_id'),
				// 'type'          => a($dataRow, 'tax_document', 'type'),
				// 'subnumber'     => a($dataRow, 'tax_document', 'subnumber'),
				'template'      => a($dataRow, 'tax_document', 'template'),
				// 'serialnumber'  => a($dataRow, 'tax_document', 'serialnumber'),
				'total'         => a($dataRow, 'tax_document', 'total'),
				'totaldiscount' => a($dataRow, 'tax_document', 'totaldiscount'),
				'totalvat'      => a($dataRow, 'tax_document', 'totalvat'),
			];

			if(is_array(a($dataRow, 'doc_detail')))
			{
				foreach ($dataRow['doc_detail'] as $key => $value)
				{
					$export[a($value, 'template')] = a($value, 'details_id');
				}
			}

			$export = [$export];

			\dash\utility\export::csv(['name' => 'Export_accounting_doc_'. \dash\request::get('id'), 'data' => $export]);
		}

		// if(a(\dash\data::dataRow(), 'tax_document', 'status') === 'temp')
		// {
		// 	\dash\face::btnSave('formlock1');
		// 	\dash\face::btnSaveValue('lock');
		// 	\dash\face::btnSaveText(T_("Lock"));
		// }
		// elseif(a(\dash\data::dataRow(), 'tax_document', 'status') === 'lock')
		// {
		// 	\dash\face::btnInsert('formlock1');
		// 	\dash\face::btnInsertValue('unlock');
		// 	\dash\face::btnInsertText(T_("Unlock"));
		// }

	}
}
?>