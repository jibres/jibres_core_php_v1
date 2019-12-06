<?php
namespace content_enter\loginas;


class controller
{
	public static function routing()
	{
		$keyMd5 = \dash\url::child();

		if(!$keyMd5 || mb_strlen($keyMd5) !== 32)
		{
			\dash\redirect::to(\dash\url::kingdom());
		}

		$loginas = isset($_SESSION['login_as']) ? $_SESSION['login_as'] : null;

		if(!$loginas || !is_array($loginas))
		{
			\dash\redirect::to(\dash\url::kingdom());
		}

		$isOk      = false;
		$subdomain = null;
		$referer   = null;

		foreach ($loginas as $key => $value)
		{
			if(isset($value['key']) && $value['key'] === $keyMd5)
			{
				$isOk      = true;
				$subdomain = isset($value['subdomain']) ? $value['subdomain'] : null;
				$referer   = isset($value['referer']) ? $value['referer'] : null;
				break;
			}

		}

		if(!$isOk || !$subdomain)
		{
			\dash\redirect::to(\dash\url::kingdom());
		}

		\dash\open::get();
		\dash\open::post();

		\dash\data::logitToSubdomain($subdomain);
		\dash\data::logiToReferer($referer);




	}
}
?>