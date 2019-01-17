<?php
function pieChart($used, $free, $part)
{
	return '<div class="pie"><div class="rotate" style="transform:rotate(.'.$part.'turn);"></div></div>
	<div class="data"><p>'.$used.'Go used</p><p>'.$free.'Go free</p>
	<p>'.$part.'% used</p></div>';
}

function gauge($level, $max, $arc=false)
{	
	if($arc)
	{
		$prop=($level/$max-0.5)/2;
		$percent=round($level/$max*100, 0);
		return '<div class="gauge gauge-arc"><div class="mask" style="transform:rotate('.$prop.'turn);"></div><p>'.$percent.'</p></div>';
	}
	else
	{
		$prop=($level/$max)*100;
		return '<div class="gauge gauge-line"><div class="mask" style="left:'.$prop.'px;"></div><p>'.$level.'°C</div>';
	}
}