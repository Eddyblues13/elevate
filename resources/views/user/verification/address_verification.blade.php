@section('title', 'Address Verification - RegentMarkets')
@include('home.header')

<style>
    .verify-main {
        background-color: #E6F3FD;
        min-height: calc(100vh - 200px);
        padding: 40px 20px;
    }

    .dark .verify-main {
        background-color: #0b1118;
    }

    .verify-container {
        max-width: 600px;
        margin: 0 auto;
    }

    .verify-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1a1f2b;
        margin-bottom: 12px;
        text-align: center;
    }

    .dark .verify-title {
        color: #ffffff;
    }

    .verify-subtitle {
        font-size: 0.9rem;
        color: #6b7280;
        text-align: center;
        margin-bottom: 30px;
    }

    .dark .verify-subtitle {
        color: #a5bdd9;
    }

    .verify-box {
        background: #ffffff;
        padding: 32px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
        margin-bottom: 24px;
    }

    .dark .verify-box {
        background: #0b1118;
        border-color: #363c4e;
    }

    .file-upload-wrapper {
        display: flex;
        gap: 12px;
        align-items: center;
        margin-bottom: 20px;
    }

    .file-select-btn {
        padding: 12px 20px;
        border: 1px solid #04b3e1;
        border-radius: 8px;
        background: transparent;
        color: #04b3e1;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.3s;
    }

    .file-select-btn:hover {
        background: rgba(4, 179, 225, 0.1);
    }

    .file-select-btn.selected {
        background: #10b981;
        border-color: #10b981;
        color: white;
    }

    .file-name-display {
        flex: 1;
        padding: 12px 14px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        background: #f9fafb;
        font-size: 0.85rem;
        color: #6b7280;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .dark .file-name-display {
        background: #1e293b;
        border-color: #363c4e;
        color: #a5bdd9;
    }

    .verify-btn {
        display: block;
        width: 100%;
        padding: 14px 20px;
        border: none;
        border-radius: 8px;
        background: #04b3e1;
        color: white;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
        font-family: inherit;
        margin-bottom: 12px;
    }

    .verify-btn:hover {
        background: #039bc2;
    }

    .skip-btn {
        display: block;
        width: 100%;
        padding: 14px 20px;
        border: 1px solid #04b3e1;
        border-radius: 8px;
        background: transparent;
        color: #04b3e1;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        font-family: inherit;
        margin-bottom: 12px;
    }

    .skip-btn:hover {
        background: rgba(4, 179, 225, 0.1);
    }

    .logout-btn {
        display: block;
        width: 50%;
        margin: 20px auto 0;
        padding: 10px 20px;
        border: 1px solid #04b3e1;
        border-radius: 8px;
        background: transparent;
        color: #04b3e1;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
    }

    .logout-btn:hover {
        background: rgba(4, 179, 225, 0.1);
        color: #04b3e1;
    }

    /* Address Info Section */
    .address-info-box {
        background: #ffffff;
        padding: 24px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }

    .dark .address-info-box {
        background: #0b1118;
        border-color: #363c4e;
    }

    .address-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .address-field {
        display: flex;
        flex-direction: column;
    }

    .address-label {
        font-size: 0.75rem;
        color: #6b7280;
        margin-bottom: 4px;
    }

    .dark .address-label {
        color: #a5bdd9;
    }

    .address-value {
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        background: #f9fafb;
        font-size: 0.85rem;
        color: #1a1f2b;
    }

    .dark .address-value {
        background: #1e293b;
        border-color: #363c4e;
        color: #ffffff;
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
        .verify-box, .address-info-box {
            padding: 20px;
        }
        .verify-main {
            padding: 30px 16px;
        }
        .address-grid {
            grid-template-columns: 1fr;
        }
        .file-upload-wrapper {
            flex-direction: column;
            align-items: stretch;
        }
        .logout-btn {
            width: 70%;
        }
    }
</style>

<main class="verify-main">
    <div class="verify-container">
        <h1 class="verify-title">Address Verification</h1>
        <p class="verify-subtitle">Please upload your utility bill for address verification</p>

        <!-- Upload Form Box -->
        <div class="verify-box">
            <form id="addressVerificationForm" enctype="multipart/form-data">
                @csrf

                <div class="file-upload-wrapper">
                    <input type="file" id="utilityBillInput" name="utility_bill" accept="image/*,.pdf" style="display: none;">
                    <button type="button" id="billSelectBtn" class="file-select-btn" 
                            onclick="document.getElementById('utilityBillInput').click();">
                        Select Bill
                    </button>
                    <div id="billFileName" class="file-name-display">No file selected</div>
                </div>

                <button type="submit" class="verify-btn" id="submitBtn">
                    <span id="submitText">Submit</span>
                    <span id="spinner" class="loading-spinner" style="display: none;"></span>
                </button>

                <button type="button" class="skip-btn" id="skipBtn">SKIP</button>

                <a href="{{ route('logout') }}" class="logout-btn"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    LOGOUT
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </form>
        </div>

        <!-- Address Info Box -->
        <div class="address-info-box">
            <div class="address-grid">
                <div class="address-field">
                    <span class="address-label">Mobile Number (Optional)</span>
                    <div class="address-value">{{ Auth::user()->phone ?? '' }}</div>
                </div>
                <div class="address-field">
                    <span class="address-label">Street Address</span>
                    <div class="address-value">{{ Auth::user()->address ?? '' }}</div>
                </div>
                <div class="address-field">
                    <span class="address-label">Zip Code</span>
                    <div class="address-value">{{ Auth::user()->zip_code ?? '' }}</div>
                </div>
                <div class="address-field">
                    <span class="address-label">City</span>
                    <div class="address-value">{{ Auth::user()->city ?? '' }}</div>
                </div>
                <div class="address-field">
                    <span class="address-label">State</span>
                    <div class="address-value">{{ Auth::user()->state ?? '' }}</div>
                </div>
                <div class="address-field">
                    <span class="address-label">Country</span>
                    <div class="address-value">{{ Auth::user()->country ?? '' }}</div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('home.footer')

<script>
    // File input handling
    document.getElementById('utilityBillInput').addEventListener('change', function(e) {
        const fileName = e.target.files[0] ? e.target.files[0].name : 'No file selected';
        const billFileName = document.getElementById('billFileName');
        const billSelectBtn = document.getElementById('billSelectBtn');
        
        billFileName.textContent = fileName;
        
        if (e.target.files.length > 0) {
            billSelectBtn.classList.add('selected');
        } else {
            billSelectBtn.classList.remove('selected');
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
        
        submitText.textContent = 'Submitting...';
        spinner.style.display = 'inline-block';
        submitBtn.disabled = true;
        
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
                if (data.redirect) {
                    window.location.href = data.redirect;
                }
            } else {
                toastr.error(data.message || 'Error submitting address verification');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            toastr.error('An error occurred while submitting the form');
        })
        .finally(() => {
            submitText.textContent = 'Submit';
            spinner.style.display = 'none';
            submitBtn.disabled = false;
        });
    });

    // Skip button
    document.getElementById('skipBtn').addEventListener('click', function() {
        if (confirm('Are you sure you want to skip address verification?')) {
            window.location.href = "{{ route('home') }}";
        }
    });
</script>