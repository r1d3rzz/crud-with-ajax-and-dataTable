<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->addColumn('updated_at', function ($row) {
                    $createdDate = $row->updated_at->format('d/m/Y');
                    $createdTime = $row->updated_at->diffForHumans();
                    return $createdDate . " | " . $createdTime;
                })
                ->addColumn('actions', function ($row) {
                    $editIcon = "<a href='/users/edit/$row->id' class='btn btn-sm btn-success'>" . "<i class='bx bx-edit'></i>" . "</a>";
                    $detailIcon = "<a href='/users/show/$row->id' class='btn btn-sm btn-outline-info'>" . "<i class='bx bx-info-circle' style='color:#000' ></i>" . "</a>";
                    $deleteIcon = "<a href='#' data-id='$row->id' class='btn btn-sm btn-danger delete-btn'>" . "<i class='bx bx-trash'></i>" . "</a>";

                    return "<div class='btn-group'>$editIcon $detailIcon $deleteIcon</div>";
                })
                ->rawColumns(['action', 'actions'])
                ->make(true);
        }
        return view('users.index');
    }

    public function create()
    {
        return view("users.create");
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $formData = $request->validate([
            "name" => ["required", "min:3"],
            "email" => ["required", "email", Rule::unique("users", "email")],
            "password" => ["required", "min:8"],
        ]);

        if ($request->profile) {
            $formData["profile"] = $request->file('profile')->store('profiles');
        }

        User::create($formData);

        return redirect(route('users.index'))->with("created", "User Create Successful");
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->file('profile')) {
            if ($user->profile) {
                Storage::disk('public')->delete($user->profile);
            }
            $user->profile = $request->file('profile')->store('profiles');
        } else {
            $user->profile;
        }

        $user->password = $request->password ? $request->password : $user->password;
        $user->update();

        return redirect(route('users.index'))->with('updated', 'User updated successful');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return "success";
    }
}
