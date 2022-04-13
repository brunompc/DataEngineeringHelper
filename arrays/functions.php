<?php

/**
	Merges two arrays, considering the respective values for specific keys.
	
	This function returns an array containing two sub-arrays. The first sub-array
	will contain the result of merging the two sources. The second sub-array will
	contain the unmatched sub-arrays from either source.
	
	* $source1 is an array of arrays;
	* $source2 is an array of arrays;
	* $s1_key is the key of $source1 that will be used to match against $source2
	* $s2_key is the key of $source2 that will be used to match against $source1
	* $ignore_unpaired_arrays is a boolean. If true, any sub-array of $source1/$source2 
	that is not matched with an element of $source2/$source1 will be ignored. Otherwise, 
	the sub-array will be added to the function's result. Defaults to false.
	* $return_unpaired_arrays is a boolean. If true, any sub-array of $source1/$source2
	that is not matched with an element of $source2/$source1 will be returned in the 
	second array that the function returns. Defaults to false.
*/
function merge_data_sources($source1, $source2, $s1_key, $s2_key, $ignore_unpaired_arrays = false, $return_unpaired_arrays = false) {

	$unpaired = array();
	$result = array();

	$linear_source1 = array();
	$linear_source2 = array();
	
	for($i=0; $i<count($source1); $i++) {
		$linear_source1[$source1[$i][$s1_key]] = $source1[$i];
	}

	for($j=0; $j<count($source2); $j++) {
		$linear_source2[$source2[$j][$s2_key]] = $source2[$j];
	}
	
	foreach($linear_source1 as $key => $value) {
		if(array_key_exists($key, $linear_source2)) {
			$result[] = array_merge($value, $linear_source2[$key]);
			$handled[$key] = true;
		}
		else {
			if(!$ignore_unpaired_arrays) {
				$result[] = $value;
			}
			if($return_unpaired_arrays) {
				$unpaired[] = $value;
			}
		}
	}

	// place in the array any element of the 2nd source that
	// was not paired with an element of the 1st source
	foreach($linear_source2 as $key => $value) {
		if(!array_key_exists($key, $handled)) {
			if(!$ignore_unpaired_arrays) {
				$result[] = $value;
			}
			if($return_unpaired_arrays) {
				$unpaired[] = $value;
			}
		}
	}

	return array($result, $unpaired);
}

?>