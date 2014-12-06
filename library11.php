<HTML>
<HEAD>
<TITLE>
Book Status
</TITLE>
</HEAD>
<BODY bgcolor = lavender >
<H2>Test PHP-MySQL</H2>
<HR height=8>
<P>

<?php
$status = $_POST['status'];
echo "<H2>Library $status</H2>";

/* Connect to MySQL */ 
$link = mysql_connect ("Services1.mcs.sdsmt.edu", "s7032956f14", "change_me") or
  die("Unable to connect");

/* Select the database */
  mysql_select_db("db_7032956f14") or die("Unable to select the database");

  //$r1 = mysql_query("Select patronID FROM Patron WHERE patronName = '$status'");

   //$row = mysql_fetch_row($r1);
   //$patronName = $row[0];


   //there's something wrong with this query, i think.
  $result = mysql_query("Select loanNo, title, authorName FROM Loan, Book, Author, Patron WHERE patronName = '$status'");
  //WHERE loanNo.patronID = Patron.patronID AND Book.authorNo = Author.authorNo AND patronName = '$status'");
// $result = mysql_query("Select videoNo, title, category from VideoForRent, Video
//     where Video.CatalogID = VideoForRent.CatalogID AND status = '$status'");

?>

<TABLE Border="1">
<TR>

<?php
/* Fetch and display the attribute names */
while ($field=mysql_fetch_field($result))
{
   echo "<TH>";
   echo "$field->name";
   echo "</TH>";
}
echo "</TR>";

/* Fetch and displays each row of $result */ 
if($result)
{
   while($row=mysql_fetch_row($result))
   {
      echo "<TR>";
      for ($i=0; $i < mysql_num_fields($result); $i++)
      {
         echo "<TD> $row[$i] </TD>";
      }
      echo "</TR>\n";
   }
}

/*
if (isset($_POST['search']))
{
   $id = 0;
   $title = $_POSN['title']\
	$query = "SELECT copyID, title FROM CopyBook, Book WHERE title LIKE '%$title%' AND copyID > $id"; //this doesnt make sense
   //$query = "SELECT patronID, patronName, patronType FROM Patron WHERE patronName LIKE '%$name%' AND patronID > $id";
   //$query = "SELECT MEMBERID, FNAME, LNAME, ADDRESS, DATEJOINED, PHONENO FROM Member WHERE FNAME LIKE '%$fname%' AND LNAME LIKE '%$lname%' AND MEMBERID > $id";
   $res = mysql_query($query);
   $row = mysql_fetch_row($res);
   if ($row[0] > 0)
   {
       $id      = $row[0];
       $title   = $row[1];
    }
}
*/

mysql_close($link);
?>


<BR>

<?php
if (isset($_POST['message']))
{
   echo "<BR><BR>$message";
}
?>

<BR>

</TABLE>
<BR>
<BR>
<a href = library.html>Return to Main Web Page</a>
</BODY>
</HTML>
