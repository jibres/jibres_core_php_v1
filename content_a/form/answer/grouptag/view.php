<?php
namespace content_a\form\answer\grouptag;


class view extends \content_a\form\answer\view
{
	public static function config()
	{
		parent::config();

		$form_id = \dash\request::get('id');
		// page title
		\dash\face::title(T_("Group tag"));
		// back
		\dash\data::back_text(T_('Answers'));
		\dash\data::back_link(\dash\url::this(). '/answer?id='. $form_id);

		\dash\data::listEngine_before(null);
		\dash\face::btnExport(null);
		\dash\data::listEngine_newActionByCurrentFilterURL(null);
		\dash\data::listEngine_newActionByCurrentFilterTitle(null);
		\dash\data::listEngine_search(\dash\url::current());
		\dash\data::listEngine_cleanFilterUrl(\dash\url::current(). '?id='. \dash\request::get('id'));
		\dash\data::listEngine_sort(false);
		\dash\data::listEngine_openKerkere(true);
		\dash\data::sortList(false);
		\dash\face::btnView(null);


	}
}
?>
