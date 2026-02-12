@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show mb-3">{{ session('message') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3">{{ session('error') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3">{{ session('success') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h4 class="admin-page-title">{{ $user->name }}</h4>
                <p class="admin-page-subtitle">User Management</p>
            </div>
            <div class="d-flex gap-2">
                <a class="btn btn-sm btn-admin-primary" href="{{ route('manage.users.page') }}"><i
                        class="fa fa-arrow-left me-1"></i> Back</a>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                        data-bs-toggle="dropdown">Actions</button>
                    <ul class="dropdown-menu dropdown-menu-end"
                        style="background:var(--card-bg);border-color:var(--border-color);">
                        <li><a class="dropdown-item" style="color:var(--text-color);" href="">Login Activity</a></li>
                        <li><a class="dropdown-item" style="color:var(--text-color);" href="#" data-bs-toggle="modal"
                                data-bs-target="#holdingBalanceModal">Credit/Debit Holding Balance</a></li>
                        <li><a class="dropdown-item" style="color:var(--text-color);" href="#" data-bs-toggle="modal"
                                data-bs-target="#tradingBalanceModal">Credit/Debit Trading Balance</a></li>
                        <li><a class="dropdown-item" style="color:var(--text-color);" href="#" data-bs-toggle="modal"
                                data-bs-target="#stakingBalanceModal">Credit/Debit Staking Balance</a></li>
                        <li><a class="dropdown-item" style="color:var(--text-color);" href="#" data-bs-toggle="modal"
                                data-bs-target="#miningBalanceModal">Credit/Debit Mining Balance</a></li>
                        <li><a class="dropdown-item" style="color:var(--text-color);" href="#" data-bs-toggle="modal"
                                data-bs-target="#referralBalanceModal">Credit/Debit Referral Balance</a></li>
                        <li><a class="dropdown-item" style="color:var(--text-color);" href="#" data-bs-toggle="modal"
                                data-bs-target="#profitBalanceModal">Credit/Debit Profit</a></li>
                        <li>
                            <hr class="dropdown-divider" style="border-color:var(--border-color);">
                        </li>
                        <li><a class="dropdown-item" style="color:var(--text-color);"
                                href="{{ route('admin.users.deposits.index', ['user' => $user->id]) }}">Edit Deposit</a>
                        </li>
                        <li><a class="dropdown-item" style="color:var(--text-color);"
                                href="{{ route('admin.users.withdrawals.index', ['user' => $user->id]) }}">Edit
                                Withdrawal</a></li>
                        <li>
                            <hr class="dropdown-divider" style="border-color:var(--border-color);">
                        </li>
                        <li><a class="dropdown-item" style="color:var(--text-color);" href="#" data-bs-toggle="modal"
                                data-bs-target="#sendmailtooneuserModal">Send Email</a></li>
                        <li><a class="dropdown-item text-success" href="#" data-bs-toggle="modal"
                                data-bs-target="#switchuserModal">Gain Access</a></li>
                        <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal"
                                data-bs-target="#deleteModal">Delete {{ $user->name }}</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Balance Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-3 col-6">
                <div class="admin-stat-card">
                    <div class="admin-stat-label">Deposit Balance</div>
                    <div class="admin-stat-value">{{ config('currencies.' . $user->currency, '$') }}{{
                        number_format($trading_balance, 2, '.', ',') }}</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="admin-stat-card">
                    <div class="admin-stat-label">Holding Balance</div>
                    <div class="admin-stat-value">{{ config('currencies.' . $user->currency, '$') }}{{
                        number_format($holding_balance, 2, '.', ',') }}</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="admin-stat-card">
                    <div class="admin-stat-label">Trading Balance</div>
                    <div class="admin-stat-value">{{ config('currencies.' . $user->currency, '$') }}{{
                        number_format($trading_balance, 2, '.', ',') }}</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="admin-stat-card">
                    <div class="admin-stat-label">Mining Balance</div>
                    <div class="admin-stat-value">{{ config('currencies.' . $user->currency, '$') }}{{
                        number_format($mining_balance, 2, '.', ',') }}</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="admin-stat-card">
                    <div class="admin-stat-label">Referral Balance</div>
                    <div class="admin-stat-value">{{ config('currencies.' . $user->currency, '$') }}{{
                        number_format($referral_balance, 2, '.', ',') }}</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="admin-stat-card">
                    <div class="admin-stat-label">Profit</div>
                    <div class="admin-stat-value">{{ config('currencies.' . $user->currency, '$') }}{{
                        number_format($profit_balance, 2, '.', ',') }}</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="admin-stat-card">
                    <div class="admin-stat-label">Total Deposit</div>
                    <div class="admin-stat-value">{{ config('currencies.' . $user->currency, '$') }}{{
                        number_format($successful_deposits_sum, 2, '.', ',') }}</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="admin-stat-card">
                    <div class="admin-stat-label">Signal Strength</div>
                    <div class="admin-stat-value">{{ $user->signal_strength }}%</div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="admin-card mb-4">
            <h6 style="color:var(--heading-color);" class="mb-3">Quick Actions</h6>
            <div class="d-flex flex-wrap gap-2">
                <span class="admin-badge-success">Status: Active</span>
                <a class="btn btn-sm btn-admin-primary"
                    href="{{ route('admin.users.trading-histories.index', ['user' => $user->id]) }}">Add Trade</a>
                <a class="btn btn-sm btn-admin-primary"
                    href="{{ route('admin.users.edit', ['user' => $user->id]) }}">Edit User</a>
                <a class="btn btn-sm btn-admin-primary"
                    href="{{ route('admin.users.identity-verifications.index', ['user' => $user->id]) }}">ID
                    Verification</a>
                <a class="btn btn-sm btn-admin-primary"
                    href="{{ route('admin.users.address-verifications.index', ['user' => $user->id]) }}">Address
                    Verification</a>
            </div>
        </div>

        <!-- Toggle Settings -->
        <div class="admin-card mb-4">
            <h6 style="color:var(--heading-color);" class="mb-3">Toggle Settings</h6>
            <div class="row g-3">
                @php
                $toggles = [
                'top_up_mail' => 'Top Up Mail',
                'notification_status' => 'Notification Status',
                'network_status' => 'Network Status',
                'upgrade_status' => 'Upgrade Status',
                'confirmed_registration_fee' => 'Confirmed Registration Fee',
                'top_up_status' => 'Top Up Status',
                'subscription_status' => 'Subscription Status',
                ];
                @endphp
                @foreach($toggles as $field => $label)
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center gap-2">
                        <label class="admin-switch">
                            <input type="checkbox" id="{{ $field }}" {{ $user->$field ? 'checked' : '' }}
                            onchange="updateStatus('{{ $field }}', this.checked)">
                            <span class="admin-switch-slider"></span>
                        </label>
                        <div>
                            <small style="color:var(--text-color);">{{ $label }}</small><br>
                            <span id="{{ $field }}_status"
                                class="admin-badge-{{ $user->$field ? 'success' : 'danger' }}"
                                style="font-size:0.7rem;">
                                {{ $user->$field ? 'ON' : 'OFF' }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <style>
            .admin-switch {
                position: relative;
                display: inline-block;
                width: 44px;
                height: 24px;
            }

            .admin-switch input {
                opacity: 0;
                width: 0;
                height: 0;
            }

            .admin-switch-slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: var(--border-color);
                transition: .3s;
                border-radius: 24px;
            }

            .admin-switch-slider:before {
                position: absolute;
                content: "";
                height: 18px;
                width: 18px;
                left: 3px;
                bottom: 3px;
                background-color: white;
                transition: .3s;
                border-radius: 50%;
            }

            .admin-switch input:checked+.admin-switch-slider {
                background-color: var(--accent-color);
            }

            .admin-switch input:checked+.admin-switch-slider:before {
                transform: translateX(20px);
            }
        </style>

        <script>
            function updateStatus(field, value) {
            fetch("{{ route('admin.update.user.status') }}", {
                method: "POST",
                headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                body: JSON.stringify({ user_id: "{{ $user->id }}", field: field, value: value ? 1 : 0 })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const el = document.getElementById(`${field}_status`);
                    el.textContent = value ? 'ON' : 'OFF';
                    el.className = value ? 'admin-badge-success' : 'admin-badge-danger';
                    el.style.fontSize = '0.7rem';
                    toastr.success('Status updated successfully');
                } else {
                    toastr.error('Error updating status');
                    document.getElementById(field).checked = !value;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                toastr.error('Error updating status');
                document.getElementById(field).checked = !value;
            });
        }
        </script>

        <!-- User Information -->
        <div class="admin-card mb-4">
            <h6 style="color:var(--heading-color);" class="mb-3">User Information</h6>
            @php
            $fields = [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email Address',
            'phone_number' => 'Mobile Number',
            'currency' => 'Currency',
            'country' => 'Country',
            'city' => 'City',
            'profile_photo' => 'Profile Photo',
            'email_verification' => 'Email Verification',
            'id_verification' => 'ID Verification',
            'address_verification' => 'Address Verification',
            'user_status' => 'User Status',
            'signal_strength' => 'Signal Strength',
            'referral_code' => 'Referral Code',
            'referred_by' => 'Referred By',
            ];
            @endphp

            @foreach($fields as $key => $label)
            <div class="d-flex align-items-center py-2 px-3 border-bottom"
                style="border-color:var(--border-color) !important;">
                <div class="col-md-4">
                    <strong style="color:var(--heading-color);">{{ $label }}</strong>
                </div>
                <div class="col-md-8 d-flex align-items-center gap-2">
                    @if($key === 'profile_photo')
                    <span id="display-{{ $key }}">
                        <img src="{{ asset($user->$key) }}" alt="Profile Photo"
                            style="width:60px;height:60px;border-radius:50%;object-fit:cover;">
                    </span>
                    <input type="file" class="admin-form-control d-none" id="input-{{ $key }}" accept="image/*">
                    @elseif(in_array($key, ['email_verification', 'id_verification', 'address_verification']))
                    <span id="display-{{ $key }}" style="color:var(--text-color);">
                        {{ $user->$key == 1 ? 'Verified' : 'Not Verified' }}
                    </span>
                    <select class="admin-form-control d-none" id="input-{{ $key }}" style="width:auto;">
                        <option value="1" {{ $user->$key == 1 ? 'selected' : '' }}>Verified</option>
                        <option value="0" {{ $user->$key == 0 ? 'selected' : '' }}>Not Verified</option>
                    </select>
                    @else
                    <span id="display-{{ $key }}" style="color:var(--text-color);">{{ $user->$key }}</span>
                    <input type="text" class="admin-form-control d-none" id="input-{{ $key }}" value="{{ $user->$key }}"
                        style="width:auto;">
                    @endif
                    <button class="btn btn-sm btn-admin-primary edit-btn" data-field="{{ $key }}">Edit</button>
                    <button class="btn btn-sm btn-success save-btn d-none" data-field="{{ $key }}">Save</button>
                </div>
            </div>
            @endforeach

            <div class="d-flex align-items-center py-2 px-3 border-bottom"
                style="border-color:var(--border-color) !important;">
                <div class="col-md-4"><strong style="color:var(--heading-color);">Password</strong></div>
                <div class="col-md-8" style="color:var(--text-color);">{{ $plain }}</div>
            </div>
            <div class="d-flex align-items-center py-2 px-3">
                <div class="col-md-4"><strong style="color:var(--heading-color);">Registered</strong></div>
                <div class="col-md-8" style="color:var(--text-color);">{{
                    \Carbon\Carbon::parse($user->created_at)->format('D, M j, Y g:i A') }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Balance Modals -->
@php
$balanceModals = [
['id' => 'holdingBalanceModal', 'title' => 'Holding Balance', 'route' => 'update.holding.balance'],
['id' => 'tradingBalanceModal', 'title' => 'Trading Balance', 'route' => 'update.trading.balance'],
['id' => 'stakingBalanceModal', 'title' => 'Staking Balance', 'route' => 'update.staking.balance'],
['id' => 'miningBalanceModal', 'title' => 'Mining Balance', 'route' => 'update.mining.balance'],
['id' => 'referralBalanceModal', 'title' => 'Referral Balance', 'route' => 'update.referral.balance'],
['id' => 'profitBalanceModal', 'title' => 'Profit', 'route' => 'update.profit.balance'],
];
@endphp

@foreach($balanceModals as $modal)
<div id="{{ $modal['id'] }}" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"
            style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
            <div class="modal-header" style="border-color:var(--border-color);">
                <h5 class="modal-title" style="color:var(--heading-color);">Update {{ $user->first_name }}'s {{
                    $modal['title'] }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route($modal['route']) }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);">Amount</label>
                        <input class="admin-form-control" type="number" name="amount" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);">Type</label>
                        <select class="admin-form-control" name="type" required>
                            <option value="credit">Credit</option>
                            <option value="debit">Debit</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);">Description</label>
                        <textarea class="admin-form-control" name="description" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-admin-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Send Email Modal -->
<div id="sendmailtooneuserModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"
            style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
            <div class="modal-header" style="border-color:var(--border-color);">
                <h5 class="modal-title" style="color:var(--heading-color);">Send Email to {{ $user->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.send.mail') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $user->email }}">
                    <div class="mb-3">
                        <input type="text" name="subject" class="admin-form-control" placeholder="Subject" required>
                    </div>
                    <div class="mb-3">
                        <textarea placeholder="Type your message here" class="admin-form-control" name="message"
                            rows="6" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-admin-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Switch User Modal -->
<div id="switchuserModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"
            style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
            <div class="modal-header" style="border-color:var(--border-color);">
                <h5 class="modal-title" style="color:var(--heading-color);">Login as {{ $user->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p style="color:var(--text-color);">You are about to login as {{ $user->name }}.</p>
                <a class="btn btn-success" href="{{ route('users.impersonate', $user->id) }}">Proceed</a>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"
            style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
            <div class="modal-header" style="border-color:var(--border-color);">
                <h5 class="modal-title" style="color:var(--heading-color);">Delete User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p style="color:var(--text-color);">Are you sure you want to delete {{ $user->name }}? Everything
                    associated with this account will be lost.</p>
                <a class="btn btn-danger" href="{{ route('delete.user', $user->id) }}">Yes, I'm sure</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", function() {
            let field = this.dataset.field;
            document.getElementById(`display-${field}`).classList.add("d-none");
            document.getElementById(`input-${field}`).classList.remove("d-none");
            this.classList.add("d-none");
            document.querySelector(`.save-btn[data-field='${field}']`).classList.remove("d-none");
        });
    });

    document.querySelectorAll(".save-btn").forEach(button => {
        button.addEventListener("click", function() {
            let field = this.dataset.field;
            let newValue;

            if (field === 'profile_photo') {
                let fileInput = document.getElementById(`input-${field}`);
                let file = fileInput.files[0];
                if (!file) { toastr.error("Please select a photo to upload."); return; }
                let formData = new FormData();
                formData.append('photo', file);
                formData.append('user_id', "{{ $user->id }}");
                fetch("{{ route('admin.updateUser') }}", {
                    method: "POST",
                    headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`display-${field}`).innerHTML = `<img src="${data.new_value}" alt="Profile Photo" style="width:60px;height:60px;border-radius:50%;object-fit:cover;">`;
                        document.getElementById(`display-${field}`).classList.remove("d-none");
                        document.getElementById(`input-${field}`).classList.add("d-none");
                        button.classList.add("d-none");
                        document.querySelector(`.edit-btn[data-field='${field}']`).classList.remove("d-none");
                        toastr.success(data.message);
                        if (data.redirect) window.location.href = data.redirect;
                    } else { toastr.error(data.message || "Error updating profile photo."); }
                })
                .catch(error => { console.error("Error:", error); toastr.error("An error occurred."); });
            } else {
                newValue = document.getElementById(`input-${field}`).value;
                fetch("{{ route('admin.updateUser') }}", {
                    method: "POST",
                    headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                    body: JSON.stringify({ field: field, value: newValue, user_id: "{{ $user->id }}" })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`display-${field}`).textContent = newValue;
                        document.getElementById(`display-${field}`).classList.remove("d-none");
                        document.getElementById(`input-${field}`).classList.add("d-none");
                        button.classList.add("d-none");
                        document.querySelector(`.edit-btn[data-field='${field}']`).classList.remove("d-none");
                        toastr.success("Updated successfully!");
                    } else { toastr.error("Error updating data."); }
                })
                .catch(error => { console.error("Error:", error); toastr.error("An error occurred."); });
            }
        });
    });
});
</script>

@include('admin.footer')