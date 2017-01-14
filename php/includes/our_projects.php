<div class="bottom_content">
    <h3>Our Projects</h3>
    <div class="grid_2">

        <!--display projects -->
        <?php
        foreach ($projects as $eachProject){

        ?>
        <div class="col-md-4 portfolio-left" style="height: 350px;">
            <div class="portfolio-img event-img">
                <img src="<?php echo htmlentities($eachProject['image']); ?>" class="img-responsive" alt="<?php echo strip_tags($eachProject['title']); ?>"/>
                <div class="over-image"></div>
            </div>
            <div class="portfolio-description">
                <h4 style="margin-top: -20px;">
                <a href="#">
                        <?php echo (strlen($eachProject['title'])>40)?substr($eachProject['title'],0,40).'...':$eachProject['title']; ?>
                    </a>
                </h4>
                <p>
                    <?php echo (strlen($eachProject['description'])>200)?substr($eachProject['description'],0,200).'...':$eachProject['title']; ?>
                </p>
                
                <a href="project_details.php?sti=<?php echo time(); ?>&pid=<?php echo $eachProject['id']?>&uid=<?php echo md5('elegant-code')?>" style="position: absolute; bottom: 15px;">
                    <span><i class="fa fa-chain chain_1"></i>VIEW PROJECT</span>
                </a>
            </div>
            <div class="clearfix"> </div>
        </div>
        <?php } ?>
        <div class="clearfix"> </div>
    </div>

    <div class="grid_3">

        <?php
        foreach ($projectsBatch2 as $eachProjectBatch2){

        ?>
        <div class="col-md-4 portfolio-left" style="height: 350px;">
            <div class="portfolio-img event-img">
                <img src="<?php echo htmlentities($eachProjectBatch2['image']); ?>" class="img-responsive" alt="<?php echo strip_tags($eachProjectBatch2['title']); ?>"/>
                <div class="over-image"></div>
            </div>
            <div class="portfolio-description">
                <h4 style="margin-top: -20px;">
                <a href="#"> <?php echo (strlen($eachProjectBatch2['title'])>40)?substr($eachProjectBatch2['title'],0,40).'...':$eachProjectBatch2['title']; ?></a></h4>
                <p>
                <?php echo (strlen($eachProjectBatch2['description'])>200)?substr($eachProjectBatch2['description'],0,200).'...':$eachProjectBatch2['title']; ?>
                    
                </p>
                
                <a href="project_details.php?sti=<?php echo time(); ?>&pid=<?php echo $eachProjectBatch2['id']?>&uid=<?php echo md5('elegant-code')?>" style="position: absolute; bottom: 15px;">
                    <span><i class="fa fa-chain chain_1"></i>VIEW PROJECT</span>
                </a>
            </div>
            <div class="clearfix"> </div>
        </div>
        <?php } ?>

        <div class="clearfix"> </div>

        <div class="col-lg-3"></div>

        <div class="col-lg-5 portfolio-description" style="text-align: center; margin-top: -10px;">
            <a href="events.html">
                    <span><i class="fa fa-chain chain_1"></i>VIEW ALL PROJECTS...</span>
            </a>
        </div>
        <div class="col-lg-4"></div>

        <div class="clearfix"> </div>
    </div>
</div>

