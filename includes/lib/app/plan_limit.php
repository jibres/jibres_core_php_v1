<?php
namespace lib\app;

class plan_limit
{
	public static function check($_module, $_count = null)
	{

		switch ($_module)
		{
			case 'factor':
				return self::factor();
				break;

			case 'factordetail':
				return self::factordetail($_count);
				break;

			case 'product':
				return self::product();
				break;

			case 'thirdparty':
				return self::thirdparty();
				break;

			default:
				\dash\notif::error(T_("Invalid "));
				return false;
				break;
		}
	}

	private static function factor()
	{
		if(\lib\permission::plan('ultimateFactor'))
		{
			// nothing
			return true;
		}

		$now = date("Y-m-d");
		$count = \lib\db\factors::get_count(['store_id' => \lib\store::id(), 'DATE(factors.datecreated)' => ["=", "DATE('$now')"]]);
		$count = intval($count);

		if(\lib\permission::plan('factorCount1000'))
		{
			if($count < 1000)
			{
				// no problem
				return true;
			}
			else
			{
				\dash\notif::error(T_("Maximum allowed capacity for factors in your store has been completed"));
				return false;
			}
		}
		elseif(\lib\permission::plan('factorCount100'))
		{
			if($count < 100)
			{
				// no problem
				return true;
			}
			else
			{
				\dash\notif::error(T_("Maximum allowed capacity for factors in your store has been completed"));
				return false;
			}
		}
		else
		{
			\dash\notif::error(T_("Can not add any factor!"));
			return false;
		}
	}


	private static function product()
	{
		if(\lib\permission::plan('ultimateProduct'))
		{
			// nothing
			return true;
		}

		$count = \lib\db\products::get_count(['store_id' => \lib\store::id()]);
		$count = intval($count);

		if(\lib\permission::plan('productCount1000'))
		{
			if($count < 1000)
			{
				// no problem
				return true;
			}
			else
			{
				\dash\notif::error(T_("Maximum allowed capacity for products in your store has been completed"));
				return false;
			}
		}
		elseif(\lib\permission::plan('productCount100'))
		{
			if($count < 100)
			{
				// no problem
				return true;
			}
			else
			{
				\dash\notif::error(T_("Maximum allowed capacity for products in your store has been completed"));
				return false;
			}
		}
		else
		{
			\dash\notif::error(T_("Can not add any product!"));
			return false;
		}
	}


	private static function thirdparty()
	{
		if(\lib\permission::plan('ultimateThirdparty'))
		{
			// nothing
			return true;
		}

		$count = \lib\db\userstores::get_count(['store_id' => \lib\store::id()]);
		$count = intval($count);

		if(\lib\permission::plan('thirdpartyCount1000'))
		{
			if($count < 1000)
			{
				// no problem
				return true;
			}
			else
			{
				\dash\notif::error(T_("Maximum allowed capacity for thirdpartys in your store has been completed"));
				return false;
			}
		}
		elseif(\lib\permission::plan('thirdpartyCount100'))
		{
			if($count < 100)
			{
				// no problem
				return true;
			}
			else
			{
				\dash\notif::error(T_("Maximum allowed capacity for thirdpartys in your store has been completed"));
				return false;
			}
		}
		else
		{
			\dash\notif::error(T_("Can not add any thirdparty!"));
			return false;
		}
	}


	private static function factordetail($count)
	{
		if(\lib\permission::plan('ultimateFactorDetail'))
		{
			// nothing
			return true;
		}

		$count = intval($count);

		if(\lib\permission::plan('factordetailCount100'))
		{
			if($count < 100)
			{
				// no problem
				return true;
			}
			else
			{
				\dash\notif::error(T_("Maximum allowed capacity for factordetails in your store has been completed"));
				return false;
			}
		}
		elseif(\lib\permission::plan('factordetailCount10'))
		{
			if($count < 10)
			{
				// no problem
				return true;
			}
			else
			{
				\dash\notif::error(T_("Maximum allowed capacity for factordetails in your store has been completed"));
				return false;
			}
		}
		else
		{
			\dash\notif::error(T_("Can not add any factordetail!"));
			return false;
		}
	}
}
?>