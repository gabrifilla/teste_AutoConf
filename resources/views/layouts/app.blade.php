<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gerenciamento de Veículos</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            width: 250px;
            background-color: #f8f9fa; /* Cor de fundo da sidebar */
            padding-top: 20px;
            border-right: 1px solid #dee2e6; /* Cor da borda direita da sidebar */
        }

        .sidebar a {
            padding: 10px;
            text-decoration: none;
            font-size: 18px;
            color: #007bff; /* Cor dos links na sidebar */
            display: block;
        }

        .sidebar a:hover {
            background-color: #e2e6ea; /* Cor de fundo ao passar o mouse */
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
                <li><a href="{{ route('modelos.index') }}">Modelos</a></li>
                <li><a href="{{ route('veiculos.index') }}">Veículos</a></li>
                <li><a href="{{ route('users.index') }}">Usuários</a></li>
            </ul>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
