<style>
 
.one-liner {
    justify-content: center;
}

.one-liner .group {
    margin: 13px;
    width: 100%;
}

.group.mas_center {
    text-align: center;
    display: flex;
    justify-content: center;
}

button#mas_custom_keys {
   background-color: #333 !important;
    color: white;
    padding: 15px 45px;
    border-radius: 10px;
    font-size: 17px;
    border: none;
}

button#mas_update_keys {
   background-color: #333 !important;
    color: white;
    padding: 15px 45px;
    border-radius: 10px;
    font-size: 17px;
    border: none;
}


       .one-liner {
  flex-direction: row;
  display: flex;
  flex-wrap: nowrap;
  align-content: center;
  justify-content: space-between;
  align-items: baseline;
}
#footer-thankyou {
    display: none;
}
#payment-form {
    width: 55% !important;
    background:transparent !important;
}
#payment-form .group{
  margin: 0 10px;
  width: 100% !important;
}
#payment-form .group input,
#payment-form .group input:focus{
background:#f4f4f4 !important;
  width: 100% !important;
    margin-bottom: 25px !important;
    border: 1px solid #c4c4c4;
    height: 50px !important;
    font-size: 16px;
    margin: 0;
    padding: 12px;
    border-radius: 30px !important;
    color: black !important;

}

button#mas_showard {
    background: #333 !important;
    border: 0;
    color: #f7f7f7;
    transition: all .5s;
    height: 50px;
    font-size: 20px;
    margin: 0;
    padding: 12px;
    width: 100%;
    border-radius: 10px;
}
button#mas_showard:hover {
    cursor: pointer;
}
form#payment-form .checkout-form {
    display: none;
}
.iti.iti--allow-dropdown {
    width: 100%;
}

#payment-form .group input#phone {
    padding-left: 50px !important;
}
.iti.iti--allow-dropdown .iti__selected-flag {
    height: 50px;
}



.iti--allow-dropdown .iti__flag-container:hover .iti__selected-flag {
    background-color: transparent;
}


iframe#cardNumber,
#expiryDate,
#cvv{
  border:none !important;
  outline:none !important;
  background:#f4f4f4 !important;
}
input#amount:before {
     position: absolute;
     top: 0;
     content:"€";
 }
 input#amount{
  position:relative;
 }
#payment-form .group label{
  color: black;
}
.container{
  padding:40px;
  background:#E99C1B;
}
.form-title span.form-subtitle{
  font-size:16px;
  color:#fff;
}
.form-title h3.form-main-title{
  color:#fff;
  font-size:22px;
  text-transform:uppercase;
}

form#customkeys_form input:focus {
    background-color: white !important;
}


.button-submit,
#pay-button{
  background:#333 !important;

  border: 0;
    color: #f7f7f7;
    transition: all .5s;
    height: 50px;
    font-size: 20px;
    margin: 0;
    padding: 12px;
    width: 100%;
    border-radius: 10px;


}
button#mas_custom_keys:hover {
    cursor: pointer;
}

button#mas_update_keys:hover {
    cursor: pointer;
}
form#customkeys_form input[type=radio] {
    height: 16px !important;
}

</style>

<?php

global $wpdb;
$cardinputtable = $wpdb->prefix.'card_keys';
$result_input = $wpdb->get_results( "SELECT * FROM $cardinputtable WHERE card_keys_id = 1" );
$colm1 =  "";
$colm2 =  "";
$colm3 =  "";
$colm4 =  "";
$colm5 =  "";
$colm6 =  "";
$colm7 =  "";

foreach ($result_input as $post){
$colm1 = $post->secretcard_key ?? "";
$colm2 = $post->publiccard_key ?? "";
$colm3 = $post->threed_key ?? "";
$colm4 = $post->capture_key ?? "";
$colm5 = $post->success_url ?? "";
$colm6 = $post->failure_url ?? "";
$colm7 = $post->environment ?? "";
}



?>


<div class="container">
      <div class="form-title" style="text-align:center;">
      <h3 class="form-main-title">
      Checkout Gateway Settings
    </h3>
      </div>
    <form
      id="customkeys_form"
      method="POST" action="#">

      <div class="one-liner">
      <div class="group">
      <label for="name" class="label">Environment *</label>
        <input name="environment" type="radio" class="input" value="sandbox" required <?php 
if($colm7=='sandbox'){
?>
checked
<?php
}else{

}
        ?>> Sandbox
        <input name="environment" type="radio" class="input" value="live" <?php 
if($colm7=='live'){
?>
checked
<?php
}else{

}
        ?>> Live
			</div>
</div>

  <div class="one-liner">
      <div class="group">
				<label for="name" class="label">Secret Key *</label>
				<input id="secret_key" name="secret_key" type="text" class="input" placeholder="Enter Secret Key" required="required" value=<?php echo $colm1 ?> >
			</div>
			<div class="group">
			<label for="name" class="label">Public Key *</label>
			<input id="public_key" type="text" name="public_key" class="input" placeholder="Enter Public Key" required="required" value=<?php echo $colm2 ?> >
      </div>
</div>

<div class="one-liner">
      <div class="group">
				<label for="success_url" class="label">Success URL</label>
				<input id="success_url" name="success_url" type="text" class="input" placeholder="Enter success url"   value=<?php echo $colm5 ?> >
			</div>
			<div class="group">
			<label for="failure_url" class="label">Failure URL</label>
			<input id="failure_url" type="text" name="failure_url" class="input" placeholder="Enter failure url" value=<?php echo $colm6 ?> >
      </div>
</div>

<div class="one-liner">
      <div class="group">
        <label for="name" class="label">3D *</label>
        <input name="threed_key" type="radio" class="input" value="yes" required <?php 
if($colm3=='yes'){
?>
checked
<?php
}else{

}
        ?>> Yes
        <input name="threed_key" type="radio" class="input" value="no" <?php 
if($colm3=='no'){
?>
checked
<?php
}else{

}
        ?>> No
      </div>
      <div class="group">
      <label for="name" class="label">Capture *</label>
      <input name="capture_key" type="radio" class="input" value="yes" required <?php 
if($colm4=='yes'){
?>
checked
<?php
}else{

}
        ?>> Yes
        <input name="capture_key" type="radio" class="input" value="no" <?php 
if($colm4=='no'){
?>
checked
<?php
}else{

}
        ?>> No
      </div>
</div>  

    <div class="group mas_center" style="margin:0px !important;">
<button type="submit" name="submit_custom_keys" class="mas_submit_keys" id="mas_custom_keys">Save</button>
<button type="submit" name="update_custom_keys" class="mas_update_keys" id="mas_update_keys">Update</button>
</div>

 </form>
    </div>
      
 
<?php
 


global $wpdb;
  $tblname = 'card_keys';
  $wp_track_table = $wpdb->prefix . "$tblname";
  
$charset_collate = $wpdb->get_charset_collate();

//$sqldel = "DROP TABLE ` wp_card_keys `";
$sql = "CREATE TABLE $wp_track_table (
  `card_keys_id` int(255) NOT NULL,
  `secretcard_key` varchar(255) NOT NULL,
  `publiccard_key` varchar(255) NOT NULL,
  `threed_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `capture_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `success_url` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `failure_url` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `environment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`card_keys_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );

    $cardinputtable = $wpdb->prefix.'card_keys';
    $result = $wpdb->get_results("SELECT card_keys_id from $cardinputtable WHERE `card_keys_id` IS NOT NULL");
    if(count($result) == 0)
    {

      if(isset($_POST['submit_custom_keys'])) {
        echo "<meta http-equiv='refresh' content='0'>";
        $db_secret_key=$_POST['secret_key'];
        $db_public_key=$_POST['public_key'];
        $db_threed_key=$_POST['threed_key'];
        $db_capture_key=$_POST['capture_key'];
        $db_success_url=$_POST['success_url'];
        $db_failure_url=$_POST['failure_url'];
        $db_environment =$_POST['environment'];

  $custom_tablename=$wpdb->prefix.'card_keys';

      $custom_table_data=array(
        'card_keys_id'=>1,
        'secretcard_key'=>$db_secret_key,
        'publiccard_key'=>$db_public_key,
        'threed_key'=>$db_threed_key,
        'capture_key'=>$db_capture_key,
        'success_url'=>$db_success_url,
        'failure_url'=>$db_failure_url,
        'environment'=>$db_environment
      );


    $wpdb->insert( $custom_tablename, $custom_table_data);

    }
?>
<style type="text/css">
  .mas_submit_keys{
    display: block;
  }
  .mas_update_keys{
    display: none;
  }

</style>
<?php
  }

    else
    {

?>
<style type="text/css">
  .mas_submit_keys{
    display: none;
  }
  .mas_update_keys{
    display: block;
  }

</style>
<?php
if(isset($_POST['update_custom_keys'])) {

  $table = $wpdb->prefix . 'card_keys';
 $altersql = "ALTER TABLE `{$table}`
    ADD `environment` CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;";

$query_result = $wpdb->query( $altersql );

        echo "<meta http-equiv='refresh' content='0'>";
        $db_secret_key=$_POST['secret_key'];
        $db_public_key=$_POST['public_key'];
        $db_threed_key=$_POST['threed_key'];
        $db_capture_key=$_POST['capture_key'];
        $db_success_url=$_POST['success_url'];
        $db_failure_url=$_POST['failure_url'];
        $db_environment = $_POST['environment'];
        $db_card_update_keys_id=1;

  $custom_tablename=$wpdb->prefix.'card_keys';

      $custom_table_data=array(
        'secretcard_key'=>$db_secret_key,
        'publiccard_key'=>$db_public_key,
        'threed_key'=>$db_threed_key,
        'capture_key'=>$db_capture_key,
        'success_url'=>$db_success_url,
        'failure_url'=>$db_failure_url,
        'environment'=>$db_environment
      );

      $custom_fixed_id=array(
        'card_keys_id'=>$db_card_update_keys_id
      );

    $wpdb->update( $custom_tablename, $custom_table_data, $custom_fixed_id);

    }
        //echo "filled";

    }





?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
  
$(document).ready(function(){

console.log('custom field page');
  });


</script>

