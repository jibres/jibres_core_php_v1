<?php
namespace lib\app\form\load;


use lib\app\product\variants;

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
			return false;
		}

		$update = [];


		$tokenDetail = \lib\db\form_load\get::get($postTokenId);
		if(isset($tokenDetail['token']) && $tokenDetail['token'] === $postToken)
		{
			// ok
		}
		else
		{
			return false;
		}

		$loadForm = \lib\app\form\form\get::by_id($tokenDetail['form_id']);

		if(!a($tokenDetail, 'starttime'))
		{
			$update['starttime'] = date("Y-m-d H:i:s");
		}

		if(a($loadForm, 'setting', 'randomquestion'))
		{
			$countRandom = $loadForm['setting']['randomquestion'];

			$randomId = \lib\db\form_item\get::randomItems($tokenDetail['form_id'], $countRandom);
			if($randomId)
			{
				$update['questions'] = json_encode($randomId);
			}

		}

		\lib\db\form_load\update::update($update, $postTokenId);

		$url = \dash\url::kingdom() . '/f/' . $urlFormId . '/t/' . $postToken;

		\dash\redirect::to($url);

		return true;

	}


}
