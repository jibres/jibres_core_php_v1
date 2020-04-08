<?php
namespace content_r10\irnic\domain\renew;


class model
{
	public static function post()
	{
		$post =
		[
			'domain'      => \content_r10\tools::input_body('domain'),
			'period'      => \content_r10\tools::input_body('period'),
			'agree'       => \content_r10\tools::input_body('agree'),
		];

		$result = \lib\app\nic_domain\renew::renew($post);


		\content_r10\tools::say($result);
	}
}
?>