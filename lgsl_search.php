<?php

	require "lgsl_files/lgsl_class.php";
	lgsl_database();

	$udrzba_query = mysql_query("SELECT * FROM `".$lgsl_config['db']['settingstable']."` WHERE `settings_id`='1'");
	$data_udrzba = mysql_fetch_assoc( $udrzba_query );

	echo '
	<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="sk" lang="sk">
		<head>';

		require 'template/template_headtags.php';

		echo '
		</head>
		<body>';

			require 'template/template_head.php';

			echo '
            <div class="container">
                <div class="row">
                    <div class="col-md-4">';

					require 'template/panels/panel_left.php';

					echo '
                    </div>
                    <div class="col-md-8">';

						if ($data_udrzba['settings_active'] == 1) {
							echo '<div class="alert alert-warning" role="alert">Mód údržby je zapnuty.</div>';
						}

						require 'template/panels/panel_search';

						$query = "SELECT * FROM lgsl WHERE (UPPER(ip) LIKE '%".strtoupper($_POST['ip'])."%')AND(UPPER(c_port) LIKE '%".strtoupper($_POST['c_port'])."%')";
						$result = mysql_query($query);

						echo '
						<div class="display-4">Výsledky vyhľadávania</div>
                        <hr>
                        
						<div class="w-100" style="overflow-x:auto">
							<table class="table w-100">
								<thead class="thead-light">
									<tr>
										<th scope="col" class="text-center" width="5%">Status</th>
										<th scope="col" class="text-center" width="5%">Hra</th>
										<th scope="col" class="text-left" width="61%">Názov servera</th>
										<th scope="col" class="text-right" width="15%">IP adresa a port</th>
										<th scope="col" class="text-center" width="14%">Hráči</th>
									</tr>
								</thead>
								<tbody>';

								while ($line = mysql_fetch_array($result, MYSQL_NUM)) {

									$server = lgsl_query_cached($line[1], $line[2], $line[3], $line[4], $line[5], 'se');
									$misc   = lgsl_server_misc($server);
									$server = lgsl_server_html($server);

									$servernew = ( time() >= ( $server['o']['date'] + ( 7 * 24 * 60 * 60 ) ) ? "" : "<span class='badge badge-primary'>Nové</span>" );

									if ($misc['text_status'] == "Online") {
										$status = '<span class="badge badge-success">Online</span>';
									}
									if ($misc['text_status'] == "Offline") {
										$status = '<span class="badge badge-danger">Offline</span>';
									}

									echo "
									<tr>
										<td class='text-center'>{$status}</td>
										<td class='text-center'><img alt='{$misc['text_type_game']}' src='{$misc['icon_game']}' title='{$misc['text_type_game']}' /></td>
										<td class='text-left'>";

										if($server['o']['tip'] == 1) {
											echo "<span class='badge badge-warning'>TIP</span>";
										}
										if($server['o']['new'] == 1) {
											echo "<span class='badge badge-primary'>Nové</span>";
										}

										echo $servernew." <a href='".lgsl_link($server['o']['id'])."'>".((strlen($misc['name_filtered']) >= 32) ? substr($misc['name_filtered'], 0, 32)."..." : $misc['name_filtered'])."</a>
										
										</td>
										<td class='text-right'>{$server['b']['ip']}:{$server['b']['c_port']}</td>
										<td class='text-center'>{$server['s']['players']} / {$server['s']['playersmax']}</td>
									</tr>";

								}

								echo '
								</tbody>
							</table>
						</div>
                    </div>
                </div>
		    </div>';

			require 'template/template_footer.php';

			echo '
		</body>
	</html>';