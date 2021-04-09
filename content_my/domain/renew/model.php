<?php
namespace content_my\domain\renew;


class model
{
	public static function post()
	{

		$post =
		[
			'domain' => \dash\request::get('domain'),
			'period' => \dash\request::post('period'),
			'agree'  => \dash\request::post('agree'),
		];

		$result = \lib\app\domains\renew::renew($post);

		if(\dash\engine\process::status() && isset($result['domain_id']))
		{
			\dash\redirect::to(\dash\url::this(). '/review?type=renew&id='. $result['domain_id']);
		}


		if(\dash\engine\process::status())
		{
			if(\dash\temp::get('need_show_domain_result') && \dash\temp::get('domain_name_url'))
			{
				\dash\redirect::to(\dash\url::here(). '/domain/setting?domain='. \dash\temp::get('domain_name_url'));
			}
			else
			{
				\dash\redirect::to(\dash\url::this());
			}
		}
	}
}
?>