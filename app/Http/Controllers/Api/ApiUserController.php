<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ApiUserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'customer')->get();

        return response()->json([
            'status' => 'success',
            'data' => $users
        ], 200);
    }

    public function login(Request $request)
    {
        try {
            // Validate request
            $validator = Validator::make($request->all(), [
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = User::where('name', $request->username)->first();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Username tidak terdaftar'
                ], 401);
            }

            // Verify password
            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Password salah'
                ], 401);
            }

            // Generate token
            $token = $user->createToken('auth_token')->plainTextToken;

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'Login berhasil',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'foto_profile' => $user->foto_profile ? asset('storage/' . $user->foto_profile) : null
                ],
                'token' => $token
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function profile(Request $request)
    {
        $user = $request->user();

        Log::info('=== PROFILE REQUEST ===');
        Log::info('User ID: ' . $user->id);
        Log::info('User foto_profile field: ' . $user->foto_profile);

        $fotoProfileUrl = null;
        if ($user->foto_profile) {
            $fotoProfileUrl = asset('storage/' . $user->foto_profile);
            Log::info('Generated foto URL: ' . $fotoProfileUrl);
        }

        $response = [
            'status' => 'success',
            'message' => 'Data pengguna berhasil diambil',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'notelp' => $user->notelp,
                'role' => $user->role,
                'foto_profile' => $fotoProfileUrl
            ]
        ];

        Log::info('Profile response: ', $response);
        return response()->json($response, 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'customer',
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User berhasil dibuat',
            'user' => $user
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logout berhasil'
        ]);
    }

    public function updateProfile(Request $request)
    {
        Log::info('=== UPDATE PROFILE REQUEST ===');
        Log::info('Request data: ', $request->all());
        Log::info('Has file: ', ['foto_profile' => $request->hasFile('foto_profile')]);

        $user = $request->user();
        Log::info('User ID: ' . $user->id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'notelp' => 'sometimes|string',
            'password' => 'nullable|min:6',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update field dasar
        if (isset($validated['name'])) {
            $user->name = $validated['name'];
        }
        if (isset($validated['email'])) {
            $user->email = $validated['email'];
        }
        if (isset($validated['notelp'])) {
            $user->notelp = $validated['notelp'];
        }
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        // ✅ IKUTI LOGIC WEB - Proses foto profile
        if ($request->hasFile('foto_profile')) {
            Log::info('Processing file upload...');

            // Hapus foto lama jika ada (ikuti logic web)
            if ($user->foto_profile && Storage::disk('public')->exists($user->foto_profile)) {
                Storage::disk('public')->delete($user->foto_profile);
                Log::info('Deleted old photo: ' . $user->foto_profile);
            }

            // ✅ SIMPAN FOTO BARU - SAMA SEPERTI WEB
            $path = $request->file('foto_profile')->store('pfp', 'public');
            $user->foto_profile = $path;

            Log::info('New photo saved: ' . $path);
            Log::info('Full URL: ' . asset('storage/' . $path));
        }

        $user->save();
        Log::info('User saved to database');

        $response = [
            'status' => 'success',
            'message' => 'Profil berhasil diperbarui',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'notelp' => $user->notelp,
                'role' => $user->role,
                'foto_profile' => $user->foto_profile ? asset('storage/' . $user->foto_profile) : null
            ]
        ];

        Log::info('Response: ', $response);
        return response()->json($response);
    }
}
