<?php
	
	require "lgsl_files/lgsl_class.php";
	lgsl_database();
	
	$novinky = mysql_query("SELECT * FROM `".$lgsl_config['db']['newstable']."` ORDER BY news_date DESC LIMIT 0,9");
					if( $novinky && mysql_num_rows($novinky) > 0)
					{	
						echo "<table class='table table-hover'>";
						while($data = mysql_fetch_array($novinky))
						{
							$newsimg = ( time() >= ( $data['news_date'] + ( 5 * 24 * 60 * 60 ) ) ? "" : "<span class='tip icon'>NEW</span>" );
							echo "
							<tr class='".lgsl_bg()."'>
								<td>
									".$newsimg." ".((strlen($data['news_name']) >= 55) ? substr($data['news_name'], 0, 50)."..." : $data['news_name'])."
								</td>
								<td>
									".Date("d.m.Y",$data['news_date'])."
								</td>
								<td class='center'>
									<a href='http://".$_SERVER['HTTP_HOST']."/novinky?viewid=".$data['news_id']."'>Zobrazi� <i class='glyphicon glyphicon-plus-sign'></i></a>
								</td>
							</tr>

							";
						}	
							echo "
							</table>";
					}
?>