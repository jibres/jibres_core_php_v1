<?php
namespace content\accounting;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Jibres Cloud Accounting'));
		\dash\face::desc(T_("Don't Delay! Manage Invoicing, Expenses, Payment, Taxes and Everything with Jibres. Simple and Accurate."));
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-accounting-cover-1.jpg');
		if(\dash\language::current() === 'fa')
		{
			\dash\face::cover(\dash\url::cdn(). '/img/cover/ir/Jibres-accounting-cover-1-fa.jpg');
		}
	}
}
?>