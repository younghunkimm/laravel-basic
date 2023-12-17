<?php

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/articles/create', function() {
    return view('articles/create');
});

Route::post('/articles', function(Request $request) {
    // 비어있지 않고, 문자열이고, 255자를 넘으면 안된다.
    $input = $request->validate([
        'body' => [
            'required',
            'string',
            'max:255',
            'min:3'
        ],
    ]);



    // /** 기존 PHP의 PDO 방식 */
    // $host = config('database.connections.mysql.host');
    // $dbname = config('database.connections.mysql.database');
    // $username = config('database.connections.mysql.username');
    // $password = config('database.connections.mysql.password');

    // /** pdo 객체를 만들고 */
    // $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // /** 쿼리 준비 */
    // $stmt = $conn->prepare("INSERT INTO articles (body, user_id) VALUES (:body, :userId)");

    // // dd($request->all());
    // // dd($request->collect());

    // /** 쿼리 값을 설정 */
    // $stmt->bindValue(':body', $input['body']);
    // // $stmt->bindValue(':userId', $request->user()->id);
    // // $stmt->bindValue(':userId', Auth::user()->id);
    // $stmt->bindValue(':userId', Auth::id());

    // /** 실행 */
    // $stmt->execute();



    /** DB 파사드를 사용하는 방법 */
    // // DB::statement("INSERT INTO articles (body, user_id) VALUES (:body, :userId)", ['body' => $input['body'], 'userId' => Auth::id()]);
    // // DB::statement("INSERT INTO articles (body, user_id) VALUES (?, ?)", [$input['body'], Auth::id()]);
    // DB::insert("INSERT INTO articles (body, user_id) VALUES (?, ?)", [$input['body'], Auth::id()]);



    /** 쿼리 빌더를 사용하는 방법 */
    // DB::table('articles')->insert([
    //     'body' => $input['body'],
    //     'user_id' => Auth::id()
    // ]);




    /** 👍 Eloquent ORM(Object Relational Mapping) 을 사용하는 방법 */
    // $article = new Article;
    // $article->body = $input['body'];
    // $article->user_id = Auth::id();
    // $article->save();

    Article::create([
        'body' => $input['body'],
        'user_id' => Auth::id(),
    ]);

    // 글을 저장한다.
    return 'hello';
});

Route::get('articles', function() {
    $articles = Article::select('body', 'created_at')
    ->latest() // ->orderBy('created_at', 'desc')
    // ->oldest() // ->orderBy('created_at', 'asc')
    ->get();

    return view('articles.index', [
        'articles' => $articles,
    ]);
});