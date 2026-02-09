@section('title', 'Sign Up - RegentMarkets')
@include('home.header')

<style>
    .register-main {
        background-color: #E6F3FD;
        min-height: calc(100vh - 200px);
        padding: 40px 20px;
    }

    .dark .register-main {
        background-color: #0b1118;
    }

    .register-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .register-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1a1f2b;
        margin-bottom: 24px;
        text-align: left;
    }

    .dark .register-title {
        color: #ffffff;
    }

    /* White content box like About page */
    .register-box {
        background: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }

    .dark .register-box {
        background: #0b1118;
        border-color: #363c4e;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px 24px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-label {
        color: #6b7280;
        font-size: 0.8rem;
        margin-bottom: 6px;
        font-weight: 400;
    }

    .dark .form-label {
        color: #a5bdd9;
    }

    .register-form-input,
    .register-form-select {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        background: #ffffff;
        font-size: 0.9rem;
        color: #1a1f2b;
        font-family: inherit;
    }

    .dark .register-form-input,
    .dark .register-form-select {
        background: #1e293b;
        border-color: #363c4e;
        color: #ffffff;
    }

    .register-form-input:focus,
    .register-form-select:focus {
        outline: none;
        border-color: #04b3e1;
    }

    .register-form-select {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 12px center;
        background-repeat: no-repeat;
        background-size: 16px 12px;
    }

    /* Terms checkbox section */
    .terms-section {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 28px 0 24px;
    }

    .register-checkbox {
        width: 18px;
        height: 18px;
        accent-color: #04b3e1;
        flex-shrink: 0;
    }

    .terms-text {
        font-size: 0.85rem;
        color: #04b3e1;
        font-weight: 500;
    }

    .terms-link {
        color: #04b3e1;
        text-decoration: none;
        font-weight: 600;
    }

    .terms-link:hover {
        text-decoration: underline;
    }

    /* Submit button */
    .register-submit-btn {
        display: block;
        width: 100%;
        max-width: 300px;
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
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .register-submit-btn:hover {
        background: #039bc2;
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

    .honeypot-field {
        position: absolute;
        left: -9999px;
    }

    @media (max-width: 900px) {
        .form-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .register-box {
            padding: 24px;
        }
    }

    @media (max-width: 600px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        .terms-section {
            flex-direction: column;
            align-items: flex-start;
        }
        .register-submit-btn {
            max-width: 100%;
        }
        .register-main {
            padding: 20px 16px;
        }
    }
</style>

<main class="register-main">
    <div class="register-container">
        <h1 class="register-title">Create An Account</h1>

        <div class="register-box">
            <form id="registerForm">
                @csrf

                <!-- Hidden spam protection fields -->
                <input type="hidden" name="js_enabled" id="js_enabled" value="0">
                <input type="hidden" name="form_token" value="{{ $formToken }}">
                <input type="hidden" name="timestamp" id="timestamp" value="{{ now()->timestamp }}">
                <input type="hidden" name="time_check" id="time_check" value="0">
                <input type="hidden" name="referral_code" value="{{ $referral_code ?? '' }}">

                <div class="honeypot-field">
                    <input type="text" name="website" id="website">
                </div>

                <script>
                    document.getElementById('js_enabled').value = 1;
                    setTimeout(function() { document.getElementById('time_check').value = 1; }, 5000);
                </script>

                <div class="form-grid">
                    <!-- Row 1 -->
                    <div class="form-group">
                        <label class="form-label">Currency</label>
                        <select name="currency" class="register-form-select" required>
                            <option value="USD" {{ old('currency')=='USD' ? 'selected' : '' }}>USD</option>
                            <option value="EUR" {{ old('currency')=='EUR' ? 'selected' : '' }}>EUR</option>
                            <option value="GBP" {{ old('currency')=='GBP' ? 'selected' : '' }}>GBP</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="register-form-input" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="register-form-input" required>
                    </div>

                    <!-- Row 2 -->
                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="register-form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="register-form-input" value="{{ old('first_name') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="register-form-input" value="{{ old('last_name') }}" required>
                    </div>

                    <!-- Row 3 -->
                    <div class="form-group">
                        <label class="form-label">Mobile Number</label>
                        <input type="tel" name="phone_number" class="register-form-input" value="{{ old('phone_number') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date Of Birth</label>
                        <input type="date" name="date_of_birth" class="register-form-input" value="{{ old('date_of_birth') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">State</label>
                        <input type="text" name="state" class="register-form-input" value="{{ old('state') }}" required>
                    </div>

                    <!-- Row 4 -->
                    <div class="form-group">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="register-form-input" value="{{ old('city') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="register-form-input" value="{{ old('address') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Country</label>
                        <select name="country" class="register-form-select" required>
                            @php
                            $countries = ["Afghanistan", "Albania", "Algeria", "Argentina", "Australia", "Austria", "Bangladesh", "Belgium", "Brazil", "Canada", "Chile", "China", "Colombia", "Czech Republic", "Denmark", "Egypt", "Finland", "France", "Germany", "Ghana", "Greece", "Hungary", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Japan", "Jordan", "Kenya", "Kuwait", "Malaysia", "Mexico", "Morocco", "Netherlands", "New Zealand", "Nigeria", "Norway", "Pakistan", "Peru", "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia", "Saudi Arabia", "Singapore", "South Africa", "South Korea", "Spain", "Sweden", "Switzerland", "Taiwan", "Thailand", "Turkey", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Venezuela", "Vietnam", "Zimbabwe"];
                            $selectedCountry = old('country', 'United States');
                            @endphp
                            @foreach($countries as $country)
                            <option value="{{ $country }}" {{ $selectedCountry==$country ? 'selected' : '' }}>{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Terms checkbox -->
                <div class="terms-section">
                    <input type="checkbox" name="terms" class="register-checkbox" {{ old('terms') ? 'checked' : '' }} required>
                    <span class="terms-text">
                        I Declare That The Information Provided Is Correct And Accept All <a href="/terms-of-service" class="terms-link">Terms Of Service</a>
                    </span>
                </div>

                <!-- Submit button -->
                <button type="submit" id="submitButton" class="register-submit-btn">
                    <span id="buttonText">CREATE MY ACCOUNT</span>
                    <span id="loadingSpinner" class="loading-spinner" style="display: none;"></span>
                </button>
            </form>
        </div>
    </div>
</main>

@include('home.footer')

<script>
    $(document).ready(function () {
        $('#registerForm').on('submit', function (e) {
            e.preventDefault();
            $('#buttonText').hide();
            $('#loadingSpinner').show();
            $('#submitButton').prop('disabled', true);

            $.ajax({
                url: '{{ route("register") }}',
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