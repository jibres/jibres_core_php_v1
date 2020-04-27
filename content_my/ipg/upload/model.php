<?php
namespace content_my\ipg\upload;


class model
{
	public static function post()
	{
		$nationalpic = \dash\upload\ipg_profile::nationalpic();
		$shpic       = \dash\upload\ipg_profile::shpic();


		if(\dash\engine\process::status())
		{
			$post = [];

			if($nationalpic)
			{
				$post['nationalpic'] = $nationalpic;
			}

			if($shpic)
			{
				$post['shpic'] = $shpic;
			}

			if(!empty($post))
			{
				\lib\app\ipg\profile\set::user_set($post);
			}
			else
			{
				\dash\notif::info(T_("Document update without change"));
			}


			\dash\redirect::to(\dash\url::this(). '/iban');
		}
	}
}
?>