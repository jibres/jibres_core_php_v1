<?php
namespace lib\app\form\load;


class startToken
{

	public static function userStartToken()
	{
		$urlFormId   = \dash\url::child();
		$postFormId  = \dash\request::post('fid');
		$postTokenId = \dash\request::post('tid');
		$postToken   = \dash\request::post('token');

		if(!\dash\validate::is_equal($urlFormId, $postFormId))
		{
			return false;
		}

		$postTokenId = \dash\validate::id($postTokenId);

		if(!$postToken || !$postTokenId)
		{
			return  false;
		}


		$tokenDetail = \lib\db\form_load\get::get($postTokenId);
		if(isset($tokenDetail['token']) && $tokenDetail['token'] === $postToken)
		{
			// ok
		}
		else
		{
			return false;
		}

		$setStartTime =
			[
				'starttime' => date("Y-m-d H:i:s"),
			];

		\lib\db\form_load\update::update($setStartTime, $postTokenId);

		$url = \dash\url::kingdom() .'/f/'. $urlFormId. '/t/'. $postToken;

		\dash\redirect::to($url);

		return true;

	}


}
