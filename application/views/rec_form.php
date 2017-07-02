<div class="container" style="text-align:center">
    <form id="add_com_form" action="<?= base_url('index.php/login/rec_send') ?>" method="post" role="form">
        <div class="form-group">
            <div class="row">
                <div class="col-lg-10">
                    So bored you forgot your password ? Field this and check your emails.   
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <input type="email" name="email" id="email" placeholder="Email">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">            
                    <input type="submit" name="add_com" id="add_com" tabindex="3" class="form-control btn-default" value="Send email">
                </div>
            </div>
        </div>
    </form>
</div>