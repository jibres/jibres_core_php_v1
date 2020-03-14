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

		$q = \dash\validate::search(\dash\request::get('q'));

		if($q)
		{
			$resultRaw    = \dash\app\user::list($q, $meta);
			foreach ($resultRaw as $key => $value)
			{
				$result['result'][] = self::getNeededField($value);
			}
		}
		else
		{
			$result['result'] =
			[
				[
					"name"  => T_("No result founded!"),
					"value" => null,
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
			$result['result'][] = ['name' => T_("No result found!"), 'value' => null];
		}

		\dash\code::jsonBoom($result);

	}

	private static function getNeededField($_data)
	{

		// $myName = '<img class="ui avatar image" src="'.  $value['avatar'] .'">';
		// $myName .= '<span class="pRa10">'. \dash\fit::number($value['code'], false). '</span>';
		// $myName .= '   '. $value['firstname']. ' <b>'. $value['lastname']. '</b> <small class="badge light mLa5">'. $value['father'].'</small>';
		// $myName .= '<span class="description">'. \dash\fit::number($value['nationalcode'], false). '</span>';

		$result   = [];
		$id       = null;
		$name     = null;
		$datalist = [];
		$priceTxt = '<span class="description ltr">';

		if(isset($_data['avatar']))
		{
			$name .= '<img class="avatar image" src="'.  $_data['avatar'] .'"> ';
		}

		if(isset($_data['id']))
		{
			$id = $_data['id'];
			$datalist['id'] = $_data['id'];
		}

		if(isset($_data['displayname']))
		{
			$datalist['displayname'] = $_data['displayname'];
			$name .= '<span class="pRa10">'. $_data['displayname']. '</span>';
		}


		if(isset($_data['mobile']))
		{
			$datalist['desc'] = $_data['mobile'];
			$name .= '<span class="badge light mRa5"><i class="sf-mobile"></i> '. \dash\fit::mobile($_data['mobile']). '</span>';
		}

			// add price to name of item
		$name   .= $priceTxt. '</span>';
		$result =
		[
			// on list
			'name'     => $name,
			'value'    => $id,
			'datalist' => $datalist,
		];


		return $result;
	}
}
?>
