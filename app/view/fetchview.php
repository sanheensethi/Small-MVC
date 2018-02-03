<?php
echo "Hello ! This is fetch view";
echo "<br>";

foreach($results as $result){
	echo $result->fname."&nbsp;&nbsp;".$result->lname."<br>";
}
?>