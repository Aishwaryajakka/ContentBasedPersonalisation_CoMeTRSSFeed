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

}

body{
	background-color: beige;
	font-family: "Times New Roman", Times, serif;
}
h1{
  font-size: 70px;
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


}

input[type=text], select {
  width: 80%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 50%;
  background-color: burlywood;
  color: black ;
  font-weight: 20px;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
 </style>
</head>

<body>
	<h1>
		CoMeT RSS Feed Recommendation
	</h1>

<form method = "POST" action="parse_feed.php">
<div class="inputbox">

	<label for="url_1">RSS FEED URL 1 : User profile</label> <br/>
	<input name="url_1" type = "text" value = "http://localhost/ContentBasedPersonalisation_CoMeTRSSFeed/r1_10_2019.xml" size ="180"><br/>
	
<br/><br/>

     <label id="label" for="url2">RSS FEEDS URL 2 : Input Document </label> <br/>
     <input name = "url_2" type = "text" value = "http://localhost/ContentBasedPersonalisation_CoMeTRSSFeed/r2_02_2020.xml" size = "180"><br/>
     
<input type = "submit" value = "SUBMIT"></div>
</form>
</body>
</html>