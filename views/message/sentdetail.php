<?php if(isset($_SESSION['identity'])):?>
    <h4 id="detail-message-title">message details</h4>
    <div class="message-detail-container">
        <div>
            <label>message sent to</label>
            <input type="text" class="form-control"
             value="<?=$dataUser->nick ?> (<?=$dataUser->name ." ". $dataUser->surname?>)" disabled />
        </div>
        <div>
            <label>message text</label>            
            <textarea class="rec-msg-txtarea form-control" disabled>
                <?= $messageText ?>
            </textarea>
        </div>
    </div>
    <?php else:
     header("Location:".base_url);
     ?>
       
        <?php endif ?>
