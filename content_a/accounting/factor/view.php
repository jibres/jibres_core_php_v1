<?php
namespace content_a\accounting\factor;


class view
{
	public static function config()
	{
		\content_a\accounting\doc\view::config(['template_list' => true]);

		$args = \dash\temp::get('factorArgs');

		$args['summary_mode'] = true;

		$summaryDetail = \lib\app\tax\doc\search::list(null, $args);

		\dash\data::summaryDetail($summaryDetail);

		\dash\face::btnInsert('');
		\dash\face::btnInsertText('');

		\dash\data::docListModeFactor(true);

		\dash\face::title(T_("Factors list :val", ['val' => \lib\app\tax\doc\ready::factor_type_translate(\dash\request::get('template'))]));


		// btn
		\dash\data::action_text(T_('Add new factor'));
		\dash\data::action_link(\dash\url::that(). '/add?'. \dash\request::build_query(['type' => \dash\request::get('template')]));


	}

}
?>
