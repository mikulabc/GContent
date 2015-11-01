<?php

function getThis()
{
	echo '<h1>This is a Title</h1><br>';
	$format1 = '<li><a class="btn btn-default" style="margin-bottom:8px;" href="%unescapedUrl%">%visibleUrl%</a>&nbsp;';
	$format2 = '<h6>H6 %metatagsogDescription%</h6>';
	$format3 = '</li>';

	
	$xml = simplexml_load_file('json_to_xml.xml');
	$result1 = $xml->xpath('/myroot/myelement');
	$result2 = $xml->xpath('/myroot/myelement/richSnippet/metatags');
	
	
	while(list( , $node) = each($result1)) {		
		$newformat = $format1;
		$newformat = str_replace("%visibleUrl%", $node->visibleUrl, $newformat);
		$newformat = str_replace("%unescapedUrl%", $node->unescapedUrl, $newformat);
		echo $newformat;
		$newformat = $format2;
		$newformat = str_replace("%metatagsogDescription%", $node->ogDescription, $newformat);	
		echo $newformat;
		$newformat = $format3;
		echo $newformat;
	}	
	
	while(list( , $node) = each($result2)) {		
		$newformat = $format1;
		$newformat = str_replace("%visibleUrl%", $node->visibleUrl, $newformat);
		$newformat = str_replace("%unescapedUrl%", $node->unescapedUrl, $newformat);
		echo $newformat;
		$newformat = $format2;
		$newformat = str_replace("%metatagsogDescription%", $node->ogDescription, $newformat);	
		echo $newformat;
		$newformat = $format3;
		echo $newformat;
	}
}

/*function getTitle()
{
	$format = '<tr>
		  <td>%number%</td>
		  <td>%title%</td>
		</tr>';
	
	
	$xml = simplexml_load_file('json_to_xml.xml');
	$result = $xml->xpath('/myroot/myelement/title');
	
	$i = 1;
	while(list( , $node) = each($result)) {				
		$newformat = $format;
		$newformat = str_replace("%number%", $i, $newformat);
		$newformat = str_replace("%title%", $node, $newformat);
		echo $newformat;
		$i++;
	}	
} */










function getArticles()
{
	$format1 = '		    
            <div class="panel panel-default">
              <div class="panel-heading">
                %articlename% <small class="pull-right">by %articlepublisher%</small>
              </div>
              <div class="panel-body">
                <span class="label label-default">Description</span> <mark>Publisher is %articlepublisher%</mark> %articledescription% <span class="label label-success">%articlearticlesection%</span> <span class="label label-warning">%articlegenre%</span> <span class="label label-info">%articleaudience%</span> <span class="label label-default">Topic</span>

                <div class="alert alert-warning">
                  <span class="label label-default">Article Body</span> %articlearticlebody%
                </div><span class="label label-danger">%articletitle%</span> <em>Published: %articledatemodified% | Modified: %articledatepublished%</em>

                <div class="well well-sm">
                  <span class="label label-default">Headlines</span> %articleheadline% | %articlealternativeheadline% <div class="pull-right"><a style="border-bottom:none;" href="%articleimage%" target="_blank"><i class="fa fa-picture-o"></i></a></div>
                </div>
              </div>
            </div>			
      ';
	/*
	%articlename%
	%articlepublisher%
	%articledescription%
	%articlearticlesection%
	%articlegenre%
	%articleaudience%
	%articlearticlebody%
	%articletitle%
	%articledatemodified%
	%articledatepublished%
	%articleheadline%
	%articlealternativeheadline%
	%articleimage%
	*/	
	$xml = simplexml_load_file('json_to_xml.xml');
	$result = $xml->xpath('/myroot/myelement/richSnippet/article');	
	
	$outputDateForPanel2="";
	
	$i=0;
	while(list( , $node) = each($result)) {		
		$articlename;
		$articlepublisher;
		$articledescription;
		$articlearticlesection;
		$articlegenre;
		$articleaudience;
		$articlearticlebody;
		$articletitle;
		$articledatemodified;
		$articledatepublished;
		$articleheadline;
		$articlealternativeheadline;
		$articleimage;
		
		$newformat = $format1;
		$newformat = str_replace("%articlename%", $node->name, $newformat);
		$newformat = str_replace("%articledescription%", $node->description, $newformat);
		$newformat = str_replace("%articlepublisher%", $node->publisher, $newformat);
		$newformat = str_replace("%articlearticlesection%", $node->articlesection, $newformat);
		$newformat = str_replace("%articlegenre%", $node->genre, $newformat);
		$newformat = str_replace("%articleaudience%", $node->audience, $newformat);
		$newformat = str_replace("%articlearticlebody%", $node->articlebody, $newformat);
		$newformat = str_replace("%articletitle%", $node->title, $newformat);
		$newformat = str_replace("%articledatemodified%", $node->datemodified, $newformat);
		$newformat = str_replace("%articledatepublished%", $node->datepublished, $newformat);
		$newformat = str_replace("%articleheadline%", $node->headline, $newformat);
		$newformat = str_replace("%articlealternativeheadline%", $node->alternativeheadline, $newformat);
		$newformat = str_replace("%articleimage%", $node->image, $newformat);
		if($i%2 == 0)
			echo $newformat;
		else
			$outputDateForPanel2 .= $newformat;
		
		$i++;
	}	
	return $outputDateForPanel2;
}

function getCreativework()
{	
	$xml = simplexml_load_file('json_to_xml.xml');
	$result = $xml->xpath('/myroot/myelement/richSnippet/creativework');
	

	
	while(list( , $node) = each($result)) {
		echo '<div class="well well-sm"> 
	<h3><span class="label label-default">Author</span>'.$node->myelement->author.'</h3>
	<ul>
	  <!-- START DUPLICATE--> ';	  
		
		foreach($node->myelement as $el)
		{
			if(isset($el->alternativeheadline))
				echo "<li>".$el->alternativeheadline."</li>";
		}
		
		echo '<!-- END DUPLICATE -->
	</ul><span class="label label-info">Editor</span> '.$node->myelement->editor.' helped to write the above <cite title="Source Title">Alternative Titles</cite>
  </div>';
	}	
}

function getComment()
{
	$format = '<div class="col-md-4">
	  <blockquote>
		<p>%commenttext%<br>
		<span class="label label-info">%commentdatecreated%</span></p><footer class="pull-right">written by <cite title="Source Title">%commentauthor%</cite></footer>
	  </blockquote>
	</div>';
	
	
	$xml = simplexml_load_file('json_to_xml.xml');
	$result = $xml->xpath('/myroot/myelement/comment');
	
	while(list( , $node) = each($result)) {		
		$newformat = $format;
		$newformat = str_replace("%commenttext%", $node->text, $newformat);
		$newformat = str_replace("%commentdatecreated%", $node->datecreated, $newformat);	
		$newformat = str_replace("%commentauthor%", $node->author, $newformat);	
		echo $newformat;
	}	
}
function getProductOrganizationOffer()
{
	$format = '<div class="well well-sm">
	<h3><span class="label label-danger">Product</span> %productname% <small>by %organizationbrand%</small></h3>
	<div class="pull-right">
	  <a href="#" class="btn btn-danger" style="margin-left:5px;">Check Availability &amp; Pricing</a>
	</div><a style="border-bottom:none;" href="%organizationurl%" target="_blank"><i class="fa fa-external-link"></i></a> <a style="border-bottom:none;" href="%organizationlogo%" target="_blank"><i class="fa fa-laptop"></i></a> <span class="label label-warning">%offerpricecurrency%</span> <span class="label label-warning">%offerprice%</span> <span class="label label-warning">%offeravailability%</span> %productdescription%
  </div>';
	
	
	$xml = simplexml_load_file('json_to_xml.xml');
	$result = $xml->xpath('/myroot/myelement/richSnippet');
	
	while(list( , $node) = each($result)) {
		if($node->product->name != "")
		{
			$newformat = $format;
			$newformat = str_replace("%productname%", $node->product->name, $newformat);
			$newformat = str_replace("%organizationbrand%", $node->organization->brand, $newformat);	
			$newformat = str_replace("%organizationurl%", $node->organization->url, $newformat);	
			$newformat = str_replace("%organizationlogo%", $node->organization->logo, $newformat);	
			$newformat = str_replace("%offerpricecurrency%", $node->offer->pricecurrency, $newformat);	
			$newformat = str_replace("%offerprice%", $node->offer->price, $newformat);	
			$newformat = str_replace("%offeravailability%", $node->offer->availability, $newformat);	
			$newformat = str_replace("%productdescription%", $node->product->description, $newformat);	
			echo $newformat;
		}
	}	
}
function getPersonName()
{
	$format = ',&nbsp;%personname%';
	
	
	$xml = simplexml_load_file('json_to_xml.xml');
	$result = $xml->xpath('/myroot/myelement/richSnippet/person');
	
	while(list( , $node) = each($result)) {		
		$newformat = $format;
		$newformat = str_replace("%personname%", $node->name, $newformat);		
		echo $newformat;
	}	
}
function getReview()
{
	$format = ' <li class="list-group-item">
   <ul>
  <li>%reviewname% <small> %reviewdescription% on <kbd>%reviewdatepublished%</kbd></li>
   </ul>
 </li>';
	
	
	$xml = simplexml_load_file('json_to_xml.xml');
	$result = $xml->xpath('/myroot/myelement/richSnippet/review');
	
	while(list( , $node) = each($result)) {
		foreach($node->myelement as $new_node)
		{
			if($new_node->name != "")
			{
				$newformat = $format;
				$newformat = str_replace("%reviewname%", $new_node->name, $newformat);		
				$newformat = str_replace("%reviewdescription%", $new_node->description, $newformat);		
				$newformat = str_replace("%reviewdatepublished%", $new_node->datepublished, $newformat);		
				echo $newformat;
			}
		}
	}	
}

function getMetatags()
{
/*metatagsogSiteName
metatagsogUrl
metatagsogImage
metatagsalWebUrl
metatagsogVideoUrl
metatagssailthruDescription
metatagsogDescription
metatagssailthruTitle
metatagsogTitle
metatagsogType
metatagssearchtype
metatagsacDictionary
metatagsarticlePublisher
metatagsogPublisher
metatagssyndicationSource
metatagsarticleAuthor
metatagsauthor
metatagssailthruAuthor
metatagsarticlePublishedTime
*/

	$format1 = '		    
		<div class="panel panel-default">
		  <div class="panel-heading">%metatagsogSiteName% <div class="pull-right"><a style="border-bottom:none;" href="%metatagsogUrl%" title="Open Graph URL" target="_blank"><i class="fa fa-external-link-square"></i></a> <a style="border-bottom:none;" href="%metatagsogImage%" title="Open Graph Image URL" target="_blank"><i class="fa fa-picture-o"></i></a> <a style="border-bottom:none;" href="%metatagsalWebUrl%" title="Open Graph Video URL: %metatagsogVideoUrl%" target="_blank"><i class="fa fa-youtube-play"></i></a></div></div>
		  <div class="panel-body"><kbd><abbr title="%metatagssailthruDescription%">Description</abbr></kbd> %metatagsogDescription%</div> 
		  <table class="table table-condensed" style="table-layout:fixed;word-wrap:break-word;overflow:hidden;white-space:nowrap;">
			<thead>
			  <tr>
				<th class="col-md-4">Item</th>
				<th>Found</th>
			  </tr>
			</thead>
			<tbody>
			  <tr class="success">
				<th class="SocialMediaTD" scope="row"><abbr title="Open Graph Title">Title</abbr></th>
				<td class="SocialMediaTD"><abbr title="%metatagssailthruTitle%">%metatagsogTitle%</abbr></td>
			  </tr>
			  <tr class="success">
				<th class="SocialMediaTD" scope="row"><abbr title="Open Graph Type">Type</abbr></th>
				<td class="SocialMediaTD">%metatagsogType% | %metatagssearchtype% (%metatagsacDictionary%)</td>
			  </tr>
			  <tr class="success">
				<th class="SocialMediaTD" scope="row"><abbr title="Open Graph & Article Publisher">Publisher</abbr></th>
				<td class="SocialMediaTD"><abbr title="%metatagsarticlePublisher%">%metatagsogPublisher%</abbr> <a href="%metatagssyndicationSource%" target="_blank"><i class="fa fa-link"></i></a></td>
			  </tr>
			  <tr class="success">
				<th class="SocialMediaTD" scope="row"><abbr title="Article Author">Author</abbr></th>
				<td class="SocialMediaTD"><abbr title="%metatagsarticleAuthor%">%metatagsauthor% / %metatagssailthruAuthor%</abbr></td>
			  </tr>
			  <tr class="success">
				<th class="SocialMediaTD" scope="row"><abbr title="Open Graph & Article Publish Date">Published</abbr></th>
				<td class="SocialMediaTD"><abbr title="%metatagsarticlePublishedTime% OR %metatagsdate% OR %metatagspublishDate% OR %metatagssailthruDate%">%metatagsogArticlePublishedTime%</abbr></td>
			  </tr>
			  <tr class="success">
				<th class="SocialMediaTD" scope="row"><abbr title="Open Graph & Article Modified Date">Modified</abbr></th>
				<td class="SocialMediaTD"><abbr title="%metatagsarticleModifiedTime% OR %metatagsogArticleModifiedTime% OR %metatagsogUpdatedTime%">%metatagsogModifiedTime%</abbr></td>
			  </tr>
			  <tr class="success">
				<th class="SocialMediaTD" scope="row"><abbr title="Open Graph Video">Video</abbr></th>
				<td class="SocialMediaTD"><a href="%metatagsogVideoSecureUrl%" title="OG Secure URL" target="_blank"><i class="fa fa-youtube"></i></a> %metatagsogVideoType% <span class="label label-danger">%metatagsogVideoWidth%x%metatagsogVideoHeight%</span> <span class="label label-danger">%metatagsogVideoTag%</span></td>
			  </tr>
			  <tr class="success">
				<th class="SocialMediaTD" scope="row"><abbr title="Locale & Language">Locale</abbr></th>
				<td class="SocialMediaTD"><abbr title="Region & Language">%metatagsogLocale% / %metatagsgeoRegion%</abbr></td>
			  </tr>
			  <tr class="success">
				<th class="SocialMediaTD" scope="row"><abbr title="Article Tag, Section & Subject">Tag / Section / Subject</abbr></th>
				<td class="SocialMediaTD">%metatagsarticleTag% / %metatagsarticleSection% / %metatagssubject%</td>
			  </tr>
			  <tr class="success">
				<th class="SocialMediaTD" scope="row"><abbr title="App Details & Name">Application</abbr></th>
				<td class="SocialMediaTD">%metatagsapplicationName% | %metatagsalIosAppName% | %metatagsalAndroidAppName%</td>
			  </tr>
			  <tr class="success">
				<th class="SocialMediaTD" scope="row">Images</th>
				<td class="SocialMediaTD"><a href="%metatagstwitterImage0%" target="_blank"><i class="fa fa-picture-o"></i></a> <a href="%metatagstwitterImage1%" target="_blank"><i class="fa fa-picture-o"></i></a> <a href="%metatagstbiImage%" target="_blank"><i class="fa fa-picture-o"></i></a> <a href="%metatagssailthruImageThumb%" target="_blank"><i class="fa fa-picture-o"></i></a> <a href="%metatagssailthruImageFull%" target="_blank"><i class="fa fa-picture-o"></i></a></td>
			  </tr>
			  <tr class="success">
				<th class="SocialMediaTD" scope="row">LinkedIn</th>
				<td class="SocialMediaTD">Owner ID: %metatagslinkedinOwner%</td>
			  </tr>
			  <tr class="info">
				<th class="SocialMediaTD" scope="row">Twitter (web)</th>
				<td class="SocialMediaTD"><i class="fa fa-twitter-square"></i>%metatagstwitterSite% / %metatagstwitterDomain% / %metatagstwitterCard% <abbr title="ID: %metatagstwitterAccountId%"><i class="fa fa-info-circle"></i></abbr> <a href="%metatagstwitterImage%" target="_blank"><i class="fa fa-picture-o"></i></a> <a href="%metatagstwitterImageSrc%" target="_blank"><i class="fa fa-file-image-o"></i></a> <abbr title="TITLE: %metatagstwitterTitle%"><i class="fa fa-font"></i></abbr> <abbr title="CREATOR: %metatagstwitterCreator%"><i class="fa fa-user"></i></abbr></td>
			  </tr>
			  <tr class="info">
				<th class="SocialMediaTD" scope="row">Twitter (desc)</th>
				<td class="SocialMediaTD"><a href="%metatagstwitterUrl%" target="_blank"><i class="fa fa-twitter"></i></a> %metatagstwitterDescription%</td>
			  </tr>
			  <tr class="info">
				<th class="SocialMediaTD" scope="row">Twitter (app)</th>
				<td class="SocialMediaTD"><abbr title="%metatagstwitterAppNameGoogleplay%"><span class="label label-info">Google Play</span></abbr> <abbr title="%metatagstwitterAppUrlIpad%"><span class="label label-info">iPad App</span></abbr> <abbr title="App Name: %metatagstwitterAppNameIpad% | URL:%metatagstwitterAppUrlIpad% | ID:%metatagstwitterAppIdIpad%"><span class="label label-info">iPad App</span></abbr> <abbr title="URL:%metatagstwitterAppUrlIphone% | ID:%metatagstwitterAppIdIphone% | App Name: %metatagstwitterAppNameIphone%"><span class="label label-info">iPhone App</span></abbr></td>
			  </tr>
			  
			  <tr class="warning">
				<th class="SocialMediaTD" scope="row">Apple</th>
				<td class="SocialMediaTD">App:%metatagsappleItunesApp% | Mobile:%metatagsappleMobileWebAppCapable% | Status:%metatagsappleMobileWebAppStatusBarStyle% | Title:%metatagsappleMobileWebAppTitle%</td>
			  </tr>
			  <tr class="warning">
				<th class="SocialMediaTD" scope="row">Android</th>
				<td class="SocialMediaTD">Google Play: <abbr title="%metatagsalIosUrl%">%metatagsalAndroidPackage%</abbr> <a href="%metatagsalAndroidUrl%" target="_blank"><i class="fa fa-external-link"></i></a> | %metatagsalIosAppStoreId%</td>
			  </tr>
			  <tr class="warning">
				<th class="SocialMediaTD" scope="row">News Keywords</th>
				<td class="SocialMediaTD"><abbr title="%metatagssailthruTags%">%metatagsnewsKeywords%</abbr></td>
			  </tr>
			  <tr class="warning">
				<th class="SocialMediaTD" scope="row">Misc / Other</th>
				<td class="SocialMediaTD">Verticals: <abbr title="%metatagstbiVertical%">%metatagssailthruVerticals%</abbr> | MS Application Tile: %metatagsmsapplicationTileimage% | Template: <abbr title="PATH: %metatagspath%">%metatagspmTemplate%</abbr></td>
			  </tr>
			  <tr class="danger">
				<th class="SocialMediaTD" scope="row">Pin Desc</th>
				<td class="SocialMediaTD"><abbr title="%metatagstitle%">%metatagspinDescription%</abbr></td>
			  </tr>
			  <tr class="danger">
				<th class="SocialMediaTD" scope="row">Pin Desc</th>
				<td class="SocialMediaTD">%metatagspinterestDescription%</td>
			  </tr>
			  <tr class="danger">
				<th class="SocialMediaTD" scope="row">Pin URLs</th>
				<td class="SocialMediaTD"><a href="%metatagspinterestUrl%" target="_blank"><i class="fa fa-pinterest"></i></a> <a href="%metatagspinUrl%" target="_blank"><i class="fa fa-pinterest-p"></i></a> <span class="label label-danger"><a href="%metatagspinMedia%" target="_blank"><i class="fa fa-pinterest-square"></i></a> Image</span></td>
			  </tr>
			  <tr style="background:#337ab7;color:white;">
				<th class="SocialMediaTD" scope="row">FB App</th>
				<td class="SocialMediaTD">%metatagsfbAppId%</td>
			  </tr>
			  <tr style="background:#337ab7;color:white;">
				<th class="SocialMediaTD" scope="row">FB Page</th>
				<td class="SocialMediaTD">%metatagsfbPageId%</td>
			  </tr>
			  <tr style="background:#337ab7;color:white;">
				<th class="SocialMediaTD" scope="row">FB Admin</th>
				<td class="SocialMediaTD">%metatagsfbAdmins%</td>
			  </tr>
			</tbody>
		  </table>
		</div>
      ';
	
	$xml = simplexml_load_file('json_to_xml.xml');
	$result = $xml->xpath('/myroot/myelement/richSnippet/metatags');	

	
	$outputDateForPanel2 = "";
	//$outputDateForPanel2->real_data = "";
	//$outputDateForPanel2->ogdesc = "";
	
	$i=0;
	while(list( , $node) = each($result)) {				
		
		$newformat = $format1;
		$newformat = str_replace("%metatagstitle%", $node->title, $newformat);
		$newformat = str_replace("%metatagsogTitle%", $node->ogTitle, $newformat);
		$newformat = str_replace("%metatagsogDescription%", $node->ogDescription, $newformat);
		$newformat = str_replace("%metatagsogImage%", $node->ogImage, $newformat);
		$newformat = str_replace("%metatagsogUrl%", $node->ogUrl, $newformat);
		$newformat = str_replace("%metatagsogPublisher%", $node->ogPublisher, $newformat);
		$newformat = str_replace("%metatagsogSiteName%", $node->ogSiteName, $newformat);
		$newformat = str_replace("%metatagsogModifiedTime%", $node->ogModifiedTime, $newformat);
		$newformat = str_replace("%metatagsogUpdatedTime%", $node->ogUpdatedTime, $newformat);
		$newformat = str_replace("%metatagsogArticlePublishedTime%", $node->ogArticlePublishedTime, $newformat);
		$newformat = str_replace("%metatagsogType%", $node->ogType, $newformat);
		$newformat = str_replace("%metatagsogVideoUrl%", $node->ogVideoUrl, $newformat);
		$newformat = str_replace("%metatagsogVideoSecureUrl%", $node->ogVideoSecureUrl, $newformat);
		$newformat = str_replace("%metatagsogVideoType%", $node->ogVideoType, $newformat);
		$newformat = str_replace("%metatagsogVideoWidth%", $node->ogVideoWidth, $newformat);
		$newformat = str_replace("%metatagsogVideoHeight%", $node->ogVideoHeight, $newformat);
		$newformat = str_replace("%metatagsogVideoTag%", $node->ogVideoTag, $newformat);
		$newformat = str_replace("%metatagsogLocale%", $node->ogLocale, $newformat);
		$newformat = str_replace("%metatagsgeoRegion%", $node->geoRegion, $newformat);
		$newformat = str_replace("%metatagsauthor%", $node->author, $newformat);
		$newformat = str_replace("%metatagsarticleAuthor%", $node->articleAuthor, $newformat);
		$newformat = str_replace("%metatagsarticlePublisher%", $node->articlePublisher, $newformat);
		$newformat = str_replace("%metatagsarticlePublishedTime%", $node->articlePublishedTime, $newformat);
		$newformat = str_replace("%metatagsarticleModifiedTime%", $node->articleModifiedTime, $newformat);
		$newformat = str_replace("%metatagsarticleTag%", $node->articleTag, $newformat);
		$newformat = str_replace("%metatagsarticleSection%", $node->articleSection, $newformat);
		$newformat = str_replace("%metatagssubject%", $node->subject, $newformat);
		$newformat = str_replace("%metatagscopyright%", $node->copyright, $newformat);
		$newformat = str_replace("%metatagsdate%", $node->date, $newformat);
		$newformat = str_replace("%metatagspublishDate%", $node->publishDate, $newformat);
		$newformat = str_replace("%metatagsapplicationName%", $node->applicationName, $newformat);
		$newformat = str_replace("%metatagslinkedinOwner%", $node->linkedinOwner, $newformat);
		$newformat = str_replace("%metatagssearchtype%", $node->searchtype, $newformat);
		$newformat = str_replace("%metatagsacDictionary%", $node->acDictionary, $newformat);
		$newformat = str_replace("%metatagssyndicationSource%", $node->syndicationSource, $newformat);
		$newformat = str_replace("%metatagstwitterAccountId%", $node->twitterAccountId, $newformat);
		$newformat = str_replace("%metatagstwitterImageSrc%", $node->twitterImageSrc, $newformat);
		$newformat = str_replace("%metatagstwitterSite%", $node->twitterSite, $newformat);
		$newformat = str_replace("%metatagstwitterDomain%", $node->twitterDomain, $newformat);
		$newformat = str_replace("%metatagstwitterTitle%", $node->twitterTitle, $newformat);
		$newformat = str_replace("%metatagstwitterUrl%", $node->twitterUrl, $newformat);
		$newformat = str_replace("%metatagstwitterAppNameIphone%", $node->twitterAppNameIphone, $newformat);
		$newformat = str_replace("%metatagstwitterAppIdIphone%", $node->twitterAppIdIphone, $newformat);
		$newformat = str_replace("%metatagstwitterAppUrlIphone%", $node->twitterAppUrlIphone, $newformat);
		$newformat = str_replace("%metatagstwitterAppNameIpad%", $node->twitterAppNameIpad, $newformat);
		$newformat = str_replace("%metatagstwitterAppIdIpad%", $node->twitterAppIdIpad, $newformat);
		$newformat = str_replace("%metatagstwitterAppUrlIpad%", $node->twitterAppUrlIpad, $newformat);
		$newformat = str_replace("%metatagstwitterAppNameGoogleplay%", $node->twitterAppNameGoogleplay, $newformat);
		$newformat = str_replace("%metatagstwitterCard%", $node->twitterCard, $newformat);
		$newformat = str_replace("%metatagstwitterImage%", $node->twitterImage, $newformat);
		$newformat = str_replace("%metatagstwitterCreator%", $node->twitterCreator, $newformat);
		$newformat = str_replace("%metatagstwitterImage0%", $node->twitterImage0, $newformat);
		$newformat = str_replace("%metatagstwitterImage1%", $node->twitterImage1, $newformat);
		$newformat = str_replace("%metatagstbiImage%", $node->tbiImage, $newformat);
		$newformat = str_replace("%metatagsmsapplicationTileimage%", $node->msapplicationTileimage, $newformat);
		$newformat = str_replace("%metatagsnewsKeywords%", $node->newsKeywords, $newformat);
		$newformat = str_replace("%metatagssailthruTags%", $node->sailthruTags, $newformat);
		$newformat = str_replace("%metatagssailthruDate%", $node->sailthruDate, $newformat);
		$newformat = str_replace("%metatagssailthruVerticals%", $node->sailthruDescription, $newformat);
		$newformat = str_replace("%metatagssailthruTitle%", $node->sailthruTitle, $newformat);
		$newformat = str_replace("%metatagssailthruImageFull%", $node->sailthruImageFull, $newformat);
		$newformat = str_replace("%metatagssailthruImageThumb%", $node->sailthruImageThumb, $newformat);
		$newformat = str_replace("%metatagssailthruAuthor%", $node->sailthruAuthor, $newformat);
		$newformat = str_replace("%metatagspmTemplate%", $node->pmTemplate, $newformat);
		$newformat = str_replace("%metatagstbiVertical%", $node->tbiVertical, $newformat);
		$newformat = str_replace("%metatagspath%", $node->path, $newformat);
		$newformat = str_replace("%metatagspinDescription%", $node->pinDescription, $newformat);
		$newformat = str_replace("%metatagspinMedia%", $node->pinMedia, $newformat);
		$newformat = str_replace("%metatagspinterestDescription%", $node->pinterestDescription, $newformat);
		$newformat = str_replace("%metatagspinterestUrl%", $node->pinterestUrl, $newformat);
		$newformat = str_replace("%metatagspinUrl%", $node->pinUrl, $newformat);
		$newformat = str_replace("%metatagsalWebUrl%", $node->pinUrl, $newformat);
		$newformat = str_replace("%metatagsalIosAppStoreId%", $node->alIosAppStoreId, $newformat);
		$newformat = str_replace("%metatagsalIosAppName%", $node->alIosAppName, $newformat);
		$newformat = str_replace("%metatagsalIosUrl%", $node->alIosUrl, $newformat);
		$newformat = str_replace("%metatagsalAndroidUrl%", $node->alAndroidUrl, $newformat);
		$newformat = str_replace("%metatagsalAndroidAppName%", $node->alAndroidAppName, $newformat);
		$newformat = str_replace("%metatagsalAndroidPackage%", $node->alAndroidPackage, $newformat);
		$newformat = str_replace("%metatagsappleMobileWebAppCapable%", $node->appleMobileWebAppCapable, $newformat);
		$newformat = str_replace("%metatagsappleMobileWebAppStatusBarStyle%", $node->appleMobileWebAppStatusBarStyle, $newformat);
		$newformat = str_replace("%metatagsappleMobileWebAppTitle%", $node->appleMobileWebAppTitle, $newformat);
		$newformat = str_replace("%metatagsappleItunesApp%", $node->appleItunesApp, $newformat);
		$newformat = str_replace("%metatagsfbAppId%", $node->fbAppId, $newformat);
		$newformat = str_replace("%metatagsfbPageId%", $node->fbPageId, $newformat);
		$newformat = str_replace("%metatagsfbAdmins%", $node->fbAdmins, $newformat);
		$newformat = str_replace("%metatagstwitterDescription%", $node->twitterDescription, $newformat);
		
		if($i%2 == 0)
			echo $newformat;
		else
			$outputDateForPanel2 .= $newformat;
			//$outputDateForPanel2->real_data .= $newformat;
		
		//if($node->ogDescription != "")
			//$outputDateForPanel2->ogdesc = $node->ogDescription;
		
		
		$i++;
	}	
	return $outputDateForPanel2;
}

function getBreadcrumb()
{
	$format = '<li>%breadcrumbtitle%</li>';
	
	
	$xml = simplexml_load_file('json_to_xml.xml');
	$result = $xml->xpath('/myroot/myelement/richSnippet/breadcrumb');
	
	while(list( , $node) = each($result)) {		
		if($node->title != "")
		{
			$newformat = $format;
			$newformat = str_replace("%breadcrumbtitle%", $node->title, $newformat);
			echo $newformat;
		}
		else if($node->myelement->title != "")
		{
			foreach($node->myelement as $new_node)
			{
				$newformat = $format;
				$newformat = str_replace("%breadcrumbtitle%", $new_node->title, $newformat);
				echo $newformat;
			}
		}
	}	
}

function getItem()
{
	$format = '<h3>Item: <small>%itemtitle%</small></h3>';
	
	
	$xml = simplexml_load_file('json_to_xml.xml');
	$result = $xml->xpath('/myroot/myelement/richSnippet/item');
	
	while(list( , $node) = each($result)) {		
		if($node->title != "")
		{
			$newformat = $format;
			$newformat = str_replace("%itemtitle%", $node->title, $newformat);
			echo $newformat;
		}
	}	
}
function getWebpage()
{
	$format = '<div class="page-header">
		  <h3>Webpage Breadcrumb from <span class="label label-info">%webpagelastreviewed%</span></h3>
		  %webpagebreadcrumb%
		</div>';
	
	
	$xml = simplexml_load_file('json_to_xml.xml');
	$result = $xml->xpath('/myroot/myelement/richSnippet/webpage');
	
	while(list( , $node) = each($result)) {
		$newformat = $format;
		foreach($node->myelement as $new_node)
			if( isset($new_node->breadcrumb) && $new_node->breadcrumb != "")
			{			
				$newformat = str_replace("%webpagebreadcrumb%", $new_node->breadcrumb, $newformat);				
			}
			
		foreach($node->myelement as $new_node)	
			if( isset($new_node->lastreviewed) && $new_node->lastreviewed != "")
				$newformat = str_replace("%webpagelastreviewed%", $new_node->lastreviewed, $newformat);
			
		echo $newformat;
	}	
}
function getHcard()
{
	$format = '<div class="page-header">
		  <h3>Contact an Expert: <form action="%hcardfn%"><input type="submit" class="btn btn-danger btn-sm" value="View Details"></form></h3>
		</div>';
	
	
	$xml = simplexml_load_file('json_to_xml.xml');
	$result = $xml->xpath('/myroot/myelement/richSnippet/hcard');
	
	while(list( , $node) = each($result)) {		
		if($node->fn != "")
		{
			$newformat = $format;
			$newformat = str_replace("%hcardfn%", $node->fn, $newformat);
			echo $newformat;
		}
	}	
}
function getScraped()
{
	$format = '<div class="page-header">
		  <h5>Found Image Link</h5>
		  <h6><pre>%scrapedimageLink%</pre></h6>
		</div>';
	
	
	$xml = simplexml_load_file('json_to_xml.xml');
	$result = $xml->xpath('/myroot/myelement/richSnippet/scraped');
	
	while(list( , $node) = each($result)) {		
		if($node->imageLink != "")
		{
			$newformat = $format;
			$newformat = str_replace("%scrapedimageLink%", $node->imageLink, $newformat);
			echo $newformat;
		}
	}	
}
function getCseImage()
{
	$format = '<li><h6><span class="label label-danger">%cseImagetype%</span> %cseImagesrc%<br>image <span class="label label-warning">width</span> %cseImagewidth% <span class="label label-warning">height</span> %cseImageheight%</h6></li>';
	
	
	$xml = simplexml_load_file('json_to_xml.xml');
	$result = $xml->xpath('/myroot/myelement/richSnippet/cseImage');
	
	while(list( , $node) = each($result)) {				
		$newformat = $format;
		$newformat = str_replace("%cseImagetype%", $node->type, $newformat);
		$newformat = str_replace("%cseImagesrc%", $node->src, $newformat);
		$newformat = str_replace("%cseImagewidth%", $node->width, $newformat);
		$newformat = str_replace("%cseImageheight%", $node->height, $newformat);
		echo $newformat;
	}	
}

function getUrl()
{
	$format = '<li><h6>%url%</h6></li>';
	
	
	$xml = simplexml_load_file('json_to_xml.xml');
	$result = $xml->xpath('/myroot/myelement/url');
	
	while(list( , $node) = each($result)) {				
		$newformat = $format;
		$newformat = str_replace("%url%", $node, $newformat);
		echo $newformat;
	}	
}

function getTitle()
{
	$format = '<tr>
		  <td>%number%</td>
		  <td>%title%</td>
		</tr>';
	
	
	$xml = simplexml_load_file('json_to_xml.xml');
	$result = $xml->xpath('/myroot/myelement/title');
	
	$i = 1;
	while(list( , $node) = each($result)) {				
		$newformat = $format;
		$newformat = str_replace("%number%", $i, $newformat);
		$newformat = str_replace("%title%", $node, $newformat);
		echo $newformat;
		$i++;
	}	
}
function getContent()
{
	$format = '<li class="list-group-item list-group-item-success">%content%</li>';
	
	
	$xml = simplexml_load_file('json_to_xml.xml');
	$result = $xml->xpath('/myroot/myelement/content');
	
	while(list( , $node) = each($result)) {				
		$newformat = $format;
		$newformat = str_replace("%content%", $node, $newformat);
		echo $newformat;
	}	
}

function getVideoobject()
{
	$format = '<div class="col-md-12">
		<h3>%videoobjectname%</h3>
		<h5>%videoobjectdescription%</h5>
	  </div>
	  <div class="col-md-8">
		<div class="embed-responsive embed-responsive-16by9">
		  <iframe class="embed-responsive-item" src="%videoobjectembedurl%"></iframe>
		</div>
	  </div>
	  <div class="col-md-4">
		<h4><span class="label label-danger"><kbd>Genre</kbd> %videoobjectgenre%</span></h4>
		<span class="label label-danger"><kbd>Youtube URL</kbd> %videoobjecturl%</span><br>
		<span class="label label-danger"><kbd>Thumbnail</kbd> %videoobjectthumbnailurl%</span><br>
		<span class="label label-danger"><kbd>Channel ID</kbd> %videoobjectchannelid%</span><br>
		<span class="label label-danger"><kbd>Video ID</kbd> %videoobjectvideoid%</span><br>
		<span class="label label-danger"><kbd>Duration</kbd> %videoobjectduration%</span><br>
		<span class="label label-danger"><kbd>Interactions</kbd> %videoobjectinteractioncount%</span><br>
		<span class="label label-danger"><kbd>Date Published</kbd> %videoobjectdatepublished%</span><br>
		<span class="label label-danger"><kbd>Width</kbd> %videoobjectwidth%</span><br>
		<span class="label label-danger"><kbd>Height</kbd> %videoobjectheight%</span><br>
		<span class="label label-danger"><kbd>Player</kbd> %videoobjectplayertype%</span><br>
		<span class="label label-danger"><kbd>Family Friendly?</kbd> %videoobjectisfamilyfriendly%</span><br>
		<span class="label label-danger"><kbd>Unlisted?</kbd> %videoobjectunlisted%</span><br>
		<span class="label label-danger"><kbd>Paid?</kbd> %videoobjectpaid%</span><br>
		<span class="label label-danger"><kbd>Regions Allowed</kbd> %videoobjectregionsallowed%</span>
	  </div>';
	
	
	$xml = simplexml_load_file('json_to_xml.xml');
	$result = $xml->xpath('/myroot/myelement/richSnippet/videoobject');
	
	while(list( , $node) = each($result)) {				
		$newformat = $format;
		$newformat = str_replace("%videoobjecturl%", $node->url, $newformat);
		$newformat = str_replace("%videoobjectname%", $node->name, $newformat);
		$newformat = str_replace("%videoobjectdescription%", $node->description, $newformat);
		$newformat = str_replace("%videoobjectpaid%", $node->paid, $newformat);
		$newformat = str_replace("%videoobjectchannelid%", $node->channelid, $newformat);
		$newformat = str_replace("%videoobjectvideoid%", $node->videoid, $newformat);
		$newformat = str_replace("%videoobjectduration%", $node->duration, $newformat);
		$newformat = str_replace("%videoobjectunlisted%", $node->unlisted, $newformat);
		$newformat = str_replace("%videoobjectthumbnailurl%", $node->thumbnailurl, $newformat);
		$newformat = str_replace("%videoobjectembedurl%", $node->embedurl, $newformat);
		$newformat = str_replace("%videoobjectplayertype%", $node->playertype, $newformat);
		$newformat = str_replace("%videoobjectwidth%", $node->width, $newformat);
		$newformat = str_replace("%videoobjectheight%", $node->height, $newformat);
		$newformat = str_replace("%videoobjectisfamilyfriendly%", $node->isfamilyfriendly, $newformat);
		$newformat = str_replace("%videoobjectregionsallowed%", $node->regionsallowed, $newformat);
		$newformat = str_replace("%videoobjectinteractioncount%", $node->interactioncount, $newformat);
		$newformat = str_replace("%videoobjectdatepublished%", $node->datepublished, $newformat);
		$newformat = str_replace("%videoobjectgenre%", $node->genre, $newformat);
		echo $newformat;
	}	
}
?>

