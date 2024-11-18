<?php

namespace App\Http\Controllers;

use App\Models\ServerGroups;
use App\Models\Servers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServerGroupsController extends Controller
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
        $serverGroups = ServerGroups::orderBy('id', 'DESC')->paginate(5);
        return view('server.groups.index', compact('serverGroups'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create(Request $request): View
    {
        return \view('server.groups.create');
    }

    /** Создать новый сервер
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    /** Создать новую группу
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        ServerGroups::create([
            'name' => $request->input('name'),
            'description' => $request->input('description', null),
        ]);

        return redirect()->route('servers.index')
            ->with('success', 'Server created successfully');
    }
}
