<?php


/* 
*
*
*   Template Name: Date
*
*    Removed from site for checking add it to the site again
*
*/

get_header(); 

echo "<div id='pageContainer'>";

// date_default_timezone_set('GMT+0');

// function checkTheXmasDate($aTimeInUnixFormat){
//     $year = date('y');
//     $yearFromNow = $year +1;
//     $endDateXmas = mktime('12','0','0','02','01',$yearFromNow);
//     $startDateXmas = mktime('12','0','0','10','01',$year);

//     $isGreaterThanStartDate = $aTimeInUnixFormat >= $startDateXmas;
//     $isLessThanEndDate = $aTimeInUnixFormat <= $endDateXmas;

//     if($isGreaterThanStartDate && $isLessThanEndDate){
//         return true;
//     }else{
//         return;
//     }
// }


// function checkThePaddysDayDates($aTimeInUnixFormat){
//     $year = date('y');
//     $startDatePaddys = mktime('12','0','0','03','01',$year);
//     $endDatePaddys = mktime('12','0','0','04','01',$year);

//     $isGreaterThanStartDate = $aTimeInUnixFormat >= $startDatePaddys;
//     $isLessThanEndDate = $aTimeInUnixFormat <= $endDatePaddys;

//     if($isGreaterThanStartDate && $isLessThanEndDate){
//         return true;
//     }else{
//         return false;
//     }
// }

// function checkTheDate($aTimeInUnixFormat){
//     $validXmasDate = checkTheXmasDate($aTimeInUnixFormat);
//     $validPaddysDate = checkThePaddysDayDates($aTimeInUnixFormat);

//     if($validXmasDate && !$validPaddysDate){
//         get_template_part('flowerGarden/xmasList');
//     }elseif(!$validXmasDate && $validPaddysDate){
//         get_template_part('flowerGarden/paddysDay');
//     }else{
//         get_template_part('flowerGarden/normalList');
//     }
// }

// function returnXmasParams(){
//     $year = date('y');
//     $yearFromNow = $year +1;
//     $endDateXmas = mktime('12','0','0','02','01',$yearFromNow);
//     $startDateXmas = mktime('12','0','0','10','01',$year);

//     $humanStartDateXmas = date("Y-m-d h:i:sa", $startDateXmas);
//     $humanEndDateXmas = date("Y-m-d h:i:sa", $endDateXmas);

//     return "<h1 class='dateTitle'>Christmas Period Used in functions</h1><p><strong>Start Date: </strong>".$humanStartDateXmas."</p><p><strong>End Date: </strong>".$humanEndDateXmas."</p>";
// }

// function returnPaddysDayParams(){
//     $year = date('y');
//     $startDatePaddys = mktime('12','0','0','03','01',$year);
//     $endDatePaddys = mktime('12','0','0','04','01',$year);

//     $humanStartDatePaddys = date("Y-m-d h:i:sa", $startDatePaddys);
//     $humanEndDatePaddys = date("Y-m-d h:i:sa", $endDatePaddys);

//     return "<h1 class='dateTitle'>Paddys Day Period Used in functions</h1><p><strong>Start Date: </strong>".$humanStartDatePaddys."</p><p><strong>End Date: </strong>".$humanEndDatePaddys."</p>";
// }

// function developerNotes(){
//     $string = '<hr>';
//     $string .= '<p>To use the functions here we call checkTheDate() and pass in the current time as a timestamp.<p>';
//     $string .= '<p> checkTheDate() calls checkTheXmasDates() and calls checkThePaddysDayDates() and returns a template part from wordpress to use</p>';
//     $string .= '<p>When a user visits the flowergarden page the template outputted will vary dependent on the inputted timestamp</p>';
//     $string .= '<p>See the following info for defined scheduling for both the xmas and paddys day</p>';
//     $string .= returnXmasParams();
//     $string .= returnPaddysDayParams();
//     $string .= '<hr>';
//     echo $string;
// }


// developerNotes();


// checkTheDate(time());


// $checkFutureDate = mktime('13','0','0','02','01','2021');
// checkTheDate($checkFutureDate);


// function changePostStatus($postID, $status){
//     $thePost = array(
//         'ID' => $postID,
//         'post_status' => $status
//     );
    
//     wp_update_post($thePost);

//     echo $status."<br>";
// };

// changePostStatus(1955, 'pending');
// changePostStatus(1958, 'draft');

// changePostStatus(1955, 'publish');
// changePostStatus(1958, 'publish');

// disable for now 
// checkTheDate(time());

echo "<h1 class='dateTitle'>Checking Global Values from functions.php (1 is true and 0 is false): <br>Is Xmas: ".$xmas ."<br> Is Paddys: ".$paddys."</h1>";

echo developerNotes();

echo  "<hr><h1 class='dateTitle'>List of flowers if its not xmas or paddys</h1>";
echo  get_template_part('flowerGarden/normalList');
echo  "<hr><h1 class='dateTitle'>List of flowers if its xmas</h1>";
echo  get_template_part('flowerGarden/xmasList');
echo  "<hr><h1 class='dateTitle'>List of flowers if its paddys</h1>";
echo  get_template_part('flowerGarden/paddysDay');
echo  "<hr>";
echo "<h1 class='dateTitle'>Shamrock Video</h1>";
echo do_shortcode( '[sfhVideoEmbed video="shamrock" id="2482"]' );
echo "<br><br><br><br>";
echo "<h1 class='dateTitle'>Shamrock Product Page</h1>";
echo "&nbsp;
<h1>Shamrock</h1>
<blockquote>The Shamrock symbolizes Ireland and many things Irish.  It’s three leaves are said to stand for faith, hope and love.</blockquote>
&nbsp;";
echo do_shortcode( '[product_page id="2482"]' );
echo "&nbsp;<h2 class='donateTitle'>Donate, share and show you care</h2>&nbsp;<hr>";
echo "&nbsp;<h1 class='dateTitle'>Email Shamrock Image: </h1>&nbsp;<hr>";
echo '<img style="max-width: 100%; height: auto;" src="https://hospicevirtualflowergarden.com/wp-content/themes/flowerGarden/viewInBrowser/viewInBrowserGenImage.php/?productId=2476&amp;fName=Damian" alt="Email Share Image, Donate Share and Show You Care">';

echo  "<hr>";
echo "<h1 class='dateTitle'>Poinsettia Video</h1>";
echo do_shortcode( '[sfhVideoEmbed video="poinsettia" id="2482"]' );
echo "<br><br><br><br>";
echo "<h1 class='dateTitle'>Poinsettia Product Page</h1>";
echo "&nbsp;
<h1>Poinsettia</h1>
<blockquote>The Poinsettia is also known as the Christmas Star and Christmas Flower. A special thoughtful gift, carrying with it good cheer and festive colours for Christmas.</blockquote>
&nbsp;";
echo do_shortcode( '[product_page id="2482"]' );
echo "&nbsp;<h2 class='donateTitle'>Donate, share and show you care</h2>&nbsp;<hr>";
echo "&nbsp;<h1 class='dateTitle'>Email Poinsettia Image: </h1>&nbsp;<hr>";
echo '<img style="max-width: 100%; height: auto;" src="https://hospicevirtualflowergarden.com/wp-content/themes/flowerGarden/viewInBrowser/viewInBrowserGenImage.php/?productId=2482&amp;fName=Damian" alt="Email Share Image, Donate Share and Show You Care">';
echo "<br><br><br><br>";


echo "</div>";

get_footer();
