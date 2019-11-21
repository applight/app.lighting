<?php

// cd to the fully qualified path (htdocs is a symlink,
// just in case we change the server later)
// then do a git pull
$result = exec( "cd /home/bitnami/htdocs ; git pull" );

echo "Pulled repo with shell result:" .  $result ;
?>