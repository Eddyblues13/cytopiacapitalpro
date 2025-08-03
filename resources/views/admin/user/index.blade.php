@include('admin.header')

<div class="main-panel">
    <div class="content-wrapper">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="content bg-dark">
            <div class="page-inner">
                <div class="mt-2 mb-4 d-flex justify-content-between align-items-center">
                    <h1 class="title1 text-light">Manage Users</h1>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add New User</a>
                </div>

                <div class="mb-5 row">
                    <div class="col-12 card shadow p-4 bg-dark">
                        <div class="table-responsive" data-example-id="hoverable-table">
                            <table id="UserTable" class="table table-hover text-light">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Country</th>
                                        <th>Status</th>
                                        <th>Verification</th>
                                        <th>Referred By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($user->profile_photo)
                                                <img src="{{ asset('storage/'.$user->profile_photo) }}"
                                                    class="rounded-circle" width="40" height="40">
                                                @else
                                                <div
                                                    class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                                    {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0,
                                                    1) }}
                                                </div>
                                                @endif
                                                <div class="ml-2">
                                                    {{ $user->first_name }} {{ $user->last_name }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->country }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($user->user_status == 'active') badge-success
                                                @elseif($user->user_status == 'banned') badge-danger
                                                @else badge-secondary
                                                @endif">
                                                {{ ucfirst($user->user_status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <span
                                                    class="badge {{ $user->email_verification ? 'badge-success' : 'badge-secondary' }}"
                                                    title="Email Verified">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                                <span
                                                    class="badge {{ $user->id_verification ? 'badge-success' : 'badge-secondary' }} ml-1"
                                                    title="ID Verified">
                                                    <i class="fas fa-id-card"></i>
                                                </span>
                                                <span
                                                    class="badge {{ $user->address_verification ? 'badge-success' : 'badge-secondary' }} ml-1"
                                                    title="Address Verified">
                                                    <i class="fas fa-home"></i>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            @if($user->referred_by)
                                            {{ $user->referrer->first_name ?? 'N/A' }}
                                            @else
                                            None
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                class="d-inline" data-ajax-delete>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<!-- Toastr -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000"
    };

    $(document).ready(function () {
        $('#UserTable').DataTable({
            order: [[0, 'asc']],
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'print', 'excel', 'pdf']
        });

        $(".dataTables_length select").addClass("bg-dark text-light");
        $(".dataTables_filter input").addClass("bg-dark text-light");

        // Handle delete with AJAX
        $('form[data-ajax-delete]').submit(function(e) {
            e.preventDefault();
            
            const form = $(this);
            const button = form.find('[type="submit"]');
            
            if(confirm('Are you sure you want to delete this user?')) {
                // Show loading state
                button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Deleting...');
                
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        if(response.status === 'success') {
                            toastr.success(response.message);
                            form.closest('tr').fadeOut(300, function() {
                                $(this).remove();
                            });
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON;
                        toastr.error(response.message || 'An error occurred');
                        button.prop('disabled', false).html('Delete');
                    }
                });
            }
        });
    });
</script>