<form id="add_com_form" action="<?= base_url('index.php/login/admin') ?>" method="post" role="form">
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-2">
                <input type="password" name="mdp" id="mdp" tabindex="1" class="form-control" placeholder="MdP ?" value="">
            </div>
            <div class="col-sm-2">            
                <input type="submit" name="try" id="try" tabindex="3" class="form-control btn-default" value="Try ME">
            </div>
        </div>
    </div>
</form>