<HTML>
<HEAD>
<TITLE>Update Books</TITLE>
</HEAD>

<BODY bgcolor = wheat>
<H2><CENTER>Update Books
</CENTER></H2>
<FORM METHOD="post" action="library4.php">
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

if (isset($_POST['left']))
{
  $q1 = "SELECT copyNo, title, author, libName FROM CopyBook, Book, Author, Library WHERE copyNo <$id ORDER BY copyNo DECS";

   $res = mysql_query($q1);
   $row = mysql_fetch_row($res);
   
   if ($row[0] > 0)
   {
       $id = $row[0]; //copyNo
       $title = $row[1];
	   $author = $row[2]; 
	   $libName = $row[3];
	   
	   $q2 = "SELECT copyNo, patronID FROM loan, WHERE copyNo = $id"; //mebe
	   $res1 = mysql_query($q2);
	   $row1 = mysql_fetch_row($res1);
	   if($row1[0]<0)
	   {
	     $avaiabile = "true";
		 $patronID = 0;
	   }
	   else
	   {
	     $available = "false";
		 $patronID = $row1[1];
	   }
    }
}

elseif (isset($_POST['right']))
{
   $q1 = "SELECT copyNo, title, author, libName FROM CopyBook, Book, Author, Library WHERE copyNo <$id ORDER BY copyNo ASC";

   $res = mysql_query($q1);
   $row = mysql_fetch_row($res);
   
   if ($row[0] > 0)
   {
       $id = $row[0]; //copyNo
       $title = $row[1];
	   $author = $row[2]; 
	   $libName = $row[3];
	   
	   $q2 = "SELECT copyNo, patronID FROM loan, WHERE copyNo = $id"; //mebe
	   $res1 = mysql_query($q2);
	   $row1 = mysql_fetch_row($res1);
	   if($row1[0]<0)
	   {
	     $avaiabile = "true";
		 $patronID = 0;
	   }
	   else
	   {
	     $available = "false";
		 $patronID = $row1[1];
	   }
    }
}

elseif (isset($_POST['search']))
{
   $id = 0;
   $title = $_POST['title']
	
   $q1 = "SELECT copyNo, title, author, libName FROM CopyBook, Book, Author, Library WHERE title LIKE '%$title%' AND copyID > $id"; 

   //$query = "SELECT patronID, patronName, patronType, FROM Patron WHERE patronName LIKE '%$name%' AND patronID > $id";
   //$query = "SELECT MEMBERID, FNAME, LNAME, ADDRESS, DATEJOINED, PHONENO FROM Member WHERE FNAME LIKE '%$fname%' AND LNAME LIKE '%$lname%' AND MEMBERID > $id";
   $res = mysql_query($q1);
   $row = mysql_fetch_row($res);
   if ($row[0] > 0)
   {
       $id = $row[0]; //copyNo
       $title = $row[1];
	   $author = $row[2]; 
	   $libName = $row[3];
	   
	   $q2 = "SELECT copyNo, patronID FROM loan, WHERE copyNo = $id"; //mebe
	   $res1 = mysql_query($q2);
	   $row1 = mysql_fetch_row($res1);
	   if($row1[0]<0)
	   {
	     $avaiabile = "true";
		 $patronID = 0;
	   }
	   else
	   {
	     $available = "false";
		 $patronID = $row1[1];
	   }
    }
}

elseif (isset($_POST['loan']))
{
   $loanNo = 12; //i dunno;
   $copyNo = $_POST['copyNo'];
   $checkOutDate = date("Y-m-d");
   $dueDate = date("Y-m-d", strtotime('+1 month'));
   $available = $_POST;
   
   /*check if patron has three books*/
   $q1 = "SELECT COUNT(*) FROM Loans WHERE patronID = $patronID";
   
   $res = mysql_query($q1);
   $row = mysql_fetch_row($res);
   if ($row[0] > 2) //i think that's right.
   {
     $message = "*****Patron has 3 books checked out already*****";
   }
   else if($available = "false")
   {
     $message = "*****Book is already checked out*****";
   }
   else
   {
     $query = "INSERT INTO Loan(loanNo, copyNo, patronNo, checkOutDate, dueDate) VALUES('$loanNo', '$copyNo', '$patronNo', '$checkOutDate', '$dueDate')"; 
   
     $query = "INSERT INTO Patron (patronID, patronName, patronType) VALUES('$id', '$name', '$type')";
     //$query = "INSERT INTO Member (MEMBERID, FNAME, LNAME, ADDRESS, DATEJOINED, PHONENO) VALUES('$id','$fname','$lname','$address','$djoined','$phoneno')";
     $res1 = mysql_query($query);
     $message = "*****Record added*****";
   }
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

<INPUT TYPE="SUBMIT" NAME="left"     VALUE="<">
<INPUT TYPE="SUBMIT" NAME="right"     VALUE=">">
<INPUT TYPE="SUBMIT" NAME="search"     VALUE="Search">

<BR>
<BR>
<INPUT TYPE="SUBMIT" NAME="loan"     VALUE="Loan">

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
