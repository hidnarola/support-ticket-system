<div class="panel panel-flat">
    
    <div class="panel-body">
        
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
<!-- /table header styling -->
