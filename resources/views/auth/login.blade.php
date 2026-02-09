@section('title', 'Sign In - RegentMarkets')
@include('home.header')

<style>
    .login-main {
        background-color: #E6F3FD;
        min-height: calc(100vh - 200px);
        padding: 60px 20px;
    }

    .dark .login-main {
        background-color: #0b1118;
    }

    .login-container {
        max-width: 500px;
        margin: 0 auto;
    }

    .login-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1a1f2b;
        margin-bottom: 24px;
        text-align: left;
    }

    .dark .login-title {
        color: #ffffff;
    }

    /* White content box like About page */
    .login-box {
        background: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }

    .dark .login-box {
        background: #0b1118;
        border-color: #363c4e;
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

    .login-form-input {
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

    .dark .login-form-input {
        background: #1e293b;
        border-color: #363c4e;
        color: #ffffff;
    }

    .login-form-input:focus {
        outline: none;
        border-color: #04b3e1;
    }

    /* Submit button */
    .login-submit-btn {
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
        margin-bottom: 20px;
    }

    .login-submit-btn:hover {
        background: #039bc2;
    }

    .forgot-password {
        display: block;
        text-align: center;
        color: #04b3e1;
        text-decoration: none;
        margin-bottom: 16px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .forgot-password:hover {
        text-decoration: underline;
    }

    .signup-prompt {
        text-align: center;
        color: #6b7280;
        font-size: 0.85rem;
    }

    .dark .signup-prompt {
        color: #a5bdd9;
    }

    .signup-link {
        color: #04b3e1;
        text-decoration: none;
        font-weight: 500;
        margin-left: 4px;
    }

    .signup-link:hover {
        text-decoration: underline;
    }

    /* Loading spinner */
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
        .login-box {
            padding: 24px;
        }
        .login-main {
            padding: 40px 16px;
        }
    }
</style>

<main class="login-main">
    <div class="login-container">
        <h1 class="login-title">Sign In</h1>

        <div class="login-box">
            <form id="loginForm">
                @csrf

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="login-form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="login-form-input" required>
                </div>

                <button type="submit" class="login-submit-btn" id="submitButton">
                    <span id="buttonText">Sign In</span>
                    <span id="loadingSpinner" class="loading-spinner" style="display: none;"></span>
                </button>

                <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a>

                <div class="signup-prompt">
                    Don't have an account?<a href="{{ route('register') }}" class="signup-link">Sign Up</a>
                </div>
            </form>
        </div>
    </div>
</main>

@include('home.footer')

<script>
    $(document).ready(function () {
        $('#loginForm').on('submit', function (e) {
            e.preventDefault();
            $('#buttonText').hide();
            $('#loadingSpinner').show();
            $('#submitButton').prop('disabled', true);

            $.ajax({
                url: '{{ route("login") }}',
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