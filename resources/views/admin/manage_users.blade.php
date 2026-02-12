@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show mb-3">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Total Users</h4>
                <p class="admin-page-subtitle">Manage all registered users</p>
            </div>
            <div class="d-flex gap-2">
                <a href="#" data-bs-toggle="modal" data-bs-target="#sendmailModal" class="btn btn-admin-primary">
                    <i class="fas fa-envelope me-1"></i> Message All
                </a>
                <a href="{{ route('add.user') }}" data-bs-toggle="modal" data-bs-target="#adduser"
                    class="btn btn-admin-primary">
                    <i class="fas fa-plus-circle me-1"></i> Open an Account
                </a>
            </div>
        </div>

        <!-- Add User Modal -->
        <div class="modal fade" id="adduser" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content"
                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                    <div class="modal-header" style="border-color:var(--border-color);">
                        <h5 class="modal-title" style="color:var(--heading-color);">Manually Add Users</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="post" action="{{ route('add.user') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">First Name</label>
                                <input type="text" id="input1" class="admin-form-control" name="first_name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Last Name</label>
                                <input type="text" class="admin-form-control" name="last_name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Email</label>
                                <input type="email" class="admin-form-control" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Password</label>
                                <input type="password" class="admin-form-control" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Confirm Password</label>
                                <input type="password" class="admin-form-control" name="password_confirmation" required>
                            </div>
                            <button type="submit" class="btn btn-admin-primary px-4">Add User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div class="row mb-3">
                <div class="col-12">
                    <form class="d-flex gap-2 flex-wrap align-items-center">
                        <select class="admin-form-control" id="numofrecord" style="width:auto;">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <select class="admin-form-control" id="order" style="width:auto;">
                            <option value="desc">Descending</option>
                            <option value="asc">Ascending</option>
                        </select>
                        <input type="text" id="searchInput" placeholder="Search by name or email"
                            class="admin-form-control" style="max-width:300px;">
                    </form>
                </div>
            </div>

            <div class="admin-table">
                <div class="table-responsive">
                    <table class="table" id="userTable">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Client Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="userslisttbl">
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div
                                            style="width:36px;height:36px;border-radius:50%;background:var(--accent-color);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:600;font-size:0.8rem;">
                                            {{ strtoupper(substr($user->first_name, 0, 1)) }}{{
                                            strtoupper(substr($user->last_name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div style="color:var(--heading-color);font-weight:500;">{{
                                                $user->first_name }} {{ $user->last_name }}</div>
                                            <small style="color:var(--text-color);">{{ strtolower($user->email)
                                                }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-admin-primary"
                                        href="{{ route('admin.user.view', $user->id) }}">Manage</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="pagination" class="mt-3"></div>
        </div>
    </div>
</div>

<!-- Send Mail to All Modal -->
<div id="sendmailModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"
            style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
            <div class="modal-header" style="border-color:var(--border-color);">
                <h5 class="modal-title" style="color:var(--heading-color);">Send Message to All Users</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    @csrf
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

<script>
    $('#input1').on('keypress', function(e) { return e.which !== 32; });

document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("searchInput");
    const numOfRecord = document.getElementById("numofrecord");
    const orderSelect = document.getElementById("order");
    const tbody = document.getElementById("userslisttbl");
    const paginationDiv = document.getElementById("pagination");
    let currentPage = 1;
    let rowsPerPage = parseInt(numOfRecord.value);
    let filteredRows = [];

    function getAllRows() { return Array.from(tbody.getElementsByTagName("tr")); }

    function displayTablePage(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        getAllRows().forEach(row => row.style.display = "none");
        filteredRows.slice(start, end).forEach(row => { row.style.display = "table-row"; });
        generatePagination(filteredRows.length, page);
    }

    function generatePagination(totalRows, currentPage) {
        paginationDiv.innerHTML = "";
        const pageCount = Math.ceil(totalRows / rowsPerPage);
        if (pageCount <= 1) return;
        if (currentPage > 1) {
            const prevBtn = document.createElement("button");
            prevBtn.innerHTML = "&laquo;";
            prevBtn.className = "btn btn-sm btn-outline-primary";
            prevBtn.style.margin = "2px";
            prevBtn.addEventListener("click", () => { currentPage--; displayTablePage(currentPage); });
            paginationDiv.appendChild(prevBtn);
        }
        for (let i = 1; i <= pageCount; i++) {
            const btn = document.createElement("button");
            btn.innerText = i;
            btn.className = `btn btn-sm ${i === currentPage ? 'btn-admin-primary' : 'btn-outline-primary'}`;
            btn.style.margin = "2px";
            btn.addEventListener("click", () => { currentPage = i; displayTablePage(currentPage); });
            paginationDiv.appendChild(btn);
        }
        if (currentPage < pageCount) {
            const nextBtn = document.createElement("button");
            nextBtn.innerHTML = "&raquo;";
            nextBtn.className = "btn btn-sm btn-outline-primary";
            nextBtn.style.margin = "2px";
            nextBtn.addEventListener("click", () => { currentPage++; displayTablePage(currentPage); });
            paginationDiv.appendChild(nextBtn);
        }
    }

    function filterTable() {
        rowsPerPage = parseInt(numOfRecord.value);
        const filter = searchInput.value.toLowerCase();
        const order = orderSelect.value;
        filteredRows = getAllRows().filter(row => row.innerText.toLowerCase().includes(filter));
        if (order === "asc") {
            filteredRows.sort((a, b) => a.cells[1].innerText.localeCompare(b.cells[1].innerText));
        } else {
            filteredRows.sort((a, b) => b.cells[1].innerText.localeCompare(a.cells[1].innerText));
        }
        currentPage = 1;
        displayTablePage(currentPage);
    }

    searchInput.addEventListener("input", filterTable);
    numOfRecord.addEventListener("change", filterTable);
    orderSelect.addEventListener("change", filterTable);
    filteredRows = getAllRows();
    displayTablePage(currentPage);
});
</script>

@include('admin.footer')