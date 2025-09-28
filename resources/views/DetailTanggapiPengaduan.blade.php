<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="/" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <h4 class="text-primary mb-0">Pengaduan</h4>
                    <div></div> <!-- placeholder untuk balance -->
                </div>

                <!-- Card Pengaduan -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- Judul dan User Info -->
                        <h5 class="card-title text-primary mb-2">Pakaian Robek</h5>
                        <p class="text-muted mb-3">
                            <strong>@jaejae125</strong><br>
                            <small>01/05/2025</small>
                        </p>

                        <!-- Isi Pengaduan -->
                        <div class="bg-light p-3 rounded mb-4">
                            <p class="mb-0">Kecewa banget, pakaian yang aku laundry jadi robek begini, kompensasinya apa ya kak?</p>
                        </div>

                    

                        <!-- Form Tanggapan -->
                        <div class="mt-4">
                            <form>
                                <div class="mb-3">
                                    <textarea class="form-control" rows="3" placeholder="Ketik pesan"></textarea>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-send me-1"></i>Kirim Tanggapan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>