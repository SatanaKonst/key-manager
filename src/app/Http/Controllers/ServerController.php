<?php

namespace App\Http\Controllers;

use App\Models\Servers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class ServerController extends Controller
{
    function __construct()
    {
        $this->middleware(
            'permission:server-list|server-create|server-edit|server-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:server-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:server-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:server-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request): View
    {
        $servers = Servers::orderBy('id', 'DESC')->paginate(5);
        return view('servers.index', compact('servers'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create(Request $request): View
    {
        return \view('servers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'server_group_id' => 'required',
            'ssh_key' => 'required',
            'name' => 'required',
            'login' => 'required',
        ]);

        $newServer = Servers::create(
            [
                'server_group_id' => $request->input('server_group_id'),
                'ssh_key' => $request->input('ssh_key', null),
                'name' => $request->input('name', 'NewServer'),
                'descriptions' => $request->input('descriptions', null),
                'login' => $request->input('login', null),
                'port' => $request->input('port', 22),
            ]
        );

        return redirect()->route('servers.index')
            ->with('success', 'Server created successfully');
    }
}
