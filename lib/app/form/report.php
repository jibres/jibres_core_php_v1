<?php
namespace lib\app\form;


class report
{
	public static function chart_pie($_item)
	{

		if(!$_item || !is_array($_item))
		{
			return null;
		}

		if(isset($_item['type_detail']['chart']) && $_item['type_detail']['chart'])
		{
			// ok
		}
		else
		{
			return null;
		}

		if(isset($_item['type_detail']['chart_type']) && $_item['type_detail']['chart_type'] && is_array($_item['type_detail']['chart_type']) && in_array('pie', $_item['type_detail']['chart_type']))
		{
			// ok
		}
		else
		{
			return null;
		}

		$item_id = \dash\get::index($_item, 'id');

		if(!$item_id)
		{
			return null;
		}

		$form_id = \dash\get::index($_item, 'form_id');

		if(!$form_id)
		{
			return null;
		}

		$load_answer = \lib\db\form_answerdetail\get::chart_pie($form_id, $item_id);
		if(!is_array($load_answer))
		{
			$load_answer = [];
		}

		$chart = [];
		foreach ($load_answer as $key => $value)
		{
			if(isset($value['count']) && isset($value['answer']))
			{
				$chart[] = ['name' => $value['answer'], 'y' =>  floatval($value['count'])];
			}
		}

		$chart = json_encode($chart, JSON_UNESCAPED_UNICODE);
		return $chart;
	}
}
?>