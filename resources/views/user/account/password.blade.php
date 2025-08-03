@include('user.layouts.header')

<style>
    /* Loading spinner */
    .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>

<!-- Main Content -->
<div class="depost-form-main w-100">
    <div class="fund-same-card">
        <form id="updatePasswordForm">
            @csrf
            <div class="input-group">
                <div class="input-label">Current Password</div>
                <input type="password" name="current_password" class="amount-input" required>
            </div>

            <div class="input-group">
                <div class="input-label">New Password</div>
                <input type="password" name="new_password" class="amount-input" required>
            </div>

            <div class="input-group">
                <div class="input-label">Confirm New Password</div>
                <input type="password" name="new_password_confirmation" class="amount-input" required>
            </div>

            <button type="submit" class="withdrawal-btn" id="submitButton">
                <span id="buttonText">Update</span>
                <span id="loadingSpinner" class="loading-spinner" style="display: none;"></span>
            </button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function () {
        $('#updatePasswordForm').on('submit', function (e) {
            e.preventDefault();

            // Show loading spinner and disable button
            $('#buttonText').hide();
            $('#loadingSpinner').show();
            $('#submitButton').prop('disabled', true);

            // Send AJAX request
            $.ajax({
                url: '{{ route("account.update.password") }}',
                method: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function (response) {
                    // Hide loading spinner and enable button
                    $('#buttonText').show();
                    $('#loadingSpinner').hide();
                    $('#submitButton').prop('disabled', false);

                    if (response.success) {
                        // Show success message
                        toastr.success(response.message);

                        // Redirect to the specified URL
                        window.location.href = response.redirect;
                    } else {
                        // Show error message
                        toastr.error(response.message);
                    }
                },
                error: function (xhr) {
                    // Hide loading spinner and enable button
                    $('#buttonText').show();
                    $('#loadingSpinner').hide();
                    $('#submitButton').prop('disabled', false);

                    // Show error message
                    toastr.error(xhr.responseJSON.message || 'An error occurred. Please try again.');
                }
            });
        });
    });
</script>

@include('user.layouts.footer')