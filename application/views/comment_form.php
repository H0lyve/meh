<hr>
<form id="add_com_form" action="<?= base_url('index.php/comment/add') ?>" method="post" role="form">
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-2">
                <input type="text" name="comment" id="comment" tabindex="1" class="form-control" placeholder="What's on your mind ?" value="">
                <input type="hidden" name="user_id" id="user_id" tabindex="2" class="form-control" value="<?= $user_id ?>">
                <input type="hidden" name="post_id" id="post_id" tabindex="2" class="form-control" value="<?= $post_id ?>">
            </div>
            <div class="col-sm-2">            
                <input type="submit" name="add_com" id="add_com" tabindex="3" class="form-control btn-default" value="Say Stuff">
            </div>
        </div>
    </div>
</form>