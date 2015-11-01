<?php
	include("xml_to_html.php");
?>
<?php
	echo '<item>
		<title>'.$_GET['keywords'].'</title>
		<dc:creator><![CDATA[mikulabc]]></dc:creator>
		<content:encoded><![CDATA[
	
	';
?>
  


<?php
echo '<!--UL list will start from here--><ul>';

$value = getValueByXpath("/myroot/myelement[1]/visibleUrl");
if( $value!= "NA")
{
	echo '<li>'.$value;
	$title = getValueByXpath("/myroot/myelement[1]/title");
	if( $title!= "NA")
	{
		echo $title;
	}
	echo '</li>';
}
$value = getValueByXpath("/myroot/myelement[2]/visibleUrl");
if( $value!= "NA")
{
	echo '<li>'.$value.'</li>';
} 

$value = getValueByXpath("/myroot/myelement[21]/visibleUrl");
if( $value!= "NA")
{
	echo '<li>'.$value.'</li>';
} else
{
 echo '<li>Not Available</li>';
}

echo '<!--UL list will start from here--></ul>';
?>

<?php
echo '<!--UL list will start from here--><ul>';

$value = getValueByXpath("/myroot/myelement[2]/visibleUrl");
if( $value!= "NA")
{
	echo '<li>'.$value;
	$title = getValueByXpath("/myroot/myelement[2]/title");
	if( $title!= "NA")
	{
		echo $title;
	}
	echo '</li>';
}
$value = getValueByXpath("/myroot/myelement[2]/visibleUrl");
if( $value!= "NA")
{
	echo '<li>'.$value.'</li>';
}

$value = getValueByXpath("/myroot/myelement[21]/visibleUrl");
if( $value!= "NA")
{
	echo '<li>'.$value.'</li>';
}

echo '<!--UL list will start from here--></ul>';
?>



<div class="well well-sm">
 <h3 style="margin-top: 0px;"><?php $value = getValueByXpath("/myroot/myelement[21]/visibleUrl");if( $value!= "NA"){echo '<li>'.$value.'</li>';} ?><small>by %metatagsogSiteName%</small> <div class="pull-right"><a target="_blank" href="%url%" title="%title%"><span class="label label-success">%visibleUrl% <i class="fa fa-external-link-square"></i></span></a></div></h3>
 %content%
 <div>
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home%number%" aria-controls="home%number%" role="tab" data-toggle="tab">Main</a></li>
    <li role="presentation"><a href="#social%number%" aria-controls="social%number%" role="tab" data-toggle="tab">Social</a></li>
    <li role="presentation"><a href="#apps%number%" aria-controls="apps%number%" role="tab" data-toggle="tab">Apps</a></li>
    <li role="presentation"><a href="#comments%number%" aria-controls="comments%number%" role="tab" data-toggle="tab">Comments</a></li>
    <li role="presentation"><a href="#images%number%" aria-controls="images%number%" role="tab" data-toggle="tab">Images</a></li>
  </ul>
  <div class="tab-content" style="background:white;border-radius:4px 4px 0 0;border:1px solid #ddd;border-top:0px;padding:10px;">
    <div role="tabpanel" class="tab-pane active" id="home%number%">
      <div class="row">
        <div class="col-md-3"><img src="%cseImagesrc%" width="%cseImagewidth%" height="%cseImageheight%" alt="%metatagsogTitle%"></div>
        <div class="col-md-9">%metatagsogDescription% <kbd>by %metatagsogPublisher%</kbd></div>
      </div>    
    </div>
    <div role="tabpanel" class="tab-pane" id="social%number%">
      %metatagstwitterSite%
    </div>
    <div role="tabpanel" class="tab-pane" id="apps%number%">
      FB App ID: %metatagsfbAppId%<br>
      Apple App ID:%metatagsappleItunesApp%
    </div>
    <div role="tabpanel" class="tab-pane" id="comments%number%">
      $dashed = strreplace(' ', '-', $_GET['keyword']); echo $dashed;
    </div>
    <div role="tabpanel" class="tab-pane" id="images%number%">
      X
    </div>
  </div>
 </div>
</div>


  
