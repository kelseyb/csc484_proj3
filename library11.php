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

  $result = mysql_query("Select loanNo, title, authorName from Loan, CopyBook, Patron, Book, Author
WHERE Loan.patronNo = Patron.patronNo AND CopyBook.copyNo = Loan.copyNo AND
Book.bookNo = CopyBook.bookNo AND Book.authorNo = Author.authorNo AND patronName = '$status'");

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

mysql_close($link);
?>

</TABLE>
<BR>
<BR>
<a href = library.html>Return to Main Web Page</a>
</BODY>
</HTML>
