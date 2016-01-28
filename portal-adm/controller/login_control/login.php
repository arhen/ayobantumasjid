 <script src="<?php echo URL; ?>js/md5.js"></script>
 <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" id='login' action="<?php echo URL;?>login/cek" method='POST'>
		        <h2 class="form-login-heading">Masuk</h2>
		        <div class="login-wrap">
		            <input type="text" class="form-control" name='username' placeholder="Username" autofocus>
		            <br>
		            <input type="password" class="form-control" name='pass' placeholder="Password" id='password'>
		            <label class="checkbox">
		            </label>
		            <button class="btn btn-theme btn-block" name='login' value='login' type="submit"><i class="fa fa-lock"></i> Masuk</button>
		            <br/>
					<?php 
					if(!empty($_GET['login'])){
						echo "<center><b style='color:red;'>Password Salah </b></center>";
						
					}
					?>
					<hr>

		
		        </div>
		
		
		      </form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    
	  <script type="text/javascript">
	  function sub(){
		// var password = $('#password').val();
		var md5 = CryptoJS.MD5(CryptoJS.MD5(password)+CryptoJS.MD5(password));
		
		// var aaa = $('#hiddenpassword').val(md5);
		
		var ssss = document.getElementById("password").value = md5;
		
		alert(ssss);
		
		return false;
	  
	  };
	  
	</script>