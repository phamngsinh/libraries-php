<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11/18/14
 * Time: 10:33 PM
 */
namespace libraries;
class StringsAbstract
{

	//You want to know if a string contains a particular substring. For example, you want to
	//find out if an email address contains a @.
	function strpos($str, $val)
	{
		return strpos($str, $val);

	}

	//You want to extract part of a string, starting at a particular place in the string
	function substr($string, $start, $length)
	{
		return substr($string, $start, $length);
	}
	//Replacing Substrings
	/**
	 * @param $old_string
	 * @param $new_substring
	 * @param $start
	 * @return string
	 * You want to replace a substring with a different string. For example, you want to obscure
	 * all but the last four digits of a credit card number before printing it.
	 */
	function substr_replace($old_string, $new_substring, $start, $length = 0)
	{
		return substr_replace($old_string, $new_substring, $start, $length);
	}
	//Reversing a String by Word or Byte
	//You want to reverse the words or the bytes in a string
	//array_reverse
	function strrev($string)
	{
		return strrev($string);
	}

	//Replace all occurrences of the search string with the replacement string
	function   str_replace($search, $replace, $subject)
	{
		str_replace($search, $replace, $subject);

	}

	//Use ucfirst() or ucwords() to capitalize the first letter of one or more words, as shown
	function ucfirst($string)
	{
		return ucfirst($string);
	}

	function ucwords($string)
	{
		return ucwords($string);
	}

	function strtolower($string)
	{
		return strtolower($string);
	}

	function strtoupper($string)
	{
		return strtoupper($string);

	}

	/*Use ltrim(), rtrim(), or trim(). The ltrim() function removes whitespace from the
beginning of a string, rtrim() from the end of a string, and trim() from both the
beginning and end of a string:*/
	function ltrim($string, $charlist)
	{
		return ltrim($string, $charlist);
	}

	function rtrim($string, $charlist)
	{
		return rtrim($string, $charlist);
	}

	function trim($string)
	{

		return trim($string);

	}


}