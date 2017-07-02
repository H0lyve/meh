<div class="container">
    <div class="col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 ">
        <form id="add_com_form" action="<?= base_url('index.php/post/add') ?>" method="post" role="form">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-8 ">
                        <input type="text" name="title" id="title" tabindex="1" class="form-control" placeholder="Title" value="">
                    </div>
                </div>
                   <div class="row">
                    <div class="col-sm-8 ">
                        <div class="form-group">
                          <textarea name="content" class="form-control" rows="5" id="content" placeholder="Go on"></textarea>
                        </div>
                    </div>
                </div>
                <?php if($this->session->userdata('username') != false){ ?>
                    <input type="hidden" name="id" id="id" value="<?= $this->session->userdata('id') ?>">
                <?php }elseif($this->input->cookie('log', TRUE) == '1'){ ?>
                    <input type="hidden" name="id" id="id" value="<?= $this->input->cookie('id', TRUE) ?>">
                <?php } ?>
                <div class="row">
                    <div class="col-sm-2 col-sm-offset-3">            
                        <input type="submit" name="add_com" id="add_com" tabindex="3" class="form-control btn-default" value="Send Stuff">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<hr>
<?php 
if($this->session->userdata('username') != false){ 
    var_dump($this->session->userdata('id'));
}elseif($this->input->cookie('log', TRUE) == '1'){
    var_dump($this->input->cookie('id', TRUE));
    
} ?>