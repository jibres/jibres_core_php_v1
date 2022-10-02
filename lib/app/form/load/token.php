<?php
namespace lib\app\form\load;


class token
{

	public static function generateTokenBeforeLoad(&$result)
	{

		$checkUniqueSession = boolval(a($result, 'setting', 'uniquesession'));

		if($token = \dash\data::loadByCurrentToken())
		{
			$formLoadDetail = \lib\db\form_load\get::by_token($token);
			if($checkUniqueSession)
			{
				$formLoadDetail['isUnique'] = checkUnique::uniqueToken($formLoadDetail);
			}
		}
		else
		{
			$formId           = $result['id'];
			$formLoadDetail   = [];
			$generateNewToken = true;

			if($checkUniqueSession)
			{
				$formLoadDetail['isUnique'] = checkUnique::uniqueIpAgent($formId);
				if(!$formLoadDetail['isUnique'])
				{
					$generateNewToken = false;
				}
			}

			if($generateNewToken)
			{
				$token                   = self::generateTokenString($result);
				$formLoadDetail['token'] = $token;

				$formLoadId           = self::insertFormLoadRecord($token, $result);
				$formLoadDetail['id'] = $formLoadId;
			}

		}

		$result['formLoad'] = $formLoadDetail;


	}


	private static function generateTokenString($result) : string
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
