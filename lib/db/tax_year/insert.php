<?php
namespace lib\db\tax_year;


class insert
{


	/**
	 * Insert new record to product category table
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function new_record($_args)
	{
		if(isset($_args['code']))
		{
			$query = "SELECT * FROM tax_year WHERE tax_year.code = '$_args[code]' LIMIT 1";
			$result = \dash\pdo::get($query, [], null, true);
			if(isset($result['id']))
			{
				\dash\notif::error(T_("Duplicate code"));
				return false;
			}
		}
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `tax_year` SET $set ";
			if(\dash\db::query($query))
			{
				return \dash\db::insert_id();
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

}
?>
