@include('admin.header')

<div class="main-panel">
    <div class="content bg-dark">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{ session('message') }}</div>
            @endif
            <div class="mt-2 mb-4">
                <h1 class="title1 text-light">Add Trader</h1>
            </div>
            <div class="mb-5 row">
                <div class="col-lg-12">
                    <div class="p-3 card bg-dark">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if ($errors->any()))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form id="addTraderForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Trader Name</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Enter trader name"
                                        type="text" name="name" value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Followers</h5>
                                    <input class="form-control text-light bg-dark"
                                        placeholder="Enter number of followers" type="number" name="followers"
                                        value="{{ old('followers', 0) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Return Rate (%)</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Enter return rate"
                                        type="number" step="any" name="return_rate" value="{{ old('return_rate', 0) }}"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Minimum Amount ($)</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Enter minimum amount"
                                        type="number" step="any" name="min_amount" value="{{ old('min_amount') }}"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Maximum Amount ($)</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Enter maximum amount"
                                        type="number" step="any" name="max_amount" value="{{ old('max_amount') }}"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Profit Share (%)</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Enter profit share"
                                        type="number" step="any" name="profit_share"
                                        value="{{ old('profit_share', 0) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Verified Status</h5>
                                    <select class="form-control text-light bg-dark" name="is_verified">
                                        <option value="1" {{ old('is_verified')=='1' ? 'selected' : '' }}>Verified
                                        </option>
                                        <option value="0" {{ old('is_verified')=='0' ? 'selected' : '' }}>Not Verified
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Profile Picture</h5>
                                    <input class="form-control text-light bg-dark" type="file" name="picture" required>
                                    <small class="text-muted">Image will be uploaded to cloud storage</small>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="submit" class="btn btn-primary" value="Add Trader">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.footer')

    <script>
        document.getElementById('addTraderForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            // Show loading state
            const submitBtn = this.querySelector('[type="submit"]');
            const originalBtnText = submitBtn.value;
            submitBtn.value = 'Processing...';
            submitBtn.disabled = true;

            fetch("{{ route('traders.store') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(async response => {
                const contentType = response.headers.get('content-type');
                
                if (contentType && contentType.includes('application/json')) {
                    return response.json();
                }
                
                // Handle non-JSON responses (like HTML error pages)
                const text = await response.text();
                throw new Error(text || 'Server returned an error');
            })
            .then(data => {
                if (data.success) {
                    toastr.success(data.message || 'Trader added successfully!');
                    // Redirect or clear form after success
                    setTimeout(() => {
                        window.location.href = data.redirect_url || window.location.href;
                    }, 1500);
                } else {
                    toastr.error(data.message || 'Error adding trader');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                toastr.error(error.message || 'An error occurred while processing your request');
            })
            .finally(() => {
                submitBtn.value = originalBtnText;
                submitBtn.disabled = false;
            });
        });
    </script>
</div>