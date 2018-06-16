<?php
function allowedPathValue($value)
{
	$blockedValues = array(".git", "phpmyadmin");
	return !in_array($value, $blockedValues);
}

function getDirContents($dir, &$results = array())
{
    $files = scandir($dir);

    foreach($files as $key => $value)
	{
        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
        if(!is_dir($path))
		{
            $results[] = $value;
        }
		else if($value != "." && $value != ".." && allowedPathValue($value))
		{
			$subResults[] = $value;
			$subResults = getDirContents($path, $subResults);
			$results[] = $subResults;
			unset($subResults);
        }
    }

    return $results;
}

function printDirectoryContent($content, $depth, $path)
{
	$i=0;
	
	foreach($content as $element)
	{
		if(!is_array($element))
		{
			$value=$element;
			$link=$path.'/'.$value;
			echo '<a class="element file" href="'.$link.'">';
			echo   '<svg viewport="0 0 150 100" width="150px" height="100px">
						<rect x="39" y="9" rx="5" ry="5" width="72" height="90" />
						<line x1="55" y1="50" x2="95" y2="50" stroke-linecap="round" />
						<line x1="55" y1="60" x2="95" y2="60" stroke-linecap="round" />
						<line x1="55" y1="70" x2="95" y2="70" stroke-linecap="round" />
					</svg>';
			echo $value.'</a>';
		}
		else
		{
			$folderName = array_shift($element);
			echo '<input type="radio" name="'.$depth.'" id="'.$folderName.$depth.'">';
			echo '<div><label class="element folder" for="'.$folderName.$depth.'">';
			echo   '<svg viewport="0 0 150 100" width="150px" height="100px">
						<path d="M25 20 a5,5 0 0 1 5,-5 h40 a5,5 0 0 1 5,5 a5,5 0 0 0 5,5 h40 a5,5 0 0 1 5,5 v60 a5,5 0 0 1 -5,5 h-90 a5,5 0 0 1 -5,-5 Z" />
						<rect x="25" y="25" rx="5" ry="5" width="100" height="70" />
					</svg>';
			echo $folderName.'</label>';
			echo '<div class="folderContent directoryContent">';
			
			$newPath = $path.'/'.$folderName;
			printDirectoryContent($element, $depth+1, $newPath);
			
			echo '<input type="radio" name="'.$depth.'" id="close'.$depth.'">';
			echo '<label class="close" for="close'.$depth.'">';
			echo   '<svg viewport="0 0 20 20" width="20px" height="20px">
						<line x1="1" y1="1" x2="19" y2="19" stroke-linecap="round" />
						<line x1="1" y1="19" x2="19" y2="1" stroke-linecap="round" />
					</svg>';
			echo '</label>';
			echo '</div>';
			echo '</div>';
		}
		$i++;
	}
}
