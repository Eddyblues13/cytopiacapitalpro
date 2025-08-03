@include('user.layouts.header')

<!-- Add Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Main Content -->
<div class="depost-form-main w-100 px-2 my-4">
    <div class="fund-same-card" style="background-color: #121825;">
        <form id="addressVerificationForm" enctype="multipart/form-data">
            @csrf
            <h2 class="heading fs-4 py-3 text-center text-white">Address Verification</h2>

            <div>
                <p class="text-header">City {{Auth::user()->city}}</p>
                <p class="text-header">State</p>
                <p class="text-header">Zip Code</p>
                <p class="text-header">Country {{Auth::user()->country}}</p>
                <p class="text-header">Street Address</p>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <div class="d-flex gap-3 align-items-center">
                        <input type="file" id="utilityBillInput" name="utility_bill" accept="image/*"
                            style="display: none;">
                        <button id="billSelectBtn" class="btn btn-select" type="button"
                            onclick="document.getElementById('utilityBillInput').click(); return false;">
                            Select Bill
                        </button>
                        <div id="billFileName" class="file-name-display flex-grow-1 text-white"
                            style="background-color: transparent;">
                            No file selected
                        </div>
                    </div>
                    <div class="text-danger utility-bill-error"></div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="withdrawal-btn mb-3" id="submitBtn">
                    <span id="submitText">Submit</span>
                    <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status"
                        aria-hidden="true"></span>
                </button>

                <button type="button" class="withdrawal-btn mb-3"
                    style="background: transparent; border: 1px solid #0287df" id="skipBtn">
                    Skip
                </button>
            </div>

            <div class="d-flex justify-content-center">
                <button class="withdrawal-btn my-4 w-25"
                    style="background: transparent; border: 1px solid #0287df">LOGOUT</button>
            </div>
        </form>
    </div>
</div>

<!-- Add jQuery and Toastr JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    // Initialize Toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000",
        "extendedTimeOut": "1000"
    };

    // Update file input styling when file is selected
    document.getElementById('utilityBillInput').addEventListener('change', function(e) {
        const fileName = e.target.files[0] ? e.target.files[0].name : 'No file selected';
        const billFileName = document.getElementById('billFileName');
        const billSelectBtn = document.getElementById('billSelectBtn');
        
        billFileName.textContent = fileName;
        
        if (e.target.files.length > 0) {
            // Change to success color
            billSelectBtn.style.backgroundColor = '#28a745';
            billSelectBtn.style.borderColor = '#28a745';
            billSelectBtn.style.color = 'white';
            billFileName.style.color = '#28a745';
        } else {
            // Reset styles
            billSelectBtn.style.backgroundColor = '';
            billSelectBtn.style.borderColor = '';
            billSelectBtn.style.color = '';
            billFileName.style.color = 'white';
        }
    });

    // Form submission
    document.getElementById('addressVerificationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = e.target;
        const formData = new FormData(form);
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const spinner = document.getElementById('spinner');
        
        // Show spinner
        submitText.textContent = 'Submitting...';
        spinner.classList.remove('d-none');
        submitBtn.disabled = true;
        
        // Clear previous errors
        document.querySelectorAll('.text-danger').forEach(el => el.textContent = '');
        
        fetch("{{ route('verifications.user.address') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toastr.success(data.message || 'Address verification submitted successfully!');
                form.reset();
                document.getElementById('billFileName').textContent = 'No file selected';
                
                // Reset button styles
                const billSelectBtn = document.getElementById('billSelectBtn');
                billSelectBtn.style.backgroundColor = '';
                billSelectBtn.style.borderColor = '';
                billSelectBtn.style.color = '';
                document.getElementById('billFileName').style.color = 'white';
                
                // Redirect or do something else on success
            } else {
                if (data.errors) {
                    for (const [key, value] of Object.entries(data.errors)) {
                        const errorElement = document.querySelector(`.${key}-error`);
                        if (errorElement) {
                            errorElement.textContent = value[0];
                        }
                    }
                }
                toastr.error(data.message || 'Error submitting address verification');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            toastr.error('An error occurred while submitting the form');
        })
        .finally(() => {
            // Hide spinner
            submitText.textContent = 'Submit';
            spinner.classList.add('d-none');
            submitBtn.disabled = false;
        });
    });

    // Skip button functionality
    document.getElementById('skipBtn').addEventListener('click', function() {
        if (confirm('Are you sure you want to skip address verification?')) {
            // You can add AJAX call here to handle skip functionality
            toastr.info('Address verification skipped');
            // Redirect or do something else
        }
    });
</script>

@include('user.layouts.footer')