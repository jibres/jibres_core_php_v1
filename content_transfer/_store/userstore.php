<?php
namespace content_transfer\_store;

class userstore
{
	public static function run()
	{
		\content_transfer\say::info('Transfer userstore ...');
		self::transfer_user_store();


	}


	private static function transfer_user_store()
	{
		$query =
		"
			SELECT
			userstores.*,
			stores.new_id AS `new_store_id`
			FROM userstores
			INNER JOIN stores ON stores.id = userstores.store_id
			WHERE userstores.user_id NOT IN (SELECT stores.creator FROM stores)
		";

		$result = \dash\db::get($query, null, false, 'local', ['database' => 'jibres_transfer']);

		foreach ($result as $key => $value)
		{
			$user_store =
			[
				"jibres_user_id"        => $value['user_id'],
				"permission"            => $value['permission'],
				"avatar"                => $value['avatar'],
				// "postion"               => $value['postion'],
				"displayname"           => $value['displayname'],
				"firstname"             => $value['firstname'],
				"lastname"              => $value['lastname'],
				// "code"                  => $value['code'],
				"father"                => $value['father'],
				"mobile"                => $value['mobile'],
				"birthday"              => $value['birthday'],
				"nationalcode"          => $value['nationalcode'],
				"status"                => $value['status'] === 'delete' ? 'removed' : $value['status'],
				// "desc"                  => $value['desc'],
				"datecreated"           => $value['datecreated'],
				"datemodified"          => $value['datemodified'],
				"email"                 => $value['email'],
				// "shfrom"                => $value['shfrom'],
				"pasportcode"           => $value['pasportcode'],
				"gender"                => $value['gender'],
				"marital"               => $value['marital'],
				// "shcode"                => $value['shcode'],
				// "birthcity"             => $value['birthcity'],
				"phone"                 => $value['phone'],
				// "customer"              => $value['customer'],
				// "staff"                 => $value['staff'],
				// "supplier"              => $value['supplier'],
				// "address_id"            => $value['address_id'],
				// "visitor"               => $value['visitor'],
				// "visitor2"              => $value['visitor2'],
				// "totalorder"            => $value['totalorder'],
				// "totalspent"            => $value['totalspent'],
				// "taxexempt"             => $value['taxexempt'],
				// "marketing"             => $value['marketing'],
				// "companyname"           => $value['companyname'],
				// "companyeconomiccode"   => $value['companyeconomiccode'],
				// "companynationalid"     => $value['companynationalid'],
				// "companyregisternumber" => $value['companyregisternumber'],
				// "companyaddress_id"     => $value['companyaddress_id'],
				// "fax"                   => $value['fax'],
				"nationality"           => $value['nationality'],
				// "file"                  => $value['file'],
				// "credit"                => $value['credit'],
				// "companytel"            => $value['companytel'],
				// "sumpaysupplier"        => $value['sumpaysupplier'],
				// "sumpaycustomer"        => $value['sumpaycustomer'],
				// "sumsalestaff"          => $value['sumsalestaff'],
				// "countordercustomer"    => $value['countordercustomer'],
				// "countordersupplier"    => $value['countordersupplier'],
				// "countorderstaff"       => $value['countorderstaff'],
				// "lastpaycustomer"       => $value['lastpaycustomer'],
				// "lastactivity"          => $value['lastactivity'],
				// "customercredit"        => $value['customercredit'],
				// "balance"               => $value['balance'],
				// "sumbuystaff"           => $value['sumbuystaff'],
				// "countorderbuystaff"    => $value['countorderbuystaff'],
				// "new_store_id"          => $value['new_store_id'],

			];


			$user_store_id = null;

			$check_query = "SELECT * FROM users WHERE users.mobile = '$value[mobile]' LIMIT 1";
			$check       = \dash\db::get($check_query, null, true, 'local', ['database' => 'jibres_'. $value['new_store_id']]);

			if(isset($check['id']))
			{
				$user_store_id = $check['id'];
			}
			else
			{
				$set = \dash\db\config::make_set($user_store, ['type' => 'insert']);

				$query = " INSERT INTO users SET $set ";

				$inserr_new_store = \dash\db::query($query, 'local', ['database' => 'jibres_'. $value['new_store_id']]);

				if($inserr_new_store)
				{
					$user_store_id = \dash\db::insert_id();
				}
			}

			if(!$user_store_id)
			{
				\content_transfer\say::end('Can not add store! '.  json_encode($new_store, JSON_UNESCAPED_UNICODE));
			}

			$query = "UPDATE userstores SET userstores.new_id = $user_store_id WHERE userstores.id = $value[id] LIMIT 1";
			\dash\db::query($query, 'local', ['database' => 'jibres_transfer']);
		}
	}




}
?>