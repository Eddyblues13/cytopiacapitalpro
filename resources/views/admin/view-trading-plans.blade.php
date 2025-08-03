@include('admin.header')

<div class="main-panel">
    <div class="content-wrapper">
        @if(session('message'))
        <div class="alert alert-success mb-2">{{ session('message') }}</div>
        @endif

        <div class="content bg-dark">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                </div>

                <div class="mt-2 mb-4 d-flex justify-content-between align-items-center">
                    <h1 class="title1 text-light">Manage Account Plans</h1>
                    <a href="{{ route('admin.create-trading-plan') }}" class="btn btn-primary">Create New Plan</a>
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
                                            <a href="{{ route('admin.edit-trading-plan', $plan->id) }}"
                                                class="btn btn-warning">Edit</a>
                                            <form action="{{ route('admin.delete-trading-plan', $plan->id) }}"
                                                method="POST" class="d-inline">
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

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
    }
</script>

<script type="text/javascript">
    var badWords = [
        '<!--Start of Tawk.to Script-->',
        '<script type="text/javascript">',
        '<!--End of Tawk.to Script-->'
    ];

    $(':input').on('blur', function(){
        var value = $(this).val();
        $.each(badWords, function(idx, word){
            value = value.replace(word, '');
        });
        $(this).val(value);
    });
</script>

<script>
    $(document).ready(function () {
        $('#PlanTable').DataTable({
            order: [[0, 'desc']],
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'print', 'excel', 'pdf']
        });

        $(".dataTables_length select").addClass("bg-dark text-light");
        $(".dataTables_filter input").addClass("bg-dark text-light");
    });
</script>

<script>
    $(document).ready(function () {
        $('.UserTable').DataTable({
            order: [[0, 'desc']]
        });
        $(".dataTables_length select").addClass("bg-dark text-light");
        $(".dataTables_filter input").addClass("bg-dark text-light");
    });
</script>