@extends('layouts.user')

@section('content')
<div class="w-full py-8">
    <span class="text-2xl">Ganti Password</span>
    <form method="POST" action="{{ route('user.profil.simpan') }}" class="w-1/2 mt-8 space-y-4">
        @csrf
        <div class="grid grid-cols-1 gap-2">
            <label for="password" class="w-full mb-2 mt-2 text-sm font-medium ">Password</label>
            <input type="text" name="password" id="password" class="bg-white rounded border-gray-300 p-2.5 focus:outline-none focus:ring-0 focus:border-rose-400" placeholder="Password">
            @error('password')
                <div class="ml-20 text-sm text-red-500 italic">{{ $message }}</div>
            @enderror
        </div>
        <div class="grid grid-cols-1 gap-2">
            <label for="password_confirmation" class="w-full mb-2 mt-2 text-sm font-medium ">Konfirmasi Password</label>
            <input type="text" name="password_confirmation" id="password_confirmation" class="bg-white rounded border-gray-300 p-2.5 focus:outline-none focus:ring-0 focus:border-rose-400" placeholder="Password">
            @error('password_confirmation')
                <div class="ml-20 text-sm text-red-500 italic">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="text-white bg-rose-600 hover:bg-rose-500 focus:ring-0 focus:outline-none font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 text-center">Simpan</button>
    </form>
</div>
@endsection