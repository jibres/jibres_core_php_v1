<?php
namespace content_su\tg\system;


class view
{
	public static function config()
	{
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$myTitle = T_("Telegram log");
		\dash\face::title($myTitle);

		\dash\data::action_text(T_('Back to dashboard'));
		\dash\data::action_link(\dash\url::this());



		$search_string = \dash\request::get('q');
		if($search_string)
		{
			$myTitle .= ' | '. T_('Search for :search', ['search' => $search_string]);
		}

		$allow = ['user','mobile','userid','chatid','user_id','hooktext','hookdate','step','sendmethod','sendtext','senddate','responsedate','status',];

		$args = \dash\request::get();

		if(is_array($args))
		{
			foreach ($args as $key => $value)
			{
				if(!in_array($key, $allow))
				{
					unset($args[$key]);
				}
			}
		}


		$args['sort']  = \dash\request::get('sort');
		$args['order'] = \dash\request::get('order');

		if(!$args['order'])
		{
			$args['order'] = 'DESC';
		}

		if(!$args['sort'])
		{
			$args['sort'] = 'telegrams.id';
		}

		$args['telegrams.user_id'] = null;

		$args['group_by_chatid'] = true;

		unset($args['page']);

		$dataTable = \dash\db\telegrams::search(\dash\request::get('q'), $args);

		// if(is_array($dataTable))
		// {
		// 	$dataTable = array_combine(array_column($dataTable, 'chatid'), $dataTable);

		// 	$load      = array_column($dataTable, 'chatid');
		// 	$load      = array_unique($load);
		// 	$load      = array_filter($load);

		// 	if($load)
		// 	{
		// 		$load = implode(',', $load);
		// 		$load = \dash\db\users::get(['chatid' => ["IN", "($load)"]]);

		// 		foreach ($load as $key => $value)
		// 		{
		// 			if(isset($value['chatid']))
		// 			{
		// 				if(isset($dataTable[$value['chatid']]))
		// 				{
		// 					$dataTable[$value['chatid']] = array_merge($value, $dataTable[$value['chatid']]);
		// 				}
		// 			}
		// 		}
		// 	}

		// }

		\dash\data::dataTable($dataTable);

		$filterArray = $args;
		$dataFilter = \dash\app\sort::createFilterMsg($search_string, $filterArray);
		\dash\data::dataFilter($dataFilter);
	}
}
?>