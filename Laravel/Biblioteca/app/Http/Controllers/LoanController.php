<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Error;

class LoanController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        //$loans = BookUser::where('id_user', $user->id_user)->paginate(3);
        $loans = DB::table('book_user')
                    ->join('users', 'book_user.id_user', '=', 'users.id_user')
                    ->join('books', 'book_user.id_book', '=', 'books.id_book')
                    ->select('books.title', 'books.author', 'books.editorial', 'book_user.loan_date')
                    ->where('book_user.id_user', '=', $user->id_user)->paginate(3);

        return view('loans.index', ['loans' => $loans]);
    }

    public function showAll(){
        //$loans = BookUser::paginate(5);
        $loans = DB::table('book_user')
            ->join('users', 'book_user.id_user', '=', 'users.id_user')
            ->join('books', 'book_user.id_book', '=', 'books.id_book')
            ->select('users.id_user', 'books.id_book', 'users.name', 'users.surname', 'books.title', 'books.author', 'books.editorial', 'book_user.loan_date')
            ->paginate(5);

        return view('admin.index', ['loans' => $loans]);
    }

    public function getShow($id_user, $id_book, $loanDate) {
        $user = User::findOrFail($id_user);
        $book = Book::findOrFail($id_book);
        return view('admin.show', ['user' => $user, 'book' => $book, 'loanDate' => $loanDate]);
    }

    public function getCreate() {
        $users = User::all();
        $books = Book::all();
        return view('admin.create', ['users' => $users, 'books' => $books]);
    }

    public function postCreate(Request $request) {
        $request->validate([
            'user' => 'required',
            'book' => 'required',
            'date' => 'required'
        ]);

        /*$hasLoan = BookUser::where('id_user', $request->input('user'))
                             ->where('id_book', $request->input('book'))
                            ->where('loan_date', $request->input('date'))
                            ->first();*/

        $hasLoan = DB::table('book_user')->where('id_user', $request->input('user'))
                                               ->where('id_book', $request->input('book'))
                                               ->where('loan_date', $request->input('date'))
                                                ->first();

        if ($hasLoan) {
            return redirect()->action([LoanController::class, 'getCreate'])
                ->with('error', 'El préstamo ya existe');
        }

        $user = User::findOrFail($request->input('user'));
        $book = $request->input('book');
        $date = $request->input('date');

        $user->books()->attach($book, ['loan_date' => $date]);

        return redirect()->action([LoanController::class, 'showAll'])
            ->with('success', 'El prestamo se ha insertado');
    }

    public function getDelete($id_user, $id_book, $loanDate) {
        $user = User::findOrFail($id_user);
        $book = Book::findOrFail($id_book);

        return view('admin.delete', ['user' => $user, 'book' => $book, 'loan_date' => $loanDate]);
    }

    public function delete($id_user, $id_book, $loanDate) {
        $user = User::findOrFail($id_user);

        $user->books()->detach($id_book, $loanDate);

        return redirect()->action([LoanController::class, 'showAll'])
            ->with('delete', 'El prestamo se ha borrado');
    }

    public function getEdit($id_user, $id_book, $loanDate) {
        $users = User::all();
        $books = Book::all();
        $user = User::findOrFail($id_user);
        $book = Book::findOrFail($id_book);

        return view('admin.edit', ['user' => $user, 'book' => $book, 'loan_date' => $loanDate, 'users' => $users, 'books' => $books]);
    }

    public function putEdit(Request $request, $id_user, $id_book, $loan_date) {
        $request->validate([
            'user' => 'required',
            'book' => 'required',
            'date' => 'required'
        ]);

        /*$loan = BookUser::where('id_user', $id_user)
                        ->where('id_book', $id_book)
                        ->where('loan_date', $loan_date)
                        ->firstOrFail();*/

        $hasLoan = DB::table('book_user')
                    ->where('id_user', $request->input('user'))
                    ->where('id_book', $request->input('book'))
                    ->where('loan_date', $request->input('date'))
                    ->first();

        if ($hasLoan) {
            return redirect()->action([LoanController::class, 'showAll'])
                ->with('error', 'El préstamo ya existe');
        }

        $loan = DB::table('book_user')
                    ->where('id_user', $id_user)
                    ->where('id_book', $id_book)
                    ->where('loan_date', $loan_date)
                    ->first();

        $loan->id_user = $request->input('user');
        $loan->id_book = $request->input('book');
        $loan->loan_date = $request->input('date');

        DB::table('book_user')
            ->where('id_user', $id_user)
            ->where('id_book', $id_book)
            ->where('loan_date', $loan_date)
            ->update([
                'id_user' => $loan->id_user,
                'id_book' => $loan->id_book,
                'loan_date' => $loan->loan_date,
            ]);

        return redirect()->action([LoanController::class, 'showAll'])
            ->with('update', 'El préstamo se ha actualizado');

        /*
            ELOQUENT
            **a partir del control hasLoan**

            $userOld = User::findOrFail($id_user);
            $bookOld = Book::findOrFail($id_book);

            $user = User::findOrFail($request->input('user'));

            $userOld->books()->detach($bookOld, ['loan_date' => $loan_date]);

            $user->books()->attach($request->input('book'), ['loan_date' => $request->input('date')]);
          */
    }
}
