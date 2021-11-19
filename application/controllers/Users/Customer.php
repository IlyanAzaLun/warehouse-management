<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'controllers/User.php';
class Customer extends User
{
     public function index()
     {
          echo "ok";
     }

     public function FunctionName($value='')
     {
          // code...
     }
}