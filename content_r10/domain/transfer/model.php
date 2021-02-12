<?php
namespace content_r10\domain\transfer;


class model
{
	public static function post()
	{
		$post =
		[
			'domain'    => \dash\request::input_body('domain'),
			'agree'     => \dash\request::input_body('agree'),
			'nic_id'    => \dash\request::input_body('nic_id'),
			'irnic_new' => \dash\request::input_body('irnic_new'),
			'pin'       => \dash\request::input_body('pin'),
		];

		$result = \lib\app\nic_domain\transfer::transfer($post);


		\content_r10\tools::say($result);
	}
}
?>