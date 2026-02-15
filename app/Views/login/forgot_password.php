<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 
<div id="login">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-9">
                <div class="card auth-box">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="sign-in-logo">
                                <a href="<?php echo base_url(); ?>">
                                    <img src="<?php echo base_url('assets/img/handglove-logo.png'); ?>" alt="">
                                </a>
                                <div class="sign-in-img">
                                    <img src="<?php echo base_url('assets/img/sign-in.png'); ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="registration-form">
                                <div class="reg-content">
                                    <div class="reg-header">
                                        <h3>Forgot Password</h3>
                                    </div>
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
                                                                <input type="email" class="form-control required" name="email" placeholder="Enter your email address..">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="buttons">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input type="submit"  class="thm-btn-secondary" value="Reset Password">
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
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>