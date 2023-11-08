<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\AutocompleteController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ReplacementController;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Replacement;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;


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


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('curriculum', function () {
		return view('curriculum');
	})->name('curriculum');



	Route::get('/profile/{user}', [UserController::class, 'show'])->name('show-profile');

	Route::get('company-profile', [CompanyController::class, 'profile'])->name('company-profile');
	Route::put('user-company-profile-update/{id}', [UserController::class, 'update_company'])->name('company_update');


	Route::get('postulaciones', function () {
		return view('postulaciones');
	})->name('postulaciones');

	Route::get('empleos', function () {
		return view('empleos');
	})->name('empleos');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('user-management', function () {
		return view('laravel-examples/user-management');
	})->name('user-management');

	Route::get('user-managment', [ResumeController::class, 'userManagement'])->name('resume.filter');
	Route::get('/ver-empleo/{id}', [ReplacementController::class, 'show'])->name('ver.empleo');
	Route::get('/tables', [ReplacementController::class, 'index'])->name('empleos.buscar');

    Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/test', function () {
		return view('create-company');
	});

	Route::resource('/replacement', ReplacementController::class);
	Route::resource('/resume', ResumeController::class);
	Route::get('/postula/{replacement_id}', [ReplacementController::class, 'asignar'])->name('replacement.asignar');
	Route::resource('/company', CompanyController::class);
	Route::resource('/user-profile', UserController::class);
	Route::resource('/user-experience', ExperienceController::class);
	Route::resource('/user-education', EducationController::class);
	Route::resource('/user-language', LanguageController::class);
	Route::resource('/user-skills', SkillController::class);
	Route::get('/user-skills/search', [SkillController::class, 'search'])->name('user-skills.search');
	Route::get('/remplazos/{id}', [ReplacementController::class, 'mostrar'])->name('replacement.mostrar');
	//Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::get('/autocomplete/companies', [AutocompleteController::class, 'companies'])->name('api.companies.autocomplete');
	//Route::post('/user-profile', [InfoUserController::class, 'store']);
	Route::get('/autocomplete/user-education', [AutocompleteController::class, 'searchEducation']);
// Y así para los demás campos...
	Route::get('/postulaciones', [UserController::class, 'showApplications'])->name('mis.postulaciones');
	Route::delete('/eliminar-postulacion/{replacementId}', [ReplacementController::class, 'destroyApplication'])->name('eliminar.postulacion');



	//VISTAS DE LA COMPAÑIA SIIIIIIII

    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store'])->name('user.session');
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');