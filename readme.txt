Deployment Instruction

1.	Download command-line SSH tool putty and/or GUI SSH/FTP tool Bit from F:\Dept\MCS\CSC484, and install them on your windows machine.
2.	Log into Linux101.mcs.sdsmt.edu using the tool install in step 1 with your ID# and Password (This password may be different from the ones for your university account and mysql database).
3.	Create a ¡°www¡± folder in your home directory. Then issue the commands ¡°chmod o+x¡±, ¡°chmod o+rx www¡± to grant appropriate permissions. 
4.	Add web pages to the www folder.
5.	Run the command ¡° mysql  -u   sn...nf14   -h services1.mcs.sdsmt.edu -p    db_n¡­nf14¡± form Linux terminal, where n¡­n is your student ID. The initial password for mysql is ¡°change_me¡±.

6.	Use the command ¡°mysql> SET PASSWORD = PASSWORD('new_password'); ¡° to change your password for mysql (keep it for later use)

7.	Donwload mysql workbench from F:\Dept\MCS\CSC484 and Install it to your windows machine.

8.	Create a new connect in workbench for services1.mcs.sdsmt.edu using your username sn...nf14   and your mysql password.

9.	Run the scripts ¡°create_VIDEOS.sql¡± and ¡°populate_VIDEOS.sql¡± to create and populate the example videostore database 

10.	Modify and configure the mysql database connection information in the all web pages where need database operation. Change ¡°USERNAME¡± to ¡°sn...nf14¡±, change ¡°PASSWORD¡± to ¡°your password¡±, and change ¡°DATABASE¡± to ¡°db_n¡­nf14¡±

11.	Visit the example web pages at http://dev.mcs.sdsmt.edu/~nnnnnnnnn/videostore.html with your ID# replacing ¡°nnnnnnn¡±.  






