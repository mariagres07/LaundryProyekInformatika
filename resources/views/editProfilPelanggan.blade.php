<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('/water.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .card-custom {
            border: 3px solid #2F65B9; /* garis biru */
            border-radius: 15px;
            background: #fff;
            padding: 25px;
        }
        .title {
            text-align: center;
            font-weight: bold;
            color: #2F65B9;
            margin-bottom: 20px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card-custom shadow">
                    <div class="title">EDIT PROFILE</div>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('pelanggan.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" 
                                value="{{ old('nama', $user->name ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" class="form-control" 
                                value="{{ old('username', $user->username ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No Hp <span class="text-danger">*</span></label>
                            <input type="text" name="no_hp" class="form-control" 
                                value="{{ old('no_hp', $user->no_hp ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" 
                                value="{{ old('email', $user->email ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti password</small>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
