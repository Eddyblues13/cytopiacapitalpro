@include('admin.header')
<div class="main-panel bg-dark">
        <div class="content bg-dark">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                <h1 class="title1 text-light">Add New Manager</h1>
                </div>
                <div>
    </div>            <div>
    </div>                <div class="mb-5 row">
                    <div class="col-lg-8 offset-lg-2 card p-3 bg-dark shadow">
                        <form method="POST" action="https://stockmarket-hq.com/account/admin/dashboard/saveadmin">
                            <input type="hidden" name="_token" value="EqGt2txdTJHMwXVRjoCB9yNMVUEKJvIhyXqL7wBp">

                            <div class="form-group">
                                <h4 class="text-light">First Name</h4>
                                <div>
                                    <input id="name" type="text" class="form-control bg-dark text-light" name="fname" value="" required>
                                                                    </div>
                            </div>
                            <div class="form-group">
                                <h4 class="text-light">Last Name</h4>
                                <div>
                                    <input id="name" type="text" class="form-control bg-dark text-light" name="l_name" value="" required>
                                                                    </div>
                            </div>

                            <div class="form-group">
                                <h4 class="text-light">E-Mail Address</h4>

                                <div>
                                    <input id="email" type="email" class="form-control bg-dark text-light" name="email" value="" required>

                                                                    </div>
                            </div>
                            
                            <div class="form-group">
                                <h4 class="text-light">Phone number</h4>
                                <div>
                                    <input id="phone" type="number" class="form-control bg-dark text-light" name="phone" value="" required>

                                                                    </div>
                            </div>
                            <div class="form-group">
                                <h4 class="text-light">Type</h4>
                                <select class="form-control bg-dark text-light" name="type">
                                    <option>Super Admin</option>
                                    <option>Admin</option>
                                </select><br>
                            </div>

                            <div class="form-group">
                                
                                <h4 class="text-light">Password</h4>
                                <div>
                                    <input id="password" type="password" class="form-control bg-dark text-light" name="password" required>

                                                                    </div>
                            </div>

                            <div class="form-group">
                                <h4 class="text-light">Confirm Password</h4>
                                <div>
                                    <input id="password-confirm" type="password" class="form-control bg-dark text-light" name="password_confirmation" required>

                                                                    </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <button type="submit" class="px-3 btn btn-primary btn-lg">
                                        <i class="fa fa-plus"></i> Save User
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@include('admin.footer')
				