<?php
// Report runtime errors
ini_set("display_errors", "1");
error_reporting(E_ALL);

include_once 'libs/Validator.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>PHP OOP Form Validation</title>
	<link rel="stylesheet" type="text/css" href="../jjv/css/bootstrap.min.css" />
	<style type="text/css">
	.red{
	    color:red;
	    }
	.form-area
	{
	    background-color: #FAFAFA;
		padding: 10px 40px 60px;
		margin: 10px 0px 60px;
		border: 1px solid GREY;
	}
	</style>
</head>
<body>
<div class="container">
	<div class="col-md-6 col-md-offset-3">
		<div class="form-area">  
		    <form role="form" action="" method="post">
		        <br style="clear:both">
		        <h3 style="margin-bottom: 25px; text-align: center;">PHP OOP Form Validation</h3>
		        <?php
				if( isset( $_POST['submit'] ) ) :
					$rules2 = array(
						array(
							'field' => 'name',
							'label' => 'Customer Name',
							'rules' => 'required|minlength:6|maxlength:12'
						),
						array(
							'field' => 'email',
							'label' => 'Email Address',
							'rules' => 'required|valid_email'
						),
						array(
							'field' => 'mobile',
							'label' => 'Mobile Number',
							'rules' => 'required|valid_mobile'
						),
						array(
							'field' => 'subject',
							'label' => 'Subject',
							'rules' => 'required|minlength:6|maxlength:12'
						),
						array(
							'field' => 'message',
							'label' => 'Message',
							'rules' => 'required|minlength:25|maxlength:500'
						)
					);

					Validator::set_rules( $rules2 );
					Validator::run();

					if( Validator::$hasError ) {
						echo '<div class="alert alert-warning">' . Validator::display_errors() . '</div>';
					} else {
						echo 'No Error';
					}
				endif;
				?>
		    	<div class="form-group">
					<input type="text" class="form-control" id="name" value="<?php echo Validator::set_value('name', ''); ?>" name="name" placeholder="Name">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" id="email" value="<?php echo Validator::set_value('email', ''); ?>" name="email" placeholder="Email">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" id="mobile" value="<?php echo Validator::set_value('mobile', ''); ?>" name="mobile" placeholder="Mobile Number" ng-pattern="/^(?:\+88|01)?(?:\d{11}|\d{13})$/">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" id="subject" value="<?php echo Validator::set_value('subject', ''); ?>" name="subject" placeholder="Subject">
				</div>
		        <div class="form-group">
		            <textarea class="form-control" type="textarea" id="message" name="message" placeholder="Message" maxlength="260" rows="7"><?php echo Validator::set_value('message', ''); ?></textarea>
		        	<span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>                    
		        </div>
		            
		        <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right">Submit Form</button>
		    </form>
		</div>
	</div>
</div>
<script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($){ 
	    $('#characterLeft').text('260 characters left');
	    $('#message').keydown(function () {
	        var max = 260;
	        var len = $(this).val().length;
	        if (len >= max) {
	            $('#characterLeft').text('You have reached the limit');
	            $('#characterLeft').addClass('red');
	            $('#btnSubmit').addClass('disabled');            
	        }
	        else {
	            var ch = max - len;
	            $('#characterLeft').text(ch + ' characters left');
	            $('#btnSubmit').removeClass('disabled');
	            $('#characterLeft').removeClass('red');            
	        }
	    });
	});
</script>
</body>
</html>