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
                <div class="mt-2 mb-4"></div>

                <div class="mt-2 mb-4 d-flex justify-content-between align-items-center">
                    <h1 class="title1 text-light">Manage Account Plans</h1>
                    <a href="{{ route('admin.plans.create') }}" class="btn btn-primary">Create New Plan</a>
                </div>

                <div class="mb-5 row">
                    <div class="col-12 card shadow p-4 bg-dark">
                        <div class="table-responsive" data-example-id="hoverable-table">
                            <table id="PlanTable" class="table table-hover text-light">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price ($)</th>
                                        <th>Swap Fee</th>
                                        <th>Trading Pairs</th>
                                        <th>Leverage</th>
                                        <th>Spread</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($plans as $plan)
                                    <tr>
                                        <td>{{ $plan->name }}</td>
                                        <td>{{ number_format($plan->price, 2) }}</td>
                                        <td>{{ $plan->swap_fee ? 'Yes' : 'No' }}</td>
                                        <td>{{ $plan->pairs }}</td>
                                        <td>{{ $plan->leverage ?? 'N/A' }}</td>
                                        <td>{{ $plan->spread ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('admin.plans.edit', $plan->id) }}"
                                                class="btn btn-warning">Edit</a>
                                            <form action="{{ route('admin.plans.destroy', $plan->id) }}" method="POST"
                                                class="d-inline" data-ajax-delete>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
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
        $('#PlanTable').DataTable({
            order: [[0, 'desc']],
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
            
            if(confirm('Are you sure you want to delete this plan?')) {
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