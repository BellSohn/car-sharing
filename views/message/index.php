<?php if(isset($_SESSION['identity'])):?>
    <h4 class="profil-messages-title">MY MESSAGES</h4>
    <div class="row row-content">
        <div class="col sent-messages">
            <h5>sent messages</h5>
                <!--messages for the event a message was deleted-->
                <?php if(isset($_SESSION['deleteSentMessage']) && $_SESSION['deleteSentMessage'] == 'complete'):?>
                    <strong class="success">The message was succesfully deleted</strong>
                    <?php elseif(isset($_SESSION['deleteSentMessage']) && $_SESSION['deleteSentMessage'] == 'failed'):?>
                        <strong class="failed">the message was not deleted</strong>
                    <?php endif ?>
                    <?php Utils::deleteSessions('deleteSentMessage')?>
            <?php if($numRows > 0):?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>date</th>
                            <th>title</th>
                        </tr>
                    </thead>
                    <?php while($message = $messageSet->fetch_object()):?>
                        <tr>
                            <td><?= $message->date ?></td>
                            <td><?= $message->title?></td>
                            <td>
                                <form action="<?= base_url?>message/sentMessageDetail" method="POST">
                                    <input type="hidden" name="messageTxt" value="<?=$message->text ?>" />
                                    <input type="hidden" name="messageId" value="<?=$message->id ?>" />
                                    <input type="hidden" name="userDestId" value="<?= $message->user_destination ?>" />
                                    <button type="submit" class="btn btn-primary open-btn">open</button>
                                </form>
                            </td>
                            <td>
                                <form action="<?=base_url ?>message/deleteSentMessage" method="POST">
                                <input type="hidden" name="messageId" value="<?=$message->id ?>" />
                                <button type="submit" class="btn btn-danger delete-btn">delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endwhile ?>
                </table>
                <?php else :?>
                    <h6>there are no messages to show</h6>
                <?php endif; ?>
        </div>
        <div class="col received-messages">
            <h5>received messages</h5>
            <?php if(isset($_SESSION['deleteMessage']) && $_SESSION['deleteMessage'] == 'complete'):?>
                <strong class="success">message successfully deleted</label>
                <?php elseif(isset($_SESSION['deleteMessage']) && $_SESSION['deleteMessage'] == 'failed'):?>
                    <strong class="failed">the message was not deleted</strong>
                    <?php endif ?>
                    <?php Utils::deleteSessions('deleteMessage') ?>                   
            <?php if($recNumRows > 0) :?>
                <!--<h6>los recibimos</h6>-->
                <table class="table">
                    <thead>
                        <tr>
                            <th>date</th>
                            <th>title</th>
                        </tr>
                    </thead>
                    <?php while($recmessage = $receivedMessages->fetch_object()):?>
                        <tr>
                            <td><?=$recmessage->date ?></td>
                            <td><?=$recmessage->title ?></td>
                            <!--<td><?=$recmessage->id?></td>-->
                            <td>
                                <form action="<?= base_url?>message/receivedMessageDetail" method="POST">
                                    <input type="hidden" name="userSentId" value="<?= $recmessage->user_sent ?>">
                                    <input type="hidden" name="messageId" value="<?=$recmessage->id ?>">
                                    <input type="hidden" name="messageText" value="<?=$recmessage->text ?>">
                                    <button type="submit" class="btn btn-success">open</button>                                    
                                </form>
                            </td>
                            <td>
                                <form action="<?= base_url ?>message/deleteReceivedMessage" method="POST">
                                        <input type="hidden" name="messageId" value="<?=$recmessage->id ?>" />
                                        <button type="submit" class="btn btn-danger">delete</button>                                 
                                </form>
                            </td>
                                
                                
                           
                        </tr>
                    <?php endwhile ?>

                </table>
                <?php else :?>
                    <h6>no received messages to show</h6>
                <?php endif ?>    
        </div>
    </div>
<?php else:
    header("Location:".base_url);
?>

    <?php endif; ?>