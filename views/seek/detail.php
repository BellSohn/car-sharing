<?php if(isset($_SESSION['identity'])) :?>
    <h4 id="seek-detail-title">SERCH DETAIL</h4>
    <content class="itinerary-detail-content">
        <?php if(isset($_SESSION['seekUpdate']) && $_SESSION['seekUpdate'] == 'complete') :?>
            <strong class="success">search successfully updated</strong>
            <?php elseif(isset($_SESSION['seekUpdate']) && $_SESSION['seekUpdate'] == 'failed') :?>
                <strong class="failed">search update failed</strong>
                <?php endif; ?>
                <?php Utils::deleteSessions('seekUpdate') ?>
        <form class="serch-detail-form" action="<?= base_url ?>seek/updateSeek" method="POST">
            <input type="hidden" name="seekId" value="<?= $mySeekDetail->id ?>"/>
            <div>
                <label>depart date</label>
                <input type="date" name="depart_date" class="skdetail form-control" value="<?=$mySeekDetail->depart_date ?>" />
            </div>
            <div>
                <label>start place</label>
                <input type="text" name="start_place" class="skdetail form-control" value="<?= $mySeekDetail->start_place ?>" />
            </div>
            <div>
                <label>end place</label>
                <input type="text" name="end_place" class="skdetail form-control" value="<?=$mySeekDetail->end_place ?>" />
            </div>
            <div>
                <label>seats demanded</label>
                <input type="number" name="seats_demanded" class="form-control" value="<?= $mySeekDetail->seats_demanded ?>" />
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </content>
    <?php else:
        header("Location:".base_url);
     ?>

    <?php endif; ?>