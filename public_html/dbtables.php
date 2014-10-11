<?php
$connect = mysqli_connect("localhost", "root", "root", "store");
$qTables = $connect->query("SHOW TABLES FROM store");
function _type($type, $def){
	$def = $def ? "!$def" : null;
	preg_match("/^([^(]*)(\((.*)\))?/", $type, $tp);
		$_type = $tp[1];
		$_length = isset($tp[3]) ? $tp[3] : null;
		switch ($_type) {
			case 'enum':
			$_length = preg_replace("[']", "", $_length);
			return ("'type' => '$_type@$_length{$def}'");
			break;
			default:

			return ("'type' => '$_type@$_length{$def}'");
			break;
		}
	}
	while ($row = $qTables->fetch_object()) {
		$content = "<?php\n";
		$content .= "namespace sql;\n";
		$TABLENAME = $row->Tables_in_store;
		$content .= "class $TABLENAME {\n";
		$qCOL = $connect->query("DESCRIBE $TABLENAME");
		$fn ="\n";
		while ($crow = $qCOL->fetch_object()) {
			$LABEL = $TABLENAME.'_'.$crow->Field;
			$content .= "\tpublic \$$crow->Field = array(". _type($crow->Type, $crow->Default).", 'label' => '$LABEL');\n";
			$fn .="\tpublic function $crow->Field(){}\n";
		}
		$content .= $fn;
		$content .= "}\n";
		$content .= "?>";
		file_put_contents("./sql/$TABLENAME.sql.php", $content);
	}
	$connect->close();
	?>