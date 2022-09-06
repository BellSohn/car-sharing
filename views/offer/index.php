<h4 class="search-offer-title">SEARCH THE AVAILABLE OFFER</h4>
<div class="row">
    <div class="col search-criteria">
        <form class="search-form" action="<?= base_url ?>offer/offerSearch" method="POST">
            <div class="col col-destination">
                <!--my search one-->
                <label class="badge  bdg-dest">search by destination</label>
                <input type="text" name="dest-search" class="input-dest form-control" />
            </div>
            <div class="col col-date">
                <label class="badge  bdg-date">search by date</label>
                <input type="date" name="date-search" class="input-date form-control" />
            </div>
            <div class="col col-free-seats">
                <label class="badge  bdg-seats">search by seats</label>
                <input type="number" name="seats-search" class="input-seats form-control" />
            </div>
            <button class="btn btn-success btn-search">search</button>
        </form>  
    </div>
    <?php if(isset($_SESSION['saveMessage']) && $_SESSION['saveMessage'] == 'complete') :?>
                            <div class="col new-message-ok">
                                <h5 class="badge bg-success">The message was successfully sent</h5>
                            </div>
                         <?php elseif(isset($_SESSION['saveMessage']) && $_SESSION['saveMessage'] == 'failed'):?>
                            <div class="col new-message-ok">
                                <h5 class="badge bg-warning">The message was not sent</h5>
                            </div>
                            <?php endif; ?>
                            <?php Utils::deleteSessions('saveMessage')?>
   
   <!--message modal-->
   
    <div class="modal fade" id="exampleModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message to <span id="contact_info"></span></h5>
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

</div>
<?php if(isset($numRows) && $numRows > 0) :?>
        <table class="table table-itineraries-offer">
            <thead>
                <tr>
                    <th>depart date</th>
                    <th>depart time</th>
                    <th>depart place</th>
                    <th>end place</th>
                    <th>free seats</th>
                    <th>get contact</th>
                </tr>
            </thead>
            <?php while($itinerary = $resultSet->fetch_object()) :?>
                <tr>
                    <td><?= $itinerary->depart_date ?></td>
                    <td><?= $itinerary->depart_time ?></td>
                    <td><?= $itinerary->depart_place ?></td>
                    <td><?= $itinerary->end_place ?></td>
                    <td><?= $itinerary->free_seats ?></td>
                    <td>
                        <?php if(isset($_SESSION['identity']) && $_SESSION['identity']->id == $itinerary->id_usuario):?>
                            <!--es tu oferta-->
                            <img src="<?= base_url ?>assets/images/user.png" alt="user logged">
                        <?php elseif(isset($_SESSION['identity'])) :?>   
                            <!--contacto--> 
                            <a href="#" class="contact" value="<?= $itinerary->id_usuario ?>"><img src="<?= base_url ?>assets/images/contact.png" alt="user contact"></a>
                        <?php elseif(!isset($_SESSION['identity'])):?>    
                            <label class="linkto-register">members only,<a href="<?= base_url ?>user/register">be member</a></label>
                            <?php endif ?>
                            
                    </td>
                    
                </tr>
            <?php endwhile; ?>
            <span class="badge bg-warning" id="reset-search">new search</span>
        </table>
    <?php elseif(isset($numRows) && $numRows == 0) :?>
        <h5 id="noresults-found">no results were found</h5>
    <?php endif; ?>





 