<html>
    <head>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container p-5">
            <h1 class="text-xl">글쓰기</h1>
            <form action="/articles" method="POST" class="mt-3">
                @csrf

                <input type="text" name="body" class="block w-full mb-2 rounded">
                @error('body')
                    <p class="text-xs text-red-500 mb-3">{{ $message }}</p>
                @enderror

                {{-- @foreach ($errors->get('body') as $msg)
                    <p class="text-xs text-red-500 mb-1">{{ $msg }}</p>
                @endforeach --}}

                <button type="submit" class="py-1 px-3 bg-black text-white rounded text-xs">저장하기</button>
            </form>
        </div>
    </body>
</html>