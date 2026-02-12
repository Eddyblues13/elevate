@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Add Trader</h4>
                <p class="admin-page-subtitle">Add a new expert trader</p>
            </div>
            <a href="{{ route('traders.index') }}" class="btn btn-sm btn-outline-secondary"><i
                    class="fas fa-arrow-left me-1"></i> Back</a>
        </div>

        <div class="admin-card">
            <form id="addTraderForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Trader Name</label>
                        <input class="admin-form-control" placeholder="Enter trader name" type="text" name="name"
                            value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Followers</label>
                        <input class="admin-form-control" placeholder="Enter number of followers" type="number"
                            name="followers" value="{{ old('followers', 0) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Return Rate (%)</label>
                        <input class="admin-form-control" placeholder="Enter return rate" type="number" step="any"
                            name="return_rate" value="{{ old('return_rate', 0) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Minimum Amount ($)</label>
                        <input class="admin-form-control" placeholder="Enter minimum amount" type="number" step="any"
                            name="min_amount" value="{{ old('min_amount') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Maximum Amount ($)</label>
                        <input class="admin-form-control" placeholder="Enter maximum amount" type="number" step="any"
                            name="max_amount" value="{{ old('max_amount') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Profit Share (%)</label>
                        <input class="admin-form-control" placeholder="Enter profit share" type="number" step="any"
                            name="profit_share" value="{{ old('profit_share', 0) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Verified Status</label>
                        <select class="admin-form-control" name="is_verified">
                            <option value="1" {{ old('is_verified')=='1' ? 'selected' : '' }}>Verified</option>
                            <option value="0" {{ old('is_verified')=='0' ? 'selected' : '' }}>Not Verified</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Profile Picture</label>
                        <input class="admin-form-control" type="file" name="picture" required>
                        <small style="color:var(--text-color);">Image will be uploaded to cloud storage</small>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-admin-primary">Add Trader</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
    document.getElementById('addTraderForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    const submitBtn = this.querySelector('[type="submit"]');
    const originalBtnText = submitBtn.textContent;
    submitBtn.textContent = 'Processing...';
    submitBtn.disabled = true;

    fetch("{{ route('traders.store') }}", {
        method: 'POST', body: formData,
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 'Accept': 'application/json' }
    })
    .then(async response => {
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) return response.json();
        const text = await response.text(); throw new Error(text || 'Server returned an error');
    })
    .then(data => {
        if (data.success) { toastr.success(data.message || 'Trader added successfully!'); setTimeout(() => { window.location.href = data.redirect_url || window.location.href; }, 1500); }
        else { toastr.error(data.message || 'Error adding trader'); }
    })
    .catch(error => { console.error('Error:', error); toastr.error(error.message || 'An error occurred'); })
    .finally(() => { submitBtn.textContent = originalBtnText; submitBtn.disabled = false; });
});
</script>