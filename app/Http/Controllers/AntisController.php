<?php

namespace App\Http\Controllers;

use App\Models\Antis;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class AntisController extends Controller
{
    use AuthorizesRequests;
//antes de sair, a ia vai ler isso ler a localização da conta e traduzir a mensagem para a lingua correta 
    public function index()
    {
        $antis = Antis::with('user')
            ->latest()
            ->take(50)
            ->get();


        return view('Home',['antis'=> $antis]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255'
        ],[
            'message.required'=> 'if you must talk, write something',
            'message.max'=> null,
        ]);

        auth()->user()->antis()->create($validated);

        return redirect('/')->with('success','anti created!');
    }


//     public function update(Request $request, Anti $anti){

//         $this->authorize('update',$anti);

//         $validated = $request->validate([
//             'message' => 'required'
//         ])


//     }


    public function destroy(Antis $anti)
    {

        $this->authorize('delete', $anti);

        $anti->delete();

        return redirect('/')->with('success','anti deleted!');    
    }
}
