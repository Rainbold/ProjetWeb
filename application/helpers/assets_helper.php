<?php  

if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

if ( ! function_exists('css_url'))
{
	// css_url is used to create the path of the given css file
	function css_url($nom)
	{
		return base_url() . 'assets/css/' . $nom . '.css';
	}
}

if ( ! function_exists('js_url'))
{
	// js_url is used to create the path of the given js file
	function js_url($nom)
	{
		return base_url() . 'assets/js/' . $nom . '.js';
	}
}

if ( ! function_exists('img_url'))
{
	// img_url is used to create the path of the given image
	function img_url($nom)
	{
		return base_url() . 'assets/img/' . $nom;
	}
}

if ( ! function_exists('img'))
{
	// img_url is used to display the given image
	function img($nom, $alt = '')
	{
		return '<img src="' . img_url($nom) . '" alt="' . $alt . '" />';
	}
}