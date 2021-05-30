<?php
namespace dash;
/**
 * Class for scp.
 */
class scp
{
	private static $connection     = null;
	private static $home_directory = null;


	public static function connect($_host = null, $_user = null, $_pass = null, $_port = 22, $_known_host = null)
	{
		if(!function_exists('ssh2_connect'))
		{
			return false;
		}

		ini_set('default_socket_timeout', 59);

		if(!self::$connection)
		{
			try
			{
				$connection = @ssh2_connect($_host, $_port);

				if($connection)
				{
					if($_known_host)
					{
						$fingerprint = @ssh2_fingerprint($connection, SSH2_FINGERPRINT_MD5 | SSH2_FINGERPRINT_HEX);

						if($fingerprint != $_known_host)
						{
							return false;
						}
					}

					$ok = @ssh2_auth_password($connection, $_user, $_pass);

					if($ok)
					{
						self::$connection = $connection;
						return true;
					}
					else
					{
						return false;
					}
				}
			}
			catch (\Exception $e)
			{
				return false;
			}
		}
	}


	public static function disconnect()
	{
		if(self::$connection)
		{
			@ssh2_disconnect(self::$connection);
			self::$connection     = null;
			self::$home_directory = null;
		}
	}



	private static function fix_home_dir($_remote_file)
	{
		return self::$home_directory. '/'. $_remote_file;
	}


	public static function send($_local_file, $_remote_file, $_create_mode = null)
	{
		self::connect();

		if(!self::$connection)
		{
			return false;
		}

		if(is_null($_create_mode))
		{
			$_create_mode = 0644;
		}

		$_remote_file = self::fix_home_dir($_remote_file);

		if(!self::check_dir($_remote_file))
		{
			self::makeDir($_remote_file, null, true);
		}

		try
		{
			$result = @ssh2_scp_send(self::$connection, $_local_file, $_remote_file, $_create_mode);
			return $result;
		}
		catch (\Exception $e)
		{
			return false;
		}
	}



	public static function recv($_remote_file, $_local_file)
	{
		self::connect();

		if(!self::$connection)
		{
			return false;
		}

		try
		{
			$result = @ssh2_scp_recv(self::$connection, self::fix_home_dir($_remote_file), $_local_file);
			return $result;
		}
		catch (\Exception $e)
		{
			return false;
		}
	}


	public static function delete($_remote_file)
	{
		self::connect();

		if(!self::$connection)
		{
			return false;
		}

		$_remote_file = self::fix_home_dir($_remote_file);

		try
		{
			$sftp   = @ssh2_sftp(self::$connection);
			$result = @ssh2_sftp_unlink($sftp, $_remote_file);
			return $result;
		}
		catch (\Exception $e)
		{
			return false;
		}
	}


	public static function makeDir($_path, $_mode = null, $_recursive = false)
	{
		self::connect();

		if(!self::$connection)
		{
			return false;
		}

		if(is_null($_mode))
		{
			$_mode = 0775;
		}

		try
		{
			$sftp   = @ssh2_sftp(self::$connection);
			$result = @ssh2_sftp_mkdir($sftp, dirname($_path), $_mode, $_recursive);
			return $result;
		}
		catch (\Exception $e)
		{
			return false;
		}
	}


	public static function check_dir($_path)
	{
		self::connect();

		if(!self::$connection)
		{
			return false;
		}

		try
		{
			$sftp   = @ssh2_sftp(self::$connection);
			$result = file_exists('ssh2.sftp://' . $sftp . dirname($_path));
			return $result;
		}
		catch (\Exception $e)
		{
			return false;
		}

	}


	public static function get_streams($_remote_path)
	{
		self::connect();

		$sftp   = @ssh2_sftp(self::$connection);

		$stream  = 'ssh2.sftp://';
		$stream .= $sftp;
		$stream .= self::$home_directory;
		$stream .= '/';
		$stream .= $_remote_path;
		return $stream;
	}



	public static function uploader_connection()
	{
		$host                 = \dash\setting\upload_scp::host();
		$username             = \dash\setting\upload_scp::username();
		$password             = \dash\setting\upload_scp::password();
		$known_host           = \dash\setting\upload_scp::known_host();
		$port                 = \dash\setting\upload_scp::port();
		self::$home_directory = '/home/'. $username;

		if(self::connect($host, $username, $password, $port, $known_host))
		{
			return true;
		}

		return false;

	}

}
?>