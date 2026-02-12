@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
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

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Expert Traders</h4>
                <p class="admin-page-subtitle">Manage copy trading experts</p>
            </div>
            <a href="{{ route('traders.create') }}" class="btn btn-admin-primary"><i class="fas fa-plus me-1"></i> Add
                New Trader</a>
        </div>

        <div class="row g-4">
            @forelse($traders as $trader)
            <div class="col-lg-4 col-md-6">
                <div class="admin-card h-100">
                    <div class="text-center mb-3">
                        <img src="{{ $trader->picture_url }}" alt="{{ $trader->name }}" class="rounded-circle mb-2"
                            width="100" height="100" style="object-fit:cover;"
                            onerror="this.src='https://via.placeholder.com/100'">
                        @if($trader->is_verified)
                        <div><span class="admin-badge-success"><i class="fas fa-check-circle me-1"></i>Verified</span>
                        </div>
                        @endif
                        <h5 class="mt-2" style="color:var(--heading-color);">{{ $trader->name }}</h5>
                        <small style="color:var(--text-color);">Expert Trader</small>
                    </div>

                    <div class="p-3 rounded" style="background:var(--input-bg);">
                        <div class="d-flex justify-content-between py-1 border-bottom"
                            style="border-color:var(--border-color) !important;color:var(--text-color);">
                            <span>Followers:</span><span style="color:var(--heading-color);">{{
                                number_format($trader->followers) }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-1 border-bottom"
                            style="border-color:var(--border-color) !important;color:var(--text-color);">
                            <span>Return Rate:</span><span class="text-success">{{ number_format($trader->return_rate,
                                2) }}%</span>
                        </div>
                        <div class="d-flex justify-content-between py-1 border-bottom"
                            style="border-color:var(--border-color) !important;color:var(--text-color);">
                            <span>Min Amount:</span><span style="color:var(--heading-color);">${{
                                number_format($trader->min_amount, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-1 border-bottom"
                            style="border-color:var(--border-color) !important;color:var(--text-color);">
                            <span>Max Amount:</span><span style="color:var(--heading-color);">${{
                                number_format($trader->max_amount, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-1" style="color:var(--text-color);">
                            <span>Profit Share:</span><span class="text-warning">{{ number_format($trader->profit_share,
                                2) }}%</span>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('traders.edit', $trader->id) }}"
                            class="btn btn-sm btn-admin-primary flex-grow-1"><i class="fas fa-edit me-1"></i>Edit</a>
                        <form action="{{ route('traders.destroy', $trader->id) }}" method="POST" class="flex-grow-1"
                            onsubmit="return confirm('Are you sure?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger w-100"><i
                                    class="fas fa-trash me-1"></i>Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="admin-card text-center py-5">
                    <i class="fas fa-users fa-3x mb-3" style="color:var(--text-color);opacity:0.3;"></i>
                    <h5 style="color:var(--heading-color);">No Traders Found</h5>
                    <p style="color:var(--text-color);">Click the button above to add your first trader</p>
                    <a href="{{ route('traders.create') }}" class="btn btn-admin-primary mt-2"><i
                            class="fas fa-plus me-1"></i>Add Trader</a>
                </div>
            </div>
            @endforelse
        </div>

        @if($traders->hasPages())
        <div class="mt-4">{{ $traders->links() }}</div>
        @endif
    </div>
</div>

@include('admin.footer')