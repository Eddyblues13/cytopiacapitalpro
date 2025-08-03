@include('admin.header')

<!-- End Sidebar -->
<div class="main-panel">
    <div class="content bg-dark">
        <div class="page-inner">
            <div class="mt-2 mb-4">
                <h1 class="title1 text-light">Available Stocks</h1>
            </div>
            <div>
            </div>
            <div>
            </div>
            <div class="mb-5 row">
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
                <div class="mt-2 mb-3 col-lg-12">
                    <a class="btn btn-primary" href="{{route('stock.create')}}"><i class="fa fa-plus"></i> Add A New
                        Stock</a>
                </div>
                @foreach($stocks as $stock)
                <div class="col-lg-4">
                    <div class="pricing-table purple border p-4 card bg-dark shadow">
                        <div class="price-tag">

                            <center><i>Stock Details</i></center>
                            <h2 class="text-light">{{$stock->stock_name}}</h2>
                        </div>
                        <!-- Features -->
                        <div class="pricing-features">
                            <div class="feature text-light">Maximum Investment Amount:<span class="text-light">
                                    ${{$stock->stock_max_amount}}</span></div>
                            <div class="feature text-light">Minimum Investment Amount:<span class="text-light">
                                    ${{$stock->stock_min_amount}}</span></div>
                            <div class="feature text-light">Top-up Amount:<span class="text-light">
                                    ${{$stock->top_up_amount}}</span></div>
                            <div class="feature text-light">Top-up Interval:<span class="text-light">
                                    {{$stock->top_up_interval}}</span></div>
                            <div class="feature text-light">Top-up Type:<span class="text-light">
                                    {{$stock->top_up_type}}</span></div>
                            <div class="feature text-light">Investment Duration:<span class="text-light">
                                    {{$stock->investment_duration}} months</span></div>
                            <div class="feature text-light">Performance:<span class="text-light">
                                    {{$stock->performance}}</span></div>
                            <div class="feature text-light">Copier ROI:<span class="text-light">
                                    {{$stock->copier_roi}}%</span></div>
                            <div class="feature text-light">Years of Experience:<span class="text-light">
                                    {{$stock->years_of_experience}}</span></div>
                            <div class="feature text-light">Top-up Status:<span class="text-light">
                                    {{$stock->top_up_status ? 'Active' : 'Inactive'}}</span></div>
                        </div>
                        <br>
                        <!-- Button -->
                        <div class="text-center">
                            <a href="{{ route('stock.edit', $stock->id) }}" class="btn btn-primary"><i
                                    class="text-white flaticon-pencil"></i> Edit</a> &nbsp;

                            <form action="{{ route('stock.destroy', $stock->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure?')"><i class="text-white fa fa-times"></i>
                                    Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('admin.footer')