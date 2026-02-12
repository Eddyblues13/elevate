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
                <h4 class="admin-page-title">Edit Trader</h4>
                <p class="admin-page-subtitle">Update trader details</p>
            </div>
            <a href="{{ route('traders.index') }}" class="btn btn-sm btn-outline-secondary"><i
                    class="fas fa-arrow-left me-1"></i> Back</a>
        </div>

        <div class="admin-card">
            <form id="editTraderForm" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Trader Name</label>
                        <input class="admin-form-control" type="text" name="name" value="{{ $trader->name }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Followers</label>
                        <input class="admin-form-control" type="number" name="followers"
                            value="{{ $trader->followers }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Return Rate (%)</label>
                        <input class="admin-form-control" type="number" step="any" name="return_rate"
                            value="{{ $trader->return_rate }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Minimum Amount ($)</label>
                        <input class="admin-form-control" type="number" step="any" name="min_amount"
                            value="{{ $trader->min_amount }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Maximum Amount ($)</label>
                        <input class="admin-form-control" type="number" step="any" name="max_amount"
                            value="{{ $trader->max_amount }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Profit Share (%)</label>
                        <input class="admin-form-control" type="number" step="any" name="profit_share"
                            value="{{ $trader->profit_share }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Verified Status</label>
                        <select class="admin-form-control" name="is_verified">
                            <option value="1" {{ $trader->is_verified == 1 ? 'selected' : '' }}>Verified</option>
                            <option value="0" {{ $trader->is_verified == 0 ? 'selected' : '' }}>Not Verified</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Profile Picture</label>
                        <input class="admin-form-control" type="file" name="picture">
                        <small style="color:var(--text-color);">Leave empty to keep current image</small>
                        @if($trader->picture_url)
                        <div class="mt-2">
                            <img src="{{ $trader->picture_url }}" alt="Current" class="rounded" width="80" height="80"
                                style="object-fit:cover;">
                            <div class="form-check mt-1">
                                <input class="form-check-input" type="checkbox" name="remove_picture"
                                    id="remove_picture">
                                <label class="form-check-label" style="color:var(--text-color);"
                                    for="remove_picture">Remove current picture</label>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-admin-primary">Update Trader</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
    document.getElementById('editTraderForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    const submitBtn = this.querySelector('[type="submit"]');
    const originalBtnText = submitBtn.textContent;
    submitBtn.textContent = 'Updating...'; submitBtn.disabled = true;

    fetch("{{ route('traders.update', $trader->id) }}", {
        method: 'POST', body: formData,
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 'Accept': 'application/json', 'X-HTTP-Method-Override': 'PUT' }
    })
    .then(async response => {
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) return response.json();
        const text = await response.text(); throw new Error(text || 'Server returned an error');
    })
    .then(data => {
        if (data.success) { toastr.success(data.message || 'Trader updated!'); setTimeout(() => { window.location.href = data.redirect_url || window.location.href; }, 1500); }
        else { toastr.error(data.message || 'Error updating trader'); }
    })
    .catch(error => { console.error('Error:', error); toastr.error(error.message || 'An error occurred'); })
    .finally(() => { submitBtn.textContent = originalBtnText; submitBtn.disabled = false; });
});
</script>