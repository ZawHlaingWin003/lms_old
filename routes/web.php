<?php

use App\Http\Controllers\Auth\LogInController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseSectionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EssayController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\MultipleChoiceController;
use App\Http\Controllers\ShortQuestionController;
use App\Http\Controllers\siteAdministrationController;
use App\Http\Controllers\userController;
use App\Http\Controllers\ZoomController;
use App\Http\Controllers\SummernoteController;
use App\Http\Controllers\TrueFalseController;
use App\Models\CourseCategory;
use App\Models\CourseSection;
use App\Models\Role;
use App\Models\TrueFalse;
use App\Models\TrueFalseAnswer;
use App\Models\ZoomMeeting;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// use App\Http\Controllers\Zoom\GenerateSignature;

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

// authentication
Route::get('/login', function() {
            return view('auth.login');
        })->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware('auth')->group(function() {

    Route::get('/', function () {
        return redirect()->route('dashboard');
    })->middleware('auth');

    // all user dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //////////////// ADMIN /////////////////////////
    //administration
    Route::get('/siteAdministration', [siteAdministrationController::class, 'index'])->name('admin.siteAdministration');

    // user management
    Route::get('/registration', [userController::class, 'create'])->name('register');
    Route::post('/registration/store', [userController::class, 'store'])->name('register.submit');
    Route::get('/users/all', [userController::class, 'index'])->name('showAllUser');
    Route::get('/users/{user}/edit', [userController::class, 'edit'])->name('editUser');
    Route::get('/users/{user}/detail', [userController::class, 'show'])->name('showUser');
    Route::post('/users/{user}/update', [userController::class, 'update'])->name('updateUser');
    Route::post('/users/{user}/delete', [userController::class, 'destroy'])->name('destroyUser');

    // category management
    Route::get('/courseCategory', [CategoryController::class, 'index'])->name('get.courseCategory');
    Route::get('/courseCategory/create', [CategoryController::class, 'create'])->name('create.courseCategory');
    Route::post('/courseCategory/submit', [CategoryController::class, 'store'])->name('submit.courseCategory');
    Route::get('/courseCategory/{id}/courses', [CategoryController::class, 'get_courses'])->name('get.coursesByCategory');

    // course management
    Route::get('/course', [CourseController::class, 'index'])->name('get.course');
    // course is created by course setting. So, create course means create a new course setting.
    Route::get('/createCourse', [CourseController::class, 'create'])->name('create.course');
    Route::post('/course/submit', [CourseController::class, 'store'])->name('submit.course');
    Route::get('/course/{id}', [CourseController::class, 'show'])->name('show.course');
    Route::get('/course/{course}/edit', [CourseController::class, 'edit'])->name('edit.course');
    Route::post('/course/{course}/update', [CourseController::class, 'update'])->name('update.course');
    Route::post('/course/{course}/delete', [CourseController::class, 'destroy'])->name('destroy.course');

    // course section management
    Route::post('/courseSection/store', [CourseSectionController::class, 'store'])->name('store.courseSection');
    Route::post('/courseSection/update', [CourseSectionController::class, 'update'])->name('update.courseSection');
    Route::post('/courseSection/delete', [CourseSectionController::class, 'destroy'])->name('destroy.courseSection');

    // zoom controller
    // Create meeting room using topic, agenda, start_time.
    // Route::post('/meetings/{course}/{section_id}', [MeetingController::class, 'create'])->name('store.zoom');
    // // Get information of the meeting room by ID.
    // Route::get('/meetings/{id}', [MeetingController::class, 'get'])->where('id', '[0-9]+');
    // Route::patch('/meetings/{id}', [MeetingController::class, 'update'])->where('id', '[0-9]+');
    // Route::delete('/meetings/{id}', [MeetingController::class, 'delete'])->where('id', '[0-9]+');

    // Create zoom class page
    Route::get('/createZoomClass/{course}/{section_id}', [ZoomController::class, 'create'])->name('create.zoom');
    // Store zoom class using topic, agenda, start_time.
    Route::post('/storeZoomClass/{course}/{section_id}', [ZoomController::class, 'store'])->name('store.zoom');
    // show zoom class
    Route::get('/showZoomClass/{course}/{zoom}', [ZoomController::class, 'show'])->name('show.zoom');
    // edit zoom class
    Route::get('/editZoomClass/{course}/{zoom}', [ZoomController::class, 'edit'])->name('edit.zoom');
    // update zoom class
    Route::post('/updateZoomClass/{course}/{zoom}', [ZoomController::class, 'update'])->name('update.zoom');
    // destroy zoom class
    Route::post('/destroyZoomClass', [ZoomController::class, 'destroy'])->name('destroy.zoom');
    // start or join the zoom class
    Route::get('/enterZoomClass/{zoom}', [ZoomController::class, 'enter'])->name('enter');

    // Create Lesson Page
    Route::get('/createLesson/{course}/{section_id}', [LessonController::class, 'create'])->name('create.lesson');
    // Submit Lesson Page
    Route::post('/storeLesson/{course}/{section_id}', [LessonController::class, 'store'])->name('store.lesson');
    // Show Lessson
    Route::get('/showLesson/{course}/{lesson}', [LessonController::class, 'show'])->name('show.lesson');
    // Edit Lesson Page
    Route::get('/editLesson/{course}/{lesson}', [LessonController::class, 'edit'])->name('edit.lesson');
    // Update Lesson Page
    Route::post('/updateLesson/{course}/{lesson}', [LessonController::class, 'update'])->name('update.lesson');
    // Destroy Lesson Page
    Route::post('/destroyLesson', [LessonController::class, 'destroy'])->name('destroy.lesson');



    /*
    |--------------------------------------------------------------------------
    | Exam
    |--------------------------------------------------------------------------
    */
    // Create Exam
    Route::get('/createExam/{course}/{section_id}', [ExamController::class, 'create'])->name('create.exam');
    // Store Exam
    Route::post('/storeExam/{course}/{section_id}', [ExamController::class, 'store'])->name('store.exam');
    // Show Exam(Exam Detail)
    Route::get('/showExam/{course}/{exam}', [ExamController::class, 'show'])->name('show.exam');
    // Edit Exam
    Route::get('/editExam/{course}/{exam}', [ExamController::class, 'edit'])->name('edit.exam');
    // Update Exam
    Route::put('/updateExam/{course}/{exam}', [ExamController::class, 'update'])->name('update.exam');
    // Delete Exam
    Route::delete('/deleteExam/{exam}', [ExamController::class, 'destroy'])->name('delete.exam');

    // Question List Page
    Route::get('/chooseQuestionType/{course}/{exam}', [ExamController::class, 'chooseQuestionType'])->name('chooseQuestionType.exam');

    // Answer Paper Page
    Route::get('/answerpaper/{course}/{exam}', [ExamController::class, 'answerpaper'])->name('answerpaper.exam');
    // Store Student Answers
    Route::post('/answerpaper/{course}/{exam}', [ExamController::class, 'storeAnswer'])->name('store.answer');
    // Show Exam
    Route::get('/showLesson/{course}/{lesson}', [LessonController::class, 'show'])->name('show.lesson');


    /*
    |--------------------------------------------------------------------------
    | Short Question
    |--------------------------------------------------------------------------
    */
    // Create Short Question
    Route::get('/createShortQuestion/{course}/{exam}', [ShortQuestionController::class, 'create'])->name('create.shortQuestion');
    // Store Short Question
    Route::post('/storeShortQuestion/{course}/{exam}', [ShortQuestionController::class, 'store'])->name('store.shortQuestion');
    // Edit Short Question
    Route::get('/editShortQuestion/{course}/{exam}/{shortQuestion}', [ShortQuestionController::class, 'edit'])->name('edit.shortQuestion');
    // Update Short Question
    Route::put('/updateShortQuestion/{course}/{exam}/{shortQuestion}', [ShortQuestionController::class, 'update'])->name('update.shortQuestion');
    // Delete Short Question
    Route::delete('/deleteShortQuestion/{shortQuestion}', [ShortQuestionController::class, 'destroy'])->name('delete.shortQuestion');


    /*
    |--------------------------------------------------------------------------
    | Essay Question
    |--------------------------------------------------------------------------
    */
    // Create Essay Question
    Route::get('/createEssay/{course}/{exam}', [EssayController::class, 'create'])->name('create.essay');
    // Store Essay Question
    Route::post('/storeEssay/{course}/{exam}', [EssayController::class, 'store'])->name('store.essay');
    // Edit Essay Question
    Route::get('/editEssay/{course}/{exam}/{essay}', [EssayController::class, 'edit'])->name('edit.essay');
    // Update Essay Question
    Route::put('/updateEssay/{course}/{exam}/{essay}', [EssayController::class, 'update'])->name('update.essay');
    // Delete Essay Question
    Route::delete('/deleteEssay/{essay}', [EssayController::class, 'destroy'])->name('delete.essay');


    /*
    |--------------------------------------------------------------------------
    | Multiple Choice
    |--------------------------------------------------------------------------
    */
    // Create Multiple Choice
    Route::get('/createMultipleChoice/{course}/{exam}', [MultipleChoiceController::class, 'create'])->name('create.multipleChoice');
    // Store Multiple Choice
    Route::post('/storeMultipleChoice/{course}/{exam}', [MultipleChoiceController::class, 'store'])->name('store.multipleChoice');
    // Edit Multiple Choice
    Route::get('/editMultipleChoice/{course}/{exam}/{multipleChoice}', [MultipleChoiceController::class, 'edit'])->name('edit.multipleChoice');
    // Update Multiple Choice
    Route::put('/updateMultipleChoice/{course}/{exam}/{multipleChoice}', [MultipleChoiceController::class, 'update'])->name('update.multipleChoice');
    // Delete Multiple Choice
    Route::delete('/deleteMultipleChoice/{multipleChoice}', [MultipleChoiceController::class, 'destroy'])->name('delete.multipleChoice');


    /*
    |--------------------------------------------------------------------------
    | True False
    |--------------------------------------------------------------------------
    */
    // Create True False
    Route::get('/createTrueFalse/{course}/{exam}', [TrueFalseController::class, 'create'])->name('create.trueFalse');
    // Store True False
    Route::post('/storeTrueFalse/{course}/{exam}', [TrueFalseController::class, 'store'])->name('store.trueFalse');
    // Edit True False
    Route::get(('/editTrueFalse/{course}/{exam}/{trueFalse}'),[TrueFalseController::class, 'edit'])->name(('edit.trueFalse'));
    // Update True False
    Route::put('/updateTrueFalse/{course}/{exam}/{trueFalse}', [TrueFalseController::class, 'update'])->name('update.trueFalse');
    // Delete True False
    Route::delete('/deleteTrueFalse/{id}',[TrueFalseController::class, 'destroy'])->name('delete.trueFalse');



    // Forum Page
    Route::get('/forumpage', [ForumController::class, 'forum'])->name('forum.show');


    /*
    |--------------------------------------------------------------------------
    | For Event Calender
    |--------------------------------------------------------------------------
    */
    Route::get('calender', [CalenderController::class, 'cal'])->name('index.calender');
    Route::post('calender/action', [CalenderController::class, 'action'])->name('action.calendar');

});


