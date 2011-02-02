<?php
/***********************************************
November 11,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/

Class PageCache
{
	public static function GetCacheName()
	{	
		$cachePath = CACHE_PATH."/pages/";
		return $cachePath.md5($_SERVER['REQUEST_URI']);
	}

	public static function LoadCache($min = 5)
	{		
        $time = microtime();
		$time = explode(" ", $time);
		$time = $time[1] + $time[0];
		$start = $time;


		if ($_POST) return;
		$cachetime = $min * 60; 
        $cachefile =  self::GetCacheName();
		 $time = time() - $cachetime;
        if ( file_exists($cachefile) && 
			 (time() - $cachetime < filemtime($cachefile))) 
        {
         include($cachefile);
         echo "<!-- Cached ".date('jS F Y H:i', filemtime($cachefile))." -->\n";
		    /* End Load Time */
			$time = microtime();
			$time = explode(" ", $time);
			$time = $time[1] + $time[0];
			$finish = $time;
			$totaltime = ($finish - $start);
			printf ("<B>This page took %f seconds to load.</B>", $totaltime);
			//Echo "<BR>start = $start  | finish = $finish";
         exit;
        }
		
	}//LoadCache

	public static function SaveCache()
	{
		     $cachefile =  self::GetCacheName();
			 $fp = fopen($cachefile, 'w'); 
			 fwrite($fp, ob_get_contents());
             fclose($fp); 
	}//SaveCache
}

?>