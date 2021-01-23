<?php
namespace dash\app\ticket;

class check
{

	public static function variable($_args, $_id = null)
	{
		$content_condition = 'desc';

		if(\dash\permission::check('crmTicketManager'))
		{
			$content_condition = 'html';
		}

		$condition =
		[
			'title'       => 'title',
			'status'      => ['enum' => ['approved','awaiting','unapproved','spam','deleted','filter','close', 'answered']],
			'via'         => ['enum' => ['site', 'telegram', 'sms', 'contact', 'admincontact', 'app']],
			'type'        => 'string_50',
			'user_id'     => 'id',
			'sendmessage' => 'bit',
			'solved'      => 'bit',
			'file'        => 'string',
			'content'     => $content_condition,
			'parent'      => 'id',
		];

		$require = ['content'];
		$meta    = [];

		$data    = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}

}
?>