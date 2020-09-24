<?php
namespace content_a\form\analytics\filter;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Analitics'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '?id='. \dash\request::get('id'));

		\dash\face::btnInsert('formexec');
		\dash\face::btnInsertText(T_("Execute filter"));

		$count_all = floatval(\lib\app\form\filter\run::count_all(\dash\request::get('id'), \dash\request::get('fid')));
		\dash\data::countAll($count_all);
		// // back
		// \dash\data::action_text(T_('Manage condition'));
		// \dash\data::action_link(\dash\url::that(). '/addcondition?'. \dash\request::fix_get());

		\dash\face::btnDuplicate(\dash\url::that(). '/duplicate?'. \dash\request::fix_get());
		// \dash\face::btnView(\dash\url::that(). '/table?'. \dash\request::fix_get());

		$where_list = \lib\app\form\filter\get::where_list(\dash\request::get('fid'), \dash\request::get('id'));
		\dash\data::whereList($where_list);

		$allChoice = \lib\app\form\choice\get::all_choice(\dash\request::get('id'));
		\dash\data::allChoice($allChoice);

		$fields = \lib\app\form\form\ready::fields(\dash\data::formDetail());

		\dash\data::fields($fields);

		if(\dash\request::get('x'))
		{
			$result = [];
			$result['form'] = \dash\data::formDetail();
			$result['fields'] = $fields;
			\dash\code::jsonBoom($result);

		}

	}

}
?>
