<!DOCTYPE html>
<html>
<head>
	<title>Smart home</title>
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="page-header">
			<h1> Sistem Kontrol Rumah </h1>
		</div>
		<p> Pilih Saklar </p>
	</div>
	<br>
	<div class="container">
		<div class="checkbox">
			<?php	
				$data_condition = file_get_contents('data.json');
				$data_condition = json_decode($data_condition, true);
				for ($i=0; $i < count($data_condition); $i++)
				{
					
						$ruang = $data_condition[$i]['ruang'];
						$status = (int)$data_condition[$i]['status'];
						
						if ($status == 1) { $on = 'checked';} else {$on = '';
						}
						echo '<div class="checkbox"><label><input '.$on.' data-toggle="toggle" type="checkbox" id="'.$ruang.'">Saklar Lampu '.$ruang.'</label></div><br>';
				}
				
			?>
		</div>
	</div>
</body>
</html>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>

	<?php
		$data_condition = file_get_contents('data.json');
		$data_condition = json_decode($data_condition, true);
		for ($i=0; $i < count($data_condition); $i++)
		{
				$ruang = $data_condition[$i]['ruang'];
				///$status = (int)$data_condition[$i]['status'];
				echo '$(function() {
						$("#'.$ruang.'").change(function() {
							d_post = $(this).prop("checked");
							if (d_post == true) { post = 1; } else{ post = 0; }
							saklar = "'.$ruang.'";
							$.ajax
							({
									url:"saklar_'.$ruang.'.php",
									method:"GET",
									data:{status:post,ruang:saklar},
									success:function(data)
									{
											alert(data);
									}
							})
						})
				})
				';
			}
		?>
</script>