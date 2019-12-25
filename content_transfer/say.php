<?php
namespace content_transfer;

class say
{
	private static function dir()
	{
		return __DIR__. '/output.me.log';
	}


	public static function clean()
	{
		\dash\file::delete(self::dir());
	}

	public static function start()
	{
		$_text = date("Y-m-d H:i:s"). ' ' . str_repeat('-', 50). " START TRANSFER MACHINE \n";
		\dash\file::append(self::dir(), $_text);
	}


	public static function out($_text, $_type = null)
	{
		$_text = date("Y-m-d H:i:s"). ' - '. ucfirst($_type). ' ' . str_repeat('-', 5). ' '. $_text. "\n";
		\dash\file::append(self::dir(), $_text);
	}



	public static function ok($_text)
	{
		self::out($_text, 'ok   ');
	}

	public static function info($_text)
	{
		self::out($_text, 'info ');
	}

	public static function error($_text)
	{
		self::out($_text, 'error');
	}

	public static function end($_text)
	{
		self::out($_text, 'end  ');
		echo '<pre>';
		echo nl2br(\dash\file::read(self::dir()));
		echo '</pre>';
		\dash\code::boom();
	}



}
?>