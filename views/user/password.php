<?php if(isset($_SESSION['identity'])) :?>
    <h4 class="profil-repass-title">PASSWORD REBUILD</h4>
    <content class="pass-upt-content">
        <?php if(isset($_SESSION['updatePassword']) && $_SESSION['updatePassword'] == 'updated') :?>
            <strong class="success">Password successfully updated</strong>
            <?php elseif(isset($_SESSION['updatePassword']) && $_SESSION['updatePassword'] == 'failed'):?>
                <strong class="failed">Password update failed</strong>
            <?php endif; ?>
            <?php Utils::deleteSessions('updatePassword');?>
        <form class="pass-upt-form" action="<?= base_url?>user/updatePassword" method="POST">
            <div>
                <label for="">actual password</label>
                <input type="password" name="password" class="pass-field form-control" />
            </div>
            <div>
                <label for="">nue password</label>
                <input type="password" name="newpass" class="pass-new form-control" />
            </div>
            <div>
                <label for="">confirm the new password</label>
                <input type="password" name="confirmpass" class="pass-confirm form-control" />
            </div>
            <button type="submit" class="btn btn-warning update-btn">password update</button>
        </form>
        <div class="warning-msg">confim doesnt match new password</div>
    </content>
    <?php else:
        header("Location:".base_url);
     ?>

    <?php endif; ?>