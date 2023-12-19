<html>
    <head>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container p-5">
            <h1 class="text-2xl mb-5">글목록</h1>

            @foreach ($articles as $article)
                @if ($loop->first) <p>first</p> @endif

                <div class="bg-white-500 border rounded my-3 p-3">
                    <p>{{ $loop->index }}</p>
                    <p>{{ $article->body }}</p>
                    <p>{{ $article->user->name }}</p>
                    <p>{{ $article->created_at->diffForHumans() }}</p>
                </div>

                @if ($loop->last) <p>last</p> @endif
            @endforeach
        </div>

        <div class="container p-5">
            {{ $articles->links() }}
        </div>
    </body>
</html>