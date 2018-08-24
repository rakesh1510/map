<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Country-Region DropDown Menu</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
        <style type="text/css">
            .login-form {
                width: 340px;
                margin: 50px auto;
            }
            .login-form form {
                margin-bottom: 15px;
                background: #f7f7f7;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                padding: 30px;
            }
            .login-form h2 {
                margin: 0 0 15px;
            }
            .form-control, .btn {
                min-height: 38px;
                border-radius: 2px;
            }
            .btn {        
                font-size: 15px;
                font-weight: bold;
            }
        </style>
    </head>
    <?php
    print_r($_REQUEST);
    ?>
    <?php echo validation_errors(); ?>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center" style="margin-bottom:40px;">
                    <h2>Country-Region DropDown Menu</h2>
                </div>
                <div class="col-md-12">
                    <form class="form-horizontal" action="<?php echo base_url() . 'index.php/map/show_map' ?>" method="post">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Country</label>
                            <?php
                            $CI = &get_instance();
                            $countries = $CI->get_Country();
                            ?>

                            <select name="country" id="country">
                                <option value="selectcountry">Select your country*</option>
                                <?php
                                foreach ($countries as $key => $country) {
                                    ?>                                   
                                    <option value="<?php echo $country['country_name']; ?>"   <?php
                                    if ($country['country_name'] == $_REQUEST['country']) {
                                        echo "selected";
                                    }
                                    ?>><?php echo $country['country_name']; ?> </option>
                                        <?php }
                                        ?>
                            </select>
                            <!--                        <div class="col-sm-10">
                                                        <select class="form-control gds-cr gds-countryflag" country-data-region-id="gds-cr-1"></select>
                                                    </div>-->
                        </div>
                        <div class="form-group">
                            <label for="gds-cr-1" class="col-sm-2 control-label">State</label>
                            <div id="state">
                                <select name="states" id="states" >
                                    <option value="">Select your State</option>
                                </select>                            

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gds-cr-1" class="col-sm-2 control-label">City</label>
                            <div id="city">
                                <select name="city" id="city" >
                                    <option value="">Select your City</option>
                                </select>                            
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-primary" style="margin-left: 200px">Click</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>


<script>
    $(document).ready(function () {

        $('#country').on('change', function () {
            var country_id = $(this).val();
//            alert($_REQUEST['states']);
        //            var country_id = $(this).val();
            if (country_id == '') {
                $('#state').prop('disable', true);
            } else {

//                $('#state').prop('disable', false);
//                alert(country_id);


                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/map/get_state",
//                    data: {textbox: $("#fullname").val()},
                    data: {'country_id': country_id},
//                    dataType: "json",
//                    cache: false,
                    success:
                            function (data) {
                                $('#state').html(data);
                            }
                });

            }

        })

//        $('#states').on('change', function () {


    })
    function getData(city_ids) {
        $(document).ready(function () {
            var city_id = city_ids;
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/map/get_city",
                data: {'city_id': city_id},
                success:
                        function (data) {
                            $('#city').html(data);
                        }
            });
        });
    }
    function selectRegion(city_name) {
        getData(city_name);
//            var city_id = $(this).val();
//        alert(city_id);
    }


</script>