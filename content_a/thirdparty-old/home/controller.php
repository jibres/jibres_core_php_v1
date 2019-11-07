<?php
namespace content_a\thirdparty\home;

class controller
{

	public static function routing()
	{
		if(\dash\request::get('json') === 'true')
		{
			$notif_result = [];
			$result       = [];

			$meta              = [];
			// $list           = \dash\request::get('list'); // staff, customer, supplier
			$type              = \dash\request::get('type'); // buy, sale
			$meta['sort_type'] = $type;

			if($type === 'sale')
			{
				$meta['userstores.supplier'] = ["IS", "NULL"];
			}

			$resultRaw         = \lib\app\thirdparty::list(\dash\request::get('q'), $meta);

			foreach ($resultRaw as $key => $value)
			{
				$name = '<div class="f">';

				if(isset($value['id']))
				{
					$result['result'][$key]['value'] = $value['id'];
				}

				if(isset($value['displayname']))
				{
					$name .='<span class="c"><b>'. $value['displayname'] . '</b></span>';

				}
				if(isset($value['mobile']))
				{
					$name .= '<div class="cauto pLa5"><div class="badge">'.\dash\utility\human::number($value['mobile']). '</div></div>';

				}

				$result['result'][$key]['name'] = $name. '</div>';
			}

			if(!$result)
			{
				$result = [];
				$result['result'][] = ['name' => T_("No result found!"), 'value' => null];
			}

			$result = json_encode($result, JSON_UNESCAPED_UNICODE);
			echo $result;
			\dash\code::boom();
		}
	}
}
?>