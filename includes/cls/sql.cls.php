<?php 
/**
* 
*/
class sql_cls {
	// public function __construct($sql = false, $string = false) {
	// 	// var_dump(func_get_args());
	// 	// var_dump($sql);
	// 	// var_dump($string);
	// 	if(!$string){
	// 		// where not found 
	// 		 $sql->whereId("10");
	// 		 var_dump($sql);
	// 	}else{
	// 		 	$sql->andId("20");
	// 	}


		// if(empty($sql->conditions[0])){
		// 	var_dump("where not found");
		// }else{
		// 	var_dump($sql->conditions[0]);
		// 	var_dump("where found :)");
		// }
	// }

	public static function config($sql  = false , $string = false){
		if(!$string){
			// where not found 
			 $sql->whereId("10");
			 var_dump($sql);
		}else{
			 	$sql->andId("20");
		}
	}
}
 
 ?>
