<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function store(Request $request)
    {

        // Get all users
        $query = User::query();

        // Filtering based on specified fields
        if ($request->has('fields')) {
            $fields = explode(',', $request->fields);
            $query->select($fields);
        }

        // Search
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('firstname', 'like', "%$searchTerm%")
                ->orWhere('lastname', 'like', "%$searchTerm%")
                ->orWhere('nickname', 'like', "%$searchTerm%");
        }

        // Sort
        if ($request->has('sort')) {
            $sortField = $request->sort;
            $query->orderBy($sortField);
        }
// Limit
if ($request->has('limit')) {
    $limit = $request->limit;
    $query->limit($limit);
}

$users = $query->get();

return response()->json($users);
}
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'age' => 'required|integer',
            'nickname' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::create($validator->validated());

        return response()->json($user, 201);
    }
public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    public function remove($id){
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'Student deleted successfully'], 204);
    }

}
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'age' => 'required|integer',
            'nickname' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::findOrFail($id);
        $user->update($validator->validated());

        return response()->json($user);
    }

}
