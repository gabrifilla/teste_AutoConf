<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gerenciamento de Veículos</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
        }

        #app {
            display: flex;
        }

        /* Estilo do menu lateral */
        .sidebar {
            height: 100vh;
            width: 250px; /* Largura reduzida para ícones pequenos */
            background-color: #343a40; /* Cor de fundo da sidebar */
            padding-top: 20px;
            border-right: 1px solid #495057; /* Cor da borda direita da sidebar */
            color: #ffffff; /* Cor do texto na sidebar */
        }

        .sidebar a {
            padding: 10px;
            text-decoration: none;
            font-size: 18px;
            color: #ffffff; /* Cor dos links na sidebar */
            display: block;
            text-align: center;
        }

        .sidebar a:hover {
            background-color: #495057; /* Cor de fundo ao passar o mouse */
        }

        /* Ícone no estilo Font Awesome */
        .sidebar i {
            margin-bottom: 10px;
        }

        /* Estilo do conteúdo principal */
        .content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="{{ route('marcas.index') }}"><i class="fas fa-car"></i> Marcas</a></li>
                <li><a href="{{ route('modelos.index') }}"><i class="fas fa-cogs"></i> Modelos</a></li>
                <li><a href="{{ route('veiculos.index') }}"><i class="fas fa-car-alt"></i> Veículos</a></li>
                <li><a href="{{ route('users.index') }}"><i class="fas fa-users"></i> Usuários</a></li>
            </ul>
            <a href="{{ route('logout') }}" class="logout-btn">Logout</a>
        </div>

        <!-- Conteúdo principal -->
        <div class="content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <!-- Navbar content -->
            </nav>

            <!-- Conteúdo da página -->
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
