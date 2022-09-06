
<?php if(isset($_SESSION['identity'])) :?>
    <h4 id="my-itinerates-title">MI ITINERATES</h4>
        <?php if($numRows > 0) :?>
            <table class="table table-borderless table-myitinerates">
                <thead>
                    <tr>
                        <th>depart date</th>
                        <th>depart time</th>
                        <th>depart place</th>
                        <th>end place</th>
                        <th>free seats</th>
                    </tr>
                </thead>
                <?php while($itinerary = $myitineraries->fetch_object()) :?>
                    <tr>
                        <td><?= $itinerary->depart_date ?></td>
                        <td><?= $itinerary->depart_time ?></td>
                        <td><?= $itinerary->depart_place ?></td>
                        <td><?= $itinerary->end_place ?></td>
                        <td><?= $itinerary->free_seats ?></td>
                        <td><a href="<?= base_url ?>itinerate/detail&id=<?= $itinerary->id ?>" class="btn btn-success">edit</a></td>
                    </tr>
                 <?php endwhile ?>   
            </table>
            <h4 id="my-search-title">MY SEARCHS</h4>
            <?php if($seekRows > 0) :?>
                <table class="table table-borderless table-mysearchs">
                    <thead>
                        <tr>
                            <th>depart date</th>
                            <th>start place</th>
                            <th>end place</th>
                            <th>seats demanded</th>
                        </tr>
                    </thead>
                    <?php while($seek = $miSeeks->fetch_object()) :?>
                        <tr>
                            <td><?= $seek->depart_date ?></td>
                            <td><?= $seek->start_place?></td>
                            <td><?= $seek->end_place ?></td>
                            <td><?= $seek->seats_demanded?></td>
                            <td><a href="<?= base_url ?>seek/detail&id=<?=$seek->id ?>" class="btn btn-success">edit</a></td>
                        </tr>
                    <?php endwhile ?>    

                </table>
                <?php else: ?>
                    <h5>NO SEARCHS TO SHOW</h5>
                <?php endif; ?>
        <?php else: ?>
        <h5>NO RESULTS TO SHOW</h5>
        <?php endif; ?>

        
    <?php else:
        header("Location:".base_url);
     ?>
        
    <?php endif ?>
