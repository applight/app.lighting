<?php
echo "{\n";
foreach( $_POST as $key => $value ) {
	 echo "$key : $value,\n";
}
echo "\n};"
?>