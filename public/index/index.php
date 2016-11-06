<?php










function randomStringFromFigures($x)
{
	$str = '';
	for($i=0;$i<$x;$i++)
	{
		$str .= (string)rand(0, 9);
	}
	return $str;
}

echo randomStringFromFigures(3);

?> 
