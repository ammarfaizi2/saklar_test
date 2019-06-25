<?php 
	
	
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	$update_ruang = $_GET['ruang'];
	$update_status = $_GET['status'];
	$from_wemos = $_GET['wemos'];
    $from_android = $_GET['android'];

	if ($from_android != null) {
		$data = file_get_contents('data.json');
		// $data = str_replace('"', '\"', $data);
		// $data = json_decode($data, true);
		echo $data;
	}
	
	if ($update_ruang == null && $update_status == null && $from_wemos != null) 
	{
		$data = file_get_contents('data.json');
		// $data = str_replace('"', '\"', $data);
		$data = json_decode($data, true);
		
		for ($i=0; $i < count($data) ; $i++) 
		{ 
			$ruang = $data[$i]['ruang'];
			$status = $data[$i]['status'];
			$for_get_arduino[] = [$ruang => $status];
		}

		$for_get_arduino = json_encode($for_get_arduino);
		$for_get_arduino = str_replace('},{', ',', $for_get_arduino);
		$for_get_arduino = str_replace(['[',']'], '', $for_get_arduino);

		echo $for_get_arduino;
		die();
	}

	$data = file_get_contents('data.json');
	$data_array = json_decode($data, true);

	for ($i=0; $i < count($data_array) ; $i++) 
	{ 
		$ruang = $data_array[$i]['ruang'];
		$status = (int)$data_array[$i]['status'];

		if ($update_ruang == $ruang) {
			$to_save[] =  ['ruang' => $ruang, 'status' => (int)$update_status];	
			
			if ((int)$update_status == 1) {
				echo "menyalakan lampu ".$ruang;
			} else {
				echo "mematikan lampu ".$ruang;
			}

		}else{
			$to_save[] =  ['ruang' => $ruang, 'status' => $status];	
		}
	}

	$end_update = json_encode($to_save, JSON_PRETTY_PRINT);

	file_put_contents('data.json', $end_update);

 ?>