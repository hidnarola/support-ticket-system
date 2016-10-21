<?php $segment = $this->uri->segment(3); ?>
<!-- Table header styling -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?php echo $user_type; ?> List</h5>

        <div class="heading-elements">
            <ul class="icons-list">
                <?php if ($segment == 'tenants') { ?>
                    <button type="button" class="btn bg-pink-400" onclick="window.location = 'admin/users/add/tenant'"><i class="icon-user-plus position-left"></i>Add </button>
                <?php } else { ?>
                    <button type="button" class="btn bg-pink-400" onclick="window.location = 'admin/users/add/staff'"><i class="icon-user-plus position-left"></i>Add </button> 
                <?php } ?>
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>

    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable-basic">
                <thead>
                    <tr class="bg-teal">
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <!--<th>Password</th>-->
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($users as $key => $record) {
                        ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $record['fname']; ?></td>
                            <td><?php echo $record['lname']; ?></td>
                            <td><?php echo $record['email']; ?></td>
                            <!--<td><?php echo $record['password']; ?></td>-->
                            <td><?php echo $record['address']; ?></td>
                            <td>
                                <ul class="icons-list">
                                    <li class="text-teal-600">
                                        <a id="edit_<?php //echo base64_encode($record['id']);    ?>" class="edit"><i class="icon-pencil7"></i></a>
                                    </li>
                                    <li class="text-danger-600">
                                        <a id="delete_<?php //echo base64_encode($record['id']);    ?>" class="delete"><i class="icon-trash"></i></a>
                                    </li>
                                </ul>
                            </td>
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