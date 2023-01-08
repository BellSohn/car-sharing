<h2 class="register-user-title">REGISTER NEW COSTUMER</h2>
<?php
    if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete') :?>
    <strong class="success">register successfully completed</strong>
    <span class="spn-login"><a href="#" class="to-login" data-toggle="modal" data-target="exampleModalCenter">login</a></span>
    <?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed') :?>
    <strong class="failed">register failed.Please check the data.</strong>
    <?php endif; ?>
    <?php  Utils::deleteSessions('register');
?>
<div class="client-register-form">

    <form class="register-form" action="<?= base_url?>user/saveUser" method="POST">
        <div>
            <label for="name">name</label>
            <input type="text" name="name" class="form-control" />    
        </div>
        <div>
            <label for="surname">surname</label>
            <input type="text" name="surname" class="form-control" />
        </div>
        <div>
            <label for="nick">nick</label>
            <input type="text" name="nick" class="form-control" />
        </div>
        <div>
            <label for="phone">phone</label>
            <input type="text" name="phone" class="form-control" />
        </div>
        <div>
            <label for="email">email</label>
            <input type="email" name="email" class="form-control" />
        </div>
        <div>
            <label for="password">password</label>
            <input type="password" name="password" class="form-control" />
         </div>
         <div>
             <label for="role">role</label>
             <input type="role" name="role" class="form-control" value="user" />
         </div>
         <button type="submit" class="btn btn-success">Send</button>
    </form>
    
