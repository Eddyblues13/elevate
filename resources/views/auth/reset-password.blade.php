@section('title', 'Reset Password - RegentMarkets')
@include('home.header')

<style>
    .reset-main {
        background-color: #E6F3FD;
        min-height: calc(100vh - 200px);
        padding: 60px 20px;
    }

    .dark .reset-main {
        background-color: #0b1118;
    }

    .reset-container {
        max-width: 500px;
        margin: 0 auto;
    }

    .reset-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1a1f2b;
        margin-bottom: 24px;
        text-align: left;
    }

    .dark .reset-title {
        color: #ffffff;
    }

    .reset-box {
        background: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }

    .dark .reset-box {
        background: #0b1118;
        border-color: #363c4e;
    }

    .reset-description {
        color: #6b7280;
        font-size: 0.9rem;
        margin-bottom: 24px;
        line-height: 1.6;
    }

    .dark .reset-description {
        color: #a5bdd9;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        color: #6b7280;
        font-size: 0.8rem;
        margin-bottom: 6px;
        font-weight: 400;
    }

    .dark .form-label {
        color: #a5bdd9;
    }

    .reset-form-input {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        background: #ffffff;
        font-size: 0.9rem;
        color: #1a1f2b;
        font-family: inherit;
        box-sizing: border-box;
    }

    .dark .reset-form-input {
        background: #1e293b;
        border-color: #363c4e;
        color: #ffffff;
    }

    .reset-form-input:focus {
        outline: none;
        border-color: #04b3e1;
    }

    .reset-submit-btn {
        display: block;
        width: 100%;
        padding: 14px 24px;
        border: none;
        border-radius: 8px;
        background: #04b3e1;
        color: white;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
        font-family: inherit;
        margin-top: 24px;
    }

    .reset-submit-btn:hover {
        background: #039bc2;
    }

    .loading-spinner {
        display: inline-block;
        width: 18px;
        height: 18px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    @media (max-width: 600px) {
        .reset-box {
            padding: 24px;
        }
        .reset-main {
            padding: 40px 16px;
        }
    }
</style>

<main class="reset-main">
    <div class="reset-container">
        <h1 class="reset-title">Reset Password</h1>

        <div class="reset-box">
            <p class="reset-description">
                Enter your email address and create a new password.
            </p>

            <form id="resetPasswordForm">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="reset-form-input" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <input type="password" name="password" class="reset-form-input" placeholder="Enter new password (min 8 characters)" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="reset-form-input" placeholder="Confirm your new password" required>
                </div>

                <button type="submit" class="reset-submit-btn" id="submitButton">
                    <span id="buttonText">Reset Password</span>
                    <span id="loadingSpinner" class="loading-spinner" style="display: none;"></span>
                </button>
            </form>
        </div>
    </div>
</main>

@include('home.footer')

<script>
    $(document).ready(function () {
        $('#resetPasswordForm').on('submit', function (e) {
            e.preventDefault();
            $('#buttonText').hide();
            $('#loadingSpinner').show();
            $('#submitButton').prop('disabled', true);

            $.ajax({
                url: '{{ route("password.update") }}',
                method: 'POST',
                data: $(this).serialize(),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#buttonText').show();
                    $('#loadingSpinner').hide();
                    $('#submitButton').prop('disabled', false);
                    if (response.success) {
                        toastr.success(response.message);
                        window.location.href = response.redirect;
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr) {
                    $('#buttonText').show();
                    $('#loadingSpinner').hide();
                    $('#submitButton').prop('disabled', false);
                    toastr.error(xhr.responseJSON.message || 'An error occurred. Please try again.');
                }
            });
        });
    });
</script>