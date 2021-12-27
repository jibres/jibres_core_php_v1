<?php
namespace dash\db;


class config
{




	/**
	 * Makes a set.
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public static function make_set($_args, $_options = [])
	{
		$default_options =
		[
			'type' => 'update',
		];

		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options = array_merge($default_options, $_options);

		$set = [];
		foreach ($_args as $key => $value)
		{
			if(!is_string($key))
			{
				continue;
			}

			if($value === null)
			{
				if($_options['type'] === 'insert')
				{
					// continue;
				}
				else
				{
					$set[] = " `$key` = NULL ";
				}
			}
			elseif(is_string($value) && (!isset($value) || $value == '' ))
			{
				if($_options['type'] === 'insert')
				{
					// continue;
				}
				else
				{
					$set[] = " `$key` = NULL ";
				}
			}
			elseif(is_string($value))
			{
				$set[] = " `$key` = '$value' ";
			}
			elseif(is_numeric($value))
			{
				$set[] = " `$key` = $value ";
			}
			elseif(is_bool($value))
			{
				if($value)
				{
					$set[] = " `$key` = 1 ";
				}
				else
				{
					$set[] = " `$key` = NULL ";
				}
			}
			else
			{
				$set[] = " `$key` = '$value' ";
			}
		}

		if(!empty($set))
		{
			if($_options['type'] === 'update')
			{
				$set = implode(',', $set);
			}
			elseif($_options['type'] === 'insert')
			{
				$set = implode(',', $set);
			}
			else
			{
				$set = false;
			}
		}
		else
		{
			$set = false;
		}
		return $set;
	}






}
?>
