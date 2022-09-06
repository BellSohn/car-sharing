<?php if(isset($_SESSION['identity'])) :?>
    <h4 id="itinerate-detail-title">ITINERARY DETAIL</h4>
    <content class="itinerary-detail-content">
        <?php if(isset($_SESSION['updateItinerate']) && $_SESSION['updateItinerate'] == 'complete') :?>
            <strong class="success">itinerate successfully updated</strong>
            <?php elseif(isset($_SESSION['updateItinerate']) && $_SESSION['updateItinerate'] == 'failed') :?>
                <strong class="failed">updated failed</strong>
                <?php  endif; ?>
                <?php Utils::deleteSessions('updateItinerate') ?>
        <form class="itineray-detail-form" action="<?= base_url ?>itinerate/updateItinerate" method="POST">
            <input type="hidden" name="itid" value="<?= $details->id ?>" />
            <div>
                <label>depart date</label>
                <input type="date" name="depart_date" class="itdetail form-control" value="<?= $details->depart_date ?>" />
            </div>
            <div>
                <label>depart time</label>
                <input type="time" name="depart_time" class="itdetail form-control" value="<?= $details->depart_time ?>" />
            </div>
            <div>
                <label>depart place</label>
                <input type="text" name="depart_place" class="itdetail form-control" value="<?= $details->depart_place ?>" />
            </div>
            <div>
                <label>end place</label>
                <input type="text" name="end_place" class="itdetail form-control" value="<?= $details->end_place?>" />
            </div>
            <div>
                <label>free seats</label>
                <input type="text" name="free_seats" class="itdetail form-control" value="<?= $details->free_seats ?>" />
            </div>
            <button type="submit" value="" class="btn btn-success">Update</button>
        </form>

    </content>
    <?php else:
        header("Location:".base_url);
     ?>

    <?php endif ?>
