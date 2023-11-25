<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\VeiculoController;
    use App\Http\Controllers\MarcaController;
    use App\Http\Controllers\ModeloController;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "web" middleware group. Make something great!
    |
    */

    // Pagina inicial sendo sempre login
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

    // Função que faz com que apenas sejam acessadas as rotas caso login seja realizado
    Route::middleware('auth')->group(function () {

        // Usuários
        Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');
        Route::get('/usuarios/criar', [UserController::class, 'create'])->name('users.create');
        Route::post('/usuarios', [UserController::class, 'store'])->name('users.store');
        Route::get('/usuarios/{user}/editar', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/usuarios/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])->name('users.destroy');


        // Veículos
        Route::get('/veiculos', [VeiculoController::class, 'index'])->name('veiculos.index');
        Route::get('/veiculos/criar', [VeiculoController::class, 'create'])->name('veiculos.create');
        Route::post('/veiculos', [VeiculoController::class, 'store'])->name('veiculos.store');
        Route::get('/veiculos/filtrar', [VeiculoController::class, 'filtrar']);
        Route::get('/veiculos/busca-modelos/{marca}', [VeiculoController::class, 'buscaModelos']);
        Route::get('/veiculos/{veiculo}/editar', [VeiculoController::class, 'edit'])->name('veiculos.edit');
        Route::put('/veiculos/{veiculo}', [VeiculoController::class, 'update'])->name('veiculos.update');
        Route::delete('/veiculos/{veiculo}', [VeiculoController::class, 'destroy'])->name('veiculos.destroy');

        // Marcas
        Route::get('/marcas/criar', [MarcaController::class, 'create'])->name('marcas.create');
        Route::post('/marcas', [MarcaController::class, 'store'])->name('marcas.store');

        // Modelos
        Route::get('/modelos/criar', [ModeloController::class, 'create'])->name('modelos.create');
        Route::post('/modelos', [ModeloController::class, 'store'])->name('modelos.store');

    });

    // Rota para fazer login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']); 