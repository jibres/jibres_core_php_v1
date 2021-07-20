<?php
namespace content_a\accounting\factor\edit;


class view
{
	public static function config()
	{
		$dataRow = \dash\data::dataRow();

		\dash\face::title(T_('Accounting Document Number'). ' '. a($dataRow, 'tax_document', 'number'));

		\dash\data::userToggleSidebar(false);

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '/all');


		\content_a\accounting\factor\add\view::static_var();


		$docIsLock = a($dataRow, 'tax_document', 'status') === 'lock';

		if(!$docIsLock)
		{
			\dash\face::btnSave('form1');
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