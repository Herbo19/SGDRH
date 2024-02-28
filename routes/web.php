<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EstadoMetaController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MetasController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CriterioController;
use App\Http\Controllers\EquipaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipaFuncionarioController;
use App\Http\Controllers\MetasEquipaController;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('welcome', [UsuarioController::class, 'welcome']);

Route::view('/', 'auth.login');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/logout', [AdminController::class, 'logout']);
Auth::routes();


//Middleware para verificar se user esta logado
Route::middleware(['auth.check'])->group(function () {

Route::middleware(['preventBackHistory'])->group(function () {



//Admin Rotas
Route::get('/admin/login', [AdminController::class, 'login']);

Route::get('/admin', [AdminController::class, 'index'])->name('index.index');

Route::post('/admin/login', [AdminController::class, 'submeter_login']);
});
//Login Rotas
Route::post('/auth',[UsuarioController::class, 'auth']);


//Middleware para Admin Rotas acesso
Route::group(['middleware' => 'admin.access'], function () {
    // Your admin dashboard route and other admin-related routes
    Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    // ...

    //Departamento Rotas
    Route::get('depart/{id}/eliminar',[DepartamentoController::class, 'eliminar']);
    Route::resource('depart',DepartamentoController::class);

    //Cargo Rotas
    Route::get('cargo/{id}/eliminar',[CargoController::class, 'eliminar']);
    Route::resource('cargo',CargoController::class);

    //Usuario Rotas
    Route::get('/users/{id}/eliminar',[UsuarioController::class, 'eliminar'])->name('user.eliminar');

    Route::get('/usuario', [UsuarioController::class, 'index'])->name('user');
    Route::get('/usuario/create', [UsuarioController::class, 'create'])->name('user.create');
    Route::post('/usuario/store', [UsuarioController::class, 'store'])->name('user.store');

    Route::get('/usuario/{id}', [UsuarioController::class, 'update'])->name('user.atualizar');



    Route::get('/usuario/{id}/show', [UsuarioController::class, 'showUsuario'])->name('user.mostrar');
    Route::get('/usuario/show/tipo', [UsuarioController::class, 'mostrarTipo'])->name('user.show.type');

    Route::get('/usuario/tipo/mostrar', [RoleController::class, 'index'])->name('tipo.show');
    Route::post('/usuario/tipo/store', [RoleController::class, 'store'])->name('tipo.store');

    Route::get('/usuario/{id}/eliminar',[RoleController::class, 'eliminar'])->name('tipo.eliminar');
    Route::get('/usuario/{id}/editar',[RoleController::class, 'editar'])->name('tipo.editar');

    Route::put('/usuario/{id}/tipo/atualizar',[RoleController::class, 'atualizar'])->name('tipo.atualizar');

    Route::get('autocomplete', [UsuarioController::class,'autocomplete'])->name('autocomplete');
    Route::post('searchUser',[UsuarioController::class,'searchUser']);


    //Funcionario Rotas
    Route::get('funcionario/{id}/eliminar',[FuncionarioController::class, 'eliminar']);
    Route::resource('funcionario',FuncionarioController::class);

    Route::get('/autocomplete-search', [MetasController::class, 'autocompleteSearch']);





//Equipas Rotas
Route::get('/equipa/funcionario/{id}', [EquipaFuncionarioController::class, 'show'])->name('addTo.equipa');
Route::post('/equipa/meter-equipa', [EquipaFuncionarioController::class, 'addFuncionarioEquipa'])->name('funcionario.atribuir_equipa');
Route::delete('/equipa/{id}/funcionario/{equipa}', [EquipaFuncionarioController::class, 'detachEmployee'])->name('funcionario.tirar_equipa');

Route::get('/equipa/metas/todas', [MetasEquipaController::class, 'show'])->name('equipa.metas_todas');
Route::get('/metas/equipa/criar',[MetasEquipaController::class, 'create'])->name('equipa.criar_meta');
Route::post('/metas/equipa/store', [MetasEquipaController::class, 'store'])->name('equipa.store_meta');
Route::get('minhas/equipa/{id}', [MetasEquipaController::class, 'minhaEquipa'])->name('equipa.minhas_metas');
Route::get('equipa/{id}/editar', [MetasEquipaController::class, 'edit'])->name('equipa.metas_edit');
Route::put('/meta/{id}/equipa/atualizar',[MetasEquipaController::class, 'update'])->name('equipa.metas_update');
Route::get('/meta/{id}/equipa/eliminar',[MetasEquipaController::class, 'destroy'])->name('equipa.metas_destroy');
Route::get('/meta/{id}/equipa/mostraruma',[MetasEquipaController::class, 'showOneMeta'])->name('equipa.metas_mostrarUma');




//Metas Rotas
Route::get('metas/{id}/eliminar',[MetasController::class, 'eliminar']);
Route::resource('metas',MetasController::class);



//Feedback Rotas
Route::get('/feedback/criterio', [CriterioController::class, 'index'])->name('feedback.criterio.show');
Route::post('/feedback/criterio/store', [CriterioController::class, 'store'])->name('feedback.criterio.store');
Route::get('/feedback/{id}/criterio/editar',[CriterioController::class, 'editar'])->name('criterio.editar');
Route::put('/feedback/{id}/criterio/atualizar',[CriterioController::class, 'atualizar'])->name('criterio.update');
Route::get('/feedback/{id}/criterio/eliminar',[CriterioController::class, 'eliminar'])->name('criterio.eliminar');

Route::get('/admin/relatorio', [AdminController::class, 'indexRelatorio'])->name('relatorio.show');


Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');

});

Route::resource('metas',MetasController::class, [
    'except' => ['store', 'eliminar', 'edit', 'index']
]);

//Equipas rotas
Route::post('/equipas/store', [EquipaController::class, 'store'])->name('equipas.store');
Route::get('equipas',[EquipaController::class,'index'])->name('equipas.index');
Route::get('equipas/create',[EquipaController::class,'create'])->name('equipas.create');
Route::get('/equipas/{id}',[EquipaController::class, 'eliminar'])->name('equipas.eliminar');
Route::get('/equipas/{id}/editar',[EquipaController::class, 'edit'])->name('equipas.editar');
Route::put('/equipas/{id}/atualizar',[EquipaController::class, 'update'])->name('equipas.update');
Route::get('/equipas/{id}/mostrar',[EquipaController::class, 'show'])->name('equipas.show');


Route::get('equipa/mostrar/metas/{id}', [MetasEquipaController::class, 'mostrarMetaEquipa'])->name('mostrar_equipa.meta');
Route::get('equipa/metas/{id}', [MetasEquipaController::class, 'showMetaEquipa'])->name('meta.quipas_metas');
Route::get('equipa/atualizarestado/meta/{id}', [MetasEquipaController::class, 'atualizarEstado'])->name('atualizar_estado.equipa_meta');
Route::get('/equipa/meta/{id}/editar',[MetasEquipaController::class, 'editarEstadoMeta'])->name('meta_equipa.estado_editar');


Route::get('estado/{id}/metas',[EstadoMetaController::class, 'editar'])->name('meta.estado.editar');
Route::put('estado/{id}/metas/atualizar',[EstadoMetaController::class, 'atualizarEstado'])->name('meta.estado.atualizar');


Route::get('minhas/equipas/{id}', [MetasEquipaController::class, 'minhaEquipa'])->name('equipa.minhas_metas');

//usuario rotas = acesso usuario normal
Route::get('/usuario/{id}/edit', [UsuarioController::class, 'edit'])->name('user.edit');
Route::put('/usuario/update/{id}',[UsuarioController::class, 'update'])->name('user.update');


Route::get('metas/{id}',[MetasController::class, 'show']);
Route::get('/perfil/{id}',[PerfilController::class, 'show'])->name('user.show');
Route::get('/dashboard/{id}', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('minhas/metas',[MetasController::class, 'minhasmetas'])->name('minhameta');

Route::get('/generate-pdf/{id}', [PerfilController::class, 'generatePdf']);

Route::get('/generateAdmin-pdf', [DashboardController::class, 'generatePdfAdmin']);

Route::get('/mark-notification-as-read/{id}',[HomeController::class, 'markAsRead']);

});
