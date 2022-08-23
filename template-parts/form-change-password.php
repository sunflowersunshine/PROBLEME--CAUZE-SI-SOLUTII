

<div class="row">
            <?php if(isset($_GET['error'])): ?>
                <div class="alert alert-danger" role="alert">
                <?php for($i = 0 ; $i < $_GET['error'] ; $i++) : ?>
                    <?php echo $_GET[$i];?> <br>
                    <?php endfor; ?>
                </div>
            <?php elseif(isset($_GET['succes'])) :?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_GET['succes'];?> 
                </div>
            <?php endif; ?>
    </div>
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="<?php echo esc_url(admin_url( 'admin-post.php' )); ?>" class="change-password-form">
            <input type="hidden" name="action" value="user_change_password" />


                <div class="form-group log_pass">
                    <input type="password" 
                    class="form-control form-control-sm" 
                    id="old_password" 
                    name="old_password" 
                    placeholder="Parolă veche" required>
                </div>

                <div class="form-group log_pass">
                    <input type="password" 
                    class="form-control form-control-sm" 
                    id="new_password" 
                    name="new_password" 
                    placeholder="Parolă nouă" required>
                </div>

                <div class="form-group log_pass">
                    <input type="password" 
                    class="form-control form-control-sm" 
                    id="confirm_new_password" 
                    name="confirm_new_password" 
                    placeholder="Confirmă parola nouă" required>
                </div>
                
                <?php wp_nonce_field('changePassword', 'nonce'); ?>
                <button type="submit" id="change_pass_button" name="change_pass_button" class="btn btn-info">Schimbă parola</button>
            </form>
        </div>
</div>  
