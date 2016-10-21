<div class="row">
    <div class="col-lg-3">
        <!-- Members online -->
        <div class="panel bg-indigo-300">
            <div class="panel-body">
                <div class="heading-elements">
                    <!--<span class="heading-text badge bg-teal-800">+53,6%</span>-->
                </div>
                <h3 class="no-margin"><?php echo $total_departments; ?></h3>
                Departments
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
                <div class="heading-elements">
                    <!--<span class="heading-text badge bg-teal-800">+53,6%</span>-->
                </div>
                <h3 class="no-margin"><?php echo $total_tenants;?></h3>
                Staff
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
                <div class="heading-elements">
                    <!--<span class="heading-text badge bg-teal-800">+53,6%</span>-->
                </div>
                <h3 class="no-margin"><?php echo $total_staffs;?></h3>
                Tenants
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
                <div class="heading-elements">
                    <!--<span class="heading-text badge bg-teal-800">+53,6%</span>-->
                </div>
                <h3 class="no-margin"><?php echo $total_tickets;?></h3>
                Tickets
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