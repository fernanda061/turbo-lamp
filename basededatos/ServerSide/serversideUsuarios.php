<?php
require 'serverside.php';
$table_data->get('vista_usuarios','user_id',array('user_id', 'username','first_name','last_name','gender','password','status'));

?>