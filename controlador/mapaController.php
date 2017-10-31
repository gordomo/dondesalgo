<?php

require_once('../modelo/evento.php');
$action = (!empty($_GET['action'])) ? $_GET['action'] : '';

switch ($action) {
	case 'getEventos':

	$eventos_boliches = new evento();

	$resulEventos = $eventos_boliches->getEventos(true); 
	$respuesta = [];
	if(!is_numeric($resulEventos)){
		while($evento = $resulEventos->fetch_assoc())
		{
			$id = $evento['ideventos'];
			$geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.urlencode($evento['direccion']).',Rosario,Santa+Fe&sensor=false');

			$output= json_decode($geocode);
			// $evento['lat'] = '';
			// die(var_dump($evento));
			$evento['lat'] = (!empty($output->results[0]->geometry->location->lat)) ? $output->results[0]->geometry->location->lat : '';
			$evento['lng'] = (!empty($output->results[0]->geometry->location->lng)) ? $output->results[0]->geometry->location->lng : '';
			$respuesta[$id] = $evento;
		}
		$resulEventos->free();
	}
	
	echo json_encode($respuesta);
	break;
	
	default:
		# code...
	break;
}

exit();