<?php if(isset($_SESSION['identity'])):?>
<h4 class="profil-account-title">CHANGE THE DETAILS OF YOUR ACCOUNT</h4>
<div class="profil-div">
    <?php
        if(isset($_SESSION['updateperso']) && $_SESSION['updateperso'] == 'complete'):?>
        <strong class="success">update succesfull</strong>
        <?php elseif(isset($_SESSION['updateperso']) && $_SESSION['updateperso'] == 'failed'): ?>
        <strong class="failed">update failed</strong>
        <?php endif; ?>
        <?php Utils::deleteSessions('updateperso'); ?>
     
    <form class="profil-form" action="<?= base_url ?>user/updatePersoData" method="POST">
    <input type="hidden" name="userId" value="<?= $_SESSION['identity']->id ?>" />
        <div>
            <label for="name">name</label>
            <input type="text" name="name" class="form-control" value="<?= $_SESSION['identity']->name ?>" /> 
        </div>
        <div>
            <label for="surname">surname</label>
            <input type="text" name="surname" class="form-control" value="<?= $_SESSION['identity']->surname ?>" />
        </div>
        <div>
            <label for="nick">nick</label>
            <input type="text" name="nick" class="form-control" value="<?= $_SESSION['identity']->nick ?>" />
        </div>
        <div>
            <label for="phone">phone</label>
            <input type="text" name="phone" class="form-control" value="<?= $_SESSION['identity']->phone ?>" />
        </div>
        <div>
            <label for="email">email</label>
            <input type="email" name="email" class="form-control" value="<?= $_SESSION['identity']->email ?>" />
        </div>
        <button type="submit" value="update" class="btn btn-success">Update</button>
    </form>
<div>
<?php else: 
    header("Location:".base_url);
?>
    

<?php endif; ?>