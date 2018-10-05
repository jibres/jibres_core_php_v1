<?php
namespace content_a\thirdparty\home;

class controller
{

	public static function routing()
	{
		if(in_array(\dash\request::get('list'), ['mobile']))
		{
			$query_string = \dash\request::get('q');
			if(!$query_string)
			{
				$query_string = null;
			}

			$args                    = [];
			$args['order']           = 'desc';
			$args['search_in_other'] = false;

			$query_string = \dash\utility\convert::to_en_number($query_string);

			if(substr($query_string, 0, 1) === '0')
			{
				$new_q = '98'. substr($query_string, 1);

				$args['1.1'] = ["= 1.1 ", " AND (userstores.mobile LIKE '%$query_string%' OR userstores.mobile LIKE '$new_q%' )"];
			}
			else
			{
				$args['1.1'] = ["= 1.1 ", " AND userstores.mobile LIKE '%$query_string%' "];
			}

			$thirdpartyList       = \lib\app\thirdparty::list($query_string, $args);
			$result            = [];
			$result['success'] = true;
			$result['result']  = [];

			foreach ($thirdpartyList as $key => $value)
			{
				$myName = '<img class="ui avatar image" src="'.  $value['avatar'] .'">';
				// $myName .= '<span class="pRa10">'. \dash\utility\human::fitNumber($value['mobile'], false). '</span>';
				$myName .= '   '. $value['firstname']. ' <b>'. $value['lastname'];

				// $nationalcode = $value['nationalcode'];
				// if(!$value['nationalcode'] && $value['pasportcode'])
				// {
				// 	$nationalcode = $value['pasportcode'];
				// }

				// $myName .= '<span class="badge mLa10 info2">'. \dash\utility\human::fitNumber($nationalcode, false). '</span>';

				if($value['mobile'])
				{
					$myName .= '<span class="description ">'. \dash\utility\human::fitNumber($value['mobile'], 'mobile'). '</span>';
				}


				$result['result'][] =
				[
					'name'  => $myName,
					'value' => $value['id'],
				];
			}

			if(!$result['result'])
			{
				$result['result'][] =
				[
					'name'  => '<span class="badge warn">'. T_("Add"). '</span> <span class="badge mLa10 pain">' . $query_string. '</span>',
					'value' => $query_string,
				];
			}

			if(!\dash\utility\filter::mobile($query_string))
			{
				$result['result'] =
				[
					[
						'name'  => '<span class="badge txtC danger2">'. T_("Invalid moible"). '</span>',
						'value' => 'error',
					]
				];
			}

			$result = json_encode($result, JSON_UNESCAPED_UNICODE);
			echo $result;
			\dash\code::boom();
		}
	}
}
?>