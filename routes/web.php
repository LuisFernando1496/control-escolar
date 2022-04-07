<?php
use App\Models\Student;
use App\Models\Schedule;
use App\Models\School;
use App\Models\User;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Livewire\Subject\MainComponent;
use App\Http\Livewire\Letter\MainComponent as LetterComponent;
use App\Http\Livewire\Group\IndexComponent as groupIndex;
use App\Http\Livewire\Notices\Admin\IndexComponent as adminIndexComponent;
use App\Http\Controllers\Notice; //this a controller too
use App\Http\Controllers\AssetController;
use App\Http\Controllers\downloadPdfController;
use App\Http\Controllers\StudentController;
use App\Http\Livewire\AccessControl\MainComponent as AccessControlComponent;
use App\Http\Livewire\Asset\MainComponent as AssetComponent;
use App\Http\Livewire\Asset\Student\MainComponent as InstrumentacionComponent;
use App\Http\Livewire\Configuration\MainComponent as ConfigurationMainComponent;
use App\Http\Livewire\History\MainComponent as HistoryMainComponent;
use App\Http\Livewire\Report\MainComponent as ReportMainComponent;
use App\Http\Livewire\Student\MainComponent as StudentMainComponent;
use App\Http\Livewire\User\IndexComponent as UserMainComponent;
use App\Http\Livewire\Schedule\ScheduleComponent;
use App\Http\Livewire\Score\MainComponent as ScoreMainComponent;
use App\Http\Livewire\Student\Scores as StudentScoreComponent;
use App\Http\Livewire\User\UpdateComponent;
use Illuminate\Support\Facades\Route;

// DB::listen(function($query){
//     echo "<pre>{{$query->sql}}</pre>";
// });
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome'); 

Route::group(['middleware' => ['auth:sanctum', 'verified', 'status.manager']], function () {
    Route::group(['middleware' => 'can:only,"admin|docente|alumno|tutor"'], function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        Route::get('/horario',ScheduleComponent::class)->name('horario');
        Route::get('/decargaPdf',[downloadPdfController::class,'descargarPdf'])->name('descargarPDF');
        Route::get('/scores', ScoreMainComponent::class)->name('scores');
        Route::get('/records',HistoryMainComponent::class)->name('records');
    });
    Route::group(['middleware' => 'can:hasRole,"admin"'], function () {
        Route::get('/control-access',AccessControlComponent::class)->name('access');;
        Route::get('/subject',MainComponent::class)->name('subject');
        Route::get('/letters',LetterComponent::class)->name('letters');
        Route::get('/users', UserMainComponent::class)->name('users.index');
        Route::get('/users/edit/{user}', UpdateComponent::class)->name('users.edit');
        Route::get('/groups',groupIndex::class)->name('groups');
        Route::get('/system',ConfigurationMainComponent::class)->name('system');
    });
    Route::group(['middleware' => 'can:only,"alumno|tutor"'], function () {
        Route::get('/instrumentacion/{description?}/{subject?}/{title?}',[AssetController::class, 'show'])->name('asset.show');
        Route::get('/Instrumentacion',InstrumentacionComponent::class)->name('instrumentacion');
    });
    Route::group(['middleware' => 'can:only,"admin|docente"'], function () {
        Route::post('/students',[StudentController::class, 'store'])->name('students.store');
        Route::get('/students', StudentMainComponent::class)->name('students');
    });
    Route::get('/notices',adminIndexComponent::class)->name('notices')->middleware('can:hasPermission,"notices.create"');
    Route::get('/reports',ReportMainComponent::class)->name('reports')->middleware('can:hasPermission,"report.create"');
    Route::get('/instrumentacion/download/{description?}/{subject?}/{title?}',[AssetController::class, 'download'])->name('asset.download');
    Route::get('/asset',AssetComponent::class)->name('asset')->middleware("can:hasPermission,'assets.create'");
    Route::get('/students/register',[StudentController::class,'create'])->name('students.register')->middleware('can:hasPermission,"user.student.create"');
});
Route::get('boleta', function () {
    //como saber si es el primer año o el segundo  o el terceo?
        //- es necesario saberlo?
        $grupo = 1; //A
        $scoreM = 0;
        $students = Student::where([["current_group_id", 1],["current_grade_id", 3]])->whereYear('period', '=', 2021)->with('user', 'currentGroup')->get()->each(function($es){
            $es->schedules->unique('subject_id')->each(function($materia) use ($es) {
                $es[$materia->subject->key] = round($materia->subject->scores->avg('score'), 2); //para que solo imprima 2 decimales
            });
            $es['final'] = round($es->scores->avg('score'), 2); // conocer el promedio actual
            // dd($es['final']);
        });

        $school = School::findOrFail(1)->first();
        // dd($students);
    return PDF::loadView('documents.report.report-card', compact('students', 'school'))->stream();
})->name('boleta');

//noticias/aviso de convocatoria  publica
Route::group([], function () {
    Route::get('/notices/{uuid}',[Notice::class, 'show'])->name('notice.show');
    Route::get('/notices/download/{uuid}',[Notice::class, 'download'])->name('notice.download');
 });
