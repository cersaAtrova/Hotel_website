<div class="container text-center">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
        <p class="display-3">Create Your Password</p>
        <div class="container w-50">
            <input type="password" class="text-form-control p-2 mb-3" placeholder="Enter your password" name="new_passwd" id="passwd" minlength="6" required>
            <input type="submit" name="update_passwd" id="reserved" class="ui btn btn-nav btn-primary" value="Update">
        </div>
    </form>
</div>