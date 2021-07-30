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
			'type'       => \dash\data::myType(),
			'put_on'     => a($dataRow, 'fill_value', 'put_on', 'details_id'),
			'thirdparty' => a($dataRow, 'fill_value', 'thirdparty', 'details_id'),
			'pay_from'   => a($dataRow, 'fill_value', 'pay_from', 'details_id'),
			'date'       => \dash\fit::date_en(a($dataRow, 'tax_document', 'date')),
		];
		$duplicateLink = \dash\url::that(). '/add?';
		$duplicateLink .= \dash\request::build_query($duplicateLinkArgs);
		\dash\face::btnDuplicate($duplicateLink);

		// save btn
		\dash\face::btnNew(\dash\url::that(). '/add?type='. \dash\data::myType());

		// view document btn
		\dash\face::btnView(\dash\url::this(). '/doc/edit?id='. \dash\request::get('id'));


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