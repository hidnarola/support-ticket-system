<div class="row">
    <div class="col-lg-3">
        <!-- Members online -->
        <div class="panel bg-indigo-300">
            <div class="panel-body">
                <div class="heading-elements icon-dasboard">
                    <!--<span class="heading-text badge bg-teal-800">+53,6%</span>-->
                    <!--<div class="media-left"><a href="#" class="btn border-success text-success btn-flat btn-icon btn-rounded btn-sm"><i class="icon-checkmark3"></i></a></div>-->
                    <div class="icon-object border-white text-white"><i class="icon-collaboration"></i></div>
                </div>
                <h3 class="no-margin"><?php echo $total_departments; ?></h3>
                <?php echo ($total_departments==1) ? 'Department' : 'Departments'; ?>
                <!--<div class="text-muted text-size-small">489 avg</div>-->
            </div>
            <div class="container-fluid">
                <div id="members-online"></div>
            </div>
        </div>
        <!-- /members online -->
    </div>
    <div class="col-lg-3">
        <!-- Members online -->
        <div class="panel bg-pink-400">
            <div class="panel-body">
                <div class="heading-elements icon-dasboard">
                    <!--<span class="heading-text badge bg-teal-800">+53,6%</span>-->
                    <div class="icon-object border-white text-white"><i class="icon-users"></i></div>
                </div>
                <h3 class="no-margin"><?php echo $total_tenants;?></h3>
                <?php echo ($total_tenants==1) ? 'Tenant' : 'Tenants'; ?>
                <!--<div class="text-muted text-size-small">489 avg</div>-->
            </div>
            <div class="container-fluid">
                <div id="members-online"></div>
            </div>
        </div>
        <!-- /members online -->
    </div>
    <div class="col-lg-3">
        <!-- Members online -->
        <div class="panel bg-slate-400">
            <div class="panel-body">
                <div class="heading-elements icon-dasboard">
                    <!--<span class="heading-text badge bg-teal-800">+53,6%</span>-->
                    <div class="icon-object border-white text-white"><i class="icon-people"></i></div>
                    
                </div>
                <h3 class="no-margin"><?php echo $total_staffs;?></h3>
                Staff
                <!--<div class="text-muted text-size-small">489 avg</div>-->
            </div>
            <div class="container-fluid">
                <div id="members-online"></div>
            </div>
        </div>
        <!-- /members online -->
    </div>
    <?php if($total_tickets != 0) { ?>
    <div class="col-lg-3">
        <!-- Members online -->
        <div class="panel bg-warning-400">
            <div class="panel-body">
                <div class="heading-elements icon-dasboard">
                    <!--<span class="heading-text badge bg-teal-800">+53,6%</span>-->
                    <div class="icon-object border-white text-white"><i class=" icon-ticket"></i></div>
                </div>
                <h3 class="no-margin"><?php echo $total_tickets;?></h3>

                <h3 class="no-margin">10</h3>
                <?php echo ($total_tickets==1) ? 'Ticket' : 'Tickets'; ?>

                <!--<div class="text-muted text-size-small">489 avg</div>-->
            </div>
            <div class="container-fluid">
                <div id="members-online"></div>
            </div>
        </div>
        <!-- /members online -->
    </div>
    <?php } ?>
</div>