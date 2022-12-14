<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
    <title>Nasywa Snack</title>
</head>
<body>
    
    <div class="flex">

        {{-- hiasan abstrak --}}
        <div class="w-3/5 h-screen hidden md:block">
            <div class="grid grid-cols-3 grid-rows-3">
                <div class="w-full h-screen row-span-3">
                    <div class="w-full h-1/3 bg-red-200"></div>
                    <div class="w-full h-1/3 rounded-full bg-red-300"></div>
                    <div class="w-full h-1/3 bg-red-100"></div>
                </div>
                <div class="w-full h-screen row-span-3">
                    <div class="w-full h-1/2 rounded-tr-full bg-red-300"></div>
                    <div class="w-full h-1/2 rounded-bl-full bg-red-100"></div>
                </div>
                <div class="w-full h-screen bg-red-200 rounded-br-full rounded-tl-full row-span-3"></div>
            </div>
    
            {{-- welcoming text --}}
            <span class="absolute top-28 left-24 mr-12 font-semibold text-8xl text-slate-500">Selamat Datang</span>
            <span class="absolute top-56 left-72 mr-12 font-semibold text-8xl text-slate-500">di</span>
            <span class="absolute top-80 left-96 logo font-semibold text-8xl text-white">Nasywa</span>
        </div>
        <div class="w-full md:w-2/5 h-screen grid content-center md:p-16">
            <span class="flex px-8 text-3xl text-rose-600 font-bold">Daftar Akun</span>
    
            {{-- sign up form --}}
            <form class="px-8 pt-8 mb-4" method="POST" action="">
                <div class="flex space-x-4 mb-4">
                    <input class="appearance-none outline-none border-0 bg-gray-200 rounded-md w-full h-12 py-2 px-3 text-gray-700 leading-tight hover:bg-white hover:border-white hover:ring-2 hover:ring-rose-500 hover:duration-500 focus:bg-white focus:ring focus:ring-red-300 focus:border-red-300" id="firstname" type="text" name="firstname" required autocomplete="off" placeholder="Nama Depan">
                    @error('firstname')
                        <span class="text-red-500 text-xs italic">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input class="appearance-none outline-none border-0 bg-gray-200 rounded-md w-full h-12 py-2 px-3 text-gray-700 leading-tight hover:bg-white hover:border-white hover:ring-2 hover:ring-rose-500 hover:duration-500 focus:bg-white focus:ring focus:ring-red-300 focus:border-red-300" id="lastname" type="text" name="lastname" autocomplete="off" placeholder="Nama Belakang">
                    @error('lastname')
                        <span class="text-red-500 text-xs italic">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4">
                    <input class="appearance-none outline-none border-0 bg-gray-200 rounded-md w-full h-12 py-2 px-3 text-gray-700 leading-tight hover:bg-white hover:border-white hover:ring-2 hover:ring-rose-500 hover:duration-500 focus:bg-white focus:ring focus:ring-red-300 focus:border-red-300" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="Email">
                    @error('email')
                        <span class="text-red-500 text-xs italic">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-6">        
                    <input class="appearance-none outline-none border-0 bg-gray-200 rounded-md w-full h-12 py-2 px-3 text-gray-700 leading-tight hover:bg-white hover:border-white hover:ring-2 hover:ring-rose-500 hover:duration-500 focus:bg-white focus:ring focus:ring-red-300 focus:border-red-300" id="password" type="password" name="password" required autocomplete="off" placeholder="Password">
                    @error('password')
                        <span class="text-red-500 text-xs italic">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-6">        
                    <input class="appearance-none outline-none border-0 bg-gray-200 rounded-md w-full h-12 py-2 px-3 text-gray-700 leading-tight hover:bg-white hover:border-white hover:ring-2 hover:ring-rose-500 hover:duration-500 focus:bg-white focus:ring focus:ring-red-300 focus:border-red-300" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="off" placeholder="Konfirmasi">
                    @error('password_confirmation')
                        <span class="text-red-500 text-xs italic">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="flex justify-center mb-4">
                    <button class="w-full bg-rose-600 hover:bg-rose-500 hover:duration-300 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline" type="submit">
                        Daftar
                    </button>
                </div>
            </form>
    
            {{-- to sign in page --}}
            <div class="flex justify-center">
                <span class="text-sm text-gray-500">
                    Sudah punya akun? <a class="text-blue-500 hover:text-blue-800" href="{{ route('login') }}">Masuk</a>
                </span>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
</body>
</html>