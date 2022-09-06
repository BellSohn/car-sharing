<h4 class="user-seek-title">USERS SEEKS</h4>
<?php if($numRows < 0)  :?>
    <h4>No hay resultados</h4>
    <?php else :?>
        <!--<h4>mostramos los resultados</h4>-->
        <table class="table table-itineraries-offer">
            <thead>
                <tr>
                    <th>to</th>
                    <th>from</th>
                    <th>when</th>
                    <th>places demanded</th>
                    <th>get contact</th>
                </tr>
            </thead>
            <?php while($seek = $allAvailableSeek->fetch_object()):?>
                <tr>
                    <td><?=$seek->end_place ?></td>
                    <td><?=$seek->start_place ?></td>
                    <td><?=$seek->depart_date ?></td>
                    <td class="pl-demanded"><?=$seek->seats_demanded ?></td>
                    <td>
                    <?php if(isset($_SESSION['identity']) && $_SESSION['identity']->id == $seek->id_usuario):?>
                            <!--es tu oferta-->
                            <img src="<?= base_url ?>assets/images/user.png" alt="user logged">
                        <?php elseif(isset($_SESSION['identity'])) :?>   
                            <!--contacto--> 
                            <a href="#" class="contact" value="<?= $seek->id_usuario ?>"><img src="<?= base_url ?>assets/images/contact.png" alt="user contact"></a>
                        <?php elseif(!isset($_SESSION['identity'])):?>    
                            <label class="linkto-register">members only,<a href="<?= base_url ?>user/register"> be member</a></label>
                            <?php endif ?>
                    </td>
                    
                </tr>
            <?php endwhile ?>
            
        </table>
<?php endif ?>    
<!--message modal-->
   
<div class="modal fade" id="exampleModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url?>offer/insertMessage" method="POST">
                    <input type="hidden" name="logged_user_id" value="<?=$_SESSION['identity']->id?>" />
                    <input type="hidden" name="itinerary_user_id" id="user_itinerary" value="" />
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">title</label>
                        <input type="text" name="msg-title" class="form-control" id="message-title">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" name="msg-text" id="message-text"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Send message</button>
                    </div>
                </form>
            </div>
            
            </div>
        </div>
     </div>  