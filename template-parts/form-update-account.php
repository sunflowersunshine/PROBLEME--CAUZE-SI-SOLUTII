<?php $current_user = wp_get_current_user(); ?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
            <div class="panel panel-primary">
                <div class="panel-heading">
                <h3 class="panel-title"><?= $current_user->display_name; ?></h3>
                <span class ="edit-button"><i class="fa fa-pencil-square-o"></i>(Editare)</span>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3"> <img alt="User Pic" src="<?= get_avatar_url($current_user-> ID); ?>" class="img-circle img-responsive"> </div>
                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <form  action="" >
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
                                    <td><button type="submit" id="update_btn" class="btn btn-info">Salvează modificările</button></td>
                                </tr>
                                </form>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
