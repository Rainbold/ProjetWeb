<?php  

if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

if ( ! function_exists('exists'))
{
	function exists($var)
	{
		return isset($var) && !empty($var);
	}
}

if ( ! function_exists('echo_var'))
{
	function echo_var($var, $type='str')
	{
		if(exists($var))
			echo $var;
		else
			switch($type)
			{
				case 'str':
					echo '';
					break;
				case 'num':
					echo 0; 
					break;
			}	
	}
}