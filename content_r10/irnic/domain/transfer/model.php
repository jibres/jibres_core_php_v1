<?php
namespace content_r10\irnic\domain\transfer;


class model
{
	public static function post()
	{
		$post =
		[
			'domain'    => \content_r10\tools::input_body('domain'),
			'agree'     => \content_r10\tools::input_body('agree'),
			'nic_id'    => \content_r10\tools::input_body('nic_id'),
			'irnic_new' => \content_r10\tools::input_body('irnic_new'),
			'pin'       => \content_r10\tools::input_body('pin'),
		];

		$result = \lib\app\nic_domain\transfer::transfer($post);


		\content_r10\tools::say($result);
	}
}
?>