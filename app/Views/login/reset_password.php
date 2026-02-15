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
                                        <h3>Reset Password</h3>
                                    </div>
                                    <div class="reg-body">
                                        <div id="reg-basic">
                                            <?php if($isValid == 1){ ?>
                                                
                                                <form id="reg-form" action="<?php echo base_url('login/change-password'); ?>" method="POST">
                                                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                                                    <div class="fields" id="errorMsg">
                                                        <?php if($session->getFlashdata('error')): ?>
                                                            <div class="alert alert-danger rounded-0 py-1 px-2 mb-3">
                                                                <?= $session->getFlashdata('error') ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="fields">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="">Password</label>
                                                                    <input type="password" id="password-2" class="form-control required" name="password">
                                                                    <div><small><em>Minimum of 8 characters.</em></small></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="fields">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="">Confirm Password</label>
                                                                    <input type="password" id="confirm-2" class="form-control required" name="confirm">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="buttons">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="submit" class="thm-btn-secondary" value="Reset Password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            <?php }else{ ?>
                                                <div id="reg-form">
                                                    <div class="fields">
                                                        <h3>Invalid Reset Password Link</h3>
                                                        <p>The reset password link is either invalid or already expired.</p>
                                                    </div>

                                                    <div class="buttons">
                                                        <div class="row">
                                                            <div class="col-md-12 text-center">
                                                                <a href="<?php echo base_url('login'); ?>" class="btn btn-primary">Login</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }?>
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