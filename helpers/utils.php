<?php

class Utils{

public static function deleteSessions($name){
    if(isset($_SESSION[$name])){
        $_SESSION[$name] = null;
        unset($_SESSION[$name]);
    }

    return $name;
}

public static function isIdentity(){
  if(!isset($_SESSION['identity'])){
    header("Location:".base_url);
  }else{
    return true;
  }
}

public static function logout(){
    if(isset($_SESSION['identity'])){
        $_SESSION['identity'] = null;
        unset($_SESSION['identity']);
    }
}

public static function loadLoginForm(){

    return `<div class="messagepop" id="exampleModalCenter">
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
  </div>`;
}


}