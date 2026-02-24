<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inventory System') | Pro Dashboard</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        /* Embedding the CSS directly to ensure it works regardless of build step */
        {!! file_get_contents(resource_path('css/app.css')) !!}
    </style>
</head>
<body>
    @auth
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i data-lucide="layout-dashboard"></i>
                <span class="ms-2">InventoryPro</span>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMain">
                <div class="navbar-nav ms-auto gap-2 align-items-center">
                    <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                        <i data-lucide="package" class="d-inline-block align-text-bottom me-1" style="width:18px"></i> Products
                    </a>
                    <a class="nav-link {{ request()->routeIs('sales.*') ? 'active' : '' }}" href="{{ route('sales.create') }}">
                        <i data-lucide="shopping-cart" class="d-inline-block align-text-bottom me-1" style="width:18px"></i> New Sale
                    </a>
                    <a class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}" href="{{ route('reports.index') }}">
                        <i data-lucide="bar-chart-3" class="d-inline-block align-text-bottom me-1" style="width:18px"></i> Reports
                    </a>
                    
                    <div class="ms-3 ps-3 border-start d-flex align-items-center gap-3">
                        <div class="text-end d-none d-sm-block">
                            <div class="fw-bold small text-dark">{{ Auth::user()->name }}</div>
                            <div class="text-secondary" style="font-size: 10px;">Administrator</div>
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-light border-0 text-danger p-2 rounded-circle" title="Sign Out">
                                <i data-lucide="log-out" style="width: 18px;"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @endauth

    <main class="container py-5 animate-fade-in">
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm d-flex align-items-center gap-2 mb-4">
                <i data-lucide="check-circle" style="width:18px"></i>
                {{ session('success') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger border-0 shadow-sm mb-4">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i data-lucide="alert-circle" style="width:18px"></i>
                    <strong class="mb-0">Please fix the following:</strong>
                </div>
                <ul class="mb-0 ps-4">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>