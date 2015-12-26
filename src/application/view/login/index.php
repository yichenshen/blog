<main>
<div class="container">
	<h1>Login</h1>
	<form action="<?php echo URL; ?>login/auth" method="post">
		
		<div class="form-group">
	    	<label for="username" class="sr-only">Username</label>
	    	<input type="text" name="username" class="form-control" placeholder="Username" required />
	    </div>

	    <div class="form-group">
	    	<label for="password" class="sr-only">Password</label>
	    	<input type="password" name="password" class="form-control" placeholder="Password" required/>
	    </div>

	    <input type="submit" class="btn btn-primary">
	</form>
</div>
</main>