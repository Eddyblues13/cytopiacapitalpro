@include('admin.header')
<div class="main-panel bg-dark">
            <div class="content bg-dark">
                <div class="page-inner">
                    <div class="mt-2 mb-4">
                    <h1 class="title1 text-light">Managers List</h1>
                    </div>
                    <div>
    </div>            <div>
    </div>                   
                    <div class="mb-5 row">
                        <div class="col p-4 shadow card bg-dark">
                            <div class="table-responsive" data-example-id="hoverable-table">
                                <table id="ShipTable" class="table table-hover text-light"> 
                                    <thead> 
                                        <tr> 
                                            <th>USER ID</th>
                                            <th>FIRSTNAME</th>
                                            <th>LASTNAME</th>
                                            <th>EMAIL</th>
                                            <th>PHONE</th>
                                            <th>TYPE</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </tr> 
                                    </thead> 
                                    <tbody> 
                                                                        <tr>
                                        <td>1</td>
                                        <td>Admin</td>
                                        <td>Test</td>
                                        <td>admin@admin.com</td>
                                        <td>34444443</td>
                                        <td>Super Admin</td>
                                        <td>active</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                                </a>
                                                <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuLink">

                                                                                                        <a class="m-1 btn btn-danger btn-sm" href="https://stockmarket-hq.com/account/admin/dashboard/ublock/1">Block</a>
                                                                                                        <a href="#" data-toggle="modal" data-target="#resetpswdModal1"  class="m-1 btn btn-warning btn-sm">Reset Password</a>
                                                    
                                                    <a href="#" data-toggle="modal" data-target="#deleteModal1" class="m-1 btn btn-danger btn-sm">Delete</a>
                                                    <a href="#" data-toggle="modal" data-target="#edituser1" class="m-1 btn btn-secondary btn-sm">Edit</a>
                                                    <a href="#" data-toggle="modal" data-target="#sendmailModal1" class="m-1 btn btn-info btn-sm">Send Email</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <!-- Reset user password Modal -->
										<div id="resetpswdModal1" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
            
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                <div class="modal-header bg-dark ">
                                                    
                                                    <h4 class="modal-title text-light">Reset Password</strong></h4>
                                                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body bg-dark p-3">
                                                    <p class="text-light">Are you sure you want to reset password for Admin to <span class="text-primary font-weight-bolder">admin01236</span></p>
                                                    <a class="btn btn-danger" href="https://stockmarket-hq.com/account/admin/dashboard/resetadpwd/1">Reset Now</a>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Reset user password Modal -->

                                        <!-- Delete user Modal -->
										<div id="deleteModal1" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
            
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                <div class="modal-header bg-dark">
                                                    
                                                    <h4 class="modal-title text-light">Delete Manager</strong></h4>
                                                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body bg-dark p-3">
                                                    <p class="text-light">Are you sure you want to delete Admin</p>
                                                    <a class="btn btn-danger" href="https://stockmarket-hq.com/account/admin/dashboard/deleletadmin/1">Yes i'm sure</a>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Delete user Modal -->
                                        
								<!-- Edit user Modal -->
                                    <div id="edituser1" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                                <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header bg-dark">
                                                    
                                                    <h4 class="modal-title text-light">Edit user details.</strong></h4>
                                                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body bg-dark">
                                                        <form style="padding:3px;" role="form" method="post" action="https://stockmarket-hq.com/account/admin/dashboard/editadmin">
                                                            <h5 class=" text-light">Firstname</h5>
                                                            <input style="padding:5px;" class="form-control bg-dark text-light" value="Admin" type="text" name="fname" required><br/>
                                                            <h5 class=" text-light">Lastname</h5>
                                                            <input style="padding:5px;" class="form-control bg-dark text-light" value="Test" type="text" name="l_name" required><br/>
                                                            <h5 class=" text-light">Email</h5>
                                                            <input style="padding:5px;" class="form-control bg-dark text-light" value="admin@admin.com" type="email" name="email" required><br/>
                                                            <h5 class=" text-light">Phone Number</h5>
                                                            <input style="padding:5px;" class="form-control bg-dark text-light" value="34444443" type="text" name="phone" required>
                                                            <br>
                                                            <h5 class=" text-light">Type</h5>
                                                            <select class="form-control bg-dark text-light" name="type">
                                                                <option>Super Admin</option>
                                                                <option>Super Admin</option>
                                                                <option>Admin</option>
                                                            </select><br>
                                                            <input type="hidden" name="_token" value="EqGt2txdTJHMwXVRjoCB9yNMVUEKJvIhyXqL7wBp">
                                                            <input type="hidden" name="user_id" value="1">
                                                            <input type="submit" class="btn btn-info" value="Update account">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Edit user Modal -->
                                    <!-- send a single user email Modal-->
                                    <div id="sendmailModal1" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header bg-dark">
                                                    <h4 class="modal-title text-light">Send Email Message</h4>
                                                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                                                </div>
                                                
                                                <div class="modal-body bg-dark">
                                                    <p class="text-light">This message will be sent to Admin Test </p>
                                                    <form role="form" method="post" action="https://stockmarket-hq.com/account/admin/dashboard/sendmail">
                                                        <input type="hidden" name="user_id" value="1">
                                                        <div class="form-group">
                                                            <input type="text" name="subject" class="form-control bg-dark text-light" placeholder="Enter Email Subject">
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea class="form-control bg-dark text-light" name="message " row="3" placeholder="Type your message here" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" name="_token" value="EqGt2txdTJHMwXVRjoCB9yNMVUEKJvIhyXqL7wBp">
                                                            <input type="submit" class="btn btn-primary" value="Send"> 
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                                                        </tbody> 
                                </table>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
@include('admin.footer')