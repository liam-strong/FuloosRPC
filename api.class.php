<?php

  /*

    Fuloos Daemon RPC API

    require_once 'api.class.php';
    $Fuloos = new \API\Fuloos("ipaddress", "rpcport", "rpcuser", "rpcpassword");

  */

  namespace API;

  class Fuloos {

    public $rpc_host;
    public $rpc_port;
    public $rpc_username;
    public $rpc_password;

    public function __construct($rpchost, $rpcport, $rpcuser, $rpcpass)
    {
      if(!isset($rpchost) || !isset($rpcport) || !isset($rpcuser) || !isset($rpcpass))
      {
        // If missing parameters, return this error.
        die("Please check your RPC Information, missing information...");
      } else {
        // Set the parameters.
        $this->rpc_host = $rpchost;
        $this->rpc_port = $rpcport;
        $this->rpc_username = $rpcuser;
        $this->rpc_password = $rpcpass;
      }
    }


    /*
      @function - Get Account balance
      @parameters - FLS Address or FLS accountname
    */
    public function _get_daemon_info()
    {
      $response = $this->_call("getinfo", array());
      print_r($response);
    }


    /*
      @function - Get Account balance
      @parameters - FLS Address or FLS accountname
    */
    public function _get_account_balance($input)
    {
      $response = $this->_call("getbalance", array($input));
      return $response['result'];
    }

    /*
      @function - Get Account Address
      @parameters - accountname
    */
    public function _get_account_address($input)
    {
      $response = $this->_call("getaccountaddress", array($input));
      return $response['result'];
    }

    /*
      @function - Create a new account or address for wallet.
      You can either request a new address for existing account or you can create a new account and new address wil return.
    */
    public function _create_account_address($input)
    {
      $response = $this->_call("getnewaddress", array($input));
      return $response['result'];
    }

    /*
      @function - List Transactions of account requested.
      @parameter- accountname
    */
    public function _list_transactions($input)
    {
      $response = $this->_call("listtransactions", array($input));
      print_r($response);
    }


    /*
      @function - Send transaction to another FLS Address
      @parameter -
                  flsaccount - can be left "" or a specific account name
                  flsaddress - recieve address
                  flsamount - the amount of fls being transacted

    */
    public function _send_transaction($flsaccount, $flsaddress, $flsamount)
    {
      $response = $this->_call("sendfrom", array($flsaccount, $flsaddress, (int)$flsamount));
      return $response['result'];
    }


    /*
      Please do not edit the _call method, this is used to send request to the daemon RPC.
      If this is changed, please make sure you know what you are doing..
    */

    public function _call($method, $paramas)
    {
      // If no parameters are passed, this will be an empty array
      $params = array_values($paramas);
      $request = json_encode(array(
          'method' => $method,
          'params' => $paramas,
          'id'     => $this->id
      ));

      // Start Curl Request
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "$this->rpc_host:$this->rpc_port");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_USERPWD, "$this->rpc_username:$this->rpc_password");
      curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
      $output = curl_exec($ch);
      $info = curl_getinfo($ch);
      curl_close($ch);

      // Return as decoded json response
      return json_decode($output, true);
    }

  }

?>
