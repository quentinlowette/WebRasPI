<?php

function printRasp()
{
	echo '	<svg viewport="0 0 320 220" width="320px" height="220px" class="rpi">
				<rect x="1" y="84" width="45" height="40" class="fill"/> <!--SD Card-->
				<rect x="5" y="5" rx="5" ry="5" width="300" height="200" /> <!--Board-->
				<g> <!--Holes-->
					<circle cx="15" cy="15" r="6" class="hole"/>
					<circle cx="15" cy="195" r="6" class="hole"/>
					<circle cx="215" cy="15" r="6" class="hole"/>
					<circle cx="215" cy="195" r="6" class="hole"/>
				</g>
				<rect x="245" y="15" width="70" height="55" class="component"/> <!--USB-->
				<rect x="245" y="77" width="70" height="55" class="component"/> <!--USB-->
				<rect x="235" y="140" width="80" height="55" class="component"/> <!--Ethernet-->
				<rect x="25" y="190" width="30" height="20" class="component"/> <!--Power-->
				<rect x="90" y="170" width="55" height="40" class="component"/> <!--HDMI-->
				<rect x="173" y="161" width="30" height="40" class="component"/> <!--Jack1-->
				<rect x="178" y="201" width="20" height="15" class="component"/> <!--Jack2-->
				<g> <!--SD Port-->
					<polyline points="15,65 25,65 25,145 15,145 15,133 10,128 10,82 15,77 15,65" class="fill"/>
					<rect x="21" y="72" width="4" height="56"/>
				</g>
				<g><!--GPIO-->
					<rect x="25" y="8" width="175" height="10" class="fill"/>';
					for($i=0;$i<20;$i++)
					{
						$x=32+$i*8.5;
						echo '<circle cx="'.$x.'" cy="10" r="1" class="pin thin"/>
							  <circle cx="'.$x.'" cy="16" r="1" class="pin thin"/>';
					}
		echo '	</g>
				<rect x="70" y="65" width="55" height="55" class="fill"/> <!--Processor1-->
				<g> <!--Processor2-->';
					$xx=180;
					$yy=70;
					$size=30;
					$line=3;
					$space=5;
					echo '<rect x="'.$xx.'" y="'.$yy.'" width="'.$size.'" height="'.$size.'" class="fill"/>';
					for($i=0;$i<14;$i++)
					{
						if($i<7)
						{
							$x=$xx+(($i%7)*$space);
							$y=$yy-$line;
							echo '<line x1="'.$x.'" y1="'.$y.'" x2="'.$x.'" y2="'.($y+$line).'" class="pin"/>';
							echo '<line x1="'.$x.'" y1="'.($y+$size+$line).'" x2="'.$x.'" y2="'.($y+$size+$line+$line).'" class="pin"/>';
						}
						else
						{
							$y=$yy+(($i%7)*$space);
							$x=$xx-$line;
							echo '<line x1="'.$x.'" y1="'.$y.'" x2="'.($x+$line).'" y2="'.$y.'" class="pin"/>';
							echo '<line x1="'.($x+$size+$line).'" y1="'.$y.'" x2="'.($x+$size+$line+$line).'" y2="'.$y.'" class="pin"/>';
						}
					}
		echo '	</g>
				<rect x="10" y="161" width="5" height="10" class="ledgreen" /> <!--LED1-->
				<rect x="10" y="175" width="5" height="10" class="ledred" /> <!--LED2-->
				<g> <!--CSI (Camera Interface)-->
					<polyline points="152,200 162,200 162,188 167,183 167,137 162,132 162,120 152,120 152,200" class="fill"/>
					<rect x="152" y="132" width="4" height="56"/>
				</g>
				<text x="70" y="45">Raspberry Pi</text>
			</svg>';
}

function printFiles($dir)
{
	include 'scripts/files.php';
	
	$content = getDirContents($dir);
	
	echo '<div class="directoryContent">';
	printDirectoryContent($content, 0, "");
	echo '</div>';
}

function printSystem()
{
	include 'scripts/systemVariables.php';
	include 'scripts/graphs.php';
	
	echo '<div class="infos">
			<div class="info list system">
				<h3>System</h3>
				<div>
					<p>Hostname</p><p>'.$hostname.'</p>
					<p>Distribution</p><p>'.$dist.'</p>
					<p>Kernel Version</p><p>'.$kernel.'</p>
					<p>Uptime</p><p>'.$uptime.'</p>
					<p>Last Boot</p><p>'.$lastboot.'</p>
					<p>System Time</p><p>'.$dateString.'</p>
				</div>
			</div>
			<div class="info list net">
				<h3>Network</h3>
				<div>
					<p>Name</p><p>'.$netName.'</p>
					<p>IP Address</p><p>'.$ip.'</p>
					<p>Link quality</p>'.gauge($netQuality[0],$netQuality[1], true).'
				</div>
			</div>
			<div class="info load">
				<h3>CPU Load Average</h3>
				<div>
					<p>1 min</p><p>'.$loadavg[0]*100 .'%</p>
					<p>5 min</p><p>'.$loadavg[1]*100 .'%</p>
					<p>15 min</p><p>'.$loadavg[2]*100 .'%</p>
				</div>
			</div>
			<div class="info list server">
				<h3>Server</h3>
				<div>
					<p>Apache Version</p><p>'.$versions[0].'</p>
					<p>PHP Version</p><p>'.$versions[1].'</p>
					<p>MySQL Version</p><p>'.$versions[2].'</p>
				</div>
			</div>
			<div class="info storage">
				<h3>Storage</h3>
				<div>
					'.pieChart(substr($storage[0], 0, -1), substr($storage[1], 0, -1), substr($storage[2], 0, -1)).'
				</div>
			</div>	
		  </div>';
}