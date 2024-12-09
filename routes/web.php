<?php

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

Auth::routes();

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/', 'LandingController@index')->name('landing');
Route::get('/info-penyakit', 'LandingController@diseasesInfo')->name('landing.disease-info');
Route::get('/info-penyakit/{disease}', 'LandingController@diseaseDetail')->name('landing.disease-info.detail');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::get('/prediction', 'DiseaseCertaintyController@predictionForm')->name('prediction');
    Route::get('/prediction/result', 'DiseaseCertaintyController@predictionResult')->name('prediction.result');
    Route::get('/symptoms', 'SymptomsController@listSymptoms')->name('master.symptoms.list');
    Route::get('/symptoms/create', 'SymptomsController@createSymptom')->name('master.symptoms.create');
    Route::post('/symptoms/create', 'SymptomsController@saveSymptom')->name('master.symptoms.save');
    Route::get('/symptoms/{symptom}/edit', 'SymptomsController@editSymptom')->name('master.symptoms.edit');
    Route::post('/symptoms/{symptom}/update', 'SymptomsController@updateSymptom')->name('master.symptoms.update');
    Route::get('/symptoms/{id}/delete', 'SymptomsController@confirmDeleteSypmtom')->name('master.symptoms.confirm-delete');
    Route::post('/symptoms/{symptom}/delete', 'SymptomsController@deleteSypmtom')->name('master.symptoms.delete');
    Route::get('/symptoms/ajax-datatable', 'SymptomsController@ajaxSymptomsDatatable')->name('master.symptoms.datatable');

    Route::get('/diseases', 'DiseasesController@listDiseases')->name('master.diseases.list');
    Route::get('/diseases/{id}/delete', 'DiseasesController@confirmDeleteDisease')->name('master.diseases.confirm-delete');
    Route::post('/diseases/{disease}/delete', 'DiseasesController@deleteDisease')->name('master.diseases.delete');
    Route::get('/diseases/create', 'DiseasesController@createDisease')->name('master.diseases.create');
    Route::post('/diseases/create', 'DiseasesController@saveDisease')->name('master.diseases.save');
    Route::get('/diseases/{disease}/edit', 'DiseasesController@editDisease')->name('master.diseases.edit');
    Route::post('/diseases/{disease}/update', 'DiseasesController@updateDisease')->name('master.diseases.update');
    Route::get('/diseases/ajax-datatable', 'DiseasesController@ajaxDiseasesDatatable')->name('master.diseases.datatable');

    Route::get('/certainties', 'CertaintiesController@list')->name('master.certainties.list');
    Route::get('/certainties/create', 'CertaintiesController@createCertainty')->name('master.certainties.create');
    Route::post('/certainties/create', 'CertaintiesController@saveCertainty')->name('master.certainties.save');
    Route::get('/certainties/{id}/delete', 'CertaintiesController@confirmDelete')->name('master.certainties.confirm-delete');
    Route::post('/certainties/{certainty}/delete', 'CertaintiesController@delete')->name('master.certainties.delete');
    Route::get('/certainties/{certainty}/edit', 'CertaintiesController@edit')->name('master.certainties.edit');
    Route::post('/certainties/{certainty}/update', 'CertaintiesController@update')->name('master.certainties.update');

    Route::get('/assignments/list', 'DiseaseCertaintyController@assignList')->name('master.assignments.list');
    Route::get('/assignments/{disease}', 'DiseaseCertaintyController@assignSymptomCertainties')->name('master.assignments.assign');
    Route::post('/assignments/{diseaseId}', 'DiseaseCertaintyController@storeSymptomCertaintyAssignments')->name('master.assignments.store');

    Route::get('/knowledges', 'KnowledgeController@index')->name('master.knowledges.list');
    Route::get('/knowledges/ajax-datatable', 'KnowledgeController@ajaxKnowledgeDatatable')->name('master.knowledges.datatable');
    Route::get('/knowledges/create', 'KnowledgeController@create')->name('master.knowledges.create');
    Route::post('/knowledges/store', 'KnowledgeController@store')->name('master.knowledges.store');
    Route::get('/knowledges/{knowledge}/delete', 'KnowledgeController@destroy')->name('master.knowledges.destroy');

    Route::get('/decision-tree', 'DecisionTreeController@index')->name('decision-tree.list');
    Route::get('/decision-tree/ajax-datatable', 'DecisionTreeController@ajaxDecisionTreeDatatable')->name('decision-tree.datatable');
});
