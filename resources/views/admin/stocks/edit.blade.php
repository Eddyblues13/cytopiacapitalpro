@include('admin.header')

<div class="main-panel">
    <div class="content bg-dark">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{ session('message') }}</div>
            @endif
            <div class="mt-2 mb-4">
                <h1 class="title1 text-light">Edit Stock</h1>
            </div>

            <div class="mb-5 row">
                <div class="col-lg-12 ">
                    <div class="p-3 card bg-dark">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('stock.update', $stock->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Stock Name</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Enter stock name"
                                        type="text" name="stock_name"
                                        value="{{ old('stock_name', $stock->stock_name) }}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Stock Maximum Amount</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Enter stock max amount"
                                        type="number" name="stock_max_amount"
                                        value="{{ old('stock_max_amount', $stock->stock_max_amount) }}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Stock Minimum Amount</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Enter stock min amount"
                                        type="number" name="stock_min_amount"
                                        value="{{ old('stock_min_amount', $stock->stock_min_amount) }}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Stock JS</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Enter stock JS"
                                        type="text" name="stock_js" value="{{ old('stock_js', $stock->stock_js) }}"
                                        required>
                                </div>

                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Stock Graph</h5>
                                    <input class="form-control text-light bg-dark"
                                        placeholder="Enter stock graph URL or file" type="text" name="stock_graph"
                                        value="{{ old('stock_graph', $stock->stock_graph) }}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Top Up Amount</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Enter top-up amount"
                                        type="number" name="top_up_amount"
                                        value="{{ old('top_up_amount', $stock->top_up_amount) }}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Top Up Interval</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Enter top-up interval"
                                        type="text" name="top_up_interval"
                                        value="{{ old('top_up_interval', $stock->top_up_interval) }}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Top Up Type</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Enter top-up type"
                                        type="text" name="top_up_type"
                                        value="{{ old('top_up_type', $stock->top_up_type) }}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Investment Duration</h5>
                                    <input class="form-control text-light bg-dark"
                                        placeholder="Enter investment duration" type="number" name="investment_duration"
                                        value="{{ old('investment_duration', $stock->investment_duration) }}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Top Up Status</h5>
                                    <select class="form-control text-light bg-dark" name="top_up_status" required>
                                        <option value="active" {{ old('top_up_status', $stock->top_up_status) ==
                                            'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('top_up_status', $stock->top_up_status) ==
                                            'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Performance</h5>
                                    <input class="form-control text-light bg-dark"
                                        placeholder="Enter performance details" type="text" name="performance"
                                        value="{{ old('performance', $stock->performance) }}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Copier ROI</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Enter copier ROI"
                                        type="number" step="0.01" name="copier_roi"
                                        value="{{ old('copier_roi', $stock->copier_roi) }}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Years of Experience</h5>
                                    <input class="form-control text-light bg-dark"
                                        placeholder="Enter years of experience" type="number" name="years_of_experience"
                                        value="{{ old('years_of_experience', $stock->years_of_experience) }}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Stock Picture</h5>
                                    <input class="form-control text-light bg-dark" type="file" name="picture">
                                    @if ($stock->picture)
                                    <img src="{{ asset('storage/' . $stock->picture) }}" alt="Stock Picture"
                                        width="100">
                                    @endif
                                </div>

                                <div class="form-group col-md-12">
                                    <h5 class="text-light">Stock Description</h5>
                                    <textarea class="form-control text-light bg-dark"
                                        placeholder="Enter stock description" name="description" rows="4"
                                        required>{{ old('description', $stock->description) }}</textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <input type="submit" class="btn btn-primary" value="Update Stock">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.footer')
</div>