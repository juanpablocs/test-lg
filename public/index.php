<?php
    use Model\User;
    use Service\PasswordValidator;

    require dirname(__FILE__) . '/../autoload.php';

    $post = sanitize_request($_POST);
    $errors = [];
    $success = false;
    $user = new User(USER_FAKE_ID);

    if(!$user->exist()) {
        die('Access Restricted');
    }

    $current_password = $post['current_password'];
    $new_password = $post['new_password'];
    $confirm_password = $post['confirm_password'];

    if (isset($current_password)) {

        $passwords = [
            'current_password' => $current_password, 
            'new_password' => $new_password, 
            'confirm_password' => $confirm_password 
        ]; 

        foreach($passwords as $k => $pass) {
            $passValidator = new PasswordValidator($pass);
            $passValidator->valid();
            $errors[$k] = $passValidator->getErrors();
        }

        if(!password_verify($current_password, $user->getPassword())) {
            $errors['current_password'][] = 'Password Invalid';
        }

        if( countErrors($errors) === 0 && $new_password !== $confirm_password) {
            $errors['current_password'][] = 'The new password does not match';
        }

        if(countErrors($errors) === 0) {
            $success = true;
            $user->updatePassword(password($new_password));
        }
    }

?>

<h3>Change your password</h3>
<p>Welcome <?php echo $user->getName(); ?> </p>

<form method='post'>
    
    <?php if($success): ?>
        <p>Changes saved correctly</p>
    <?php else: ?>
        <pre style='border: 1px solid #ddd;background: #eee;padding: 10px'>
            <?php countErrors($errors) > 0 ? trim(print_r($errors)) : null; ?>
        </pre>
    <?php endif; ?>

    <div>
        <label>Current Password</label>
        <input type='password' name='current_password' placeholder='Current Password' />
    </div>

    <div>
        <label>New Password</label>
        <input type='password' name='new_password' placeholder='New Password' />
    </div>

    <div>
        <label>Confirm Password</label>
        <input type='password' name='confirm_password' placeholder='Confirm Password' />
    </div>

    <button type='submit'>Save</button>
</form>