<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		CoMeT RSS Feed Recommendation
 </title>
 <style>
 	.doc{
width: 100%;
background-color: beige;
margin-left:20px; 
margin-right:20px;
background-color: cornsilk;
text-align: center;
font-size: 1.5em;
color: black;
border: 1px solid black;
top:20px;

}

body{
	background-color: beige;
	font-family: "Times New Roman", Times, serif;
}

.inputbox{
margin-left:20px; 
margin-right:20px;
background-color: cornsilk;
text-align: center;
font-size: 1.5em;
color: black;
border: 1px solid black;
top:20px;
display:none;

}


</style>
</head>

<?php

include("index.php");
include("procedures.php");

$url_1 = $_POST['url_1'];
$url_2 = $_POST['url_2'];

if($url_1==null){
echo "<br/> NULL entered for URL 1 . Using default User Profile";
$url_1 = "http://localhost/ContentBasedPersonalisation_CoMeTRSSFeed/r1_10_2019.xml";

}


if($url_2==null){
	echo "<br/> NULL entered for URL 2 . Using default RSS Feed";
	$url_2 = "http://localhost/ContentBasedPersonalisation_CoMeTRSSFeed/r2_02_2020.xml"; 

}




$xml1 = simplexml_load_file($url_1);
$xml2 = simplexml_load_file($url_2);


$i = 0;
$j = 0;
$document_collection = array();
$userprofile_vector = generateUserProfileVector($xml1);
$ranks_array = array();
$contents_array = array();
$ranked_documents = array();
$titles_array = array();
$ranked_titles = array();
$d = 0;

while($xml2->channel->item[$i]!=null){

	$string = $xml2->channel->item[$i]->description;
	$title = $xml2->channel->item[$i]->title;
	
	$document_vector = createDocumentVector($xml2->channel->item[$i]->description);

	$title_vector = createDocumentVector($xml2->channel->item[$i]->title);

	if($document_vector!=null && $title_vector!=null)
	{
		$cosine_similarity = calculate_cosine_similarity($userprofile_vector,$document_vector);
	    $cooccurence_percent = find_cooccurence_percent($userprofile_vector,$document_vector);
	    $title_cooccurence_percent = find_cooccurence_percent($userprofile_vector,$title_vector);
        $rank = $cosine_similarity + $cooccurence_percent + $title_cooccurence_percent;

	$ranks_array[$j] = $rank;
	$contents_array[$j] = $string;
	$titles_array[$j] = $title;
	$j++;
	}
	
	 $i++;
}

arsort($ranks_array);


foreach ($ranks_array as $key => $value) {
	$ranked_documents[$d] = $contents_array[$key];
	$ranked_titles[$d] = $titles_array[$key];
	$d++;
}


for($k=0;$k<sizeof($ranked_documents);$k++){
	echo "<div class=\"doc\"><h2>Ranked no:".($k+1)."<h2><br>";
	echo "<h2>".$ranked_titles[$k]."</h2><br>";
	echo $ranked_documents[$k];
	echo "</div><br>";

}


?>
 </html>