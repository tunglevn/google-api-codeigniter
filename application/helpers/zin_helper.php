<?php
function set_output($type,$content) 
{
	$CI =&get_instance();
	
	$CI->load->helper('file');
	
	$mime = get_mime_by_extension('.'.$type);
	
	header('Content-type: '.$mime);
	
	exit($content);

}

function yttime($youtube_time) 
{
    $hours = '0';
    $minutes = '0';
    $seconds = '0';

    $hIndex = strpos($youtube_time, 'H');
    $mIndex = strpos($youtube_time, 'M');
    $sIndex = strpos($youtube_time, 'S');
    $length = strlen($youtube_time);
    if($hIndex > 0)
    {
        $hours = substr($youtube_time, 2, ($hIndex - 2));
    }
    if($mIndex > 0)
    {
        if($hIndex > 0)
        {
            $minutes = substr($youtube_time, ($hIndex + 1), ($mIndex - ($hIndex + 1)));
        }      
        else
        {
            $minutes = substr($youtube_time, 2, ($mIndex - 2));
        }
    }
    if($sIndex > 0)
    {
        if($mIndex > 0)
        {
            $seconds = substr($youtube_time, ($mIndex + 1), ($sIndex - ($mIndex + 1)));
        }
        else if($hIndex > 0)
        {
            $seconds = substr($youtube_time, ($hIndex + 1), ($sIndex - ($hIndex + 1)));
        }      
        else
        {
            $seconds = substr($youtube_time, 2, ($sIndex - 2));
        }
    }
    
    $result = array(
    		'form'	=> 	$hours.":".$minutes.":".$seconds,
    		'int'	=> ($hours * 60) + ($minutes * 60) + $seconds
    );
    return $result;        
}