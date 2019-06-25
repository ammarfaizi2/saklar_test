<?php

$fullJson = json_decode(file_get_contents("data.json"), true);
foreach ($fullJson as $k => &$v) {
	if ($v["ruang"] === $_GET["ruang"]) {
		$v["status"] = (int)$_GET["status"];
		echo ($v["status"] ? "menyalakan" : "mematikan")." lampu {$_GET["ruang"]}";
		break;
	}
}
file_put_contents("data.json", json_encode($fullJson, 128));
