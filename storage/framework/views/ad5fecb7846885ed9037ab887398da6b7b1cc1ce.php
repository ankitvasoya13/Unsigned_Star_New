<!DOCTYPE html>
<html>

<head>
    <title>Welcome Email</title>
</head>

<body>
    
    <br />
    
    
    Please click on the below link to verify your email account
    <br />
    <a href="<?php echo e(url('user/verify', $user->token)); ?>">Verify Email</a>
</body>

</html>