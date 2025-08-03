@include('user.layouts.header')

<!-- Add Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Main Content -->
<div class="depost-form-main w-100 px-2">
    <div class="fund-same-card" style="background-color: #121825;">
        <form id="identityVerificationForm" enctype="multipart/form-data">
            @csrf
            <h2 class="heading fs-4 py-3 text-center text-primary">Verify your identity</h2>
            <div class="row">
                <p class="text-header">Please verify your identity by uploading a valid government issued identification
                    card. You may experience difficulties when uploading from an ios device. Make sure your browser has
                    camera access in your ios settings.</p>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="d-flex gap-3 align-items-center">
                        <input type="file" id="frontPhotoInput" name="front_photo" accept="image/*"
                            style="display: none;">
                        <button id="frontSelectBtn" class="btn btn-select" type="button"
                            onclick="document.getElementById('frontPhotoInput').click(); return false;">
                            Select Front
                        </button>
                        <div id="frontFileName" class="file-name-display flex-grow-1 text-white"
                            style="background-color: transparent;">
                            No file selected
                        </div>
                    </div>
                    <div class="text-danger front-photo-error"></div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <div class="d-flex gap-3 align-items-center">
                        <input type="file" id="backPhotoInput" name="back_photo" accept="image/*"
                            style="display: none;">
                        <button id="backSelectBtn" class="btn btn-select" type="button"
                            onclick="document.getElementById('backPhotoInput').click(); return false;">
                            Select Back
                        </button>
                        <div id="backFileName" class="file-name-display flex-grow-1 text-white"
                            style="background-color: transparent;">
                            No file selected
                        </div>
                    </div>
                    <div class="text-danger back-photo-error"></div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="withdrawal-btn" id="submitBtn">
                    <span id="submitText">Upload</span>
                    <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status"
                        aria-hidden="true"></span>
                </button>
            </div>
        </form>
    </div>

    <div class="text-center my-4">
        <a href="#" class="text-primary text-decoration-none"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LOGOUT</a>

        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
            @csrf
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

    // Function to update input styling when file is selected
    function updateInputStyle(inputId, fileNameId, buttonId) {
        const input = document.getElementById(inputId);
        const fileNameDisplay = document.getElementById(fileNameId);
        const button = document.getElementById(buttonId);
        
        input.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const fileName = e.target.files[0].name;
                fileNameDisplay.textContent = fileName;
                
                // Change button color to indicate success
                button.style.backgroundColor = '#28a745';
                button.style.borderColor = '#28a745';
                button.style.color = 'white';
                
                // Change file name display color
                fileNameDisplay.style.color = '#28a745';
            } else {
                fileNameDisplay.textContent = 'No file selected';
                
                // Reset button style
                button.style.backgroundColor = '';
                button.style.borderColor = '';
                button.style.color = '';
                
                // Reset file name display color
                fileNameDisplay.style.color = 'white';
            }
        });
    }

    // Apply styling to both file inputs
    updateInputStyle('frontPhotoInput', 'frontFileName', 'frontSelectBtn');
    updateInputStyle('backPhotoInput', 'backFileName', 'backSelectBtn');

    // AJAX form submission
    document.getElementById('identityVerificationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = e.target;
        const formData = new FormData(form);
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const spinner = document.getElementById('spinner');
        
        // Show spinner
        submitText.textContent = 'Uploading...';
        spinner.classList.remove('d-none');
        submitBtn.disabled = true;
        
        // Clear previous errors
        document.querySelectorAll('.text-danger').forEach(el => el.textContent = '');
        
        fetch("{{ route('verifications.user.identity') }}", {
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
                // Show success toast
                toastr.success(data.message || 'Identity verification submitted successfully!');
                
                // Reset form and styles
                form.reset();
                document.getElementById('frontFileName').textContent = 'No file selected';
                document.getElementById('backFileName').textContent = 'No file selected';
                
                // Reset button styles
                document.getElementById('frontSelectBtn').style.backgroundColor = '';
                document.getElementById('frontSelectBtn').style.borderColor = '';
                document.getElementById('frontSelectBtn').style.color = '';
                document.getElementById('backSelectBtn').style.backgroundColor = '';
                document.getElementById('backSelectBtn').style.borderColor = '';
                document.getElementById('backSelectBtn').style.color = '';
                
                // Reset file name colors
                document.getElementById('frontFileName').style.color = 'white';
                document.getElementById('backFileName').style.color = 'white';
            } else {
                if (data.errors) {
                    // Show error toast for general errors
                    if (data.message) {
                        toastr.error(data.message);
                    }
                    
                    // Display field-specific errors
                    for (const [key, value] of Object.entries(data.errors)) {
                        const errorElement = document.querySelector(`.${key}-error`);
                        if (errorElement) {
                            errorElement.textContent = value[0];
                        }
                    }
                } else {
                    toastr.error(data.message || 'An error occurred while submitting the form');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            toastr.error('An error occurred while submitting the form');
        })
        .finally(() => {
            // Hide spinner
            submitText.textContent = 'Upload';
            spinner.classList.add('d-none');
            submitBtn.disabled = false;
        });
    });
</script>

@include('user.layouts.footer')