<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class User extends CI_Controller
{
    public function __construct()
    {
		parent::__construct();
		echo __METHOD__;
    }

}