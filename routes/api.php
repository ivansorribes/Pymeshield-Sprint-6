<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\DevicesController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'indexAPI']);
    Route::get('/taskLimit', [UserController::class, 'oneMonthTaskLimit']);
    Route::get('/activitiesLimit', [UserController::class, 'assignedCoursesUser']);
    Route::get('/graphicUserData', [UserController::class, 'graphicUserData']);

});

Route::post('/loginPhone', [AuthController::class, 'loginPhone']);




/** ----- EQUIP 4 ------ */
//Controlador de la vista página Aceptación Tareas
Route::get('/llistat-tasques', [TaskController::class, 'showTasks'])->name('llistat-tasques');
Route::get('/datos-tasques', [TaskController::class, 'datosTasques'])->name('datos-tasques');//endpoint donde llegan les tasques del usuario
Route::post('/crear-tareas', [TaskController::class, 'createTasks'])->name('crear-tareas');

//Controladores de las vistas Kanban y Gantt
Route::get('/gantt', [TaskController::class, 'gantt'])->name('vista-gantt');

//Presupuestos
Route::get('/mostrar-pressupostos', [BudgetController::class, 'show'])->name('mostrar-pressupostos'); //muestra presupuestos
Route::get('/crear-pressupost', [BudgetController::class, 'crearPresupuesto'])->name('crear-pressupost'); //formulario para crear presupuestos
Route::post('/enviar-pressupost', [BudgetController::class, 'store'])->name('enviar-pressupost'); //llamar al metodo de crear nuevo prespuesto

// ModifyBudget
Route::get('/all-data', [BudgetController::class, 'showAcceptModify'])->name('all-data');
Route::get('/all-data-manages', [BudgetController::class, 'showAllManages'])->name('all-data-manages');
Route::get('/buscador-budgetTaks/{buscado}', [BudgetController::class, 'search'])->name('buscador-budgetTaks');
Route::put('/edit-accepted/{idTask}', [BudgetController::class, 'updateAccepted'])->name('edit-accepted');
Route::put('/add-price/{id}/{price}', [BudgetController::class, 'updatePrice'])->name('add-price');
Route::get('/get-total', [BudgetController::class, 'getTotal'])->name('get-total');

// CRUD tasks
Route::get('/questionnaires-data', [QuestionnaireController::class, 'allQuestionnaires'])->name('questionnaires-data');
Route::get('/users-data', [UserController::class, 'allUsers'])->name('users-data');
Route::get('/tasks-data', [TaskController::class, 'allTasks'])->name('tasks-data');
Route::post('/new-task', [TaskController::class, 'store'])->name('new-task');
Route::put('/edit-task/{idTask}', [TaskController::class, 'update'])->name('edit-task');
Route::delete('/delete-task/{idTask}', [TaskController::class, 'destroy'])->name('delete-task');
Route::get('/buscador-tasks/{buscado}', [TaskController::class, 'search'])->name('buscador-tasks');


// Asignar Precios
Route::get('/Asignar-Precios/{id}', [TaskController::class, 'asignarPrecios'])->name('Asignar-Precios'); //Vista para la pagina Aceptar-Presupuestos
Route::get('/mostrar-tareas/{id}', [TaskController::class, 'mostrarTareas'])->name('mostrarTareas'); //Datos que le paso a la vista de la pagina Aceptar-Presupuestos
Route::put('/actualizar-tareas', [BudgetController::class, 'updateTasks'])->name('updateTask');
Route::put('/update-task/{id}', [BudgetController::class, 'updateSingleTask'])->name('updateSingleTask');

/** ----- FINAL EQUIP 4 ------  */


/** ----- EQUIP 5 ------ */

Route::get('/devicelist',[InventoryController::class, 'index']);
Route::post('/devices/delete', [DevicesController::class, 'delete']);

/** -- kivy equip 2 */

Route::resource('question',QuestionController::class)->except(['show']);

Route::get('kivy/json', [QuestionnaireController::class, 'indexmobil']);

Route::get('kivy/json/{id}/', [QuestionnaireController::class, 'indexmobilID']);

Route::get('kivy/report', [ReportController::class, 'indexmobil']);

Route::get('kivy/report/{id}/', [ReportController::class, 'indexmobilID']);

Route::get('kivy/question', [QuestionController::class, 'indexmobil']);

Route::get('kivy/question/{id}/', [QuestionController::class, 'indexmobilID']);
