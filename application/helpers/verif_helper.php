<?php  

if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

if ( ! function_exists('exists'))
{
	// exists tests if the variable is not empty
	function exists($var)
	{
		return isset($var) && !empty($var);
	}
}

if ( ! function_exists('echo_var'))
{
	// echo_var displays a variable only if it is not empty
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