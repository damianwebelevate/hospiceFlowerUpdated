<?php
?>
<div class="wrap">


<div id="pageOne">
<h2>Change Customer From Name<h2>
    <h3>Select Flower</h3>
    <form action="" id="whichFlowerToUse">
        <ul id="productListDisplay">
            <li id='2482' class="chooseFlower">
                <img src="<?php echo get_stylesheet_directory_uri(). '/images/poinsettia.png' ?>" alt="">
                <h4>Poinsettia</h4>
                <label style="float:left;" for="2482">Select Poinsettia</label>
                <input style="float:right;" type="checkbox" class="checkbox" id="2482" name="2482" >
                <button dataRel="2482" style="display: none;">Add Name and Email</button>
            </li>
            <li id='1748' class="chooseFlower">
                <img src="<?php echo get_stylesheet_directory_uri(). '/images/camellia.png' ?>" alt="">
                <h4>Camellia</h4>
                <label style="float:left;" for="1748">Select Camellia</label>
                <input style="float:right;" type="checkbox" class="checkbox" id="1748" name="1748" >
            </li>
            <li id='1955' class="chooseFlower">
                <img src="<?php echo get_stylesheet_directory_uri(). '/images/daisy.png' ?>" alt="">
                <h4>Daisy</h4>
                <label style="float:left;" for="1955">Select Daisy</label>
                <input style="float:right;" type="checkbox" class="checkbox" id="1955" name="1955" >
            </li>
            <li id='1963' class="chooseFlower">
                <img src="<?php echo get_stylesheet_directory_uri(). '/images/gardenia.png' ?>" alt="">
                <h4>Gardenia</h4>
                <label style="float:left;" for="1963">Select Gardenia</label>
                <input style="float:right;" type="checkbox" class="checkbox" name="1963" >
            </li>
            <li id='1981' class="chooseFlower">
                <img src="<?php echo get_stylesheet_directory_uri(). '/images/lily.png' ?>" alt="">
                <h4>Lily</h4>
                <label style="float:left;" for="1981">Select Lily</label>
                <input style="float:right;" type="checkbox" class="checkbox" name="1981" >
            </li>
            <li id='1970' class="chooseFlower">
                <img src="<?php echo get_stylesheet_directory_uri(). '/images/redrose.png' ?>" alt="">
                <h4>Red Rose</h4>
                <label style="float:left;" for="1970">Select Red Rose</label>
                <input style="float:right;" type="checkbox" class="checkbox" name="1970" >
            </li>
            <li id='48' class="chooseFlower">
                <img src="<?php echo get_stylesheet_directory_uri(). '/images/sunflower.png' ?>" alt="">
                <h4>Sunflower</h4>
                <label style="float:left;" for="48">Select Sunflower</label>
                <input style="float:right;" type="checkbox" class="checkbox" name="48" >
            </li>
            <li id='1975' class="chooseFlower">
                <img src="<?php echo get_stylesheet_directory_uri(). '/images/tulip.png' ?>" alt="">
                <h4>Tulip</h4>
                <label style="float:left;" for="1975">Select Tulip</label>
                <input style="float:right;" type="checkbox" class="checkbox" name="1975" >
            </li>
            <li id='2476' class="chooseFlower">
                <img src="<?php echo get_stylesheet_directory_uri(). '/images/shamrock.png' ?>" alt="">
                <h4>Shamrock</h4>
                <label style="float:left;" for="2476">Select Shamrock</label>
                <input style="float:right;" type="checkbox" class="checkbox" name="2476" >
            </li>

            <li style="background: none; display: none;" id="changeFlower">
                <button style="display: block; margin: 0 auto;" id="changeFlowerAction">Change Flower</button>
            </li>
        </ul>
    </form>

</div>
<div style="clear:both;"></div>

<div id="pageTwo" style="display: none;">
    <h3>Add Details</h3>
    <p class="small"><span class="redText">*</span> Denotes a Required Field</p>

    <p id="errorArea" class="redText" style="display: none;"></p>

    <form action="" id="addDetails">
        <div class="firstHalf">
            <label for="fName">From Name <span class="redText">*</span></label>
        </div>
        <div class="firstHalf">
            <input type="text" name="fName" id="fName" required placeholder="Enter a new From Name">
        </div>
        <p class="small">Enter a New From Name to send to <em>ANY</em> Customer's Email Address</p>
        <div class="firstHalf">
            <label for="email">Customer Email Address <span class="redText">*</span></label>
        </div>
        <div class="firstHalf">
            <input type="email" name="email" id="customerEmail" required placeholder="Enter a valid email address">
        </div>
        <p class="small">Enter the customers email address</p>
        <div class="firstHalf">
            <label for="productId">Product ID</label>
        </div>
        <div class="firstHalf">
            <input type="number" name="productId" id="productId" disabled>
        </div>
        <p class="small">Product ID</p>
        <div class="firstHalf">
            <!-- nothing -->
            &nbsp;
        </div>
        <div class="firstHalf">
            <button id="previewEmail" style="float: right;">Preview Email</button>
        </div>
    </form>
</div>

<div style="clear: both;"></div>

<div id="pageThree" style="display: none;">
    <h3>Preview Email</h3>
    <div class="firstHalf">
        <button id="goBackNow">Go Back</button>
    </div>

    <div class="firstHalf">
        <button style="float: right;" id="sendEmailNow">Send Email</button>
    </div>
    
    <div style="clear:both;"></div>
    
    <div style="display: block; max-width: 600px; min-height: 200px; margin: 0 auto; margin-bottom: 80px; border: 1px solid lightgrey; overflow: auto; background: white;">
    <img style="display: block; margin: 30px auto; width: 200px;" src="https://hospicevirtualflowergarden.com/wp-content/uploads/2020/04/logo.png">
    <div style="position: relative; display: block; min-height:40px">
    <h3 style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:24px;font-weight:300;line-height:150%;margin:0;text-align:center;color:#000;">Hospice Virtual Flower Garden</h3>
    </div>
    <div style="position: relative; padding-left: 20px; display: block; height: 20px; line-height: 20px; font-size: 20px; text-align: left;"></div>
    <div style="position: relative; padding: 48px 48px 32px;">
        <img style="max-width: 100%; height: auto;" id="imageOutput"  alt="Email Share Image, Donate Share and Show You Care">
        </div>
    <div style="position: relative; padding-left: 20px; display: block; height: 20px; line-height: 20px; font-size: 20px; text-align: left;"></div>
    <div style="position: relative; padding-left: 20px; display: block; height: 20px; line-height: 20px; font-size: 20px; text-align: left;"></div>
    <div style="position: relative; padding-left: 20px; display: block; height: 20px; line-height: 20px; font-size: 20px; text-align: left;"></div>
    <div style="position: relative; display: block; min-height: 10px;">
    <p style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:12px;font-weight:300;line-height:150%;margin:0;text-align:center;color:#000;">Copyright <sup>©</sup> 2020 <strong> St. Francis Hospice</strong></p>
    <div style="position: relative; padding-left: 20px; display: block; height: 20px; line-height: 20px; font-size: 20px; text-align: left;"></div>
    </div>
    </div>
    
</div>

<div style="display: none;" id="pageFour">

    <div id="loadingScreen" style="display: none;"><!-- while we are waiting for the email to send -->
        <div class="loader"></div>
        <div class="some"><h1>Sending Email Please Wait...</h1></div>
    </div>
    <div style="display: none;" id="messageArea"><!-- outputs messages and errors if any --> </div>
    <button style="display: none;" id="resetAll">Send Another Email</button>

</div>

</div>
