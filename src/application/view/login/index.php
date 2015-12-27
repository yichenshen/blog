<main>
<div class="container">
<br />

	<div class="row">

		<div class="col-md-offset-3 col-md-6">

			<div class="panel panel-default">

				<div class="panel-heading">
					<h1 class="panel-title">Login</h1>
				</div>

				<div class="panel-body">

					<?php if(isset($error)): ?>
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							
							<strong>Error!</strong>
							<?php echo $error; ?>
						</div>
					<?php endif; ?>

					<form action="<?php echo URL; ?>login/auth" method="post">

						<div class="form-group">
					    	<label for="username" class="sr-only">Username</label>
					    	<input 	<?php if(isset($user)){ echo 'value=' . $user; } ?>
					    			type="text" 
					    			name="username" 
					    			class="form-control" 
					    			placeholder="Username" 
					    			required />
					    </div>

					    <div class="form-group">
					    	<label for="password" class="sr-only">Password</label>
					    	<input type="password" name="password" class="form-control" placeholder="Password" required/>
					    </div>

					    <input type="submit" class="btn btn-block btn-primary">
					</form>
				</div>
			</div>
		</div>
	</div>
</main>