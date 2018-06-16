<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XKeyMail - secure-password.net</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,80">
    <link rel="stylesheet" href="assets/fonts/material-icons.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Simple-Footer.css">
</head>

<body>
    <div class="jumbotron">
        <h1 class="text-center">XKeyMail <i class="material-icons" id="mail_icon">mail_outline</i></h1></div>
    <div class="container">
        <form class="bootstrap-form-with-validation" method="POST" action="audit_statistic.php">
            <h2 class="text-center">Input selector</h2>
            <div class="form-group">
                <label class="control-label" for="text-input">To: </label>
                <div class="checkbox">
                 <label class="control-label">
                  <input type="checkbox" name="cb1" value="value_cb1"/>
                  <strong>Show whole "TO List"</strong>
                 </label>
                </div>
                <div class="checkbox">
                 <label class="control-label">
                  <input type="checkbox" name="cb2" value="value_cb2"/>
                  <strong>Show whole "CC List"</strong>
                 </label>
                </div>
                <div class="checkbox">
                 <label class="control-label">
                  <input type="checkbox" name="cb3" value="value_cb3"/>
                  <strong>Show whole "BCC List"</strong>
                 </label>
                </div>
                <input class="form-control" type="text" name="TO-MAIL" placeholder="test-to@domain.com" id="text-input" value="<?php echo htmlspecialchars($_POST['TO-MAIL']); ?>">
            </div>
            <div class="form-group">
                <label class="control-label" for="text-input">From: </label>
                <input class="form-control" type="text" name="FROM-MAIL" placeholder="test-from@domain.com" id="text-input" value="<?php echo htmlspecialchars($_POST['FROM-MAIL']); ?>">
            </div>
            <div class="form-group">
                <label class="control-label" for="text-input">Date from:</label>
                <input class="form-control" type="text" name="DATE-FROM" placeholder="20/03/2016" id="text-input" value="<?php echo htmlspecialchars($_POST['DATE-FROM']); ?>">
            </div>
            <div class="form-group">
                <label class="control-label" for="text-input">Date to:</label>
                <input class="form-control" type="text" name="DATE-TO" placeholder="26/07/2017" id="text-input" value="<?php echo htmlspecialchars($_POST['DATE-TO']); ?>">
            </div>
            <div class="form-group">
                <label class="control-label" for="textarea-input">String: </label>
                <textarea class="form-control" name="STRING_SEARCH" placeholder="Please write string which you are looking for." id="textarea-input"><?php echo htmlspecialchars($_POST['STRING_SEARCH']); ?></textarea>
            </div>
            <div class="form-group"></div>
            <div class="form-group"></div>
            <div class="form-group">
               <!-- <p class="form-static-control">comment</p> -->
            </div>
            <div class="form-group" id="search_button">
                <button class="btn btn-default btn-lg" type="submit" name="sub_butt" id="sub_butt">Search </button>
                <button class="btn btn-default btn-lg" type="submit" name="stats_butt" id="stats_butt">Statistics</button>
            </div>
        </form>
    </div>
            <?php
/////////////////
// STATS MODE //
////////////////
if(isset($_POST['stats_butt'])) {
 $VAR_MAIL_TO = $_POST['TO-MAIL'];
 $VAR_MAIL_FROM = $_POST['FROM-MAIL'];
 $VAR_DATE_FROM = $_POST['DATE-FROM'];
 $VAR_DATE_TO = $_POST ['DATE-TO'];
 $STR_SEARCH = htmlspecialchars($_POST['STRING_SEARCH']);

echo '<div class="container">
        <form class="bootstrap-form-with-validation">
            <h2 class="text-center">Input check</h2>';

  //MAIL
  // INPUT - MAIL TO - CHECK - empty/ correct format check
   if(!isset($VAR_MAIL_TO) || trim($VAR_MAIL_TO) == '') {
 $VAR_MAIL_TO_EMPTY_err = 'empty';
 $VAR_MAIL_TO = '';
}
 if (!filter_var($VAR_MAIL_TO, FILTER_VALIDATE_EMAIL)) {
 $VAR_MAIL_TO_FORMAT_err = 'err_format';
}
 if($VAR_MAIL_TO_FORMAT_err == 'err_format' && $VAR_MAIL_TO_EMPTY_err !== 'empty') {
  $VAR_MAIL_EXIT_1 = 'EXIT';
  $MAIL_TO_MESSAGE_format = '<div class="form-group"><p style="color:#F44336";>TO: BAD FORMAT ! --> Script Exit - Debug code: 1000</p></div>';
 }elseif ($VAR_MAIL_TO_EMPTY_err == 'empty' && $VAR_MAIL_TO_FORMAT_err == 'err_format') {
  $MAIL_TO_MESSAGE_EMPTY_FORMAT = '<div class="form-group"><p style="color:#FFEB3B";>TO: is empty -- will not included in search - Debug code: 1001</p></div>';
  $MAIL_TO_BLANK = 'novalue';
 }else {
  $MAIL_TO_MESSAGE_ok = '<div class="form-group"><p style="color:#5cb85c";>TO: Input correct - Debug code: 1002</p></div>';
 }
 echo "<p> $MAIL_TO_MESSAGE_format $MAIL_TO_MESSAGE_EMPTY_FORMAT $MAIL_TO_MESSAGE_ok </p> ";

// INPUT - MAIL FROM - CHECK - empty/ correct format check
if(!isset($VAR_MAIL_FROM) || trim($VAR_MAIL_FROM) == '') {
 $VAR_MAIL_FROM_EMPTY_err = 'empty';
 $VAR_MAIL_FROM = '';
}
  if (!filter_var($VAR_MAIL_FROM, FILTER_VALIDATE_EMAIL)) {
 $VAR_MAIL_FROM_FORMAT_err = 'err_format';
}
 if($VAR_MAIL_FROM_FORMAT_err == 'err_format' && $VAR_MAIL_FROM_EMPTY_err !== 'empty') {
  $VAR_MAIL_EXIT_2 = 'EXIT';
  $MAIL_FROM_MESSAGE_format = '<div class="form-group"><p style="color:#F44336";>FROM: BAD FORMAT ! --> Script Exit - Debug code: 1003</p></div>';
 }elseif ($VAR_MAIL_FROM_EMPTY_err == 'empty' && $VAR_MAIL_FROM_FORMAT_err == 'err_format') {
  $MAIL_FROM_MESSAGE_EMPTY_FORMAT = '<div class="form-group"><p style="color:#FFEB3B";>FROM: is empty -- will not included in search - Debug code: 1004</p></div>';
  $MAIL_FROM_BLANK = 'novalue';
 }else {
  $MAIL_FROM_MESSAGE_ok = '<div class="form-group"><p style="color:#5cb85c";>FROM: Input correct - Debug code: 1005</p></div>';
 }
 echo "<p> $MAIL_FROM_MESSAGE_format $MAIL_FROM_MESSAGE_EMPTY_FORMAT $MAIL_FROM_MESSAGE_ok </p> ";

  //DATE
  // INPUT - DATE FROM - CHECK - empty
  if(!isset($VAR_DATE_FROM) || trim($VAR_DATE_FROM) == '') {
   echo "<div class=\"form-group\"><p style='color:#F44336';>DATE FROM: is empty -- DATE IS NEEDED !! --- Script Exit - Debug code: 1006 </p></div> ";
   $VAR_DATE_FROM_err = 'EXIT';
   $VAR_DATE_FROM = '';
  }
  // INPUT - DATE TO - CHECK - empty
  if (!isset($VAR_DATE_TO) || trim($VAR_DATE_TO) == '') {
   echo "<div class=\"form-group\"><p style='color:#F44336';>DATE TO: is empty -- DATE IS NEEDED !! --- Script Exit - Debug code: 1007</p></div> ";
   $VAR_DATE_TO_err = 'EXIT';
   $VAR_DATE_TO = '';
  }

  // EXIT if DATE IS EMPTY
if ( $VAR_DATE_FROM_err == 'EXIT' || $VAR_DATE_TO_err == 'EXIT' ){
 echo '<br><div class="container"><footer class="text-muted"><div class="pull-left"><span>2017 © Michal Vasko</span></div></footer></div>';
 exit;
}

 //INPUT - DATE - Validate if is correct formated !
 function validateDate($date, $format = 'd/m/Y')
 {
  $d = DateTime::createFromFormat($format, $date);
  return $d && $d->format($format) == $date;
 }
 $DATE_FROM=validateDate($VAR_DATE_FROM);
 //echo $VAR_DATE_FROM;
 if($DATE_FROM === TRUE) {
  echo "<div class=\"form-group\"><p style='color:#5cb85c';>DATE FROM - SYNTAX CHECK: OK - Debug code: 1008</p></div> ";
 }else {
  $VAR_DATE_EXIT_1 = 'EXIT';
  echo "<div class=\"form-group\"><p style='color:#F44336';>DATE FROM - SYNTAX CHECK: Bad syntax --- Script Exit - Debug code: 1009</p></div> ";
 }
 $DATE_TO=validateDate($VAR_DATE_TO);
 //echo $VAR_DATE_TO;
 if ($DATE_TO === TRUE) {
  echo "<div class=\"form-group\"><p style='color:#5cb85c';>DATE TO - SYNTAX CHECK: OK - Debug code: 1010</p></div> ";
 }else {
  $VAR_DATE_EXIT_2 = 'EXIT';
  echo "<div class=\"form-group\"><p style='color:#F44336';>DATE TO - SYNTAX CHECK: Bad syntax --- Script Exit - Debug code: 1011</p></div> ";
 }

 //EXIT if DATE or MAIL is bad formated
 if ( $VAR_DATE_EXIT_1 == 'EXIT' || $VAR_DATE_EXIT_2 == 'EXIT' || $VAR_MAIL_EXIT_1 == 'EXIT' || $VAR_MAIL_EXIT_2 == 'EXIT' ){
 echo '<br><div class="container"><footer class="text-muted"><div class="pull-left"><span>2017 © Michal Vasko</span></div></footer></div>';
 exit;
}

//CHECK - IF DATE FROM IS NOT HIGHER AS TO DATE
$ASSIGN_DELTA_DATE_1 = $VAR_DATE_TO;
$ASSIGN_DELTA_DATE_2 = $VAR_DATE_FROM;

$REGEX_DELTA_DATE_1=str_replace('/','-', $ASSIGN_DELTA_DATE_1);
$REGEX_DELTA_DATE_2=str_replace('/','-', $ASSIGN_DELTA_DATE_2);

$CONVERT_DELTA_DATE_1=date('Y-m-d', strtotime($REGEX_DELTA_DATE_1));
$CONVERT_DELTA_DATE_2=date('Y-m-d', strtotime($REGEX_DELTA_DATE_2));

if(!($CONVERT_DELTA_DATE_1 >= $CONVERT_DELTA_DATE_2)) {
 $VAR_DATE_EXIT_3 = 'EXIT';
 echo "<div class=\"form-group\"><p style='color:#F44336';>DATE RANGE - ERROR: Date range is not set correctly --- Script Exit - Debug code: 1012</p></div> ";
}else {
 echo "<div class=\"form-group\"><p style='color:#5cb85c';>DATE RANGE - OK - Debug code: 1013</p></div> ";
}
//EXIT - Last EXIT option - if everything is correct let's check if DATE RANGE IS OK - IF NO EXIT PHP !
if ($VAR_DATE_EXIT_3 == 'EXIT') {
 echo '<br><div class="container"><footer class="text-muted"><div class="pull-left"><span>2017 © Michal Vasko</span></div></footer></div>';
 exit;
}

if(trim($STR_SEARCH) !== '') {
 echo "<div class=\"form-group\"><p>String search: $STR_SEARCH</p></div> ";
}
echo '</form></div><div class="container"><h2 class="text-center">Statistic</h2></div>';

// IMAP PART OF PHP -- In part below PHP proced information from input and give it to next part where IMAP will search information in MAIL
$conn = imap_open('ADDYOURBCCACCOUNT', 'ADDYOURBCCACCOUNT', 'ADDYOURBCCACCOUNT_PASS', OP_READONLY);

//INPUTS FROM audit.php
$FIND_MAIL_TO = $VAR_MAIL_TO;
$FIND_MAIL_FROM = $VAR_MAIL_FROM;
$FIND_DATE_TO = $VAR_DATE_TO;
$FIND_DATE_FROM = $VAR_DATE_FROM;

// Check if input for MAIL TO or MAIL FROM is empty or not - this condition chose code tree: how to set $find variable for IMAP search
if((!isset($FIND_MAIL_TO) || trim($FIND_MAIL_TO) == '') && (!isset($FIND_MAIL_FROM) || trim($FIND_MAIL_FROM) == '')){
//PARSE DATE for IMAP_SEARCH
 list($DAY_TO, $MONTH_TO, $YEAR_TO) = explode("/",$FIND_DATE_TO);
 list($DAY_FROM, $MONTH_FROM, $YEAR_FROM) = explode("/",$FIND_DATE_FROM);
 $CONVERT_MONTH_TO = DateTime::createFromFormat('!m', $MONTH_TO);
 $MONTH_TO_IMAP = $CONVERT_MONTH_TO->format('M');
 $CONVERT_MONTH_FROM = DateTime::createFromFormat('!m', $MONTH_FROM);
 $MONTH_FROM_IMAP = $CONVERT_MONTH_FROM->format('M');
 if(!isset($STR_SEARCH) || trim($STR_SEARCH) == '') {
 $find = imap_search($conn, 'SINCE "'.$DAY_FROM.' '.$MONTH_FROM_IMAP.' '.$YEAR_FROM.'" BEFORE "'.$DAY_TO.' '.$MONTH_TO_IMAP.' '.$YEAR_TO.'"' );
 }else{
 $find = imap_search($conn, 'SINCE "'.$DAY_FROM.' '.$MONTH_FROM_IMAP.' '.$YEAR_FROM.'" BEFORE "'.$DAY_TO.' '.$MONTH_TO_IMAP.' '.$YEAR_TO.'" TEXT "'.$STR_SEARCH.'"' );
 }
}elseif((!isset($FIND_MAIL_TO) || trim($FIND_MAIL_TO) == '') && (isset($FIND_MAIL_FROM) || trim($FIND_MAIL_FROM) !== '')) {
 list($DAY_TO, $MONTH_TO, $YEAR_TO) = explode("/",$FIND_DATE_TO);
 list($DAY_FROM, $MONTH_FROM, $YEAR_FROM) = explode("/",$FIND_DATE_FROM);
 $CONVERT_MONTH_TO = DateTime::createFromFormat('!m', $MONTH_TO);
 $MONTH_TO_IMAP = $CONVERT_MONTH_TO->format('M');
 $CONVERT_MONTH_FROM = DateTime::createFromFormat('!m', $MONTH_FROM);
 $MONTH_FROM_IMAP = $CONVERT_MONTH_FROM->format('M');
 if ( substr( $FIND_MAIL_FROM, 0, 2 ) === "*@") {
  $DOMAIN_MAIL_FROM = str_replace('*@', '@', $FIND_MAIL_FROM);
  $FIND_MAIL_FROM = $DOMAIN_MAIL_FROM;
 }
 if(!isset($STR_SEARCH) || trim($STR_SEARCH) == '') {
 $find = imap_search($conn, 'FROM "'.$FIND_MAIL_FROM.'" SINCE "'.$DAY_FROM.' '.$MONTH_FROM_IMAP.' '.$YEAR_FROM.'" BEFORE "'.$DAY_TO.' '.$MONTH_TO_IMAP.' '.$YEAR_TO.'"' );
 }else{
 $find = imap_search($conn, 'FROM "'.$FIND_MAIL_FROM.'" SINCE "'.$DAY_FROM.' '.$MONTH_FROM_IMAP.' '.$YEAR_FROM.'" BEFORE "'.$DAY_TO.' '.$MONTH_TO_IMAP.' '.$YEAR_TO.'" TEXT "'.$STR_SEARCH.'"' );
 }
}elseif((isset($FIND_MAIL_TO) || trim($FIND_MAIL_TO) !== '') && (!isset($FIND_MAIL_FROM) || trim($FIND_MAIL_FROM) == '')) {
 list($DAY_TO, $MONTH_TO, $YEAR_TO) = explode("/",$FIND_DATE_TO);
 list($DAY_FROM, $MONTH_FROM, $YEAR_FROM) = explode("/",$FIND_DATE_FROM);
 $CONVERT_MONTH_TO = DateTime::createFromFormat('!m', $MONTH_TO);
 $MONTH_TO_IMAP = $CONVERT_MONTH_TO->format('M');
 $CONVERT_MONTH_FROM = DateTime::createFromFormat('!m', $MONTH_FROM);
 $MONTH_FROM_IMAP = $CONVERT_MONTH_FROM->format('M');
 if ( substr( $FIND_MAIL_TO, 0, 2 ) === "*@") {
  $DOMAIN_MAIL_TO = str_replace('*@', '@', $FIND_MAIL_TO);
  $FIND_MAIL_TO = $DOMAIN_MAIL_TO;
 }
 if(!isset($STR_SEARCH) || trim($STR_SEARCH) == '') {
 $find = imap_search($conn, 'TO "'.$FIND_MAIL_TO.'" SINCE "'.$DAY_FROM.' '.$MONTH_FROM_IMAP.' '.$YEAR_FROM.'" BEFORE "'.$DAY_TO.' '.$MONTH_TO_IMAP.' '.$YEAR_TO.'"' );
 }else{
 $find = imap_search($conn, 'TO "'.$FIND_MAIL_TO.'" SINCE "'.$DAY_FROM.' '.$MONTH_FROM_IMAP.' '.$YEAR_FROM.'" BEFORE "'.$DAY_TO.' '.$MONTH_TO_IMAP.' '.$YEAR_TO.'" TEXT "'.$STR_SEARCH.'"' );
 }
}else{
 list($DAY_TO, $MONTH_TO, $YEAR_TO) = explode("/",$FIND_DATE_TO);
 list($DAY_FROM, $MONTH_FROM, $YEAR_FROM) = explode("/",$FIND_DATE_FROM);
 $CONVERT_MONTH_TO = DateTime::createFromFormat('!m', $MONTH_TO);
 $MONTH_TO_IMAP = $CONVERT_MONTH_TO->format('M');
 $CONVERT_MONTH_FROM = DateTime::createFromFormat('!m', $MONTH_FROM);
 $MONTH_FROM_IMAP = $CONVERT_MONTH_FROM->format('M');
 if ( substr( $FIND_MAIL_FROM, 0, 2 ) === "*@") {
  $DOMAIN_MAIL_FROM = str_replace('*@', '@', $FIND_MAIL_FROM);
  $FIND_MAIL_FROM = $DOMAIN_MAIL_FROM;
 }
 if ( substr( $FIND_MAIL_TO, 0, 2 ) === "*@") {
  $DOMAIN_MAIL_TO = str_replace('*@', '@', $FIND_MAIL_TO);
  $FIND_MAIL_TO = $DOMAIN_MAIL_TO;
 }
 if(!isset($STR_SEARCH) || trim($STR_SEARCH) == '') {
 $find = imap_search($conn, 'TO "'.$FIND_MAIL_TO.'" FROM "'.$FIND_MAIL_FROM.'" SINCE "'.$DAY_FROM.' '.$MONTH_FROM_IMAP.' '.$YEAR_FROM.'" BEFORE "'.$DAY_TO.' '.$MONTH_TO_IMAP.' '.$YEAR_TO.'"' );
 }else{
 $find = imap_search($conn, 'TO "'.$FIND_MAIL_TO.'" FROM "'.$FIND_MAIL_FROM.'" SINCE "'.$DAY_FROM.' '.$MONTH_FROM_IMAP.' '.$YEAR_FROM.'" BEFORE "'.$DAY_TO.' '.$MONTH_TO_IMAP.' '.$YEAR_TO.'" TEXT "'.$STR_SEARCH.'"' );
 }
}
//$count_MAILS = count($find);
//if($count_MAILS !== 1) {
//  echo "<div class=\"container\"><p class=\"text-success\"><i class=\"material-icons\" id=\"output_info_icon\">info_outline</i>$count_MAILS e-mails found</p></div>";
//}

function convertToReadableSize($size_converter) {
 $base = log($size_converter) / log(1024);
 $suffix = array("", " KB", " MB", " GB");
 $f_base = floor($base);
 return round(pow(1024, $base - floor($base)), 1) . $suffix[$f_base];
}

//ARRAY DEFFINITION
$array_domain_list = array();
$array_from_mail = array();
$array_to_mail = array();
$array_count_mail = array();
$array_count_size = array();
$array_count_from_size = array();
$array_count_to_size = array();
$array_count_unique_size = array();
$array_count_domain_size = array();
//$to_list = array();

$i = 1;
if ($find) {
$output = '';
rsort ($find);
foreach ($find as $overview) {
 //echo "Match found in :$overview\n";
 //$head_info = imap_fetch_overview($conn, $overview, 0);
 $header = imap_headerinfo($conn, $overview);
 //$mail_body = imap_body($conn, $overview);
 $from = $header->from[0]->mailbox . "@" . $header->from[0]->host;
 $from_domain = $header->from[0]->host;
 $to = $header->to[0]->mailbox . "@" . $header->to[0]->host;
 $to_domain = $header->to[0]->host;
 $mail_date = $header->MailDate;
 $mail_ID = $header->message_id;
 $mail_OS_id = $header->udate;
 $mail_subject = $header->subject;
 $mail_size = $header->Size;
 $convert_size = convertToReadableSize($mail_size);

// foreach ($header->to as $TO_LISTT) {
// $to_list[] = $TO_LISTT->mailbox . "@" . $TO_LISTT->host;
// }

 $num_body_id = $overview;
 $_POST["BODY_MAIL"] = $num_body_id;
  

/////STATISTIC FUNCTION/////////////

//CATCH ALL "FROM DOMAIN ( @example.com )"
 $array_domain_list[] = $from_domain;
 $array_domain_list[] = $to_domain;
 $array_domain_from_list[] = $from_domain;
 $array_domain_to_list[] = $to_domain;
 $array_from_mail[] = $from;
 $array_to_mail[] = $to;
 $array_count_mail = array_merge($array_from_mail, $array_to_mail);
 $array_count_size[] = $mail_size;
 $array_count_from_size[] = array($from,$mail_size);
 $array_count_to_size[] = array($to,$mail_size);
 $array_count_unique_size[] = array($from, $mail_size, $to, $mail_size);
 $array_count_domain_size[] = array($from_domain, $mail_size, $to_domain, $mail_size);

 $i++;
}
}

//Domain section
$unique_array_domain_list = array_unique($array_domain_list);
$count_unique_array_domain = count($unique_array_domain_list);
$count_unique_mail_per_domain = array_count_values($array_domain_list);
$count_unique_from_per_domain = array_count_values($array_domain_from_list);
$count_unique_to_per_domain = array_count_values($array_domain_to_list);

//e-mail counter for unique mail
$array_from_message_count = array_count_values($array_from_mail);
$array_to_message_count = array_count_values($array_to_mail);

//count total mails
$array_total_count_mail = array_count_values($array_count_mail);

//count unique mail address
$array_total_count_unique_mail_address = count($array_total_count_mail);

//count size for all mail address
$array_count_total_mail_size_convert = convertToReadableSize(array_sum($array_count_size));

//count size for all qunique address
$array_count_unique_size_raw = array();
 foreach($array_count_unique_size as $size_count => $size_unique_ID) {
 $array_count_unique_size_raw[$size_unique_ID[0]] += $size_unique_ID[1];
 $array_count_unique_size_raw[$size_unique_ID[2]] += $size_unique_ID[3];
 }

//count size for "from" mail address
$array_count_from_size_raw = array();
 foreach($array_count_from_size as $size_count => $size_from_ID) {
  $array_count_from_size_raw[$size_from_ID[0]] += $size_from_ID[1];
 }

//count size for "to" mail address
$array_count_to_size_raw = array();
 foreach($array_count_to_size as $size_count => $size_to_ID) {
  $array_count_to_size_raw[$size_to_ID[0]] += $size_to_ID[1];
 }

//count size for "domain_list"
$array_count_domain_size_raw = array();
 foreach($array_count_domain_size as $size_count => $size_domain_ID) {
 $array_count_domain_size_raw[$size_domain_ID[0]] += $size_domain_ID[1];
 $array_count_domain_size_raw[$size_domain_ID[2]] += $size_domain_ID[3];
}

//count to & from  mail address
$array_total_count_to_mail_address = count($array_to_message_count);
$array_total_count_from_mail_address = count($array_from_message_count);

//print_r($array_count_unique_size);
//echo '<br><br><br>';
//print_r($lenght_to_list);
//echo '<br><br><br>';
//print_r(array_values($to_list));
echo '<br><br><br>';
//print_r($array_to_mail);
//echo '<br>';

//SORT ARRAY
arsort($count_unique_mail_per_domain);
arsort($array_total_count_mail);
arsort($array_to_message_count);
arsort($array_from_message_count);

///////////////////DOMAIN LIST PART /////////////////////////////////////////
echo "<div class=\"container\"><p><strong>DOMAIN LIST</strong></p></div> ";

  echo "<div class=\"container\"><p class=\"text-success\"><i class=\"material-icons\" id=\"output_info_icon\">info_outline</i>$count_unique_array_domain domain found, Real e-mail size: $array_count_total_mail_size_convert</p></div>";


//STATIS HEADER
   echo '<div class="container">';
   echo '<div class="table-responsive">';
         echo '<table class="table">';
            echo '<thead>';
             echo '<tr>';
              echo '<th class="active"><strong>Domain list</strong> </th>';
              echo '<th class="active"><strong>E-mail count</strong> </th>';
              echo '<th class="active"><strong>E-mail From</strong> </th>';
              echo '<th class="active"><strong>E-mail To</strong> </th>';
              echo '<th class="active"><strong>Total size</strong></th>';
          //    echo '<th class="active"><strong>Unique E-mail address count</strong> </th>';
             echo '</tr>';
            echo '</thead>';

     foreach ($count_unique_mail_per_domain as $key => $domain_lister) {
            $size_convertor = convertToReadableSize ($array_count_domain_size_raw[$key]);
            echo '<tbody>';
              echo '<tr>';
               echo "<td><strong>$key</strong></td>";
               echo "<td><strong>$count_unique_mail_per_domain[$key]</strong></td>";
               if (empty($count_unique_from_per_domain[$key])) {
                echo "<td><strong>0</strong></td>";
               }else {
               echo "<td><strong>$count_unique_from_per_domain[$key]</strong></td>";
               }
               if (empty($count_unique_to_per_domain[$key])) {
                echo "<td><strong>0</strong></td>";
               }else {
               echo "<td><strong>$count_unique_to_per_domain[$key]</strong></td>";
               }
               echo "<td><strong>$size_convertor</strong></td>";
              echo '</tr>';
            echo '</tbody>';
    // }
    }
echo '</table>';
echo '</div>';
echo '</div>';
echo '<br>';

/////////////// MESSAGES TOTAL COUNT ////////////////////////////////////////
echo "<div class=\"container\"><p><strong>Unique E-Mail address</strong></p></div> ";
echo "<div class=\"container\"><p class=\"text-success\"><i class=\"material-icons\" id=\"output_info_icon\">info_outline</i>$array_total_count_unique_mail_address address found</p></div>";

echo '<div class="container">';
   echo '<div class="table-responsive">';
         echo '<table class="table">';
            echo '<thead>';
             echo '<tr>';
              echo '<th class="active"><strong>E-Mail address</strong> </th>';
              echo '<th class="active"><strong>E-Mail count</strong> </th>';
              echo '<th class="active"><strong>Total size</strong> </th>';
             echo '</tr>';
            echo '</thead>';
 foreach ( $array_total_count_mail as $key => $total_value ) {
       $size_convertor = convertToReadableSize($array_count_unique_size_raw[$key]);
          echo '<tbody>';
              echo '<tr>';
               echo "<td><strong>$key</strong></td>";
               echo "<td><strong>$total_value</strong></td>";
               echo "<td><strong>$size_convertor</strong></td>";
              echo '</tr>';
            echo '</tbody>';
 }
echo '</table>';
echo '</div>';
echo '</div>';
echo '<br>';

/////////////// MESSAGE TO COUNT ////////////////////////////////////////////
echo "<div class=\"container\"><p><strong>E-Mail sent TO</strong></p></div> ";
echo "<div class=\"container\"><p class=\"text-success\"><i class=\"material-icons\" id=\"output_info_icon\">info_outline</i>$array_total_count_to_mail_address address found</p></div>";

echo '<div class="container">';
   echo '<div class="table-responsive">';
         echo '<table class="table">';
            echo '<thead>';
             echo '<tr>';
              echo '<th class="active"><strong>E-Mail address</strong> </th>';
              echo '<th class="active"><strong>Count</strong> </th>';
              echo '<th class="active"><strong>Total size</strong> </th>';
             echo '</tr>';
            echo '</thead>';
    foreach ( $array_to_message_count as $key => $to_value ) {
       $size_convertor = convertToReadableSize($array_count_to_size_raw[$key]);
          echo '<tbody>';
              echo '<tr>';
               echo "<td><strong>$key</strong></td>";
               echo "<td><strong>$to_value</strong></td>";
               echo "<td><strong>$size_convertor</strong></td>";
              echo '</tr>';
            echo '</tbody>';
    }  
echo '</table>';
echo '</div>';
echo '</div>';



/////////////// MESSAGE FROM COUNT //////////////////////////////////////////
echo "<div class=\"container\"><p><strong>E-Mail sent FROM</strong></p></div> ";
echo "<div class=\"container\"><p class=\"text-success\"><i class=\"material-icons\" id=\"output_info_icon\">info_outline</i>$array_total_count_from_mail_address address found</p></div>";

 echo '<div class="container">';
   echo '<div class="table-responsive">';
         echo '<table class="table">';
            echo '<thead>';
             echo '<tr>';
              echo '<th class="active"><strong>E-Mail address</strong> </th>';
              echo '<th class="active"><strong>Count</strong> </th>';
              echo '<th class="active"><strong>Total size</strong></th>';
             echo '</tr>';
            echo '</thead>';
    foreach ( $array_from_message_count as $key => $from_value ) {
          $size_convertor = convertToReadableSize($array_count_from_size_raw[$key]);
          echo '<tbody>';
              echo '<tr>';
               echo "<td><strong>$key</strong></td>";
               echo "<td><strong>$from_value</strong></td>";
               echo "<td><strong>$size_convertor</strong></td>";
              echo '</tr>';
            echo '</tbody>';
    }
echo '</table>';
echo '</div>';
echo '</div>';


imap_close($conn);
}



/////////////////
// SEARCH MODE //
////////////////
if(isset($_POST['sub_butt'])) {
  //VARIABLE DEFINITION
   $VAR_MAIL_TO = $_POST['TO-MAIL'];
   $VAR_MAIL_FROM = $_POST['FROM-MAIL'];
   $VAR_DATE_FROM = $_POST['DATE-FROM'];
   $VAR_DATE_TO = $_POST ['DATE-TO'];
   $STR_SEARCH = htmlspecialchars($_POST['STRING_SEARCH']);

//INPUT - CHECK
   echo '<div class="container">
        <form class="bootstrap-form-with-validation">
            <h2 class="text-center">Input check</h2>';

  //MAIL
  // INPUT - MAIL TO - CHECK - empty/ correct format check
   if(!isset($VAR_MAIL_TO) || trim($VAR_MAIL_TO) == '') {
 $VAR_MAIL_TO_EMPTY_err = 'empty';
 $VAR_MAIL_TO = '';
}
 if (!filter_var($VAR_MAIL_TO, FILTER_VALIDATE_EMAIL)) {
 $VAR_MAIL_TO_FORMAT_err = 'err_format';
}
 if($VAR_MAIL_TO_FORMAT_err == 'err_format' && $VAR_MAIL_TO_EMPTY_err !== 'empty') {
  $VAR_MAIL_EXIT_1 = 'EXIT';
  $MAIL_TO_MESSAGE_format = '<div class="form-group"><p style="color:#F44336";>TO: BAD FORMAT ! --> Script Exit - Debug code: 1000</p></div>';
 }elseif ($VAR_MAIL_TO_EMPTY_err == 'empty' && $VAR_MAIL_TO_FORMAT_err == 'err_format') {
  $MAIL_TO_MESSAGE_EMPTY_FORMAT = '<div class="form-group"><p style="color:#FFEB3B";>TO: is empty -- will not included in search - Debug code: 1001</p></div>';
  $MAIL_TO_BLANK = 'novalue';
 }else {
  $MAIL_TO_MESSAGE_ok = '<div class="form-group"><p style="color:#5cb85c";>TO: Input correct - Debug code: 1002</p></div>';
 }
 echo "<p> $MAIL_TO_MESSAGE_format $MAIL_TO_MESSAGE_EMPTY_FORMAT $MAIL_TO_MESSAGE_ok </p> ";

// INPUT - MAIL FROM - CHECK - empty/ correct format check
if(!isset($VAR_MAIL_FROM) || trim($VAR_MAIL_FROM) == '') {
 $VAR_MAIL_FROM_EMPTY_err = 'empty';
 $VAR_MAIL_FROM = '';
}
  if (!filter_var($VAR_MAIL_FROM, FILTER_VALIDATE_EMAIL)) {
 $VAR_MAIL_FROM_FORMAT_err = 'err_format';
}
 if($VAR_MAIL_FROM_FORMAT_err == 'err_format' && $VAR_MAIL_FROM_EMPTY_err !== 'empty') {
  $VAR_MAIL_EXIT_2 = 'EXIT';
  $MAIL_FROM_MESSAGE_format = '<div class="form-group"><p style="color:#F44336";>FROM: BAD FORMAT ! --> Script Exit - Debug code: 1003</p></div>';
 }elseif ($VAR_MAIL_FROM_EMPTY_err == 'empty' && $VAR_MAIL_FROM_FORMAT_err == 'err_format') {
  $MAIL_FROM_MESSAGE_EMPTY_FORMAT = '<div class="form-group"><p style="color:#FFEB3B";>FROM: is empty -- will not included in search - Debug code: 1004</p></div>';
  $MAIL_FROM_BLANK = 'novalue';
 }else {
  $MAIL_FROM_MESSAGE_ok = '<div class="form-group"><p style="color:#5cb85c";>FROM: Input correct - Debug code: 1005</p></div>';
 }
 echo "<p> $MAIL_FROM_MESSAGE_format $MAIL_FROM_MESSAGE_EMPTY_FORMAT $MAIL_FROM_MESSAGE_ok </p> ";

  //DATE
  // INPUT - DATE FROM - CHECK - empty
  if(!isset($VAR_DATE_FROM) || trim($VAR_DATE_FROM) == '') {
   echo "<div class=\"form-group\"><p style='color:#F44336';>DATE FROM: is empty -- DATE IS NEEDED !! --- Script Exit - Debug code: 1006 </p></div> ";
   $VAR_DATE_FROM_err = 'EXIT';
   $VAR_DATE_FROM = '';
  }
  // INPUT - DATE TO - CHECK - empty
  if (!isset($VAR_DATE_TO) || trim($VAR_DATE_TO) == '') {
   echo "<div class=\"form-group\"><p style='color:#F44336';>DATE TO: is empty -- DATE IS NEEDED !! --- Script Exit - Debug code: 1007</p></div> ";
   $VAR_DATE_TO_err = 'EXIT';
   $VAR_DATE_TO = '';
  }

  // EXIT if DATE IS EMPTY
if ( $VAR_DATE_FROM_err == 'EXIT' || $VAR_DATE_TO_err == 'EXIT' ){
 echo '<br><div class="container"><footer class="text-muted"><div class="pull-left"><span>2017 © Michal Vasko</span></div></footer></div>';
 exit;
}

 //INPUT - DATE - Validate if is correct formated !
 function validateDate($date, $format = 'd/m/Y')
 {
  $d = DateTime::createFromFormat($format, $date);
  return $d && $d->format($format) == $date;
 }
 $DATE_FROM=validateDate($VAR_DATE_FROM);
 //echo $VAR_DATE_FROM;
 if($DATE_FROM === TRUE) {
  echo "<div class=\"form-group\"><p style='color:#5cb85c';>DATE FROM - SYNTAX CHECK: OK - Debug code: 1008</p></div> ";
 }else {
  $VAR_DATE_EXIT_1 = 'EXIT';
  echo "<div class=\"form-group\"><p style='color:#F44336';>DATE FROM - SYNTAX CHECK: Bad syntax --- Script Exit - Debug code: 1009</p></div> ";
 }
 $DATE_TO=validateDate($VAR_DATE_TO);
 //echo $VAR_DATE_TO;
 if ($DATE_TO === TRUE) {
  echo "<div class=\"form-group\"><p style='color:#5cb85c';>DATE TO - SYNTAX CHECK: OK - Debug code: 1010</p></div> ";
 }else {
  $VAR_DATE_EXIT_2 = 'EXIT';
  echo "<div class=\"form-group\"><p style='color:#F44336';>DATE TO - SYNTAX CHECK: Bad syntax --- Script Exit - Debug code: 1011</p></div> ";
 }

 //EXIT if DATE or MAIL is bad formated
 if ( $VAR_DATE_EXIT_1 == 'EXIT' || $VAR_DATE_EXIT_2 == 'EXIT' || $VAR_MAIL_EXIT_1 == 'EXIT' || $VAR_MAIL_EXIT_2 == 'EXIT' ){
 echo '<br><div class="container"><footer class="text-muted"><div class="pull-left"><span>2017 © Michal Vasko</span></div></footer></div>';
 exit;
}

//CHECK - IF DATE FROM IS NOT HIGHER AS TO DATE
$ASSIGN_DELTA_DATE_1 = $VAR_DATE_TO;
$ASSIGN_DELTA_DATE_2 = $VAR_DATE_FROM;

$REGEX_DELTA_DATE_1=str_replace('/','-', $ASSIGN_DELTA_DATE_1);
$REGEX_DELTA_DATE_2=str_replace('/','-', $ASSIGN_DELTA_DATE_2);

$CONVERT_DELTA_DATE_1=date('Y-m-d', strtotime($REGEX_DELTA_DATE_1));
$CONVERT_DELTA_DATE_2=date('Y-m-d', strtotime($REGEX_DELTA_DATE_2));

if(!($CONVERT_DELTA_DATE_1 >= $CONVERT_DELTA_DATE_2)) {
 $VAR_DATE_EXIT_3 = 'EXIT';
 echo "<div class=\"form-group\"><p style='color:#F44336';>DATE RANGE - ERROR: Date range is not set correctly --- Script Exit - Debug code: 1012</p></div> ";
}else {
 echo "<div class=\"form-group\"><p style='color:#5cb85c';>DATE RANGE - OK - Debug code: 1013</p></div> ";
}
//EXIT - Last EXIT option - if everything is correct let's check if DATE RANGE IS OK - IF NO EXIT PHP !
if ($VAR_DATE_EXIT_3 == 'EXIT') {
 echo '<br><div class="container"><footer class="text-muted"><div class="pull-left"><span>2017 © Michal Vasko</span></div></footer></div>';
 exit;
}

//STRING-SEARCH check if is empty or not



###### --- DEBUG OPTION -- INPUT VIA ECHO ---- ##########
// echo '<br>';
// echo "<div class=\"search_info\">";
// echo "<p id=\"info_1\">To: $VAR_MAIL_TO</p> ";
// echo "</div>";
// echo "<div class=\"search_info\">";
// echo "<p id=\"info_1\">From: $VAR_MAIL_FROM</p> ";
// echo "</div>";
// echo "<div class=\"search_info\">";
// echo "<p id=\"info_1\">Date From: $VAR_DATE_FROM</p> ";
// echo "</div>";
// echo "<div class=\"search_info\">";
// echo "<p id=\"info_1\">Date to: $VAR_DATE_TO</p> ";
// echo "</div>";
if(trim($STR_SEARCH) !== '') {
 echo "<div class=\"form-group\"><p>String search: $STR_SEARCH</p></div> ";
}
echo '</form></div><div class="container"><h2 class="text-center">Output </h2></div>';
//echo '</form></div><div class="container"><h2 class="text-center">Output </h2></div>';


// IMAP PART OF PHP -- In part below PHP proced information from input and give it to next part where IMAP will search information in MAIL
$conn = imap_open('ADDYOURBCCACCOUNT', 'ADDYOURBCCACCOUNT', 'ADDYOURBCCACCOUNT', OP_READONLY);

//INPUTS FROM audit.php
$FIND_MAIL_TO = $VAR_MAIL_TO;
$FIND_MAIL_FROM = $VAR_MAIL_FROM;
$FIND_DATE_TO = $VAR_DATE_TO;
$FIND_DATE_FROM = $VAR_DATE_FROM;

// Check if input for MAIL TO or MAIL FROM is empty or not - this condition chose code tree: how to set $find variable for IMAP search
if((!isset($FIND_MAIL_TO) || trim($FIND_MAIL_TO) == '') && (!isset($FIND_MAIL_FROM) || trim($FIND_MAIL_FROM) == '')){
//PARSE DATE for IMAP_SEARCH
 list($DAY_TO, $MONTH_TO, $YEAR_TO) = explode("/",$FIND_DATE_TO);
 list($DAY_FROM, $MONTH_FROM, $YEAR_FROM) = explode("/",$FIND_DATE_FROM);
 $CONVERT_MONTH_TO = DateTime::createFromFormat('!m', $MONTH_TO);
 $MONTH_TO_IMAP = $CONVERT_MONTH_TO->format('M');
 $CONVERT_MONTH_FROM = DateTime::createFromFormat('!m', $MONTH_FROM);
 $MONTH_FROM_IMAP = $CONVERT_MONTH_FROM->format('M');
 if(!isset($STR_SEARCH) || trim($STR_SEARCH) == '') {
 $find = imap_search($conn, 'SINCE "'.$DAY_FROM.' '.$MONTH_FROM_IMAP.' '.$YEAR_FROM.'" BEFORE "'.$DAY_TO.' '.$MONTH_TO_IMAP.' '.$YEAR_TO.'"' );
 }else{
 $find = imap_search($conn, 'SINCE "'.$DAY_FROM.' '.$MONTH_FROM_IMAP.' '.$YEAR_FROM.'" BEFORE "'.$DAY_TO.' '.$MONTH_TO_IMAP.' '.$YEAR_TO.'" TEXT "'.$STR_SEARCH.'"' );
 }
}elseif((!isset($FIND_MAIL_TO) || trim($FIND_MAIL_TO) == '') && (isset($FIND_MAIL_FROM) || trim($FIND_MAIL_FROM) !== '')) {
 list($DAY_TO, $MONTH_TO, $YEAR_TO) = explode("/",$FIND_DATE_TO);
 list($DAY_FROM, $MONTH_FROM, $YEAR_FROM) = explode("/",$FIND_DATE_FROM);
 $CONVERT_MONTH_TO = DateTime::createFromFormat('!m', $MONTH_TO);
 $MONTH_TO_IMAP = $CONVERT_MONTH_TO->format('M');
 $CONVERT_MONTH_FROM = DateTime::createFromFormat('!m', $MONTH_FROM);
 $MONTH_FROM_IMAP = $CONVERT_MONTH_FROM->format('M');
 if ( substr( $FIND_MAIL_FROM, 0, 2 ) === "*@") {
  $DOMAIN_MAIL_FROM = str_replace('*@', '@', $FIND_MAIL_FROM);
  $FIND_MAIL_FROM = $DOMAIN_MAIL_FROM;
 }
 if(!isset($STR_SEARCH) || trim($STR_SEARCH) == '') {
 $find = imap_search($conn, 'FROM "'.$FIND_MAIL_FROM.'" SINCE "'.$DAY_FROM.' '.$MONTH_FROM_IMAP.' '.$YEAR_FROM.'" BEFORE "'.$DAY_TO.' '.$MONTH_TO_IMAP.' '.$YEAR_TO.'"' );
 }else{
 $find = imap_search($conn, 'FROM "'.$FIND_MAIL_FROM.'" SINCE "'.$DAY_FROM.' '.$MONTH_FROM_IMAP.' '.$YEAR_FROM.'" BEFORE "'.$DAY_TO.' '.$MONTH_TO_IMAP.' '.$YEAR_TO.'" TEXT "'.$STR_SEARCH.'"' );
 }
}elseif((isset($FIND_MAIL_TO) || trim($FIND_MAIL_TO) !== '') && (!isset($FIND_MAIL_FROM) || trim($FIND_MAIL_FROM) == '')) {
 list($DAY_TO, $MONTH_TO, $YEAR_TO) = explode("/",$FIND_DATE_TO);
 list($DAY_FROM, $MONTH_FROM, $YEAR_FROM) = explode("/",$FIND_DATE_FROM);
 $CONVERT_MONTH_TO = DateTime::createFromFormat('!m', $MONTH_TO);
 $MONTH_TO_IMAP = $CONVERT_MONTH_TO->format('M');
 $CONVERT_MONTH_FROM = DateTime::createFromFormat('!m', $MONTH_FROM);
 $MONTH_FROM_IMAP = $CONVERT_MONTH_FROM->format('M');
 if ( substr( $FIND_MAIL_TO, 0, 2 ) === "*@") {
  $DOMAIN_MAIL_TO = str_replace('*@', '@', $FIND_MAIL_TO);
  $FIND_MAIL_TO = $DOMAIN_MAIL_TO;
 }
 if(!isset($STR_SEARCH) || trim($STR_SEARCH) == '') {
 $find = imap_search($conn, 'TO "'.$FIND_MAIL_TO.'" SINCE "'.$DAY_FROM.' '.$MONTH_FROM_IMAP.' '.$YEAR_FROM.'" BEFORE "'.$DAY_TO.' '.$MONTH_TO_IMAP.' '.$YEAR_TO.'"' );
 }else{
 $find = imap_search($conn, 'TO "'.$FIND_MAIL_TO.'" SINCE "'.$DAY_FROM.' '.$MONTH_FROM_IMAP.' '.$YEAR_FROM.'" BEFORE "'.$DAY_TO.' '.$MONTH_TO_IMAP.' '.$YEAR_TO.'" TEXT "'.$STR_SEARCH.'"' );
 }
}else{
 list($DAY_TO, $MONTH_TO, $YEAR_TO) = explode("/",$FIND_DATE_TO);
 list($DAY_FROM, $MONTH_FROM, $YEAR_FROM) = explode("/",$FIND_DATE_FROM);
 $CONVERT_MONTH_TO = DateTime::createFromFormat('!m', $MONTH_TO);
 $MONTH_TO_IMAP = $CONVERT_MONTH_TO->format('M');
 $CONVERT_MONTH_FROM = DateTime::createFromFormat('!m', $MONTH_FROM);
 $MONTH_FROM_IMAP = $CONVERT_MONTH_FROM->format('M');
 if ( substr( $FIND_MAIL_FROM, 0, 2 ) === "*@") {
  $DOMAIN_MAIL_FROM = str_replace('*@', '@', $FIND_MAIL_FROM);
  $FIND_MAIL_FROM = $DOMAIN_MAIL_FROM;
 }
 if ( substr( $FIND_MAIL_TO, 0, 2 ) === "*@") {
  $DOMAIN_MAIL_TO = str_replace('*@', '@', $FIND_MAIL_TO);
  $FIND_MAIL_TO = $DOMAIN_MAIL_TO;
 }
 if(!isset($STR_SEARCH) || trim($STR_SEARCH) == '') {
 $find = imap_search($conn, 'TO "'.$FIND_MAIL_TO.'" FROM "'.$FIND_MAIL_FROM.'" SINCE "'.$DAY_FROM.' '.$MONTH_FROM_IMAP.' '.$YEAR_FROM.'" BEFORE "'.$DAY_TO.' '.$MONTH_TO_IMAP.' '.$YEAR_TO.'"' );
 }else{
 $find = imap_search($conn, 'TO "'.$FIND_MAIL_TO.'" FROM "'.$FIND_MAIL_FROM.'" SINCE "'.$DAY_FROM.' '.$MONTH_FROM_IMAP.' '.$YEAR_FROM.'" BEFORE "'.$DAY_TO.' '.$MONTH_TO_IMAP.' '.$YEAR_TO.'" TEXT "'.$STR_SEARCH.'"' );
 }
}

// Check if MAIL Input contain at start *@ -- TRUE - IF you are looking for all mail for specific domain
//if ( substr( $FIND_MAIL_TO, 0, 2 ) === "*@") {
//echo "vstup: $FIND_MAIL_TO\n";
//$DOMAIN_MAIL_TO = str_replace('*@', '@', $FIND_MAIL_TO);
//$FIND_MAIL_TO = $DOMAIN_MAIL_TO;
//echo "$FIND_MAIL_TO\n";
//}

//if ( substr( $FIND_MAIL_FROM, 0, 2 ) === "*@") {
//$DOMAIN_MAIL_FROM = str_replace('*@', '@', $FIND_MAIL_FROM);
//$FIND_MAIL_FROM = $DOMAIN_MAIL_FROM;
//}

//PARSE DATE for IMAP_SEARCH
//list($DAY_TO, $MONTH_TO, $YEAR_TO) = explode("/",$FIND_DATE_TO);
//list($DAY_FROM, $MONTH_FROM, $YEAR_FROM) = explode("/",$FIND_DATE_FROM);
//$CONVERT_MONTH_TO = DateTime::createFromFormat('!m', $MONTH_TO);
//$MONTH_TO_IMAP = $CONVERT_MONTH_TO->format('M');
//$CONVERT_MONTH_FROM = DateTime::createFromFormat('!m', $MONTH_FROM);
//$MONTH_FROM_IMAP = $CONVERT_MONTH_FROM->format('M');



//TOTAL found mails for specific search
$count_MAILS = count($find);
if($count_MAILS !== 1) {
  echo "<div class=\"container\"><p class=\"text-success\"><i class=\"material-icons\" id=\"output_info_icon\">info_outline</i>$count_MAILS e-mails found</p></div>";
}


//TABLE output header
   echo '<div class="container">';
   echo '<div class="table-responsive">';
        echo '<table class="table">';
            echo '<thead>';
                echo '<tr>';
                    echo '<th class="active"><strong>DATE</strong> </th>';
                    echo '<th class="active">FROM </th>';
                    if ($_POST['cb1'] == 'value_cb1') {
                     echo '<th class="active">TO LIST</th>';
                    }
                    else {
                     echo '<th class="active">TO </th>';
                    }
                    if ($_POST['cb2'] == 'value_cb2') {
                     echo '<th class="active">CC LIST</th>';
                    }
                    if ($_POST['cb3'] == 'value_cb3') {
                     echo '<th class="active">BCC LIST</th>';
                    }
                    echo '<th class="active">SUBJECT </th>';
                    echo '<th class="active">SIZE </th>';
                    echo '<th class="active">LINUX ID</th>';
                    echo '<th class="active">BODY </th>';
                    echo '</tr>';
               echo '</thead>';

function convertToReadableSize($size_converter) {
 $base = log($size_converter) / log(1024);
 $suffix = array("", " KB", " MB", " GB");
 $f_base = floor($base);
 return round(pow(1024, $base - floor($base)), 1) . $suffix[$f_base];
}
//session_start();
//
$to_list = array();
$cc_list = array();
$bcc_list = array();

$i = 1;
if ($find) {
$output = '';
rsort ($find);
foreach ($find as $overview) {
 //echo "Match found in :$overview\n";
 //$head_info = imap_fetch_overview($conn, $overview, 0);
 $header = imap_headerinfo($conn, $overview);
 //$mail_body = imap_body($conn, $overview);
 $from = $header->from[0]->mailbox . "@" . $header->from[0]->host;
 $to = $header->to[0]->mailbox . "@" . $header->to[0]->host;
 $mail_date = $header->MailDate;
 $mail_ID = $header->message_id;
 $mail_OS_id = $header->udate;
 $mail_subject = $header->subject;
 $mail_size = $header->Size;
 $convert_size = convertToReadableSize($mail_size);

if ($_POST['cb1'] == 'value_cb1') {
 foreach ($header->to as $TO_VALUE) {
 $to_list[] = $TO_VALUE->mailbox . "@" . $TO_VALUE->host;
 }
 $display_to_list = implode(' , ',$to_list);
}
if ($_POST['cb2'] == 'value_cb2') {
 foreach ($header->cc as $CC_VALUE) {
 $cc_list[] = $CC_VALUE->mailbox . "@" . $CC_VALUE->host;
 }
 $display_cc_list = implode(' , ',$cc_list);
}
if ($_POST['cb3'] == 'value_cb3') {
 foreach ($header->bcc as $BCC_VALUE) {
 $bcc_list[] = $BCC_VALUE->mailbox . "@" . $BCC_VALUE->host;
 }
 $display_bcc_list = implode(' , ',$bcc_list);
}
 //$body_TEXT = imap_qprint(imap_fetchbody($conn, $overview, 1.2));
 //if(!strlen($body_TEXT)>0) {
 // $body_TEXT = imap_qprint(imap_fetchbody($conn, $overview, 1));
// }
 $num_body_id = $overview;
 //$TEST_124 = $body_TEXT;
 //$TEST_124 = imap_qprint(imap_body($conn, $overview));
 $_POST["BODY_MAIL"] = $num_body_id;
 //TABLE, output data in table
            echo '<tbody>';
                   echo '<tr>';
                    echo "<td><strong>$mail_date</strong> </td>";
                    echo "<td><strong>$from</strong></td>";
                    if ($_POST['cb1'] == 'value_cb1') {
                     echo "<td style='word-break: break-all';><strong>$display_to_list</strong></td>";
                    }else {
                     echo "<td><strong>$to</strong></td>";
                    }
                    if ($_POST['cb2'] == 'value_cb2') {
                     echo "<td style='word-break: break-all';><strong>$display_cc_list</strong></td>";
                    }
                    if ($_POST['cb3'] == 'value_cb3') {
                     echo "<td style='word-break: break-all';><strong>$display_bcc_list</strong></td>";
                    }
                    echo "<td style='word-break: break-all';><strong>$mail_subject</strong></td>";
                    echo "<td><strong>$convert_size</strong></td>";
                    echo "<td>$mail_OS_id</td>";
                    echo "<td><form target='_blank' method='POST' action='body.php'><button class='btn btn-info btn-xs' id='BODY_button' name='BODY_MAIL' type='submit' value='$num_body_id'><strong>Show Message</strong></button></form></td>";
                echo '</tr>';
            echo '</tbody>';

//DESTROY TO_LIST,CC_LIST,BCC_LIST
 unset($to_list);
 unset($cc_list);
 unset($bcc_list);

  $i++;
}
}
echo '</table>';
echo '</div>';
echo '</div>';
 
//TEST
//if($some) {
// $output = '';
// rsort($some);
// foreach($some as $some_ID) {
//  $overview = imap_fetch_overview($conn, $some_ID, 0);
//  $message = imap_fetchbody($conn, $some_ID, 2);
//  echo "#{$overview->msgno} ({$overview->date}) - From: {$overview->from} {$overview->subject}\n";
  //echo $message;
 //echo imap_qprint($message);
// $message = imap_qprint($message);
 //echo imap_8bit ($message);
// $dateFormatted = str_replace("-0500", "", $overview[0] -> date );
 //$output .= $overview[0] -> subject;
// $output .= $DateFormatted ;
// $output .= $message;
// }
// echo $output;
//}
imap_close($conn);

//print_r($some);
}
?>   
    <div class="container"></div>
    <div class="container">
        <footer class="text-muted">
            <div class="pull-left"><span>2017 © Michal Vasko</span></div>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
