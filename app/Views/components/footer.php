    
</div>
</div>
    <footer class="site-footer">
        <div class="container">
            <div class="footer-items">
                <ul>
                    <a href="<?php echo base_url('about-us'); ?>">About Us</a>
                    <a href="<?php echo base_url('help-and-support'); ?>">Help & Support</a>
                    <a href="<?php echo base_url('contact-us'); ?>">Contact Us</a>

                    <?php if( session()->get('isLoggedIn') == 1 ){ ?>
                    <a href="<?php echo base_url('login/logout'); ?>">Logout</a>
                    <?php }else{ ?>
                    <a href="<?php echo base_url('login'); ?>">Login</a>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </footer>
</body>
</html>
