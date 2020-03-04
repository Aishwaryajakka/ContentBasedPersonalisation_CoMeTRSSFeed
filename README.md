# Content Based Personalisation - CoMeT RSS Feed


An RSS feed system that personalizes any RSS feed using cosine similarity between the documents in the user's interested feed with a new RSS feed. It builds a new profie 

Tools Used: PHP, XAMPP and Apache Server 
Interesting RSS Feed used(User's profile ):  RSS Feed from my CoMeT Profile : http://halley.exp.sis.pitt.edu/comet/utils/_rss.jsp?month=9&year=2019&v=bookmark&user_id=3681
Second RSS Feed:  RSS feed for the Month of Febuary:  http://halley.exp.sis.pitt.edu/comet/utils/_rss.jsp?month=2&year=2020

# Steps to execute the program:
Prequiste: You will need 
1. Unzip the folder and put the folder under "/Users/aishwaryajakka/Applications/XAMPP/htdocs/<project_folder>"
2. Start the Apache Server and navigate to "http://localhost/ContentBasedPersonalisation_CoMeTRSSFeed/index.php"
3. Make sure the valid XML URLs are entered . Incase of an issue with the XML encoding. You may use this link [https://www.freeformatter.com/xml-formatter.html] to format the XML file  else run format_xml.php that has XML files with encoding; 'utf-8'

4. After submitting , the parse_feed.php will display the Ranked talks based on the user profile.

# How the program works

1. There are 2 input fields that take 2 URLs , one for user profile and other any RSS feed for which similarity of contents is to be compared and calculated.
2. The RSS feeds from the CoMeT is parsed completely where every item’s description tag contents is treated as a document.  
3. All the words in the document are extracted (Text Processing)
4. The html tags are stripped using functions in php
5. The  stop words are removed from the content (by comparing with an array of stop words that is read from a text file containing the list of 
stop words obtained from the web). 
6. The words are then normalized, turning into lower case.
7. The words are then stemmed using Porter Stemmer algorithm (Reference provided in porterStemmer.php)
8. The stems and their corresponding frequency in the collection are stored in a vector after indexing using array functions. 
9. The user profile is built into a vector by extracting the 500 top frequent stems and the values stored for each stem are the key which is term itself and the value which is given as Key = term Value = frequency of every stem/highest frequency term in the collection (ranges between 0 to 1) 
10. When the second url of RSS is passed, the document vectors are generated for every item read in the feed.
(stop words removal, normalizing, stemming performed as above) 
11. This is followed by calculating the cosine similarity between every document vector and the user profile vector as follows: 
12. So also, for every document another frequency value (co-occurrence) for the content as well as the titles of every item is calculated which is  Content – co occurrence percent  (No. of words in the document that exist in the user profile vector/No. of words in the user profile vector) Title– co occurrence percent  (No. of words in the title that exist in the user profile vector/No. of words in the user profile vector)  

13. The above gives a measure of co occurrence of the words in the document vector and the user profile vector. 

14. Finally the rank for every document is calculated by adding the cosine similarity value obtained in step 11 and co occurrence value measured in step 12. This value ranges between 0 and 1 again which 
are then ordered in descending and the corresponding documents with higher values are given higher rank and those with lower values are given with lower ranks. The overall rank calculation for every document is as follows:  

  $rank = $cosine_similarity + $cooccurence_percent + $title_cooccurence_percent; 

This ranking is interesting as it takes into account the frequency of co occurrence of words both in the title and the description of the items in the rss feeds and compares their occurrence in the user profile of interest. Further the ranking considers the cosine similarity of all the terms in the document with that of the user profile vector which gives a measure of the relative orientation of the text in the document in comparison to the text in the user’s interests. 


Author: Aishwarya Jakka
Email: Aishwaryajakka@pitt.edu