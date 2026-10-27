
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Directory</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            background: #f5f7fb;
            color: #243247;
            font-family: Arial, sans-serif;
        }

        .navbar-custom {
            background: #243b53;
        }

        .page-header {
            background: linear-gradient(135deg, #243b53, #486581);
            color: white;
            border-radius: 18px;
            padding: 32px;
        }

        .content-card {
            background: white;
            border: 1px solid #e8edf3;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(36, 59, 83, 0.04);
        }

        .form-control,
        .form-select,
        .btn {
            border-radius: 9px;
        }

        .table thead th {
            background: #f0f4f8;
            color: #486581;
            font-size: 13px;
            white-space: nowrap;
        }

        .table td {
            vertical-align: middle;
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .employee-avatar {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: #e6efff;
            color: #3159a8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
        }

        .department-badge {
            background: #e8f0fe;
            color: #3159a8;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            white-space: nowrap;
        }

        .pagination {
            margin-bottom: 0;
        }

        .page-link {
            color: #3159a8;
        }

        .active > .page-link {
            background: #3159a8;
            border-color: #3159a8;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark navbar-custom">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('employees.index') }}">
            Employee Directory
        </a>
        <span class="navbar-text text-white-50">
            Human Resources
        </span>
    </div>
</nav>

<main class="container py-5">

    <section class="page-header mb-4">
        <p class="text-white-50 mb-2">EMPLOYEE MANAGEMENT</p>
        <h1 class="fw-bold mb-2">Direktori Karyawan</h1>
        <p class="mb-0">
            Temukan informasi karyawan berdasarkan nama, email, atau departemen.
        </p>
    </section>

    <section class="content-card p-4 mb-4">
        <form action="{{ route('employees.index') }}" method="GET">
            <div class="row g-3 align-items-end">

                <div class="col-md-5">
                    <label for="search" class="form-label fw-semibold">
                        Cari Karyawan
                    </label>
                    <input
                        type="text"
                        id="search"
                        name="search"
                        class="form-control"
                        placeholder="Masukkan nama atau email..."
                        value="{{ request('search') }}"
                    >
                </div>

                <div class="col-md-4">
                    <label for="department" class="form-label fw-semibold">
                        Departemen
                    </label>
                    <select
                        id="department"
                        name="department"
                        class="form-select"
                    >
                        <option value="">Semua Departemen</option>

                        @foreach ($departments as $department)
                            <option
                                value="{{ $department }}"
                                {{ request('department') === $department ? 'selected' : '' }}
                            >
                                {{ $department }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        Cari
                    </button>

                    <a
                        href="{{ route('employees.index') }}"
                        class="btn btn-outline-secondary"
                    >
                        Reset
                    </a>
                </div>

            </div>
        </form>
    </section>

    <section class="content-card p-4">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
            <div>
                <h5 class="fw-bold mb-1">Daftar Karyawan</h5>
                <p class="text-secondary small mb-0">
                    Total hasil pencarian: {{ $employees->total() }} karyawan
                </p>
            </div>

            <span class="badge text-bg-light border px-3 py-2">
                15 data per halaman
            </span>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>KARYAWAN</th>
                        <th>EMAIL</th>
                        <th>JABATAN</th>
                        <th>DEPARTEMEN</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($employees as $employee)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="employee-avatar">
                                        {{ strtoupper(substr($employee->name, 0, 1)) }}
                                    </div>

                                    <div class="fw-semibold">
                                        {{ $employee->name }}
                                    </div>
                                </div>
                            </td>

                            <td>{{ $employee->email }}</td>

                            <td>{{ $employee->position }}</td>

                            <td>
                                <span class="department-badge">
                                    {{ $employee->department }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <h6 class="fw-bold">Karyawan tidak ditemukan</h6>
                                <p class="text-secondary mb-0">
                                    Coba ubah kata kunci atau pilihan departemen.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-4">
            <small class="text-secondary">
                Menampilkan
                {{ $employees->firstItem() ?? 0 }}–{{ $employees->lastItem() ?? 0 }}
                dari {{ $employees->total() }} data
            </small>

            {{ $employees->links('pagination::bootstrap-5') }}
        </div>

    </section>

    <footer class="text-center text-secondary small mt-4">
        Employee Directory &copy; {{ date('Y') }}
    </footer>

</main>

</body>
</html>
