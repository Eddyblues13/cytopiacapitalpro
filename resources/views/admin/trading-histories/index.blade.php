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
                    <h1 class="title1 text-light">Manage Trading Histories</h1>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createHistoryModal">
                        <i class="fas fa-plus"></i> Add New
                    </button>
                </div>

                <div class="mb-5 row">
                    <div class="col-12 card shadow p-4 bg-dark">
                        <div class="table-responsive">
                            <table id="HistoryTable" class="table table-hover text-light">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Trader</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($histories as $history)
                                    <tr>
                                        <td>{{ $history->user->first_name }} {{ $history->user->last_name }}</td>
                                        <td>{{ $history->trader->name }}</td>
                                        <td>${{ number_format($history->amount, 2) }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($history->status == 'completed') badge-success
                                                @elseif($history->status == 'failed') badge-danger
                                                @else badge-warning
                                                @endif">
                                                {{ ucfirst($history->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $history->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning edit-btn" data-id="{{ $history->id }}"
                                                data-user_id="{{ $history->user_id }}"
                                                data-trader_id="{{ $history->trader_id }}"
                                                data-amount="{{ $history->amount }}"
                                                data-status="{{ $history->status }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <form action="{{ route('admin.trading-histories.destroy', $history->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger delete-btn">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
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

<!-- Create Modal -->
<div class="modal fade" id="createHistoryModal" tabindex="-1" role="dialog" aria-labelledby="createHistoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-light" id="createHistoryModalLabel">Add New Trading History</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createHistoryForm">
                <div class="modal-body">
                    <div id="createErrors" class="alert alert-danger d-none"></div>

                    <div class="form-group">
                        <label class="text-light">User</label>
                        <select name="user_id" class="form-control bg-dark text-light" required>
                            <option value="">Select User</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="text-light">Trader</label>
                        <select name="trader_id" class="form-control bg-dark text-light" required>
                            <option value="">Select Trader</option>
                            @foreach($traders as $trader)
                            <option value="{{ $trader->id }}">{{ $trader->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="text-light">Amount ($)</label>
                        <input type="number" step="0.01" name="amount" class="form-control bg-dark text-light" required>
                    </div>

                    <div class="form-group">
                        <label class="text-light">Status</label>
                        <select name="status" class="form-control bg-dark text-light" required>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="submit-text">Create</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editHistoryModal" tabindex="-1" role="dialog" aria-labelledby="editHistoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-light" id="editHistoryModalLabel">Edit Trading History</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editHistoryForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="history_id" id="editHistoryId">
                <div class="modal-body">
                    <div id="editErrors" class="alert alert-danger d-none"></div>

                    <div class="form-group">
                        <label class="text-light">User</label>
                        <select name="user_id" id="editUserId" class="form-control bg-dark text-light" required>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="text-light">Trader</label>
                        <select name="trader_id" id="editTraderId" class="form-control bg-dark text-light" required>
                            @foreach($traders as $trader)
                            <option value="{{ $trader->id }}">{{ $trader->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="text-light">Amount ($)</label>
                        <input type="number" step="0.01" name="amount" id="editAmount"
                            class="form-control bg-dark text-light" required>
                    </div>

                    <div class="form-group">
                        <label class="text-light">Status</label>
                        <select name="status" id="editStatus" class="form-control bg-dark text-light" required>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="submit-text">Update</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.footer')

<!-- Toastr -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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

    $(document).ready(function() {
        $('#HistoryTable').DataTable({
            order: [[4, 'desc']],
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'print', 'excel', 'pdf']
        });

        // Handle create form
        $('#createHistoryForm').submit(function(e) {
            e.preventDefault();
            const form = $(this);
            const submitBtn = form.find('[type="submit"]');
            const submitText = form.find('.submit-text');
            const spinner = form.find('.spinner-border');
            
            // Show loading state
            submitText.addClass('d-none');
            spinner.removeClass('d-none');
            
            $.ajax({
                url: "{{ route('admin.trading-histories.store') }}",
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    if(response.status === 'success') {
                        toastr.success(response.message);
                        $('#createHistoryModal').modal('hide');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    }
                },
                error: function(xhr) {
                    submitText.removeClass('d-none');
                    spinner.addClass('d-none');
                    
                    if(xhr.status === 422) {
                        // Validation errors
                        const errors = xhr.responseJSON.errors;
                        let errorHtml = '<ul class="mb-0">';
                        
                        $.each(errors, function(key, value) {
                            errorHtml += '<li>' + value[0] + '</li>';
                        });
                        
                        errorHtml += '</ul>';
                        $('#createErrors').html(errorHtml).removeClass('d-none');
                    } else {
                        // Other errors
                        const response = xhr.responseJSON;
                        toastr.error(response.message || 'An error occurred');
                    }
                }
            });
        });

        // Handle edit button click
        $('.edit-btn').click(function() {
            const historyId = $(this).data('id');
            const userId = $(this).data('user_id');
            const traderId = $(this).data('trader_id');
            const amount = $(this).data('amount');
            const status = $(this).data('status');
            
            $('#editHistoryId').val(historyId);
            $('#editUserId').val(userId);
            $('#editTraderId').val(traderId);
            $('#editAmount').val(amount);
            $('#editStatus').val(status);
            
            $('#editHistoryModal').modal('show');
        });

        // Handle edit form
        $('#editHistoryForm').submit(function(e) {
            e.preventDefault();
            const form = $(this);
            const submitBtn = form.find('[type="submit"]');
            const submitText = form.find('.submit-text');
            const spinner = form.find('.spinner-border');
            const historyId = $('#editHistoryId').val();
            
            // Show loading state
            submitText.addClass('d-none');
            spinner.removeClass('d-none');
            
            $.ajax({
                url: "/admin/trading-histories/" + historyId,
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    if(response.status === 'success') {
                        toastr.success(response.message);
                        $('#editHistoryModal').modal('hide');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    }
                },
                error: function(xhr) {
                    submitText.removeClass('d-none');
                    spinner.addClass('d-none');
                    
                    if(xhr.status === 422) {
                        // Validation errors
                        const errors = xhr.responseJSON.errors;
                        let errorHtml = '<ul class="mb-0">';
                        
                        $.each(errors, function(key, value) {
                            errorHtml += '<li>' + value[0] + '</li>';
                        });
                        
                        errorHtml += '</ul>';
                        $('#editErrors').html(errorHtml).removeClass('d-none');
                    } else {
                        // Other errors
                        const response = xhr.responseJSON;
                        toastr.error(response.message || 'An error occurred');
                    }
                }
            });
        });

        // Handle delete
        $('.delete-btn').click(function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            
            if(confirm('Are you sure you want to delete this trading history?')) {
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
                    }
                });
            }
        });
    });
</script>