<div id="exTab1" class="container">	
    <ul  class="nav nav-pills">
        <li class="active">
            <a  href="#1a" data-toggle="tab">Posts</a>
        </li>
        <li>
            <a href="#2a" data-toggle="tab">Comments</a>
        </li>
        <li>
            <a href="#3a" data-toggle="tab">Users</a>
        </li>
    </ul>
    <div class="tab-content clearfix">
        <div class="tab-pane active" id="1a"> <!----------------------------------------POST--------------------------->
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>TITLE</th>
                  <th>DATE</th>
                  <th style="text-align:right">MODERATION</th>
                </tr>
              </thead>
              <tbody>
               <?php foreach($posts as $cle=>$post){ ?>
                <tr id='post_tr_<?= $post['post_id'] ?>' class="<?php if($post['post_status'] == '0'){ echo 'red_tr';}else{echo 'green_tr';}?>">
                  <th scope="row"><?= $post['post_id'] ?></th>
                  <td><?= $post['post_title'] ?></td>
                  <td><?= $post['post_date'] ?></td>
                  <td id="post_<?= $post['post_id'] ?>_1" style="text-align:right;<?php if($post['post_status'] == '0'){ echo 'display:none';}else{echo 'display:block';}?>">
                      <a class="onButton" onclick="switch_post('<?= $post['post_id']?>',0,'<?php echo base_url('index.php/post/switch_status/'); ?>');">
                          <button type="button" class="btn btn-secondary">Ban</button>
                      </a>
                  </td>
                  <td id="post_<?= $post['post_id'] ?>_0" style="text-align:right;<?php if($post['post_status'] == '1'){ echo 'display:none';}else{echo 'display:block';}?>">
                      <a class="onButton" onclick="switch_post('<?= $post['post_id']?>',1,'<?php echo base_url('index.php/post/switch_status/'); ?>');">
                          <button type="button" class="btn btn-secondary">Release</button>
                      </a>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
        </div>
        <div class="tab-pane" id="2a"><!----------------------------------------COMMENTS--------------------------->
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>USER</th>
                  <th>DATE</th>
                  <th>POST</th>
                  <th>COMMENT</th>
                  <th style="text-align:right">MODERATION</th>
                </tr>
              </thead>
              <tbody>
               <?php foreach($comments as $cle=>$comment){ ?>
                <tr id='comment_tr_<?= $comment['com_id'] ?>' class="<?php if($comment['com_status'] == '0'){ echo 'red_tr';}else{echo 'green_tr';}?>">
                  <th scope="row"><?= $comment['com_id'] ?></th>
                  <td><?= $comment['user_id'] ?></td>
                  <td><?= $comment['com_date'] ?></td>
                  <td><?= $comment['post_id'] ?></td>
                  <td><?= $comment['com_content'] ?></td>
                  <td id="com_<?= $comment['com_id'] ?>_1" style="text-align:right;<?php if($comment['com_status'] == '0'){ echo 'display:none';}else{echo 'display:block';}?>">
                      <a class="onButton" onclick="switch_com('<?= $comment['com_id']?>',0,'<?php echo base_url('index.php/comment/switch_status/'); ?>');">
                          <button type="button" class="btn btn-secondary">Ban</button>
                      </a>
                  </td>
                  <td id="com_<?= $comment['com_id'] ?>_0" style="text-align:right;<?php if($comment['com_status'] == '1'){ echo 'display:none';}else{echo 'display:block';}?>">
                      <a class="onButton" onclick="switch_com('<?= $comment['com_id']?>',1,'<?php echo base_url('index.php/comment/switch_status/'); ?>');">
                          <button type="button" class="btn btn-secondary">Release</button>
                      </a>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
        </div>
        <div class="tab-pane" id="3a"><!----------------------------------------USERS--------------------------->
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>NAME</th>
                  <th>DATE</th>
                  <th style="text-align:right">MODERATION</th>
                </tr>
              </thead>
              <tbody>
               <?php foreach($users as $cle=>$user){ ?>
                <tr id='user_tr_<?= $user['user_id'] ?>' class="<?php if($user['user_status'] == '0'){ echo 'red_tr';}else{echo 'green_tr';}?>">
                  <th scope="row"><?= $user['user_id'] ?></th>
                  <td><?= $user['user_name'] ?></td>
                  <td><?= $user['user_date'] ?></td>
                  <td id="user_<?= $user['user_id'] ?>_1" style="text-align:right;<?php if($user['user_status'] == '0'){ echo 'display:none';}else{echo 'display:block';}?>">
                      <a class="onButton" onclick="switch_user('<?= $user['user_id']?>',0,'<?php echo base_url('index.php/user/switch_status/'); ?>');">
                          <button type="button" class="btn btn-secondary">Ban</button>
                      </a>
                  </td>
                  <td id="user_<?= $user['user_id'] ?>_0" style="text-align:right;<?php if($user['user_status'] == '1'){ echo 'display:none';}else{echo 'display:block';}?>">
                      <a class="onButton" onclick="switch_user('<?= $user['user_id']?>',1,'<?php echo base_url('index.php/user/switch_status/'); ?>');">
                          <button type="button" class="btn btn-secondary">Release</button>
                      </a>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
        </div>
    </div>
</div>
<hr>
<div id='poulet'></div>
<script>
    function switch_post(id,status,url){
        $.ajax({
            url:url,
            data:{
                status:status,
                id:id
            },
            dataType:'json',
            success:function(response){
                if(response == 0){
                    $('#post_'+id+'_1').hide();
                    $('#post_'+id+'_0').show();
                    $('#post_tr_'+id).removeClass('green_tr').addClass('red_tr');  
                }else{
                    $('#post_'+id+'_1').show();
                    $('#post_'+id+'_0').hide();           
                    $('#post_tr_'+id).removeClass('red_tr').addClass('green_tr');       
                }
            }
        });        
    }
    function switch_com(id,status,url){
        $.ajax({
            url:url,
            data:{
                status:status,
                id:id
            },
            dataType:'json',
            success:function(response){
                if(response == 0){
                    $('#com_'+id+'_1').hide();
                    $('#com_'+id+'_0').show();
                    $('#comment_tr_'+id).removeClass('green_tr').addClass('red_tr');  
                }else{
                    $('#com_'+id+'_1').show();
                    $('#com_'+id+'_0').hide();           
                    $('#comment_tr_'+id).removeClass('red_tr').addClass('green_tr');       
                }
            }
        });        
    }
    function switch_user(id,status,url){
        $.ajax({
            url:url,
            data:{
                status:status,
                id:id
            },
            dataType:'json',
            success:function(response){
                if(response == 0){
                    $('#user_'+id+'_1').hide();
                    $('#user_'+id+'_0').show();
                    $('#user_tr_'+id).removeClass('green_tr').addClass('red_tr');  
                }else{
                    $('#user_'+id+'_1').show();
                    $('#user_'+id+'_0').hide();           
                    $('#user_tr_'+id).removeClass('red_tr').addClass('green_tr');       
                }
            }
        });        
    }
</script>