<?php
class HttpException extends BaseException
{
	public function __construct($t)
	{
		var_dump("yes".$t);
	}
}
?>