<HTML>
<HEAD>
<TITLE>Update members</TITLE>
</HEAD>

<BODY bgcolor = wheat>
<H2><CENTER>Update Members
</CENTER></H2>
<FORM METHOD="post" action="videostore3.php">
<P>
<HR>
<CENTER>

<?php
/* Connect to MySQL */

$link = mysql_connect ("Services1.mcs.sdsmt.edu", "USERNAME", "PASSWORD")or
  die("Unable to connect");

/* Select MySQL database */
  mysql_select_db("DATABASE") or die("Unable to select the database");

if (!isset($_POST['id']))
{
   $id=0;
}
else
{
   $id = $_POST['id'];
}

if (isset($_POST['left']))
{

   $query = "SELECT MEMBERID, FNAME, LNAME, ADDRESS, DATEJOINED, PHONENO FROM Member WHERE MEMBERID < $id ORDER BY MEMBERID DESC";
   $res = mysql_query($query);
   $row = mysql_fetch_row($res);
   if ($row[0] > 0)
   {
       $id      = $row[0];
       $fname   = $row[1];
	 $lname   = $row[2];
       $address = $row[3];
       $djoined = $row[4];
       $phoneno = $row[5];
    }
}

elseif (isset($_POST['right']))
{
   $query = "SELECT MEMBERID, FNAME, LNAME, ADDRESS, DATEJOINED, PHONENO FROM Member WHERE MEMBERID > $id ORDER BY MEMBERID ASC";
   $res = mysql_query($query);
   $row = mysql_fetch_row($res);
   if ($row[0] > 0)
   {
       $id      = $row[0];
       $fname   = $row[1];
	 $lname   = $row[2];
       $address = $row[3];
       $djoined = $row[4];
       $phoneno = $row[5];
    }
}

elseif (isset($_POST['search']))
{
   $id = 0;
   $fname = $_POST['fname'];
	$lname = $_POST['lname'];
   $query = "SELECT MEMBERID, FNAME, LNAME, ADDRESS, DATEJOINED, PHONENO FROM Member WHERE FNAME LIKE '%$fname%' AND LNAME LIKE '%$lname%' AND MEMBERID > $id";
   $res = mysql_query($query);
   $row = mysql_fetch_row($res);
   if ($row[0] > 0)
   {
       $id      = $row[0];
       $fname   = $row[1];
	 $lname   = $row[2];
       $address = $row[3];
       $djoined = $row[4];
       $phoneno = $row[5];
    }
}

elseif (isset($_POST['add']))
{$fname = $_POST['fname'];
	$lname = $_POST['lname'];
   $address = $_POST['address'];
   $djoined = $_POST['djoined'];
   $phoneno = $_POST['phoneno'];
   $query = "INSERT INTO Member (MEMBERID, FNAME, LNAME, ADDRESS, DATEJOINED, PHONENO) VALUES('$id','$fname','$lname','$address','$djoined','$phoneno')";
   $res = mysql_query($query);
   $message = "*****Record added*****";
}

elseif (isset($_POST['delete']))
{
   $query = "DELETE FROM Member WHERE MEMBERID = $id";
   $res = mysql_query($query);
   $message = "*****Record deleted*****";
}

elseif (isset($_POST['update']))
{
   $fname = $_POST['fname'];
	$lname = $_POST['lname'];
   $address = $_POST['address'];
   $djoined = $_POST['djoined'];
   $phoneno = $_POST['phoneno'];
   $query = "UPDATE Member SET FNAME='$fname', LNAME='$lname', ADDRESS='$address', DATEJOINED='$djoined', PHONENO='$phoneno' WHERE MEMBERID = $id";
   $res = mysql_query($query);
   $message = "*****Record updated*****";
}


$fname = trim($fname);
$lname = trim($lname);
$address = trim($address);
$djoined = trim($djoined);
$phoneno = trim($phoneno);

mysql_close($link);
?>

<BR> Member ID:
<BR><INPUT TYPE="TEXT" NAME="id"
    <?php echo "VALUE=\"$id\"" ?>>
<BR>
<BR> First Name:
<BR><INPUT TYPE="TEXT" NAME="fname"
    <?php echo "VALUE=\"$fname\"" ?>>
<BR>
<BR> Last Name:
<BR><INPUT TYPE="TEXT" NAME="lname"
    <?php echo "VALUE=\"$lname\"" ?>>
<BR>
<BR> Address:
<BR><INPUT TYPE="TEXT" NAME="address"
    <?php echo "VALUE=\"$address\"" ?>>
<BR>
<BR> Date Joined (yyyy-mm-dd):
<BR><INPUT TYPE="TEXT" NAME="djoined"
    <?php echo "VALUE=\"$djoined\"" ?>>
<BR>
<BR> Phone Number (xxx-xxx-xxxx):
<BR><INPUT TYPE="TEXT" NAME="phoneno"
    <?php echo "VALUE=\"$phoneno\"" ?>>
<BR>
<BR>

<INPUT TYPE="SUBMIT" NAME="left"     VALUE="<">
<INPUT TYPE="SUBMIT" NAME="right"     VALUE=">">
<INPUT TYPE="SUBMIT" NAME="search"     VALUE="Search">

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
<a href = videostore.html>Return to Main Web Page</a>
</CENTER>
</FORM>
</BODY>
<HTML>
