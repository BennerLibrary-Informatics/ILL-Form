<?php
	// Verify that an Olivet email was provided
	$email = (isset($_REQUEST['email'])) ? $_REQUEST['email'] : "";
	$emailSplit = explode("@",$email);
	if(count($emailSplit) != 2 || $emailSplit[1] != "olivet.edu")
	{
		header("index.php");
		exit;
	}
?>

<?php
   $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "/class/sendmail.php";
   include_once($path);
?>

<script>
function goBack2() {
    window.history.go(-2)
}
</script>

<!-- ===== content below here - header above ========================================================== -->

<?php
// Change the second parameter to use your institution's SMTP server.
ini_set("SMTP", "mail.example.com");

// Address to use in the "to" part of the header.
$SENDTO_ADDRESS = "email address sent to";

// Contact hyperlink to use on your confirmation page.
$EMAIL_LINK = '<a href="mailto:someone@example.com">Interlibrary Loan</a>';

// Phone number to contact your institution.
$CONTACT_PHONE = "815-867-5309";

// Support hyperlink to use on your error page.
$SUPPORT_LINK = "someone@example.com";

// Link to your institution's homepage
$HOMEPAGE_LINK = "<a href='http://home.example.com'>Institution Name</a>";

// Name to use in the "to" part of the header.
$SENDTO_NAME = "InterLibrary Loan";

// Subject of the Email. This is the title of the email seen by your ILL dept.
$SET_SUBJECT = "ILL Request";

// If the variable exists, store it to be printed in the message. Else, store ""
$first_name = (isset($_REQUEST['first_name'])) ? $_REQUEST['first_name'] : "";
$last_name = (isset($_REQUEST['last_name'])) ? $_REQUEST['last_name'] : "";
$email = (isset($_REQUEST['email'])) ? $_REQUEST['email'] : "";
$student_id = (isset($_REQUEST['student_id'])) ? $_REQUEST['student_id'] : "";
$department = (isset($_REQUEST['department'])) ? $_REQUEST['department'] : "";
$course = (isset($_REQUEST['course'])) ? $_REQUEST['course'] : "";
$status = (isset($_REQUEST['status'])) ? $_REQUEST['status'] : "";
$address = (isset($_REQUEST['address'])) ? str_replace("\n", "\n\t\t", $_REQUEST['address']) : "";
$phone = (isset($_REQUEST['phone'])) ? $_REQUEST['phone'] : "";
$date_needed = (isset($_REQUEST['date_needed'])) ? $_REQUEST['date_needed'] : "";
$comments = (isset($_REQUEST['comments'])) ? str_replace("\n", "\n\t\t", $_REQUEST['comments']) : "";
$database = (isset($_REQUEST['database'])) ? $_REQUEST['database'] : "";
$costopt = (isset($_REQUEST['costOpt'])) ? "Cost Required:\t".$_REQUEST['costOpt'] : "";
$costopth =  (isset($_REQUEST['costOpt'])) ? $_REQUEST['costOpt'] : "";
$title = (isset($_REQUEST['title'])) ? $_REQUEST['title'] : "";
$author = (isset($_REQUEST['author'])) ? $_REQUEST['author'] : "";
$source = (isset($_REQUEST['source'])) ? $_REQUEST['source'] : "";
$publisher = (isset($_REQUEST['pub'])) ? $_REQUEST['pub'] : "";
$place = (isset($_REQUEST['place'])) ? $_REQUEST['place'] : "";
$date = (isset($_REQUEST['date'])) ? $_REQUEST['date'] : "";
$issn = (isset($_REQUEST['issn'])) ? $_REQUEST['issn'] : "";
$isbn = (isset($_REQUEST['isbn'])) ? $_REQUEST['isbn'] : "";
$series = (isset($_REQUEST['series'])) ? $_REQUEST['series'] : "";
$volume = (isset($_REQUEST['volume'])) ? $_REQUEST['volume'] : "";
$issue = (isset($_REQUEST['issue'])) ? $_REQUEST['issue'] : "";
$start_page = (isset($_REQUEST['start_page'])) ? $_REQUEST['start_page'] : "";

// Used to generate the random multipart boundary code.
$semi_rand = md5(time());
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

// Email headers
$to         = $SENDTO_NAME . ' ' . '<' . $SENDTO_ADDRESS . '>';
$from       = $first_name . ' ' . $last_name . ' <' . $email . '>';
$subject    = $SET_SUBJECT;
$headers    = 'From:' . $from . "\r\n";
$headers   .= 'MIME-Version: 1.0' . "\r\n";



// Set the message variable (which is passed to the mail function)
//   to initially empty string
$message = '';

//   contactenate the HTML message.
$message .="
<h2 style='margin-top:0'>Benner - InterLibrary Loan Request</h2>
<table>
    <tr><td colspan='2'><h3>Patron Information</h3></td></tr>
    <tr><td><b>Name:</b></td><td>". $first_name ." ". $last_name ."</td></tr>
    <tr><td><b>Email:</b></td><td>". $email ."</td></tr>
    <tr><td><b>Student ID:</b></td><td>". $student_id ."</td></tr>
    <tr><td><b>Department:</b></td><td>". $department ."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Course: </b>". $course ."</td></tr>
    <tr><td><b>Status:</b></td><td>". $status ."</td></tr>
    <tr><td><b>Phone:</b></td><td>". $phone ."</td></tr>
    <tr><td><b>Address:</b></td><td>". $address ."</td></tr>
    <tr><td colspan='2'>&nbsp;</td></tr>
    <tr><td colspan='2'><h3>Item Details<h3></td></tr>
    <tr><td><b>Title:</b></td><td>". $title ."</td></tr>
    <tr><td><b>Author:</b></td><td>". $author ."</td></tr>
    <tr><td><b>Source:</b></td><td>". $source ."</td></tr>
    <tr><td><b>Publisher:</b></td><td>". $publisher ."</td></tr>
    <tr><td><b>Place Published:</b></td><td>". $place ."</td></tr>
    <tr><td><b>ISSN:</b></td><td>". $issn ."</td></tr>
    <tr><td><b>ISBN:</b></td><td>". $isbn ."</td></tr>
    <tr><td><b>Series Title:</b></td><td>". $series ."</td></tr>
    <tr><td><b>Volume:</b></td><td>". $volume ."</td></tr>
    <tr><td><b>Issue:</b></td><td>". $issue ."</td></tr>
    <tr><td><b>Date:</b></td><td>". $date ."</td></tr>
    <tr><td><b>Page Numbers:</b></td><td>". $start_page ."</td></tr>
    <tr><td colspan='2'>&nbsp;</td></tr>
    <tr><td><b>Date Needed:</b></td><td>". $date_needed ."</td></tr>
    <tr><td><b>Database Used:</b></td><td>". $database ."</td><td>(as entered by patron)</td></tr>
    <tr><td><b>Comments:</b></td><td>". $comments ."</td></tr>
	<tr><td><b>Cost incurred:</b></td><td>". $costopth ."</td></tr>
</table>
</body>";
$to_email=$SENDTO_ADDRESS;
$to_name=$SENDTO_NAME;
$from_name=$first_name . ' ' . $last_name;
$from_email=$email;
$newLine="\r\n";
$header = "MIME-Version: 1.0".$newLine;
$header .= "Content-type: text/html; charset=iso-8859-1".$newLine;
$header .= "To: ".$to_name." <".$to_email."> ".$newLine;
$header .= "From: ".$first_name . ' ' . $last_name." <".$email.">".$newLine;

if (Sendmail($to_name,$to_email,$from_name,$from_email,$subject,$message,$header)) {
    echo "<h1>Request sent</h1>";
    echo "<p>Your request is being processed. You will be notified when your ";
    echo "materials arrive. If you have any questions, please contact ";
    echo $EMAIL_LINK . " or " . $CONTACT_PHONE . ".</p>";
} else {
    echo "<h1>An error occured while processing your request</h1>";
    echo "<p>Please try your request again later. If the problem persists ";
    echo "please contact " . $SUPPORT_LINK . "</p>";
}

?>

<p><a href="javascript:goBack2()">Click here</a> to return to what you were previously doing.</p>

<!-- ===== content above here footer below here ========================================================== -->
