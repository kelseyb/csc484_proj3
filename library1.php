<HTML>
<HEAD>
<TITLE>Test PHP-MySQL-2008</TITLE>
</HEAD>

<BODY bgcolor = wheat>
<H2><CENTER>Display Loaned Books
</CENTER></H2>
<FORM METHOD="post" action="library11.php">
<P>
<CENTER>

<?php
/* Connect to MySQL */


$link = mysql_connect ("Services1.mcs.sdsmt.edu", "s7032956f14", "change_me") or
  die("Unable to connect");

/* Select MySQL database */
mysql_select_db("db_7032956f14") or die("Unable to select the database");

$res = mysql_query("Select distinct status from Library");

$num = mysql_numrows($res);


?>

<TABLE>
<TR><TH><strong> Select Patron </strong></TH></TR>
<TR><TD valign = top>
<SELECT size=<?php echo $num;?> id=status name=status>
<?php
/* Display each distinct STATUS value stored in the database */
for ($i = 0; $i < $num; $i++)
{
   $row=mysql_fetch_row($res);
   echo "<option> $row[0] </option>";
}
mysql_close($link);
?>

</SELECT></TD>
</TR>
</TABLE>


<P>
<INPUT TYPE="SUBMIT" VALUE="Execute SQL statement...">
<INPUT TYPE="RESET"  VALUE="Clear...">
<P>
</CENTER>
</FORM>
</BODY>
<HTML>
