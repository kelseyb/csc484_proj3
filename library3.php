<HTML>
<HEAD>
<TITLE>Add a New Patron</TITLE>
</HEAD>

<BODY bgcolor = wheat>
<H2><CENTER>Add a New Patron
</CENTER></H2>
<FORM METHOD="post" action="library3.php">
<P>
<HR>
<CENTER>

<?php
/* Connect to MySQL */

//this probably needs fixed
$link = mysql_connect ("Services1.mcs.sdsmt.edu", "s7032956f14", "change_me")or
  die("Unable to connect");

/* Select MySQL database */
  mysql_select_db("db_7032956f14") or die("Unable to select the database");

if (!isset($_POST['id']))
{
   $id=0;
}
else
{
   $id = $_POST['id'];
}

elseif (isset($_POST['add']))
{
   $name = $_POST['name'];
   $type = $_POST['type'];
   //$fname = $_POST['fname'];
   //$lname = $_POST['lname'];
   //$address = $_POST['address'];
   //$djoined = $_POST['djoined'];
   //$phoneno = $_POST['phoneno'];
   
   $query = "INSERT INTO Patron (patronID, patronName, patronType) VALUES('$id', '$name', '$type')";
   //$query = "INSERT INTO Member (MEMBERID, FNAME, LNAME, ADDRESS, DATEJOINED, PHONENO) VALUES('$id','$fname','$lname','$address','$djoined','$phoneno')";
   $res = mysql_query($query);
   $message = "*****Record added*****";
}

elseif (isset($_POST['delete']))
{
   //$query = "DELETE FROM Member WHERE MEMBERID = $id";
   $query = "DELETE FROM Patron WHERE patronID = $id";
   $res = mysql_query($query);
   $message = "*****Record deleted*****";
}

elseif (isset($_POST['update']))
{
   $name = $_POST['name'];
   $type = $_POST['type'];
 //  $fname = $_POST['fname'];
	// $lname = $_POST['lname'];
 //  $address = $_POST['address'];
 //  $djoined = $_POST['djoined'];
 //  $phoneno = $_POST['phoneno'];
 
  $query = "UPDATE Patron SET patronName='$name', patronType='$type' WHERE patronID = $id";
   //$query = "UPDATE Member SET FNAME='$fname', LNAME='$lname', ADDRESS='$address', DATEJOINED='$djoined', PHONENO='$phoneno' WHERE MEMBERID = $id";
   $res = mysql_query($query);
   $message = "*****Record updated*****";
}

$name = trim($name);
$type = trim($type);
// $fname = trim($fname);
// $lname = trim($lname);
// $address = trim($address);
// $djoined = trim($djoined);
// $phoneno = trim($phoneno);

mysql_close($link);
?>

<BR> Patron ID:
<BR><INPUT TYPE="TEXT" NAME="id"
    <?php echo "VALUE=\"$id\"" ?>>
<BR>
<BR> Name:
<BR><INPUT TYPE="TEXT" NAME="name"
    <?php echo "VALUE=\"$name\"" ?>>
<BR>
<BR> Type:
<BR><INPUT TYPE="TEXT" NAME="type"
    <?php echo "VALUE=\"$type\"" ?>>
	
<BR>
<BR>
<INPUT TYPE="SUBMIT" NAME="add"     VALUE="Add">
<INPUT TYPE="SUBMIT" NAME="update"     VALUE="Update">
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
<HTML>
