<!-- Default stacked layout -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h6 class="panel-title">Ticket Conversation</h6>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        <ul class="media-list chat-stacked content-group">
                <?php foreach ($ticket_coversation as $key => $value) { ?>
            <li class="media date-step  content-divider text-muted">

                    <span><?php echo $key; ?></span>
                    <!--<span>Saturday, Feb 12</span>-->
                </li>
                <?php foreach ($value as $val) { ?>


                    <li class="media">
                        <div class="media-left"><img src="assets/admin/images/placeholder.jpg" class="img-circle" alt=""></div>
                        <div class="media-body">
                            <div class="media-heading">
                                <a href="#" class="text-semibold"><?php echo $val['fname'] . ' ' . $val['lname'] ; ?></a>
                                <span class="media-annotation pull-right">12:16 pm <a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
                            </div>
                           <?php echo $val['message'];?>
                        </div>
                    </li>
                <?php }
            } ?>
                    
            <!--            <li class="media">
                            <div class="media-left"><img src="assets/admin/images/placeholder.jpg" class="img-circle" alt=""></div>
                            <div class="media-body">
                                <div class="media-heading">
                                    <a href="#" class="text-semibold">Will Grace</a>
                                    <span class="media-annotation pull-right">4:13 pm <a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
                                </div>
                                Wickedly darn before or after impeccably jeepers ouch misunderstood yikes much hello talkatively ineffectively hiccupped beyond usefully the alas prior shrugged instantaneously heroically
                            </div>
                        </li>-->



            <!--            <li class="media">
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle" alt=""></div>
                            <div class="media-body media-middle">
                                <i class="icon-menu"></i>
                            </div>
                        </li>-->
        </ul>

        <textarea name="enter-message" class="form-control content-group" rows="3" cols="1" placeholder="Enter your message..."></textarea>

        <div class="row">
            <div class="col-xs-6">
                <!--                <ul class="icons-list icons-list-extended mt-10">
                                    <li><a href="#" data-popup="tooltip" title="Send photo" data-container="body"><i class="icon-file-picture"></i></a></li>
                                    <li><a href="#" data-popup="tooltip" title="Send video" data-container="body"><i class="icon-file-video"></i></a></li>
                                    <li><a href="#" data-popup="tooltip" title="Send file" data-container="body"><i class="icon-file-plus"></i></a></li>
                                </ul>-->
            </div>

            <div class="col-xs-6 text-right">
                <button type="button" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-circle-right2"></i></b> Send</button>
            </div>
        </div>
    </div>
</div>
<!-- /default stacked layout -->