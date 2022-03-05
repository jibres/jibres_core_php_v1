<?php
namespace dash\app\log\caller\transaction;


class transaction_newPaySuccessfullSupervisor extends transaction_newPaySuccessfull
{

	public static function active_bot()
	{
		return 'jibres_bot';
	}

}
?>