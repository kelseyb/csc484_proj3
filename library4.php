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
   $q1 = "SELECT copyNo, title, authorName, libName FROM Book, Author, CopyBook, Library
	WHERE Book.authorNo = Author.authorNo AND copyNo < $id AND 
	CopyBook.bookNo = Book.bookNo AND Library.libNo = CopyBook.libNo
	ORDER BY copyNo DESC";
	
   $res = mysql_query($q1);
   $row = mysql_fetch_row($res);
   
   if ($row[0] > 0)
   {
	    $id = $row[0]; //copyNo
	    $title = $row[1];
	    $authorName = $row[2]; 
	    $libName = $row[3];
	   
		$result = mysql_query("SELECT patronNo FROM Loan WHERE copyNo = '$row[0]'");
		$row1 = mysql_fetch_row($result); 
		if ($row1[0] > 0)
		{
			$available = 'No';
			$patronID = $row1[0];
		}
		else
		{
			$available = "Yes";
			$patronID = "";
		}
    }
	else
	{
		$id = 0; 
	}
}

elseif (isset($_POST['right']))
{
    $q1 = "SELECT copyNo, title, authorName, libName FROM Book, Author, CopyBook, Library
	WHERE Book.authorNo = Author.authorNo AND copyNo > $id AND 
	CopyBook.bookNo = Book.bookNo AND Library.libNo = CopyBook.libNo
	ORDER BY copyNo ASC";
	
   $res = mysql_query($q1);
   $row = mysql_fetch_row($res);
   
   if ($row[0] > 0)
   {
        $id = $row[0]; //copyNo
        $title = $row[1];
	    $authorName = $row[2]; 
	    $libName = $row[3];
	  
		$result = mysql_query("SELECT patronNo FROM Loan WHERE copyNo = '$row[0]'");
		$row1 = mysql_fetch_row($result); 
		if ($row1[0] > 0)
		{
			$available = 'No';
			$patronID = $row1[0];
		}
		else
		{
			$available = 'Yes';
			$patronID = '';
		}
    }
	else
	{
		$id = 0; 
	}
}

elseif (isset($_POST['search']))
{
	$id = 0;
	$title = $_POST['title'];
	
	$res = mysql_query("SELECT copyNo, title, authorName, libName FROM Book, Author, CopyBook, Library
	WHERE title LIKE '%$title%' AND Book.authorNo = Author.authorNo AND 
	CopyBook.bookNo = Book.bookNo AND Library.libNo = CopyBook.libNo");
	
	$row = mysql_fetch_row($res);
	if ($row[0] > 0)
	{
		$id = $row[0]; 
		$title = $row[1];
		$authorName = $row[2]; 
		$libName = $row[3]; 
		   
		$result = mysql_query("SELECT patronNo FROM Loan WHERE copyNo = '$row[0]'");
		$row1 = mysql_fetch_row($result); 
		if ($row1[0] > 0)
		{
			$available = 'No';
			$patronID = $row1[0];
		}
		else
		{
			$available = 'Yes';
			$patronID = '';
		}
	}
}

elseif (isset($_POST['loan']))
{
	//check if book is checkout out 
	$available = $_POST['available']; 
	$id = $_POST['id'];
	$title = $_POST['title'];
	$authorName = $_POST['authorName'];
	$libName = $_POST['libName'];

	//check if patron exists
	$patronID = $_POST['patronID'];
	$q1 = "SELECT COUNT(*) FROM Patron WHERE patronNo = $patronID"; 
	$res1 = mysql_query($q1);
	$row1 = mysql_fetch_row($res1); 
	
	//check that patron does not have 3 or more loans
	$q2 = "SELECT COUNT(*) FROM Loan WHERE patronNo = $patronID";
	$res2 = mysql_query($q2);
	$row2 = mysql_fetch_row($res2);
	if ($available != 'Yes')
	{
		$message = "***Book is already checked out***";  
	}
	else if($row1[0] == 0)
	{
		$message = "***Patron does not exist***";
	}
	else if($row2[0] > 2)
	{
		$message = "*****Patron has 3 books checked out already*****";
	}
	else
	{
		//get a checkout date
		$checkOutDate = date("d-m-Y");
		$dueDate = date("d-m-Y", strtotime('+1 month'));
		
		//get a loan number 
		$query = "SELECT loanNo from Loan ORDER BY loanNo DESC";
		$res3 = mysql_query($query); 
		$row3 = mysql_fetch_row($res3); 
		$loanNo = intval($row3[0], 10) + 1; 

		$q4 = "INSERT INTO Loan(loanNo, copyNo, patronNo, checkOutDate, dueDate) VALUES('$loanNo', '$id', '$patronID', '$checkOutDate', '$dueDate')"; 
		$res4 = mysql_query($q4);
		$available = 'No'; 
		$message = "*****Record added*****";
	}

}
else if (isset($_POST['delete']))
{
	//check if book is checkout out 
	$available = $_POST['available']; 
	$id = $_POST['id'];
	$title = $_POST['title'];
	$authorName = $_POST['authorName'];
	$libName = $_POST['libName'];
	$patronID = $_POST['patronID']; 
	
	$q1 = "DELETE FROM Loan WHERE patronNo = $patronID AND copyNo = $id"; 
	$res = mysql_query($q1); 
	$message = "***Loan Removed***"; 
	$available = 'Yes';
	$patronID = ''; 


}


mysql_close($link);
?>

<BR> Copy Number:
<BR><INPUT TYPE="TEXT" NAME="id"
    <?php echo "VALUE=\"$id\"" ?>>
<BR>
<BR> Title:
<BR><INPUT TYPE="TEXT" NAME="title"
    <?php echo "VALUE=\"$title\"" ?>>
<BR>
<BR> Author:
<BR><INPUT TYPE="TEXT" NAME="authorName"
    <?php echo "VALUE=\"$authorName\"" ?>>
<BR>
<BR> Library:
<BR><INPUT TYPE="TEXT" NAME="libName"
    <?php echo "VALUE=\"$libName\"" ?>>
<BR>
<BR> Available:
<BR><INPUT TYPE="TEXT" NAME="available"
    <?php echo "VALUE=\"$available\"" ?>>
<BR>
<BR> PatronID:
<BR><INPUT TYPE="TEXT" NAME="patronID"
    <?php echo "VALUE=\"$patronID\"" ?>>
<BR>
<BR> Message:
	<?php echo $message ?>
<BR>
<BR>

<INPUT TYPE="SUBMIT" NAME="left" VALUE="<">
<INPUT TYPE="SUBMIT" NAME="right" VALUE=">">
<INPUT TYPE="SUBMIT" NAME="search" VALUE="Search">

<BR>
<BR>
<INPUT TYPE="SUBMIT" NAME="loan" VALUE="Add Loan">
<INPUT TYPE="SUBMIT" NAME="delete" VALUE="Remove Loan">

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
