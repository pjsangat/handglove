<?php
    echo view('facility/includes/profile_banner');
?>

<div id="profile-bios">
    <div class="container">
        <div class="row">
            <div id="profile-main" class="col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="row">
                    <div class="col-md-12">
                        <h2><?php echo $onboarding['name']; ?></h2>
                        <div>
                            <p><?php echo $onboarding['description']; ?></p>
                            <?php 
                            if(!empty($onboarding['command'])){ 
                                echo '<p><strong>COMMAND</strong>: ' . $onboarding['command'];
                            }
                            ?>
                        </div>
                        <div  class="mt-5">
                            <?php
                                if(!empty($onboarding['youtube_link'])){
                                    $parts = parse_url($onboarding['youtube_link']);
                                    $video_id = '';
                                    if (isset($parts['query'])) {
                                        parse_str($parts['query'], $query);
                                        if (isset($query['v'])) {
                                            $video_id = $query['v'];
                                        }
                                    } elseif (isset($parts['path'])) {
                                        // Handle short format: youtu.be/ID
                                        $video_id = ltrim($parts['path'], '/');
                                    }

                                    $url = 'https://www.youtube.com/embed/' . $video_id;
                                    echo '<iframe width="560" height="315" src="' . $url . '" frameborder="0" allowfullscreen></iframe>';
                                }
                            ?>
                        </div>
                        <div class="mt-5">
                            <?php
                            if(!empty($onboarding['filename'])){
                                echo '<a href="'.base_url('facility/profile/'.$onboarding['client_id'].'/onboarding/'.$onboarding['id'].'/pdf').'" target="_blank"><img src="'.base_url('assets/img/pdf-download-btn.png').'" style="width: 250px;max-width: 250px;"></a>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>