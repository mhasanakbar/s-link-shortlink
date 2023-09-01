<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the user is user ID '1'
        if ($user->id === 1) {
            // If the user is user ID '1', retrieve all links
            $links = Link::with('user')->get();

        } else {
            // Otherwise, fetch only the user's specific links
            $links = Link::where('user_id', $user->id)->get();
        }

        return view('backend.links.index', [
            'title' => 'History',
            'links' => $links,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // if (isset($request->link['shorted'])) {
        //     $shorted_link = $request->link['shorted'] == '' ? bin2hex(random_bytes(5)) : $request->link['shorted'];
        // } else {
        $shorted_link =  bin2hex(random_bytes(5));
        
        
        $existed_link = Link::pluck('shorted_link')->toArray();
        $original_link = Link::pluck('original_link')->toArray();

        //Digunakan untuk mengecek redudansi Original Link
        if (in_array($request->link['destination'], $original_link)) {
            return redirect()->back()->with('errors', "Link sudah ada");
        }

        //Digunakan untuk mengecek redudansi Custom Back Half
        if (in_array($shorted_link, $existed_link)) {
            return redirect()->back()->with('errors', "Please retry!");
        } else {
            $link = Link::create([
                'original_link' => $request->link['destination'],
                'shorted_link'  => $shorted_link,
                'user_id'       => Auth::user()->id,
            ]);
        }
        // return redirect()->route('route.name', ['param1' => $value1, 'param2' => $value2]);
        return redirect()->route('home', ['shorted' => $shorted_link])->with('success', "Link berhasil di pendekkan");
    }

    public function guest(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (isset($request->link['shorted'])) {
                $shorted_link = $request->link['shorted'] == '' ? bin2hex(random_bytes(5)) : $request->link['shorted'];
            } else {
                $shorted_link =  bin2hex(random_bytes(5));
            }
            $existed_link = Link::pluck('shorted_link')->toArray();

            if (in_array($shorted_link, $existed_link)) {
                return redirect()->back()->with('errors', "Coba lagi!");
            } else {
                $original_link = Link::pluck('original_link')->toArray();

                //Digunakan untuk mengecek redudansi Original Link
                if (in_array($request->link['destination'], $original_link)) {
                    return redirect()->back()->with('errors', "Link sudah ada");
                }
                $link = Link::create([
                    'original_link' => $request->link['destination'],
                    'shorted_link'  => $shorted_link,
                    'user_id'       => Auth::user()->id,
                ]);
            }
            return redirect()->route('home')->with('success', "Link berhasil di pendekkan!");
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('backend.links.edit', [
            'title' => 'Edit',
            'link' => Link::where('id', $id)->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $shorted_link = $request->link['shorted'];
        $existed_link = Link::pluck('shorted_link')->toArray();
        if (in_array($shorted_link, $existed_link)) {
            return redirect()->back()->with('errors', "Link Kostum sudah ada");
        }
        $link = Link::where('id', $id)->first();
        $link->update([
            'shorted_link' => $request->link['shorted']
        ]);

        $link->save();

        return redirect()->back()->with('success', "Link berhasil di update");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $link = Link::find($id);

        $link->delete();
        return redirect()->back()->with('success', 'Link berhasil di hapus');
    }
}
