<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

    <title>Google maps integration to Codeigniter Framework</title>    
    <head><?php
        echo $map['js'];
        ?>
        <style>
            .googlemap
            {
                background-color: aquamarine;
                alignment-adjust: central;
            }
            .tb10 {
                background-image:url(images/form_bg.jpg);
                background-repeat:repeat-x;
                border:1px solid #d1c7ac;
                width: 306px;
                height:30px;
                color:#333333;
                padding:3px;
                margin-right:4px;
                margin-bottom:8px;
                font-family:tahoma, arial, sans-serif;
            }
            input#submitbutton {
                border:2px groove #7c93ba;
                cursor:pointer; /*forces the cursor to change to a hand when the button is hovered*/
                padding: 5px 25px;
                /*give the background a gradient - see cssdemos.tupence.co.uk/gradients.htm for more info*/
                background-color:#6b6dbb; /*required for browsers that don't support gradients*/
                background: -webkit-gradient(linear, left top, left bottom, from(#88add7), to(#6b6dbb));
                background: -webkit-linear-gradient(top, #88add7, #6b6dbb);
                background: -moz-linear-gradient(top, #88add7, #6b6dbb);
                background: -o-linear-gradient(top, #88add7, #6b6dbb);
                background: linear-gradient(top, #88add7, #6b6dbb);
                /*style to the text inside the button*/
                font-family:Andika, Arial, sans-serif; /*Andkia is available at http://www.google.com/webfonts/specimen/Andika*/
                color:#fff;
                font-size:1.1em;
                letter-spacing:.1em;
                font-variant:small-caps;
                /*give the corners a small curve*/
                -webkit-border-radius: 0 15px 15px 0;
                -moz-border-radius: 0 15px 15px 0;
                border-radius: 0 15px 15px 0;
                /*add a drop shadow to the button*/
                -webkit-box-shadow: rgba(0, 0, 0, .75) 0 2px 6px;
                -moz-box-shadow: rgba(0, 0, 0, .75) 0 2px 6px;
                box-shadow: rgba(0, 0, 0, .75) 0 2px 6px;
            }
            /***NOW STYLE THE BUTTON'S HOVER AND FOCUS STATES***/
            input#submitbutton:hover, input#submitbutton:focus {
                color:#edebda;
                /*reduce the spread of the shadow to give a pushed effect*/
                -webkit-box-shadow: rgba(0, 0, 0, .25) 0 1px 0px;
                -moz-box-shadow: rgba(0, 0, 0, .25) 0 1px 0px;
                box-shadow: rgba(0, 0, 0, .25) 0 1px 0px;
            }
        </style>
    </head>
    <body>
        <div class="googlemap">
        </div>
        <center>
            <form action="google" name="mapfrm" method="post">
                <input type="text" class='tb10' value="" id="mapposition" name="mapposition" placeholder="<?php echo $_REQUEST['states'] . ',' . $_REQUEST['city']; ?>"></input>
                <!--<input type="submit" name="submitbutton" id='submitbutton' value="Add Marker">-->
            </form></center>
        <br>    
            <?php echo $map['html']; ?>
    </body>
</html>