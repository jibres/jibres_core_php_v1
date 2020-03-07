<?php
namespace content_management\renamefile;


class controller
{
	public static function routing()
	{
		$store_data = \dash\db::get("SELECT * FROM store_data");

		foreach ($store_data as $key => $value)
		{
			$old_code = \dash\coding::encode($value['id']);
			$new_code = \lib\store::code($value['id']);

			$query = "UPDATE store_data SET store_data.logo = REPLACE(store_data.logo, '$old_code', '$new_code') WHERE store_data.id = $value[id] LIMIT 1 ";
			\dash\db::query($query);
		}

		$all_store = \lib\db\store\get::all_store_fuel_detail();
		foreach ($all_store as $key => $my_store)
		{
			$old_code = \dash\coding::encode($my_store['id']);
			$new_code = \lib\store::code($my_store['id']);

			\dash\db::query("UPDATE `tickets` SET `tickets`.`file`                 = REPLACE(`tickets`.`file`, '$old_code', '$new_code')", $my_store['fuel'], ['database' => 'jibres_'. $my_store['id']]);
			\dash\db::query("UPDATE `setting` SET `setting`.`value`                = REPLACE(`setting`.`value`, '$old_code', '$new_code')", $my_store['fuel'], ['database' => 'jibres_'. $my_store['id']]);
			\dash\db::query("UPDATE `files` SET `files`.`folder`                   = REPLACE(`files`.`folder`, '$old_code', '$new_code')", $my_store['fuel'], ['database' => 'jibres_'. $my_store['id']]);
			\dash\db::query("UPDATE `files` SET `files`.`path`                     = REPLACE(`files`.`path`, '$old_code', '$new_code')", $my_store['fuel'], ['database' => 'jibres_'. $my_store['id']]);
			\dash\db::query("UPDATE `products` SET `products`.`gallery`            = REPLACE(`products`.`gallery`, '$old_code', '$new_code')", $my_store['fuel'], ['database' => 'jibres_'. $my_store['id']]);
			\dash\db::query("UPDATE `products` SET `products`.`thumb`              = REPLACE(`products`.`thumb`, '$old_code', '$new_code')", $my_store['fuel'], ['database' => 'jibres_'. $my_store['id']]);
			\dash\db::query("UPDATE `productcategory` SET `productcategory`.`file` = REPLACE(`productcategory`.`file`, '$old_code', '$new_code')", $my_store['fuel'], ['database' => 'jibres_'. $my_store['id']]);
			\dash\db::query("UPDATE `users` SET `users`.`avatar`                   = REPLACE(`users`.`avatar`, '$old_code', '$new_code')", $my_store['fuel'], ['database' => 'jibres_'. $my_store['id']]);

		}


		$file = glob(YARD. 'talambar_cloud/*');
		foreach ($file as $key => $value)
		{
			$old        = basename($value);
			$decode_old = \dash\coding::decode($old);
			$new_code   = \lib\store::code($decode_old);
			$exec       = "mv ". YARD. 'talambar_cloud/'. $old. ' '. YARD. 'talambar_cloud/'. $new_code;
			exec($exec);



		}
		echo 'done';
		exit();

	}
}
?>
