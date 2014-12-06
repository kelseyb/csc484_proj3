<HTML>
<HEAD>
<TITLE>Add a New Patron</TITLE>
</HEAD>

<BODY bgcolor = lavender>
<H2><CENTER>Add a New Patron
</CENTER></H2>
<FORM METHOD="post" action="library3.php">
<P>
<HR>
<CENTER>

<?php
/* Connect to MySQL */
$link = mysql_connect ("Services1.mcs.sdsmt.edu", "s7032956f14", "change_me")or
  die("Unable to connect");

/* Select MySQL database */
  mysql_select_db("db_7032956f14") or die("Unable to select the database");

if (!isset($_POST['patronID']))
{
   $patronID=0;
}
else
{
   $patronID = $_POST['patronID'];
}

if (isset($_POST['add']))
{
   $patronName = $_POST['patronName'];
   $patronType = $_POST['patronType'];
   
   $query = "INSERT INTO Patron VALUES('$patronID', '$patronName', '$patronType')";
   $res = mysql_query($query);
   $message = "*****Record added*****";
}

elseif (isset($_POST['delete']))
{
   $query = "DELETE FROM Patron WHERE patronID = $patronID";
   $res = mysql_query($query);
   $message = "*****Record deleted*****";
}
/*
elseif (isset($_POST['update']))
{
   $name = $_POST['name'];
   $type = $_POST['type'];
 
  $query = "UPDATE Patron SET patronName='$name', patronType='$type' WHERE patronID = $id";
   $res = mysql_query($query);
   $message = "*****Record updated*****";
}
*/

$patronName = trim($patronName);
$patronType = trim($patronType);

mysql_close($link);
?>

<BR> Patron ID:
<BR><INPUT TYPE="TEXT" NAME="patronID"
    <?php echo "VALUE=\"$patronID\"" ?>>
<BR>
<BR> Name:
<BR><INPUT TYPE="TEXT" NAME="patronName"
    <?php echo "VALUE=\"$patronName\"" ?>>
<BR>
<BR> Type:
<BR><INPUT TYPE="TEXT" NAME="patronType"
    <?php echo "VALUE=\"$patronType\"" ?>>
	
<BR>
<BR>
<INPUT TYPE="SUBMIT" NAME="add"     VALUE="Add">
<INPUT TYPE="SUBMIT" NAME="delete"     VALUE="Delete">

<?php
if (isset($_POST['message']))
{
   echo "<BR><BR>$message";
}

?>

<BR>
<BR>
<a href = library.html>Return to Main Web Page</a>
</CENTER>
</FORM>
</BODY>
</HTML>
