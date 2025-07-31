<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\Backend\User\StoreUserRequest;
use App\Http\Requests\Backend\User\UpdateUserRequest;
use App\Http\Resources\Backend\UserResource;
    use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(UserDataTable $datatable)
    {
        return $datatable->render('backend.user.index');
    }

    public function create()
    {
        return response()->json([], 200);
    }

    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            User::create($data);
            DB::commit();
            return response()->json([
                'success' => true,
                'title'   => 'Created!',
                'message' => 'User created successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'title'   => 'Create Failed!',
                'message' => 'Something went wrong while creating the user',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function edit(User $user)
    {
        return response()->json([
            'user' => new UserResource($user),
        ], 200);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }
            $user->update($data);
            DB::commit();
            return response()->json([
                'success' => true,
                'title'   => 'Updated!',
                'message' => 'User updated successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'title'   => 'Update Failed',
                'message' => 'Something went wrong while updating the user',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json([
                'success' => true,
                'title'   => 'Deleted!',
                'message' => 'User has been deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'title'   => 'Delete Failed',
                'message' => 'Something went wrong while deleting the user',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
