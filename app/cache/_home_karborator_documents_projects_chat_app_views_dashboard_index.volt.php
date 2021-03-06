<strong>Welcome <?php echo $username; ?></strong>
<?php foreach ($userModel as $user) { ?>
<ul>
    <li><p class="userName"><?php echo $user->getUsername(); ?></p></li>
</ul>
<?php } ?>

<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span>
                    <span id="userName"></span>
                </div>
                <div class="panel-body" style="overflow-y: scroll; height: 500px;">
                    <ul class="chat">

                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="send form-control input-sm"
                               placeholder="Type your message here..."/>
                        <span class="input-group-btn">
                            <button class="send btn btn-warning btn-sm" id="btn-chat">
                                Send
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
