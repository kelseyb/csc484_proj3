<HTML>
<HEAD>
<TITLE>Update Books</TITLE>
</HEAD>

<BODY bgcolor = lavender>
<H2><CENTER>Update Books
</CENTER></H2>
<FORM METHOD="post" action="library4.php">
<P>
<HR>
<CENTER>

<?php
/* Connect to MySQL */
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
   $title = $_POST['title'];
	
   $q1 = "SELECT copyNo, title, author, libName FROM CopyBook, Book, Author, Library WHERE title LIKE '%$title%' AND copyID > $id"; 

   $res = mysql_query($q1);
   $row = mysql_fetch_row($res);
   if ($row[0] > 0)
   {
       $id = $row[0]; //copyNo
       $title = $row[1];
	   $author = $row[2]; 
	   $libName = $row[3];
	   
	   $q2 = "SELECT copyNo, patronID FROM loan, WHERE copyNo = $id"; /*mebe*/
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
     $res1 = mysql_query($query);
     $message = "*****Record added*****";
   }
}

//$name = trim($name);
//$type = trim($type);

mysql_close($link);
?>

<BR> Copy Number:
<BR><INPUT TYPE="TEXT" NAME="copyNo"
    <?php echo "VALUE=\"$id\"" ?>>
<BR>
<BR> Title:
<BR><INPUT TYPE="TEXT" NAME="title"
    <?php echo "VALUE=\"$title\"" ?>>
<BR>
<BR> Author:
<BR><INPUT TYPE="TEXT" NAME="authorName"
    <?php echo "VALUE=\"$author\"" ?>>
<BR>
<BR> Library:
<BR><INPUT TYPE="TEXT" NAME="type"
    <?php echo "VALUE=\"$libName\"" ?>>
<BR>
<BR> Available:
<BR><INPUT TYPE="TEXT" NAME="type"
    <?php echo "VALUE=\"$available\"" ?>>
<BR>
<BR> PatronID:
<BR><INPUT TYPE="TEXT" NAME="patronID"
    <?php echo "VALUE=\"$patronID\"" ?>>
<BR>
<BR>

<INPUT TYPE="SUBMIT" NAME="left" VALUE="<">
<INPUT TYPE="SUBMIT" NAME="right" VALUE=">">
<INPUT TYPE="SUBMIT" NAME="search" VALUE="Search">

<BR>
<BR>
<INPUT TYPE="SUBMIT" NAME="loan" VALUE="Loan">

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
