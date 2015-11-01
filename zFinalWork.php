<?php
include("json2xml.php");
//Loop Start
//open the link
//download the content json
//remove until "results" and remove 2 lines from bottom
//convert that to xml
//make html file
//Loop End
set_time_limit (10000);

foreach(file("keywords.txt") as $keywords)
{
	$keywords = str_replace(" ", "+", $keywords);
	
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL, "https://www.googleapis.com/customsearch/v1element?key=AIzaSyCVAXiUzRYsML1Pv6RwSG1gunmMikTzQqY&rsz=filtered_cse&num=20&hl=en&prettyPrint=true&source=gcsc&gss=.com&sig=5392cbaa0b641a2ba70e25095e18ee0f&cx=017810685335096852966:1s6rjdrrc5y&q=". $keywords ."&lr=lang_en&as_oq=&sort=&googlehost=www.google.com&callback=google.search.Search.apiary800&nocache=1439805913448&start=0");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);

	$html=curl_exec($ch);
	if($html==false){
		$m=curl_error(($ch));
		error_log($m);
	}

	$pos = strpos ($html, '"results": ');
	$last_pos = strrpos($html, "]");
	
	$json = substr($html, $pos+11, $last_pos-$pos-10);//strlen($html)-$pos-11);
	
	
	file_put_contents("file.json", $json);
	
	
	
	convert_json_to_xml();
	
	curl_close($ch);
	
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL, "http://127.0.0.1:8080/gcontent/new.php?keywords=".$keywords);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);

	$html =curl_exec($ch);
	if($html==false){
		$m=curl_error(($ch));
		error_log($m);
	}

	curl_close($ch);
	
	file_put_contents("wp_import.xml", $html, FILE_APPEND);
	
	sleep(1+rand(1,2));
	//sleep(20);
	//break;
}

?>
