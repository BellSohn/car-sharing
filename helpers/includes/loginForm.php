<!DOCTYPE HTML>
<html lang="es">
<div class="login-modal-container">
 <!-- Modal -->
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
</div>
</html>
