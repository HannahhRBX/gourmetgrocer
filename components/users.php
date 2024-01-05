<?php

// Check if user is member or admin to display management columns
$userRole = RoutingController::verify_session_role();
// Retrieve all member data using the member controller
$users = $controllers->members()->get_all_members();
?>
<!-- HTML for displaying the user list -->
<div class="container mt-4">
    <h2>User Management</h2> 
    <table class="table table-striped"> 
            <tr>
                <th>First Name</th> 
                <th>Last Name</th> 
                <th>Email</th> 
                <th>Role</th>

                <?php
                //Check if admin, so that an extra Management column can appear next to each item
                if ($userRole == 'admin'){
                    ?>
                <th>Manage</th>
                <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?> <!-- Loop through each member, creating record in page table -->
                <tr>
                    
                    <td><?= htmlspecialchars_decode($user['firstname'], ENT_QUOTES) ?></td>
                    <td><?= htmlspecialchars_decode($user['lastname'], ENT_QUOTES) ?></td> 
                    <td><?= htmlspecialchars_decode($user['email'], ENT_QUOTES) ?></td> 
                    <?php
                    
                    $roleId = $controllers->members()->get_role_by_userid($user['ID']);
                    if ($roleId != null){
                      $roleId = $roleId["role_id"];
                      $role = $controllers->roles()->get_role_by_id($roleId);
                    }else{
                      $roleId = 1;
                      $role = array("name"=>"");
                    }

                    
                    ?>
                    <td><?= htmlspecialchars_decode($role['name'], ENT_QUOTES) ?></td>
                    <?php
                    //Check if admin, so that an extra column with edit and delete buttons can appear next to each item
                    if ($userRole == 'admin'){
                        ?>
                        <td><div class="container">
                        <form action="./Users.php" method="post" style="padding-right: 10px; float: left;">
                        <button class="btn btn-danger btn-md w-40 mb-4" type="submit" id="deleteButton">Delete</button>
                        <!-- Create hidden HTML variables to pass into the database processing form when submitted -->
                        <input type="hidden" name="actionType" value="delete">
                        <input type="hidden" name="userId" value="<?= $user['ID']; ?>">
                        <input type="hidden" name="userFirstName" value="<?= $user['firstname']; ?>">
                        <input type="hidden" name="userLastName" value="<?= $user['lastname']; ?>">
                        <input type="hidden" name="userEmail" value="<?= $user['email']; ?>">
                        <input type="hidden" name="userRoleId" value="<?= $roleId; ?>">
                        </form>
                        <form action="./Users.php" method="post" style="float: left;">
                        <button class="btn btn-warning btn-md w-40 mb-4" type="submit" id="editButton">Edit</button>
                        <!-- Create hidden HTML variables to pass into the database processing form when submitted -->
                        <input type="hidden" name="actionType" value="edit">
                        <input type="hidden" name="userId" value="<?= $user['ID']; ?>">
                        <input type="hidden" name="userFirstName" value="<?= $user['firstname']; ?>">
                        <input type="hidden" name="userLastName" value="<?= $user['lastname']; ?>">
                        <input type="hidden" name="userEmail" value="<?= $user['email']; ?>">
                        <input type="hidden" name="userRoleId" value="<?= $roleId; ?>">
                        </form>
                            
                        
                        </div>
                        </td> 
                        <?php
                    }
                    ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>




<!-- Delete Item Modal Popup Form Element -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post" action="../deleteRecord.php">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this user?</script></h5>
        
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="col-lg-12" style="padding-top: 15px;">
        <div class="form-group" style="padding-bottom: 15px;">
            <label class="form-label">Name: <?= $userFirstName." ".$userLastName ?></label><br>
            <label class="form-label">Email: <?= $userEmail; ?></label><br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger" id="DeleteUser">Delete</button>
      </div>
      <input type="hidden" name="objectType" value="user">
      <input type="hidden" name="objectId" value=<?= $objectId; ?>>
    </form>
    </div>
  </div>
</div>

<!-- Edit Item Modal Popup Form Element -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit an Item</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="col-lg-12" style="padding-top: 15px;">
      <form method="post" action="../updateRecord.php">
        <div class="form-group">
            <label for="exampleFormControlInput1" class="form-label">First Name</label>
            <input type="text" value="<?= $userFirstName ?>" class="form-control" name="userFirstName" id="userFirstName">
            <!--small id="emailHelp" class="form-text text-muted">Description must be at least 10 characters.</small-->
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1" class="form-label">Last Name</label>
            <input type="text" value="<?= $userLastName ?>" class="form-control" name="userLastName" id="userLastName">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="text" value="<?= $userEmail ?>" class="form-control" name="userEmail" id="userEmail">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1" class="form-label">User Role</label><br>
            <select class="select" style="padding: 4px" name="userRole">
                <?php
                // Create a dropdown list, with all catagories currently in catagories table
                $currentRole = $controllers->roles()->get_role_by_id($userRoleId);
                $roles = $controllers->roles()->get_all_roles();
                foreach ($roles as $role){
                    ?>
                    <option value=<?=$role['id'] ?><?php if ($role['id'] == $userRoleId){
                      // Make the current user's role already selected
                      ?>
                      selected 
                      <?php
                    } ?> 
                    ><?= $role['name'] ?></option>
                    <?php
                }
                ?> 
            </select>
        </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Update</button>
            <input type="hidden" name="objectType" value="user">
            <input type="hidden" name="objectId" value=<?= $objectId; ?>>
        </form>
      </div>
    </div>
  </div>
</div>


