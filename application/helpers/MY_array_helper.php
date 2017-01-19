<?php
function only_elements($items, $array, $default = NULL)
{
    $return = array();

    is_array($items) OR $items = array($items);

    foreach ($items as $item)
    {
        if(array_key_exists($item, $array)){
            $return[$item] = $array[$item];
        }
    }

    return $return;
}

function array_to_obj($array)
{
	$obj = new stdClass();

	foreach($array as $key=>$value){
		$obj->$key = $value;
	}

	return $obj;
}