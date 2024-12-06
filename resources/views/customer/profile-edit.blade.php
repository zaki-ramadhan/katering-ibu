@extends('layouts.cust')

@section('title', 'Edit Informasi Pribadi Saya')

@section('vite')
    @vite('resources/js/customer/profile.js')
@endsection

@section('content')
    @if (session('status') == 'profile-updated')
        <div class="alert alert-success">
            Profil berhasil diperbarui.
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update', auth()->user()->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>
        <div class="mb-3">
            <label for="notelp" class="form-label">Nomor Telepon</label>
            <input type="tel" name="notelp" id="notelp" class="form-control" value="{{ old('notelp', auth()->user()->notelp) }}">
        </div>
        <button type="submit" class="btn btn-primary">Perbarui Profil</button>
    </form>
@endsection
