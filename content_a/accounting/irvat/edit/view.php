<?php
namespace content_a\accounting\irvat\edit;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Edit factor"));

		\dash\data::userToggleSidebar(false);

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '/all');

		\dash\data::titleList(\lib\app\irvat\get::title_list());

		\content_a\accounting\irvat\add\view::static_var();

		if(a(\dash\data::dataRow(), 'tax_document', 'status') === 'temp')
		{
			\dash\face::btnSave('formlock1');
			\dash\face::btnSaveValue('lock');
			\dash\face::btnSaveText(T_("Lock"));
		}
		elseif(a(\dash\data::dataRow(), 'tax_document', 'status') === 'lock')
		{
			\dash\face::btnInsert('formlock1');
			\dash\face::btnInsertValue('unlock');
			\dash\face::btnInsertText(T_("Unlock"));
		}

	}
}
?>