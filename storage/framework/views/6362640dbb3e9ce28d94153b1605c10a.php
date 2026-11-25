<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($judul ?? 'Admin Panel'); ?> - Tiket Konser</title>
    <!-- Favicon -->
    <link rel="icon" href="<?php echo e(asset('image/tikett.png')); ?>" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
            overflow-x: hidden;
            /* Mencegah scrollbar horizontal saat sidebar tertutup */
        }

        .wrapper {
            display: flex;
            width: 100%;
        }

        #sidebarMenu {
            min-width: 250px;
            max-width: 250px;
            background-color: #343a40;
            color: white;
            transition: all 0.3s;
            /* Animasi transisi */
            position: fixed;
            /* Membuat sidebar tetap di tempatnya */
            height: 100vh;
            /* Tinggi penuh viewport */
            z-index: 1030;
            /* Di atas konten lain */
            left: 0;
            /* Mulai dari kiri */
            top: 0;
            /* Mulai dari atas */
            padding-top: 56px;
            /* Sesuaikan dengan tinggi navbar */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
            /* Bayangan sidebar */
        }

        #sidebarMenu.active {
            margin-left: -250px;
            /* Geser ke kiri untuk menyembunyikan */
        }

        main#content {
            /* Selector yang lebih spesifik untuk main content */
            width: 100%;
            /* Default 100% */
            padding: 2rem;
            min-height: 100vh;
            transition: all 0.3s;
            /* Animasi transisi konten */
            margin-left: 250px;
            /* Beri ruang untuk sidebar */
            position: relative;
            /* Penting untuk z-index */
            z-index: 1;
            /* Pastikan konten di bawah header */
            padding-top: calc(56px + 2rem);
            /* Sesuaikan padding-top untuk fixed header + padding default */
        }

        main#content.active {
            margin-left: 0;
            /* Geser konten ke kiri saat sidebar tertutup */
        }

        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }

        .sidebar a.active,
        .sidebar a:hover {
            color: white;
            background-color: #495057;
        }

        /* Pastikan panah dropdown terlihat */
        .profile-dropdown .dropdown-toggle::after {
            display: inline-block;
            margin-left: .255em;
            vertical-align: .255em;
            content: "";
            border-top: .3em solid;
            border-right: .3em solid transparent;
            border-bottom: 0;
            border-left: .3em solid transparent;
        }

        /* Gaya untuk header */
        .navbar {
            padding-left: 0;
            /* Hapus padding default Bootstrap */
            padding-right: 0;
            /* Hapus padding default Bootstrap */
            z-index: 100000;
            /* Meningkatkan z-index navbar agar di atas semua konten */
            height: 56px;
            /* Menetapkan tinggi tetap untuk navbar */
            min-height: 56px;
            /* Memastikan navbar tidak menyusut */
            overflow: visible;
            /* Memungkinkan dropdown untuk merender di luar tanpa mempengaruhi tata letak */
        }

        /* Gaya untuk tombol toggler di header (sisi paling kiri) */
        .navbar-toggler {
            margin-left: 1rem;
            /* Jarak dari sisi kiri header */
            border: none;
            /* Hapus border bawaan */
            background-color: transparent;
            /* Transparan agar menyatu dengan header */
            color: rgba(255, 255, 255, 0.75);
            /* Warna ikon putih keabu-abuan */
            font-size: 1.25rem;
            /* Ukuran ikon standar */
            padding: 0.5rem 0.75rem;
            /* Padding standar tombol Bootstrap */
            z-index: 100001;
            /* Pastikan toggler di atas navbar */
        }

        /* Gaya untuk brand di dalam sidebar */
        .sidebar .sidebar-brand {
            display: flex;
            align-items: center;
            padding: 1rem;
            /* Padding untuk brand di sidebar */
            color: white;
            text-decoration: none;
            font-size: 1.4rem;
            /* Ukuran font diperbesar */
            font-weight: bold;
            background-color: #212529;
            /* Warna latar belakang untuk brand di sidebar */
            margin-bottom: 1rem;
            /* Jarak dari menu di bawahnya */
        }

        .sidebar .sidebar-brand img {
            height: 40px;
            /* Ukuran logo diperbesar */
            margin-right: 0.75rem;
            /* Jarak antara logo dan teks diperbesar */
            background-color: transparent;
            /* Pastikan gambar tidak memiliki latar belakang dari CSS */
        }

        /* Pastikan dropdown profil memiliki z-index yang sangat tinggi */
        .profile-dropdown {
            position: relative;
            /* Penting untuk z-index */
            z-index: 100002;
            /* Lebih tinggi dari navbar dan toggler */
        }

        .profile-dropdown .dropdown-menu {
            position: absolute;
            /* Mengatur posisi absolut */
            top: 100%;
            /* Menempatkan dropdown tepat di bawah toggle */
            right: 0;
            /* Menyelaraskan ke kanan */
            margin-top: 0;
            /* Hapus margin-top yang sebelumnya mungkin menyebabkan masalah */
            transform: translateY(0);
            /* Reset transform jika ada */
        }
    </style>
</head>

<body>
    <header class="navbar navbar-dark bg-dark fixed-top flex-md-nowrap p-0 shadow">
        
        <button class="navbar-toggler" type="button" id="sidebarToggle" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i> 
        </button>

        
        
        <a class="navbar-brand px-3" href="#" style="visibility: hidden; width: 0; padding: 0;"></a>

        <div class="navbar-nav flex-row ms-auto"> 
            
            <div class="nav-item dropdown profile-dropdown">
                <a class="nav-link dropdown-toggle px-3" href="#" id="navbarDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    
                    <?php if(Auth::check() && Auth::user()->foto): ?>
                        
                        
                        <img src="<?php echo e(asset('storage/img-user/' . Auth::user()->foto)); ?>" alt="Profil"
                             class="rounded-circle me-1"
                            style="width: 30px; height: 30px; object-fit: cover;"
                            onerror="this.onerror=null;this.src=''; this.style.display='none'; document.getElementById('fallback-user-icon').style.display='inline-block';">
                        <i id="fallback-user-icon" class="fas fa-user-circle fa-lg me-1" style="display: none;"></i>
                    <?php else: ?>
                        <i class="fas fa-user-circle fa-lg me-1"></i> 
                    <?php endif; ?>
                    <?php echo e(Auth::check() ? Auth::user()->nama : 'Guest'); ?> 
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?php echo e(route('user.show', Auth::user()->id ?? '')); ?>">
                            <i class="fas fa-user me-2"></i> Profil Saya
                        </a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="<?php echo e(route('logout')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt me-2"></i> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div class="wrapper">
        <nav id="sidebarMenu" class="bg-dark sidebar">
            
            <a class="sidebar-brand" href="#">
                
                <img src="<?php echo e(asset('image/tikett.png')); ?>" alt="Logo Aplikasi"> 
                <span>Tiket Konser Online</span>
            </a>
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('beranda')); ?>">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('konser.index')); ?>">
                            Data Konser
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('kategori-konser.index')); ?>">
                            Kategori Konser
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('pemesanan.index')); ?>">
                            Data Pemesanan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('user.index')); ?>">
                            Data User
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main id="content" class="px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2"><?php echo e($judul ?? 'Dashboard'); ?></h1>
            </div>

            <!-- Content Area -->
            <?php echo $__env->yieldContent('content'); ?>

        </main>
    </div>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?php echo e(asset('sweetalert/sweetalert2.all.min.js')); ?>"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();

            // Script untuk toggle sidebar
            $('#sidebarToggle').on('click', function() {
                $('#sidebarMenu').toggleClass('active');
                $('#content').toggleClass('active');
            });

            // SweetAlert2 untuk pesan sukses dari session
            <?php if(session('success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '<?php echo e(session('success')); ?>',
                    showConfirmButton: false,
                    timer: 3000
                });
            <?php endif; ?>

            // SweetAlert2 untuk pesan error dari session
            <?php if(session('error')): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '<?php echo e(session('error')); ?>',
                    showConfirmButton: false,
                    timer: 3000
                });
            <?php endif; ?>

            // Script untuk konfirmasi hapus (sudah ada sebelumnya)
            $('.delete-form').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                Swal.fire({
                    title: 'Anda Yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH C:\laravel10\TiketOnline - Copy - Copy\resources\views/backend/v_layouts/app.blade.php ENDPATH**/ ?>