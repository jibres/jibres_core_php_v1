<?php
namespace content_a\accounting\report\quarter;


class view
{
	public static function config()
	{

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());
		\dash\data::dataRow(\lib\app\tax\year\get::default_year());

		$args           = [];
		$args['type']   = \dash\request::get('type');
		$args['detail'] = \dash\request::get('detail');
		$args['merge']  = \dash\request::get('merge');

		if($args['type'] === 'income')
		{
			\dash\face::title(T_('Quarterly sell report'));
		}
		else
		{
			\dash\face::title(T_('Quarterly buy report'));
		}

		$args['doc_id'] = \dash\data::oneFactorId();

		$dataTable = \lib\app\tax\doc\report\quarter::get($args);

		if(!is_array($dataTable))
		{
			$dataTable = [];
		}

		\dash\data::dataTable($dataTable);

		if(\dash\request::get('merge'))
		{
			\dash\data::action_text(T_('Split'));
			\dash\data::action_link(\dash\url::current(). \dash\request::full_get(['merge' => null]));
		}
		else
		{
			\dash\data::action_text(T_('Merge'));
			\dash\data::action_link(\dash\url::current(). \dash\request::full_get(['merge' => 1]));
		}

		if(\dash\data::oneFactorId())
		{
			\dash\face::btnView(\dash\url::this(). '/factor/edit?id='. \dash\data::oneFactorId());
			// back
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::current(). \dash\request::full_get(['fid' => null]));

			\dash\data::action_text('');
			\dash\data::action_link('');
		}
	}
}
?>
