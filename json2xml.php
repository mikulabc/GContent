<?php

include_once("XML/Serializer.php");


function json_to_xml($json) {
 $serializer = new XML_Serializer();
 $obj = json_decode($json);

 if ($serializer->serialize($obj)) {
 return $serializer->getSerializedData();
 }
 else {
 return null;
 }
}

/*************************************************************************** Generate XML ***************************************************************************/
	function convert_json_to_xml()
	{
		$json = file_get_contents("file.json");
		//$dec = json_decode($json);
		/*/print("<?xml version=\"1.0\"?>\r\n");*/
		$json_xml = json_to_xml($json);
		$json_xml = str_replace("XML_Serializer_Tag", "myelement", $json_xml);
		$json_xml = str_replace("stdClass", "Armory", $json_xml);
		//print($json_xml);
		file_put_contents("json_to_xml.xml", $json_xml);
	}
?>
