<?php

	function google_key() {

		// $api_key = 'key=AIzaSyDyp6_Qi1EUHaOCpJ2cd7IOND2iefiBeeI'; // url -> ?key=$api_key
		$api_key = 'key=AIzaSyDMRQ5iYbTt2q5c6E8pSF3HR6MTBb1l3Nc';

		return $api_key;

	}

	function google_api_nearbysearch() {

		$key = google_key();
    	
    	$api = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?'.$key;

	    return $api;

    }
	
    function google_places($location, $keyword) {

		$radius = 'radius=10000';

		$rankby = 'rankby=distance';

		$type = 'type=locksmith';

		$api_url = google_api_nearbysearch();

		$params = $location.'&'.$radius.'&'.$type.'&'.$keyword;

		$g_api = $api_url.'&'.$params;

		$ch = curl_init($g_api);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$result = curl_exec($ch);
		curl_close($ch);

		// $result = file_get_contents($g_api, true);

		if($result !== false) {
			$json = json_decode($result);
			$response = array('result' => 'success', 'data' => $json);
		} else {
			$response = array('result' => 'error', 'message' => 'Google Request Error');
		}

		return $response;

	}

	// function google_place_image($width, $photo_reference) {

	// 	$photo_request_url = 'https://maps.googleapis.com/maps/api/place/photo?';

	// 	$key = google_key();

	// 	$maxwidth = 'maxwidth='.$width;

	// 	$photoreference = 'photoreference='.$photo_reference;

	// 	$photo = $photo_request_url.$key.'&'.$maxwidth.'&'.$photoreference;

	// 	return $photo;

	// }

	function google_place_phone($place_id) {

		$api_url = 'https://maps.googleapis.com/maps/api/place/details/json?';

		$key = google_key();

		$placeid = 'placeid='.$place_id;

		$g_api = $api_url.$key.'&'.$placeid;

		// $result = file_get_contents($g_api, true);
		$ch = curl_init($g_api);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$result = curl_exec($ch);
		curl_close($ch);

		if($result !== false) {
			$json = json_decode($result);
			$response = array('result' => 'success', 'data' => $json);
		} else {
			$response = array('result' => 'error', 'message' => 'Google Request Error');
		}

		return $response;

	}


?>