<?php

/*
*
*
* Template Name: Flower Garden
* This is the template to load the videos from the server and display
* Should the theme of wordpress be changed then use the animation template for
* this page to display correctly
* **Note that this page does not include the wordpress post loop
*
*/

?>
<?php get_header(); ?>
<?php echo "<div style='width: 100%; min-height: 80px; overflow: auto;'><!-- spacer --></div>";?>



<?php
// use this to check current values and override to see output
// $xmas = 0;
// $paddys = 1;

    if(($xmas == 1) && ($paddys == 0)){
        echo get_template_part('flowerGarden/xmasList');
    }elseif(($xmas == 0)&&($paddys == 1)){
        get_template_part('flowerGarden/paddysDay');
    }else{
        get_template_part('flowerGarden/normalList');
    }
?>

<?php get_footer(); ?>
