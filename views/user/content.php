<?php if(isset($_SESSION['identity'])):?>
    <h3 id="user-content-title">PREFERENCES SETTINGS<h3>
        <div class="user-container">
            <div class="row">
                <div class="div-user-avail col">
                    <h5>my itineraries</h5>
                    <?php if(isset($_SESSION['itinerary']) && $_SESSION['itinerary'] == 'complete') :?>
                        <strong class="success">itinerary successfully stored</strong>
                        <?php elseif(isset($_SESSION['itinerary']) && $_SESSION['itinerary'] == 'failed') :?>
                         <strong class="failed">failure</strong>   
                        <?php endif ?>
                        <?php Utils::deleteSessions('itinerary');?>
                    <form class="form-user-avail" action="<?= base_url ?>user/saveNewItinerary" method="POST">
                        <input type="hidden" name="userId" value="<?= $_SESSION['identity']->id ?>" />                        
                        <div>
                            <label for="">date</label>
                            <input type="date" name="depart-date" class="form-control" />
                        </div>
                        <div>
                            <label for="">time</label>
                            <input type="time" name="depart-time" class="form-control" />
                        </div>
                        <div>
                            <label>from here</label>
                            <input type="text" name="depart-place" class="form-control" />
                        </div>
                        <div>
                            <label>to here</label>
                            <input type="text" name="end-place" class="form-control" />
                        </div>
                        <div>
                            <label>free seats</label>
                            <input type="number" name="free-seats" class="form-control" max="" min="1" />
                        </div>
                        <button type="submit" class="btn btn-success">Send</button>
                    </form>
                </div>
                <div class="div-user-avail col">
                    <h5>my search</h5>
                    <?php if(isset($_SESSION['seekSave']) && $_SESSION['seekSave'] == 'complete') :?>
                        <strong class="success">search successfully stored</strong>
                        <?php elseif(isset($_SESSION['seekSave']) && $_SESSION['seekSave'] == 'failed') :?>
                            <strong class="failed">failed while trying to store your search</strong>
                            <?php endif; ?>
                            <?php Utils::deleteSessions('seekSave')?>
                    <form class="" action="<?= base_url ?>user/saveNewSearch" method="POST">
                            <input type="hidden" name="userId" value="<?= $_SESSION['identity']->id ?>" />
                         <div>
                             <label for="">depart date</labe>
                             <input type="date" name="depart_date" class="form-control" />
                         </div>
                         <div>
                             <label for="start place">start place</label>
                             <input type="text" name="start_place" class="form-control" />
                         </div>   
                         <div>
                             <label for="end place">end place</label>
                             <input type="text" name="end_place" class="form-control" />
                         </div>
                         <div>
                             <label for="seats demanded">seats demanded</label>
                             <input type="number" name="seats_demanded" class="form-control" min="1" />
                         </div>
                         <button type="submit" class="btn btn-success">Send</button>
                    </form>
                </div>
            </div>
            
        </div>
    <?php else:
        header("Location:".base_url);
     ?>    
        
<?php endif; ?>