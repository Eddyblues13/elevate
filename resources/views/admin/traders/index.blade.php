@include('admin.header')

<div class="main-content">
    <div class="container-fluid">

        {{-- Toast Alerts --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h4 class="admin-page-title mb-1">Expert Traders</h4>
                <p class="admin-page-subtitle mb-0">Manage copy trading experts and their profiles</p>
            </div>
            <button class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#addTraderModal">
                <i class="bi bi-plus-circle me-1"></i> Add New Trader
            </button>
        </div>

        {{-- Stats Row --}}
        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-lg-3">
                <div class="admin-stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background:rgba(99,102,241,.12);color:#6366f1;">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div>
                            <div class="stat-label">Total Traders</div>
                            <div class="stat-value">{{ $traders->total() }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="admin-stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background:rgba(16,185,129,.12);color:#10b981;">
                            <i class="bi bi-patch-check-fill"></i>
                        </div>
                        <div>
                            <div class="stat-label">Verified</div>
                            <div class="stat-value">{{ $verifiedCount }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="admin-stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background:rgba(245,158,11,.12);color:#f59e0b;">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <div>
                            <div class="stat-label">Avg Return Rate</div>
                            <div class="stat-value">{{ number_format($avgReturnRate, 1) }}%</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="admin-stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background:rgba(239,68,68,.12);color:#ef4444;">
                            <i class="bi bi-heart-fill"></i>
                        </div>
                        <div>
                            <div class="stat-label">Total Followers</div>
                            <div class="stat-value">{{ number_format($totalFollowers) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Search / Filter bar --}}
        <div class="admin-card mb-4 p-3">
            <div class="row g-2 align-items-center">
                <div class="col-md-6">
                    <div class="position-relative">
                        <i class="bi bi-search position-absolute"
                            style="left:14px;top:50%;transform:translateY(-50%);color:var(--text-color);opacity:.5;"></i>
                        <input type="text" id="traderSearch" class="admin-form-control"
                            placeholder="Search traders by name…" style="padding-left:40px;">
                    </div>
                </div>
                <div class="col-md-3">
                    <select id="verifiedFilter" class="admin-form-control">
                        <option value="all">All Status</option>
                        <option value="verified">Verified Only</option>
                        <option value="unverified">Unverified Only</option>
                    </select>
                </div>
                <div class="col-md-3 text-end">
                    <span style="color:var(--text-color);font-size:13px;" id="traderCount">Showing {{ $traders->count()
                        }} of {{ $traders->total() }} traders</span>
                </div>
            </div>
        </div>

        {{-- Trader Cards Grid --}}
        <div class="row g-4" id="traderGrid">
            @forelse($traders as $trader)
            <div class="col-xl-3 col-lg-4 col-md-6 trader-card-col" data-name="{{ strtolower($trader->name) }}"
                data-verified="{{ $trader->is_verified ? 'verified' : 'unverified' }}">
                <div class="trader-profile-card">
                    {{-- Card Header with gradient --}}
                    <div class="trader-card-header">
                        <div class="trader-card-actions">
                            <div class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown" style="color:#fff;opacity:.8;">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end"
                                    style="background:var(--card-bg);border:1px solid var(--border-color);">
                                    <li>
                                        <a class="dropdown-item edit-trader-btn" href="#" data-id="{{ $trader->id }}"
                                            data-name="{{ $trader->name }}" data-followers="{{ $trader->followers }}"
                                            data-return_rate="{{ $trader->return_rate }}"
                                            data-min_amount="{{ $trader->min_amount }}"
                                            data-max_amount="{{ $trader->max_amount }}"
                                            data-profit_share="{{ $trader->profit_share }}"
                                            data-is_verified="{{ $trader->is_verified }}"
                                            data-picture_url="{{ $trader->picture_url }}"
                                            style="color:var(--text-color);">
                                            <i class="bi bi-pencil-square me-2 text-primary"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider" style="border-color:var(--border-color);">
                                    </li>
                                    <li>
                                        <form action="{{ route('traders.destroy', $trader->id) }}" method="POST"
                                            class="delete-trader-form">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-trash3 me-2"></i> Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="trader-avatar-wrap">
                            <img src="{{ $trader->picture_url }}" alt="{{ $trader->name }}" class="trader-avatar"
                                onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($trader->name) }}&background=6366f1&color=fff&size=120'">
                            @if($trader->is_verified)
                            <span class="trader-verified-badge" title="Verified Trader">
                                <i class="bi bi-patch-check-fill"></i>
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="trader-card-body">
                        <h6 class="trader-name">{{ $trader->name }}</h6>
                        <span class="trader-role">Expert Trader</span>

                        <div class="trader-stats-grid">
                            <div class="trader-stat-item">
                                <span class="trader-stat-value text-success">{{ number_format($trader->return_rate, 1)
                                    }}%</span>
                                <span class="trader-stat-label">Return Rate</span>
                            </div>
                            <div class="trader-stat-item">
                                <span class="trader-stat-value">{{ number_format($trader->followers) }}</span>
                                <span class="trader-stat-label">Followers</span>
                            </div>
                            <div class="trader-stat-item">
                                <span class="trader-stat-value text-warning">{{ number_format($trader->profit_share, 0)
                                    }}%</span>
                                <span class="trader-stat-label">Profit Share</span>
                            </div>
                        </div>

                        <div class="trader-range">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="trader-range-label">Investment Range</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="trader-range-value">${{ number_format($trader->min_amount, 0) }}</span>
                                <i class="bi bi-arrow-right" style="color:var(--text-color);opacity:.4;"></i>
                                <span class="trader-range-value">${{ number_format($trader->max_amount, 0) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12" id="emptyState">
                <div class="admin-card text-center py-5">
                    <div class="mb-3" style="font-size:48px;opacity:.2;color:var(--text-color);">
                        <i class="bi bi-people"></i>
                    </div>
                    <h5 style="color:var(--heading-color);">No Traders Found</h5>
                    <p style="color:var(--text-color);max-width:400px;margin:0 auto;">Click the button above to add your
                        first expert trader to the platform.</p>
                    <button class="btn btn-admin-primary mt-3" data-bs-toggle="modal" data-bs-target="#addTraderModal">
                        <i class="bi bi-plus-circle me-1"></i> Add Trader
                    </button>
                </div>
            </div>
            @endforelse
        </div>

        @if($traders->hasPages())
        <div class="mt-4 d-flex justify-content-center">{{ $traders->links() }}</div>
        @endif
    </div>
</div>

{{-- Add Trader Modal --}}
<div class="modal fade" id="addTraderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content admin-modal">
            <div class="modal-header" style="border-color:var(--border-color);">
                <div>
                    <h5 class="modal-title" style="color:var(--heading-color);font-weight:600;">Add New Trader</h5>
                    <small style="color:var(--text-color);">Fill in the details to add a new expert trader</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addTraderForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12 text-center mb-2">
                            <div class="trader-upload-preview" id="addPreviewWrap">
                                <img id="addPreviewImg"
                                    src="https://ui-avatars.com/api/?name=New+Trader&background=6366f1&color=fff&size=120"
                                    class="trader-upload-img">
                                <label for="addPictureInput" class="trader-upload-overlay">
                                    <i class="bi bi-camera-fill"></i>
                                </label>
                            </div>
                            <input type="file" id="addPictureInput" name="picture" accept="image/*" class="d-none"
                                required>
                            <div class="mt-1"><small style="color:var(--text-color);">Click to upload photo</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="color:var(--heading-color);font-weight:500;">Trader Name
                                <span class="text-danger">*</span></label>
                            <input class="admin-form-control" placeholder="e.g. John Smith" type="text" name="name"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"
                                style="color:var(--heading-color);font-weight:500;">Followers</label>
                            <input class="admin-form-control" placeholder="0" type="number" name="followers" value="0"
                                min="0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="color:var(--heading-color);font-weight:500;">Return Rate
                                (%) <span class="text-danger">*</span></label>
                            <input class="admin-form-control" placeholder="e.g. 15.5" type="number" step="any"
                                name="return_rate" value="0" min="0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="color:var(--heading-color);font-weight:500;">Profit Share
                                (%) <span class="text-danger">*</span></label>
                            <input class="admin-form-control" placeholder="e.g. 20" type="number" step="any"
                                name="profit_share" value="0" min="0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="color:var(--heading-color);font-weight:500;">Minimum Amount
                                ($) <span class="text-danger">*</span></label>
                            <input class="admin-form-control" placeholder="e.g. 100" type="number" step="any"
                                name="min_amount" min="0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="color:var(--heading-color);font-weight:500;">Maximum Amount
                                ($) <span class="text-danger">*</span></label>
                            <input class="admin-form-control" placeholder="e.g. 50000" type="number" step="any"
                                name="max_amount" min="0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="color:var(--heading-color);font-weight:500;">Verification
                                Status</label>
                            <select class="admin-form-control" name="is_verified">
                                <option value="1">Verified</option>
                                <option value="0" selected>Not Verified</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-color:var(--border-color);">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary" id="addTraderBtn">
                        <i class="bi bi-plus-circle me-1"></i> Add Trader
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Trader Modal --}}
<div class="modal fade" id="editTraderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content admin-modal">
            <div class="modal-header" style="border-color:var(--border-color);">
                <div>
                    <h5 class="modal-title" style="color:var(--heading-color);font-weight:600;">Edit Trader</h5>
                    <small style="color:var(--text-color);">Update the trader's profile information</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editTraderForm" enctype="multipart/form-data">
                @csrf @method('PUT')
                <input type="hidden" id="editTraderId" name="trader_id">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12 text-center mb-2">
                            <div class="trader-upload-preview" id="editPreviewWrap">
                                <img id="editPreviewImg" src="" class="trader-upload-img">
                                <label for="editPictureInput" class="trader-upload-overlay">
                                    <i class="bi bi-camera-fill"></i>
                                </label>
                            </div>
                            <input type="file" id="editPictureInput" name="picture" accept="image/*" class="d-none">
                            <div class="mt-1"><small style="color:var(--text-color);">Click to change photo</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="color:var(--heading-color);font-weight:500;">Trader Name
                                <span class="text-danger">*</span></label>
                            <input class="admin-form-control" type="text" name="name" id="editName" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"
                                style="color:var(--heading-color);font-weight:500;">Followers</label>
                            <input class="admin-form-control" type="number" name="followers" id="editFollowers" min="0"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="color:var(--heading-color);font-weight:500;">Return Rate
                                (%)</label>
                            <input class="admin-form-control" type="number" step="any" name="return_rate"
                                id="editReturnRate" min="0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="color:var(--heading-color);font-weight:500;">Profit Share
                                (%)</label>
                            <input class="admin-form-control" type="number" step="any" name="profit_share"
                                id="editProfitShare" min="0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="color:var(--heading-color);font-weight:500;">Minimum Amount
                                ($)</label>
                            <input class="admin-form-control" type="number" step="any" name="min_amount"
                                id="editMinAmount" min="0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="color:var(--heading-color);font-weight:500;">Maximum Amount
                                ($)</label>
                            <input class="admin-form-control" type="number" step="any" name="max_amount"
                                id="editMaxAmount" min="0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="color:var(--heading-color);font-weight:500;">Verification
                                Status</label>
                            <select class="admin-form-control" name="is_verified" id="editIsVerified">
                                <option value="1">Verified</option>
                                <option value="0">Not Verified</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-color:var(--border-color);">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary" id="editTraderBtn">
                        <i class="bi bi-check-circle me-1"></i> Update Trader
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .admin-modal {
        background: var(--card-bg);
        color: var(--text-color);
        border: 1px solid var(--border-color);
        border-radius: 16px;
    }

    /* Trader Profile Card */
    .trader-profile-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        overflow: visible;
        transition: all .3s ease;
    }

    .trader-profile-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(99, 102, 241, .12);
        border-color: rgba(99, 102, 241, .3);
    }

    .trader-card-header {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a78bfa 100%);
        padding: 24px 20px 40px;
        position: relative;
        text-align: center;
        border-radius: 16px 16px 0 0;
    }

    .trader-card-actions {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 2;
    }

    .trader-card-actions .dropdown-menu {
        min-width: 140px;
    }

    .trader-card-actions .dropdown-item:hover {
        background: var(--input-bg) !important;
    }

    .trader-avatar-wrap {
        position: relative;
        display: inline-block;
        margin-bottom: -50px;
    }

    .trader-avatar {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        border: 4px solid var(--card-bg);
        object-fit: cover;
        box-shadow: 0 4px 15px rgba(0, 0, 0, .15);
    }

    .trader-verified-badge {
        position: absolute;
        bottom: 2px;
        right: -2px;
        background: var(--card-bg);
        border-radius: 50%;
        width: 26px;
        height: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #6366f1;
    }

    .trader-card-body {
        padding: 56px 20px 20px;
        text-align: center;
    }

    .trader-name {
        color: var(--heading-color);
        font-weight: 700;
        font-size: 16px;
        margin-bottom: 2px;
    }

    .trader-role {
        color: var(--text-color);
        font-size: 12px;
        opacity: .7;
    }

    .trader-stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
        margin: 18px 0 14px;
        padding: 14px 0;
        border-top: 1px solid var(--border-color);
        border-bottom: 1px solid var(--border-color);
    }

    .trader-stat-item {
        text-align: center;
    }

    .trader-stat-value {
        display: block;
        font-weight: 700;
        font-size: 15px;
        color: var(--heading-color);
    }

    .trader-stat-label {
        display: block;
        font-size: 11px;
        color: var(--text-color);
        opacity: .6;
        margin-top: 2px;
    }

    .trader-range {
        background: var(--input-bg);
        border-radius: 10px;
        padding: 10px 14px;
    }

    .trader-range-label {
        font-size: 11px;
        color: var(--text-color);
        opacity: .6;
        text-transform: uppercase;
        letter-spacing: .5px;
        font-weight: 600;
    }

    .trader-range-value {
        font-weight: 700;
        font-size: 14px;
        color: var(--heading-color);
    }

    /* Upload Preview */
    .trader-upload-preview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        position: relative;
        display: inline-block;
        overflow: hidden;
        cursor: pointer;
        border: 3px solid var(--border-color);
    }

    .trader-upload-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .trader-upload-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .45);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 22px;
        opacity: 0;
        transition: opacity .2s;
        cursor: pointer;
    }

    .trader-upload-preview:hover .trader-upload-overlay {
        opacity: 1;
    }
</style>

@include('admin.footer')

<script>
    document.addEventListener('DOMContentLoaded', function() {

    // === Image Preview ===
    function setupImagePreview(inputId, previewId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        if (!input || !preview) return;
        input.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = e => preview.src = e.target.result;
                reader.readAsDataURL(this.files[0]);
            }
        });
        preview.closest('.trader-upload-preview').addEventListener('click', () => input.click());
    }
    setupImagePreview('addPictureInput', 'addPreviewImg');
    setupImagePreview('editPictureInput', 'editPreviewImg');

    // === Search & Filter ===
    const searchInput = document.getElementById('traderSearch');
    const filterSelect = document.getElementById('verifiedFilter');
    const countEl = document.getElementById('traderCount');

    function filterCards() {
        const query = searchInput.value.toLowerCase();
        const status = filterSelect.value;
        const cards = document.querySelectorAll('.trader-card-col');
        let shown = 0;
        cards.forEach(card => {
            const name = card.dataset.name;
            const verified = card.dataset.verified;
            const matchSearch = !query || name.includes(query);
            const matchStatus = status === 'all' || verified === status;
            card.style.display = (matchSearch && matchStatus) ? '' : 'none';
            if (matchSearch && matchStatus) shown++;
        });
        if (countEl) countEl.textContent = `Showing ${shown} trader${shown !== 1 ? 's' : ''}`;
    }

    if (searchInput) searchInput.addEventListener('input', filterCards);
    if (filterSelect) filterSelect.addEventListener('change', filterCards);

    // === Add Trader (AJAX) ===
    const addForm = document.getElementById('addTraderForm');
    if (addForm) {
        addForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('addTraderBtn');
            const orig = btn.innerHTML;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Adding…';
            btn.disabled = true;

            fetch("{{ route('traders.store') }}", {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(async r => { const j = await r.json(); if (!r.ok) throw j; return j; })
            .then(data => {
                toastr.success(data.message || 'Trader added!');
                setTimeout(() => location.reload(), 1200);
            })
            .catch(err => {
                if (err.errors) {
                    Object.values(err.errors).forEach(msgs => msgs.forEach(m => toastr.error(m)));
                } else {
                    toastr.error(err.message || 'Error adding trader');
                }
                btn.innerHTML = orig;
                btn.disabled = false;
            });
        });
    }

    // === Edit Trader (populate modal) ===
    document.querySelectorAll('.edit-trader-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('editTraderId').value = this.dataset.id;
            document.getElementById('editName').value = this.dataset.name;
            document.getElementById('editFollowers').value = this.dataset.followers;
            document.getElementById('editReturnRate').value = this.dataset.return_rate;
            document.getElementById('editMinAmount').value = this.dataset.min_amount;
            document.getElementById('editMaxAmount').value = this.dataset.max_amount;
            document.getElementById('editProfitShare').value = this.dataset.profit_share;
            document.getElementById('editIsVerified').value = this.dataset.is_verified;
            document.getElementById('editPreviewImg').src = this.dataset.picture_url ||
                'https://ui-avatars.com/api/?name=' + encodeURIComponent(this.dataset.name) + '&background=6366f1&color=fff&size=120';
            new bootstrap.Modal(document.getElementById('editTraderModal')).show();
        });
    });

    // === Edit Trader (AJAX submit) ===
    const editForm = document.getElementById('editTraderForm');
    if (editForm) {
        editForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const traderId = document.getElementById('editTraderId').value;
            const btn = document.getElementById('editTraderBtn');
            const orig = btn.innerHTML;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Updating…';
            btn.disabled = true;

            const formData = new FormData(this);
            fetch(`/admin/traders/${traderId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-HTTP-Method-Override': 'PUT'
                }
            })
            .then(async r => { const j = await r.json(); if (!r.ok) throw j; return j; })
            .then(data => {
                toastr.success(data.message || 'Trader updated!');
                setTimeout(() => location.reload(), 1200);
            })
            .catch(err => {
                if (err.errors) {
                    Object.values(err.errors).forEach(msgs => msgs.forEach(m => toastr.error(m)));
                } else {
                    toastr.error(err.message || 'Error updating trader');
                }
                btn.innerHTML = orig;
                btn.disabled = false;
            });
        });
    }

    // === Delete Trader ===
    document.querySelectorAll('.delete-trader-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this trader? This cannot be undone.')) return;
            const formData = new FormData(this);
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(async r => {
                if (r.redirected) { location.href = r.url; return; }
                const j = await r.json();
                return j;
            })
            .then(data => {
                if (data) {
                    toastr.success(data.message || 'Trader deleted!');
                    const col = form.closest('.trader-card-col');
                    if (col) {
                        col.style.transition = 'opacity .3s';
                        col.style.opacity = '0';
                        setTimeout(() => col.remove(), 300);
                    }
                }
            })
            .catch(() => toastr.error('Error deleting trader'));
        });
    });
});
</script>