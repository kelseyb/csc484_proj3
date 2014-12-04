<HTML>
<HEAD>
<TITLE>
Book Status
</TITLE>
</HEAD>
<BODY bgcolor = wheat >
<H2>Test PHP-MySQL</H2>
<HR height=8>
<P>

<?php
$status = $_POST['status'];
echo "<H2>Library $status</H2>";

/* Connect to MySQL */ 
$link = mysql_connect ("Services1.mcs.sdsmt.edu", "USERNAME", "PASSWORD") or
  die("Unable to connect");

/* Select the database */
  mysql_select_db("DATABASE") or die("Unable to select the database");

/* Access the VIDEOFORRENT table */
//this may be horribly wrong
  $result = mysql_query("Select loanNo, title, authorName FROM Loan, Book, Author WHERE status = '$status'");
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
}//added

if (isset($_POST['search']))
{
   $id = 0;
   $title = $_POSN['title']
   //$fname = $_POST['fname'];
	//$lname = $_POST['lname'];
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

// elseif (isset($_POST['loan']))
// {
//   $id = 0;
//   //??
//   $name = $_POSN['name']
//   //$fname = $_POST['fname'];
// 	//$lname = $_POST['lname'];
//   $query = "SELECT patronID, patronName, patronType, FROM Patron WHERE patronName LIKE '%$name%' AND patronID > $id";
//   //$query = "SELECT MEMBERID, FNAME, LNAME, ADDRESS, DATEJOINED, PHONENO FROM Member WHERE FNAME LIKE '%$fname%' AND LNAME LIKE '%$lname%' AND MEMBERID > $id";
//   $res = mysql_query($query);
//   $row = mysql_fetch_row($res);
//   if ($row[0] > 0)
//   {
//       $id      = $row[0];
//       $name   = $row[1];
//       $type   = $row[2];
//     }
// }

mysql_close($link);
?>


<BR> Patron ID:
<BR><INPUT TYPE="TEXT" NAME="id"
    <?php echo "VALUE=\"$id\"" ?>>
<BR>
<BR> Name:
<BR><INPUT TYPE="TEXT" NAME="title"
    <?php echo "VALUE=\"$name\"" ?>>
<BR>
<BR> Type:
<BR><INPUT TYPE="TEXT" NAME="authorName"
    <?php echo "VALUE=\"$type\"" ?>>
<BR>
<BR>

<INPUT TYPE="SUBMIT" NAME="search"     VALUE="Search">
<INPUT TYPE="SUBMIT" NAME="loan"     VALUE="Loan">

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
