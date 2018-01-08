<?php 

function logwrite($message)
{
$LogFile='log/log_'.date('d-M-Y').'.log';
$message = date('d-M-Y h:i:sa').' : '.$message.PHP_EOL.
"================================================".PHP_EOL;
file_put_contents($LogFile,$message."\n", FILE_APPEND);
}



?>