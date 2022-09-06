<?php if(isset($_SESSION['identity'])):?>
    <h4 id="received-message-title">Received message detail</h4>
    <div class="message-detail-container">
        <div>
            <label>message received from</label>
            <!--here I set data in session super global to use them in modal div-->
            <?php $_SESSION['sendDataId'] = $userSentData->id ?>
            <?php $_SESSION['sendDataNick'] = $userSentData->nick ?>            
            <?php $_SESSION['sendDataName'] = $userSentData->name ?>
            <?php $_SESSION['sendDatasurname'] = $userSentData->surname ?>
            <!--message in the case the answer message was successfully sent-->
            <?php if(isset($_SESSION['saveAnswerMessage']) && $_SESSION['saveAnswerMessage'] === 'complete') :?>
                <strong class="success">the message was succesfully sent</strong>
            <?php elseif(isset($_SESSION['saveAnswerMessage']) && $_SESSION['saveAnswerMessage'] === 'failed') :?> 
                <strong class="failed">the message was not sent</strong>   
                <?php endif ?>
                <?php Utils::deleteSessions('saveAnswerMessage') ?>
            <input type="text" class="form-control message-sender" 
            value="<?= $userSentData->nick ?> (<?= $userSentData->name ?> <?= $userSentData->surname ?>)" disabled />
            <button class="btn btn-success" id="answer-button">answer</button>
        </div>
        <div>
            <label>message Text</label>
            <?php foreach($receivedMessageText as $text) :?>            
            <textarea class="rec-msg-txtarea form-control" disabled>
                <?= $text ?>
            </textarea>
            <?php endforeach ?>
        </div>
    </div>
    <?php else:
        header("Location:".base_url);
     ?>
    
        
    <?php endif ?>
     <!--respuesta modal -->
     <div class="modal fade" id="answerModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                 id="exampleModalLabel">answer to <?=$_SESSION['sendDataNick']?>
                 (<?=$_SESSION['sendDataName']?><?=$_SESSION['sendDatasurname']?>)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url?>message/insertAnswerMessage" method="POST">
                    <input type="hidden" name="logged_user_id" value="<?=$_SESSION['identity']->id?>" />
                    <input type="hidden" name="itinerary_user_id" id="user_itinerary" value="<?=$_SESSION['sendDataId']?>" />
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
                        <button type="submit" class="btn btn-success" >Send message</button>
                    </div>
                </form>
            </div>            
            </div>
        </div>
     </div>  