<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 
<div id="login">
    <div class="container">
        <div id="registration-form">
            <div class="reg-title"><i class="fa fa-user"></i> FORGOT PASSWORD</div>
            <div class="reg-body">
                <div id="reg-basic">
                    <?php if($session->getFlashdata('email_sent')){ ?>
                    <div id="reg-form">
                        <div class="fields">
                            <h3>Check your inbox</h3>
                            <p>An email with a link to reset your password was sent to the email address associated with your account</p>
                            <div>
                                <dotlottie-player src="https://lottie.host/726c20ed-2649-42bc-833b-f1a513e3dee1/LYE3IHTWx0.json" background="transparent" speed="1" style="margin: auto; width: 250px;" loop autoplay></dotlottie-player>
                            </div>
                        </div>
                    </div>
                    <?php }else{ ?>
                    <form id="reg-form" action="<?php echo base_url('login/forgot-password'); ?>" method="POST">
                        <div class="fields">
                            <?php if($session->getFlashdata('error')): ?>
                                <div class="alert alert-danger rounded-0 py-1 px-2 mb-3">
                                    <?= $session->getFlashdata('error') ?>
                                </div>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Email Address</label>
                                        <input type="email" class="form-control required" name="email">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="buttons">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-blue" value="Reset Password">
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>