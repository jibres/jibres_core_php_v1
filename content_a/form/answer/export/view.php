<?php
namespace content_a\form\answer\export;


class view
{
	public static function config()
	{
		$form_id = \dash\request::get('id');
		// page title
		\dash\face::title(T_("Export form answer"));
		// back
		\dash\data::back_text(T_('Answers'));
		\dash\data::back_link(\dash\url::this(). '/answer?id='. $form_id);


		$count_all = \lib\app\form\answer\export::count_all($form_id);
		\dash\data::countAll($count_all);

		if(\dash\request::get('download') === 'now')
		{
			\lib\app\form\answer\export::download_now($form_id);
		}

		if(\dash\request::get('eid'))
		{
			\lib\app\export\download::export_form_answer(\dash\request::get('eid'));
		}

		$list = \lib\app\form\answer\export::list();
		\dash\data::exportList($list);
	}
}
?>
