<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<span>INSAE </span><i class="fa fa-shopping-cart"></i>
		</div>
		<!-- /.login-logo -->
		<div class="login-box-body">
			<p class="login-box-msg">Iniciar sesión</p>

			<form method="post">
				<div class="form-group has-feedback">
					<input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" placeholder="Contraseña" name="IngPassword" required>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="row">
					<!-- /.col -->
					<div class="col-xs-4 col-xs-offset-4">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Aceptar</button>
					</div>
					<!-- /.col -->
				</div>
			</form>

		</div>
		<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery 3 -->
	<script src="views/bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- iCheck -->
	<script src="views/plugins/iCheck/icheck.min.js"></script>
	<script>
		$(function () {
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
  });
		});
	</script>
</body>