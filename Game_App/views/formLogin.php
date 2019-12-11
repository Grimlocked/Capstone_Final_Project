<div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="index.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <?php if(!empty($username_err)): ?>
                    <span class="help-block"><?php echo $username_err; ?></span>
                <?php endif; ?>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <?php if(!empty($password_err)): ?>
                    <span class="help-block"><?php echo $password_err; ?></span>
                <?php endif; ?>
                
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="action" value="checkLogin">
            </div>
        </form>
</div>