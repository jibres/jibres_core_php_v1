<?php
namespace dash\app\user;


class site_list
{
	/**
	 * This function call everywhere need to get product list in dropdown mode
	 * in sale page or buy page
	 */
	public static function dropdown()
	{
		if(\dash\request::get('json') !== 'true')
		{
			return;
		}

		$notif_result = [];
		$result       = [];
		$meta         = [];
		$msg          = T_("Customer not found."). ' ';

		$q = \dash\validate::search_string();

		if($q)
		{
			$resultRaw    = \dash\app\user::list($q, $meta);

			foreach ($resultRaw as $key => $value)
			{
				$result['results'][] = self::getNeededField($value);
			}
		}
		else
		{
			$result['result'] =
			[
				[
					"text"  => T_("No result found!"),
					"id" => null,
					// "disabled"  => true
				]
			];
		}

		if(!$result)
		{
			$notif_result['message'] = $msg;
		}


		if(!$result)
		{
			$result = [];
			$result['results'][] = ['name' => T_("No result found!"), 'value' => null];
		}

		\dash\code::jsonBoom($result);

	}

	private static function getNeededField($_data)
	{

		if(\dash\request::get('mode') === 'text')
		{
			return
			[
				'id' => a($_data, 'id'),
				'text' => trim(a($_data, 'displayname'). ' '. \dash\fit::text(a($_data, 'mobile'))),
			];
		}

		// $myName = '<img class="ui avatar image" src="'.  $value['avatar'] .'">';
		// $myName .= '<span class="pRa10">'. \dash\fit::number($value['code'], false). '</span>';
		// $myName .= '   '. $value['firstname']. ' <b>'. $value['lastname']. '</b> <small class="badge light mLa5">'. $value['father'].'</small>';
		// $myName .= '<span class="description">'. \dash\fit::number($value['nationalcode'], false). '</span>';

		$result   = [];
		$id       = null;
		$html     = '<div class="flex align-center">';
		$datalist = [];

		if(isset($_data['avatar']))
		{
			$html .= '<img class="flex-none rounded-lg max-h-7 w-7" src="'.  $_data['avatar'] .'"> ';
		}

		if(isset($_data['id']))
		{
			$id = $_data['id'];
			$datalist['id'] = $_data['id'];
		}

		if(isset($_data['displayname']))
		{
			$datalist['displayname'] = $_data['displayname'];
			$html .= '<span class="flex-grow line-clamp-1 px-2">'. $_data['displayname']. '</span>';
		}


		if(isset($_data['mobile']))
		{
			$datalist['desc'] = $_data['mobile'];

			$html .= '<span class="flex-none">';
			$html .= \dash\fit::mobile($_data['mobile']);
			$html .= '</span>';
		}

		$html   .= '</div>';
		$result =
		[
			// on list
			'html'     => $html,
			'id'    => $id,
			'datalist' => $datalist,
		];


		return $result;
	}
}
?>
