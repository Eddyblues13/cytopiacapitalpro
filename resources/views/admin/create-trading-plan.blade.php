@include('admin.header')

<div class="main-panel">
    <div class="content bg-dark">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{ session('message') }}</div>
            @endif
            <div class="mt-2 mb-4">
                <h1 class="title1 text-light">Add Trading Plan</h1>
            </div>
            <div class="mb-5 row">
                <div class="col-lg-12">
                    <div class="p-3 card bg-dark">
                        <form action="{{ route('admin.store-trading-plan') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Plan Name</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Enter Plan name"
                                        type="text" name="name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Minimum Amount ($)</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Enter minimum amount"
                                        type="number" name="min_amount" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Maximum Amount ($)</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Enter maximum amount"
                                        type="number" name="max_amount" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Investment Duration</h5>
                                    <input class="form-control text-light bg-dark"
                                        placeholder="Enter duration (e.g. 3 months)" type="text" name="duration"
                                        required>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="submit" class="btn btn-primary" value="Add Plan">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')