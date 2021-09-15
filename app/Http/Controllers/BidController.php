<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $auth = Auth::user();
        if ($auth) {
            if ($auth->hasRole('admin')) {
                return view('dashboard', ['bids' => DB::table('Bids')->orderBy('created_at', 'DESC')->get()]);
            } else return view('dashboard');
        } else return view('auth.login');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function create(Request $request)
    {
        $valid = $request->validate([
            'first_name' => 'required|min:2|max:20',
            'last_name' => 'required|min:2|max:20',
            'patronymic' => 'required|min:2|max:20',
            'address' => 'required|min:2|max:100',
            'phone' => 'required|min:11',
            'email' => 'required|min:3|max:25',
        ]);

        $bid = Bid::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'patronymic' => $request->patronymic,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email
        ]);

        return redirect('dashboard')->with('success', 'Успешная отправка заявки. Спасибо!');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request['select_filter'] === 'fio') {
            return view('dashboard', [
                'bids' => DB::table('Bids')
                    ->where('last_name', $request['input_filter'])
                    ->orWhere('first_name', $request['input_filter'])
                    ->orWhere('patronymic', $request['input_filter'])
                    ->orWhereRaw("concat(last_name, ' ', first_name, ' ', patronymic) like '%" . $request['input_filter'] . "%'")
                    ->get()
            ]);
        }
        return view('dashboard', [
            'bids' => DB::table('Bids')
                ->where($request['select_filter'], $request['input_filter'])
                ->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bid = Bid::find($id);
        if ($bid) {
            return view('bids.edit', [
                'bid' => $bid
            ]);
        } else abort(404);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $valid = $request->validate([
            'first_name' => 'required|min:2|max:20',
            'last_name' => 'required|min:2|max:20',
            'patronymic' => 'required|min:2|max:20',
            'address' => 'required|min:2|max:100',
            'phone' => 'required|min:11',
            'email' => 'required|min:3|max:25',
        ]);

        $bid = Bid::find($id);
        $bid->first_name = $request->first_name;
        $bid->last_name = $request->last_name;
        $bid->patronymic = $request->patronymic;
        $bid->address = $request->address;
        $bid->phone = $request->phone;
        $bid->email = $request->email;
        $bid->update();

        return redirect('dashboard')->with('success', 'Успешное редактирование завявки');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $bid = Bid::find($id)->delete();
        return redirect('dashboard')->with('success', "Успешное удаление заявки id:$id");

    }
}
