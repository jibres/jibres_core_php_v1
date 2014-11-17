<?php
/**
***********************************************************************************
CAUTIONS : IF YOU DON'T KNOW WHAT'S THIS, PLEASE DON'T RUN IT!
* 
*THIS FILE READ DATABASE AND CREATE A PHP FILE FOR CREATING FORM
***********************************************************************************
**/
$connect = mysqli_connect("localhost", "jibres", "Jibres@#$567", "jibres");
$qTables = $connect->query("SHOW TABLES FROM jibres");
function _type($type, $def)
{
	$def = $def ? "!$def" : null;
	preg_match("/^([^(]*)(\((.*)\))?/", $type, $tp);
	$_type		= $tp[1];
	$_length	= isset($tp[3]) ? $tp[3] : null;
	switch ($_type) 
	{
		case 'enum':
			$_length = preg_replace("[']", "", $_length);
			return ("'type' => '$_type@$_length{$def}'");
			break;

		default:
			return ("'type' => '$_type@$_length{$def}'");
			break;
	}
}

function setproperty($myparam)
{
	$type = $myparam->Type;
	// var_dump($type);
	// for add new HTML5 feature to forms
	preg_match("/^([^(]*)(\((.*)\))?/", $type, $tp);
	$_type		= $tp[1];
	$_length	= isset($tp[3]) ? $tp[3] : null;
	$mydotpos	= strpos($_length,',');
	$mydotpos	= $mydotpos?$mydotpos:strlen($_length);
	$mylen 		= substr($_length, 0, $mydotpos);

	$mylength	= $_length;
	$mymax		= "->maxlength('".$_length."')";
	$tmp		= array();
	// tmp[0]	type
	// tmp[1]	min
	// tmp[2]	max

	// '->type("select")'
	switch ($_type) 
	{
		case 'enum':
			$tmp[0] 	= "->type('select')";
			return $tmp;
			break;

		case 'timestamp':
		case 'text':
			
			return $tmp;
			break;


		case 'smallint':
		case 'int':
		case 'bigint':
		case 'decimal':
		case 'float':
			$tmp[0] 	= "->type('number')";
			if( substr($type, strlen($type)-8) == "unsigned" )
				array_push($tmp, "->min(0)");
				
			// check for max input
			// $tmp 	.= "->onKeyDown('if(this.value.length==".$mylen.") return false;')";
			// $tmp 	.= "->max(".str_repeat("9",$mylen-1).")";
			array_push($tmp, "->max(".str_repeat("9",$mylen-1).")");


			return $tmp;
			break;


		case 'varchar':
		case 'char':
			if($mylen>100)
				$tmp[0] 	= "->type('textarea')";
			else
				$tmp[0] 	= "->type('text')";
			array_push($tmp, "->maxlength(".$mylen.")");

			return $tmp;
			break;


		case 'datetime':
			return $tmp;
			break;


		default:
			return ("N-A: Create Error");
			break;
	}
}
	while ($row = $qTables->fetch_object()) 
	{
		$content	= "<?php\n";
		$content	.= "namespace sql;\n";
		$TABLENAME	= $row->Tables_in_jibres;
		$content	.= "class $TABLENAME \n{\n";
		$qCOL		= $connect->query("DESCRIBE $TABLENAME");
		$fn			="\n";

		while ($crow = $qCOL->fetch_object()) 
		{
			// var_dump($crow);

			// ========================================================================================== Edit by Javad
			// for fields from currect table except foreign key
			// we remove the table prefix, then show ramained text for name and for label we replace _ with space
			// for foreign key we remove second part of text after _ and show only the name of table without last char
			
			$myfield		= $crow->Field;
			$mynull			= $crow->Null;
			// $property		= setproperty($crow);
			$property		= "";
			$property_type	= "";
			foreach (setproperty($crow) as $key => $value) 
			{
				if( substr($value, 0, 6)=='->type' )
				{
					$property_type = $value;
				}
				else
				{
					$property .= $value;
				}
			}
			$required		= $mynull=='NO'?'->required()':null;
			$property		.= $required;
			// var_dump($myfield."::".$property);
			// var_dump( $property );
			// exit();
			$tmp_pos 		= strpos($myfield, '_');
			$prefix			= substr($myfield, 0, $tmp_pos );
			$isforeign		= false;
			$myname			= substr($myfield, ($tmp_pos ? $tmp_pos+1 : 0) );

			$myname 		= strtolower($myname);
			$mylabel 		= str_replace("_", " ", $myname);
			$mylabel		= ucwords($mylabel);

			$txtcomment		= "\n\t//------------------------------------------------------------------ ";
			$txtstart		= "\tpublic function $myfield() \n\t{\n\t\t";
			$txtend			="\n\t}\n";
			// $content		.= "\tpublic \$$crow->Field = array(". _type($crow->Type, $crow->Default).", 'label' => '$myname');\n";

			// --------------------------------------------------------------------------------- ID
			if($myfield=="id")
			{

				$fn .= $txtcomment. "id - primary key\n";
				$fn .= "\tpublic function $myfield() {" . '$this->validate("id");' ."}\n";
				$mylabel = "ID";

			}
			// --------------------------------------------------------------------------------- Foreign Key
			elseif ($myname=="id" || $myfield=="user_id_customer")
			{
				// for foreign key we use prefix that means we use (table name-last char)
				$fn .= $txtcomment. "id - foreign key\n";
				// $fn .= $txtstart. '$this->form("#foreignkey")->name("'. $prefix.'")->validate("id");' .$txtend;
				$fn .= $txtstart. '$this->form("select")->name("'. $prefix.'")'.$property.'->type("select")->validate("id");';
				$fn .= "\n\t\t".'$this->setChild($this->form);'.$txtend;

				// $mylabel = str_replace("_", " ", $myfield);
				$isforeign	= true;
				$mylabel	= ucwords(strtolower($prefix));
				$mylabel	= $mylabel;
				
			}

			// --------------------------------------------------------------------------------- General
			elseif ($myname=='title')
			{
				$property = $property.$property_type;
				$fn .= $txtcomment. 'title'."\n";
				$fn .= $txtstart. '$this->form("text")->name("title")'.$property.';'.$txtend;
			}
			elseif ($myname=="slug")
			{
				$property = $property.$property_type;
				$fn .= $txtcomment. "slug\n";
				// $fn .= $txtstart. '$this->form("#slug");';
				$fn .= $txtstart. '$this->form("text")->name("'. $myname.'")'.$property.'->validate()->slugify("'.$prefix.'_title");';
				
				// $fn .= $txtstart. '$this->form("text")->name("'. $myname.'")->validate()';
				// $fn .= "\n\t\t->createslug(function()\t{" .'$this->value =\validator_lib::$save'."['form']['".$prefix."_title']->value;});";
				$fn .= $txtend;

				// $this->validate()->xsslug(function()
				// {
				// 	$this->value = \validator_lib::$save['form']['user_email']->value;
				// });
			}
			elseif ($myname=="desc")
			{
				$property = $property.$property_type;
				$fn .= $txtcomment. "description\n";
				$fn .= $txtstart. '$this->form("#desc")'.$property.';'.$txtend;

				$mylabel = "Description";
			}

			// --------------------------------------------------------------------------------- Email
			elseif ($myname=="email")
			{
				$fn .= $txtcomment. "email\n";
				$fn .= $txtstart. '$this->form("#email")->type("email")->required()'.$property.';'.$txtend;
			}

			// --------------------------------------------------------------------------------- Website
			elseif ($myname=="website")
			{
				$fn .= $txtcomment. "website\n";
				$fn .= $txtstart. '$this->form("#website")->type("url")'.$property.';'.$txtend;

				// $mylabel = "Description";
			}

			// --------------------------------------------------------------------------------- Website
			elseif ($myname=="mobile")
			{
				$fn .= $txtcomment. "website\n";
				$fn .= $txtstart. '$this->form()->type("tel")->name("mobile")->maxlength(17)->required();'.$txtend;
			}
			elseif ( $myname=="tel")
			{
				$fn .= $txtcomment. "website\n";
				$fn .= $txtstart. '$this->form()->type("tel")->name("tel")->maxlength(17);'.$txtend;
			}
			// --------------------------------------------------------------------------------- Password
			elseif ($myname=="pass")
			{
				$fn .= $txtcomment. "password\n";
				$fn .= $txtstart. '$this->form("#password")->type("password")->required()'.$property.';'.$txtend;
				$mylabel = "Password";
			}

			// --------------------------------------------------------------------------------- unuse
			elseif($myfield=="date_modified")
			{
				$fn .= "\tpublic function $myfield() {}\n";
				$mylabel = str_replace("_", " ", $myfield);
				$mylabel = ucwords(strtolower($mylabel));
				$mylabel = $mylabel;
			}
			elseif($myfield=="attachment_type")
			{
				$fn .= $txtstart. '$this->form("text")->name("'. $myname.'")'.$property.';'.$txtend;
			}

			// --------------------------------------------------------------------------------- radio
			elseif ($myname=="active" 		|| $myname=="view"		|| $myname=="verified"
				|| $myname=="add" 			|| $myname=="edit" 		|| $myname=="delete"
				|| $myname=="service"		|| $myname=="gender"	|| $myname=="married"
				|| $myname=="newsletter"	|| $myname=="credit"	|| $myfield=="permission_status"
				
				
				)	
			{
				$fn .= $txtcomment. "radio button\n";
				$fn .= $txtstart. '$this->form("radio")->name("'. $myname.'")->type("radio")'.$property.';';
				$fn .= "\n\t\t".'$this->setChild($this->form);'.$txtend;
			}

			// --------------------------------------------------------------------------------- select
			elseif ($myname=="status" 	|| $myname=="model" || $myname=="priority"
				|| $myname=="sellin"	|| $myname=="priority"
				|| $myname=="type"		|| $myname=="paperstatus"

				)
			{
				$fn .= $txtcomment. "select button\n";
				$fn .= $txtstart. '$this->form("select")->name("'. $myname.'")->type("select")'.$property.'->validate();';
				$fn .= "\n\t\t".'$this->setChild($this->form);'.$txtend;
			}

			// --------------------------------------------------------------------------------- Other
			elseif ($myfield=="user_extra")
			{
				$fn .= $txtcomment. "Extra\n";
				$fn .= $txtstart. '$this->form()->type("text")->label("Store name")->pl("your store name")->name("store")->required()';
				$fn .= "\n\t\t\t".'->maxlength(20)->pattern("/^[a-z0-9-].{3,15}$/")->title("3 to 15 characters or number");'.$txtend;
			}
			else
			{
				$property = $property.$property_type;
				// $fn .= $txtcomment. "email\n";
				// $fn .= $txtstart. '$this->form()->name("'. $myname.'")'."\n\t\t".'->validate();'.$txtend;
				$fn .= $txtstart. '$this->form("text")->name("'. $myname.'")'.$property.';'.$txtend;
				// $fn .= $txtstart. $txtend;
			}
			

			// ========================================================================================== Edit by Javad

			// $content .= "\tpublic \$$crow->Field = array(". _type($crow->Type, $crow->Default).", 'label' => '$mylabel');\n";
			// 'foreign' => 'table@id!value'
			$fields	= "\tpublic \$$crow->Field = array(". _type($crow->Type, $crow->Default).", 'null' =>'$mynull' ,'label' => '$mylabel');\n";
			if($isforeign)
			{
				$table				= $prefix.'s';
				$tmp_fields_start	= "\tpublic \$$crow->Field = array(". _type($crow->Type, $crow->Default).", 'null' =>'$mynull' ,'label' => '$mylabel', 'foreign' => '$table@id!";
				$tmp_fields_end		= "');\n";
				$tmp_fields_name	= $prefix . "_title";
				// $fields				= "\tpublic \$$crow->Field = array(". _type($crow->Type, $crow->Default).", 'null' =>'$mynull' ,'label' => '$mylabel', 'foreign' => '$table@id!".$prefix."_title');\n";
				// if table has a especial record
				if($table=="users")
					$tmp_fields_name = $prefix."_nickname";
				if($table=="receipts" || $table=="transactions" || $table=="papers")
					$tmp_fields_name = "id";
				$fields				= $tmp_fields_start. $tmp_fields_name. $tmp_fields_end;
			}

			$content .= $fields;
		}

		$content	.= $fn;
		$content	.= "}\n";
		$content	.= "?>";
		// file_put_contents("./created/$TABLENAME.sql.php", $content);
		file_put_contents("../$TABLENAME.sql.php", $content);
	}
	$connect->close();

	echo "Finish..!";
	?>