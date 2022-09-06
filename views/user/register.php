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
    <!-- Button trigger modal -->
 <!--   
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button>
    -->

<!-- Modal -->
<!--
<div class="messagepop pop">
    <form method="post" id="new_message" action="/messages">
        <p><label for="email">Your email or name</label><input type="text" size="30" name="email" id="email" /></p>
        <p><label for="body">Message</label><textarea rows="6" name="body" id="body" cols="35"></textarea></p>
        <p><input type="submit" value="Send Message" name="commit" id="message_submit"/> or <a class="close" href="/">Cancel</a></p>
    </form>
</div>-->


<!-- Modal -->
<!--
<div class="messagepop" id="exampleModalCenter">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">users login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url ?>user/login" method="POST">        
        <div>
          <label>email</label>
          <input type="email" name="email" class="form-control" /> 
        </div>
        <div>
          <label>password</label>
          <input type="password" name="password" class="form-control" />
        </div>
        <button type="submit" class="btn btn-success">Login</button>
      </form>      
      <div class="modal-footer">        
      </div>
    </div>
  </div>
</div>
-->
