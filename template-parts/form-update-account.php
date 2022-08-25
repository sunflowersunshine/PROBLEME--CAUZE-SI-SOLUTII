<?php $current_user = wp_get_current_user(); ?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
            
            <div class="row">
                    <?php if(isset($_GET['errors'])): ?>
                        <div class="alert alert-danger" role="alert">
                        <?php for($i = 0 ; $i < $_GET['errors'] ; $i++) : ?>
                            <?php echo $_GET[$i];?> <br>
                            <?php endfor; ?>
                        </div>
                    <?php elseif(isset($_GET['success'])) :?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $_GET['success'];?> 
                        </div>
                    <?php endif; ?>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                <h3 class="panel-title"><?= $current_user->display_name; ?></h3>
                <span class ="edit-button"><i class="fa fa-pencil-square-o"></i>(Editare)</span>
                </div>

                <div class="panel-body">
                    <div class="row">
                    <form  action="<?php echo esc_url(admin_url( 'admin-post.php' )); ?>" method="POST">
                        <div class="col-md-3 col-lg-3"> 

                            <input type="file" id="profile_pic" name="profile_pic" accept="image/*">
                            <!-- <label for="profile_pic">Adaugă o fotografie de profil</label> -->
                            <?php 
                            $profile_image_id = get_user_meta($current_user->ID,'profile_photo', true);
                            $profile_image = wp_get_attachment_image($profile_image_id, "full"); ?>
    
                        <?php if(!empty($profile_image)) :?>
                                 <div alt="User Pic" class="img-circle img-responsive"><?=  $profile_image;  ?> </div> 
                            <?php else: ?>
                                <img alt="User Pic" src="<?= get_avatar_url($current_user-> ID); ?>" class="img-circle img-responsive"> 
                            <?php endif;?>

                        </div>
                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <input type="hidden" name="action" value="user_update_account" />
                                <tr>
                                    <td>Nume:</td>
                                    <td>
                                        <input type="text" 
                                        id="myaccount-first_name" 
                                        name="myaccount-first_name"  
                                        class="update_account"
                                        value="<?= $current_user->first_name;  ?>" >
                                    </td>
                                </tr>
                                <tr>
                                    <td>Prenume:</td>
                                    <td>
                                    <input type="text" 
                                        id="myaccount-last_name" 
                                        name="myaccount-last_name"  
                                        class="update_account"
                                        value="<?= $current_user->last_name; ?>" >
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td>
                                    <input type="text"
                                        id="myaccount-email" 
                                        name="myaccount-email" 
                                        class="update_account" 
                                        value="<?= $current_user->user_email; ?>" >
                                    </td>
                                </tr>
                                <tr>
                                    <td>Telefon:</td>
                                    <td>
                                    <input type="text" 
                                        id="myaccount-phone" 
                                        name="myaccount-phone"  
                                        class="update_account"
                                        value="<?= get_user_meta( $current_user->ID, 'phone' , true ); ?>" >
                                    </td>
                                </tr>
                                <tr>
                                    <td>Adresă:</td>
                                    <td>
                                    <input type="text" 
                                        id="myaccount-adress" 
                                        name="myaccount-adress"  
                                        class="update_account"
                                        value="<?= get_user_meta( $current_user->ID, 'adress' , true ); ?>">
                                    </td>
                                </tr>
                                <tr>
                                <?php wp_nonce_field('userUpdateAccount', 'nonce'); ?>
                                    <td><button type="submit" id="update_btn" name="update_btn" class="btn btn-info">Salvează modificările</button></td>
                                </tr>
                                </form>

                        </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
