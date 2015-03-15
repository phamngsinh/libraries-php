<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11/18/14
 * Time: 10:32 PM
 */

namespace libraries;


class ArrayAbstract
{

	function __construct()
	{

	}
	// array_shift — Shift an element off the beginning of array(remove first)
	function shift($array)
	{

	}


	// array_pop(array) Pop the element off the end of array (remove last)
	function pop($array)
	{

	}


	// array_push(array,val) — Push one or more elements onto the end of array(add)
	function push()
	{
	}

	// reset(array) — Set the internal pointer of an array to its first element
	function reset($array)
	{
		return reset($array);
	}

	// range(start,end,step) — Create an array containing a range of elements
	function range()
	{

	}

	// array_map(callback, array) — Applies the callback to the elements of the given arrays
	function map()
	{

	}

	// array_splice($array, $offset, $length,$array_)— Remove a portion of the array and replace it with something else
	function splice()
	{

	}

	// $result = array_pad(array,size, value) Pad array to the specified length with a value, -size to first
	function pad($array, $size, $value)
	{
		return array_pad($array, $size, $value);
	}

	// array_merge($array1, $array2);
	function merge($array1, $array2)
	{
		return array_merge($array1, $array2);
	}

	//join(',' , $array) : array to string
	function join($splash, $array)
	{
		return join($splash, $array);
	}

	// array_key_exists($key,array) — Checks if the given key or index exists in the array
	function key_exists($key, $array)
	{
		return array_key_exists($key, $array);
	}

	// array_flip (array) -  Exchanges all keys with their associated values in an array  (remove duplicate)
	function flip($array)
	{
		return array_flip($array);
	}
	//  array_search() : Use array_search(). It returns the key of the found value. If the value is not in the
	//array, it returns false

	function search($key,$array){
		return array_search($key,$array);
	}
	// in_array() to find if an array contains a value;
	function in_array($val,$array){
		return in_array($val,$array);
	}
	// array_filter(array, callback, ARRAY_FILTER_USE_KEY /ARRAY_FILTER_USE_BOTH ) — Filters elements of an array using a callback function
	function filter($array,$function,$type = 'ARRAY_FILTER_USE_KEY' ){



	}
	// max(), min(), arsort(), and asort()

	function min($array){
		return min($array);
	}
	function max($array){
		return max($array);
	}
	//  array_reverse() -  Reversing an Array
	function reverse($array){
		return array_reverse($array);
	}
	// sort($scores, SORT_NUMERIC);
	function sort($array,$type =  'SORT_NUMERIC'){
		return sort($array,$type);

	}
	// asort()
	function asort($array,$type = 'SORT_REGULAR'){
		return asort($array,$type);

	}
	// natsort()
	// usort(array, callback)
	// array_multisort($colors, $cities)- You want to sort multiple arrays or an array with multiple dimensions.
	// usort($access_times, array('dates' , 'compare' ));
	// shuffle($array) - Randomizing an Array
	//  array_unique($array) - Removing Duplicate Elements from an Array
	//  array_walk(array, callback)
	// To compute the union:
	//$union = array_unique(array_merge($a, $b));
	// To compute the intersection:
	//$intersection = array_intersect($a, $b);
	// To find the simple difference:
	//$difference = array_diff($a, $b);
	// And for the symmetric difference:
	//$difference = array_merge(array_diff($a, $b), array_diff($b, $a));
	//, unset,
} 