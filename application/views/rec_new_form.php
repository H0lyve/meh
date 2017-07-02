<div class="container">
    <form id="register-form" action="<?= base_url('index.php/user/new_psw') ?>" method="post" role="form">
       <label> Hi <?= $user_name ?>, put your new password over here, dat should do the trick :</label>
        <div class="form-group">
            <input type="password" name="rec-password" id="rec-password" tabindex="2" class="form-control" placeholder="Password">
        </div>
        <div class="form-group">
            <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
        </div>
        <input type="hidden" name="id" id="id" tabindex="2" class="form-control" value="<?= $user_id ?>"/>
        <div id="pass_warn" class="form-group" style="display:none">            
            <p style="color:red;text-align: center;">Passwords are not matching</p>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Confirm">
                </div>
            </div>
        </div>
    </form>
</div>
<script>
$('#register-submit').click(function(e) {
    if( $('#rec-password').val() != $('#confirm-password').val() ){            
        $('#pass_warn').show();
        e.preventDefault();
    }
});
</script>