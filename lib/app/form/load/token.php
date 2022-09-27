<?php
namespace lib\app\form\load;


class token
{

	public static function generateTokenBeforeLoad(&$result)
	{

		if($token = \dash\data::loadByCurrentToken())
		{
			$formLoadDetail = \lib\db\form_load\get::by_token($token);
		}
		else
		{
			$token = self::generageTokenString($result);

			$formLoadId = self::insertFormLoadRecord($token, $result);

			$formLoadDetail =
				[
					'token' => $token,
					'id'    => $formLoadId,
				];
		}



		$result['formLoad'] = $formLoadDetail;


	}


	private static function generageTokenString($result) : string
	{
		$token   = [];
		$token[] = json_encode($result);
		$token[] = microtime();
		$token[] = \dash\user::id();
		$token[] = rand();
		$token[] = rand();

		$token = implode('@>#!', $token);
		$token = md5($token);

		return $token;
	}


	private static function insertFormLoadRecord(string $_token, $result)
	{
		$insertFormLoad =
			[
				'form_id'    => $result['id'],
				'token'      => $_token,
				'ip_id'      => \dash\utility\ip::id(),
				'agent_id'   => \dash\agent::get(true),
				'user_id'    => \dash\user::id(),
				'viewtime'   => date("Y-m-d H:i:s"),
				'starttime'  => null,
				'url_id'     => \lib\app\urls\get::url_id(),
				'referer_id' => \lib\app\urls\get::referer_id(),
				'questions'  => null,
			];

		$formLoadId = \lib\db\form_load\insert::new_record($insertFormLoad);

		return $formLoadId;
	}

}
