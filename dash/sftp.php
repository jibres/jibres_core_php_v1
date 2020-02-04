<?php
namespace dash;
/**
 * Class for sftp.
 * need to install php-ssh2
 * every sftp function
 * for @example
 *  \dash\sftp::send('local dir', 'remote dir');
 */
class sftp
{
	public static $link  = null;
	public static $login = false;

	/**
	 * connect fo fpt server
	 */
	public static function connect($_host = null, $_user = null, $_passowrd = null, $_port = null)
	{
		if(!self::$link)
		{
			$sftp_host = $_host;
			$sftp_port = $_port;
			$link = @\ssh2_connect($sftp_host, $sftp_port);

			if($link)
			{
				self::$link = $link;
				self::login($_user, $_passowrd);
			}
		}
	}


	/**
	 * login in connected sftp server
	 */
	public static function login($_user = null, $_passowrd = null)
	{
		$user = $_user;
		$pass = $_passowrd;

		$login = @\ssh2_auth_password(self::$link, $user, $pass);

		if($login)
		{
			self::$login = $login;
		}
	}


	public static function send($_local_dir, $_remote_dir, $_mode = 0664)
	{
		self::connect();
		if(self::$login)
		{
			$result = @\ssh2_scp_send(self::$link, $_local_dir, $_remote_dir, $_mode);
			return $result;
		}
		return false;
	}


	public static function receive($_remote_dir, $_local_dir)
	{
		self::connect();
		if(self::$login)
		{
			$result = @\ssh2_scp_recv(self::$link, $_remote_dir, $_local_dir);
			return $result;
		}
		return false;
	}



	/**
	 * call every sftp function if exist
	 *
	 * @param      <type>  $_func  The function
	 * @param      <type>  $_args  The arguments
	 */
	public static function __callStatic($_func, $_args)
	{
		if(function_exists('ssh2_sftp_'. $_func))
		{
			$fn = 'ssh2_sftp_'. $_func;
		}
		elseif(function_exists('ssh2_'. $_func))
		{
			$fn = 'ssh2_'. $_func;
		}
		elseif(function_exists($_func))
		{
			$fn = $_func;
		}
		else
		{
			return false;
		}

		self::connect();

		if(self::$login)
		{
			$result = @$fn(self::$link, ...$_args);
			return $result;
		}

		return false;
	}
}
?>