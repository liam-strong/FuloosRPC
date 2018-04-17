<?php
  
  // Include the class file
  require_once 'api.class.php';
  
  // Start the fuloos class with the RPC Information
  $Fuloos = new \API\Fuloos("IP-ADDRESS", "RPC-PORT", "RPC-USERNAME", "RPC-PASSWORD");
  
  // Send request to the API
  $Fuloos->_get_daemon_info();
  
  This will return an array of the latest information from the daemon.


?>
