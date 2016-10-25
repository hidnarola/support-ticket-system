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
                <div class="heading-elements icon-dasboard">
                    <!--<span class="heading-text badge bg-teal-800">+53,6%</span>-->
                    <div class="icon-object border-white text-white"><i class="icon-users"></i></div>
                </div>
                <h3 class="no-margin"><?php echo $total_tenants;?></h3>
                Tenants
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
                Staffs
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
                <!--<h3 class="no-margin">10</h3>-->
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

<div class="panel">
    <div class="panel-body">
    <div class="row">
    
        
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped datatable-basic">
                <thead>
                    <tr class="bg-teal">
                        <th>#</th>
                        <th>Title</th>
                        <th>Tenant</th>
                        <th>Type</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($tickets as $key => $record) {
                        ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $record['title']; ?></td>
                            <td><?php echo $record['fname'].' '.$record['lname']; ?></td>
                            <td><?php echo $record['type_name']; ?></td>
                            <td><?php echo $record['priority_name']; ?></td>
                            <td><?php echo $record['status_name']; ?></td>
                            <td><?php echo date('Y-m-d',strtotime($record['created'])); ?></td>
                            <td></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            
        </div>
    </div>




</div>
</div>