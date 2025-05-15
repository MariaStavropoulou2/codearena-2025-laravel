@extends('layouts.app')

@section('content')
    <div class="bg-white px-6 py-32 lg:px-8">
        <div class="mx-auto max-w-3xl text-base/7 text-gray-700">
            <h1 class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">
                {{ $post->title }}
            </h1>
            <p class="mt-6 text-xl/8">{{ $post->description }}</p>
            <img class="aspect-video rounded-xl bg-gray-50 object-cover mt-10" src="{{ $post->image }}"
                alt="{{ $post->title }}">

            <div class="mt-16 max-w-2xl">
                <p class="mt-6">{{ $post->body }}</p>
            </div>

            <div class="mt-16 font-bold">
                <a href="">{{ $post->author->name }}</a>
            </div>

            {{-- ✅ Σχόλια --}}
            @if ($post->comments->count())
                <div class="mt-20 space-y-6">
                    <h2 class="text-2xl font-semibold">Σχόλια</h2>
                    @foreach ($post->comments as $comment)
                        <div class="rounded border p-4 bg-gray-50">
                            <div class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</div>
                            <div class="font-semibold text-gray-800">{{ $comment->name }}</div>
                            <p class="mt-1 text-gray-700">{{ $comment->body }}</p>

                            {{-- Κουμπί Διαγραφής --}}
                            <form method="POST" action="{{ route('comment.delete', $comment) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Delete</button>
                            </form>


                        </div>
                    @endforeach

                </div>
            @endif

            {{-- ✅ Φόρμα Σχολίων --}}
            <div class="mt-20">
                <h2 class="text-2xl font-semibold">Αφήστε ένα σχόλιο</h2>
                <form id="comment-form" method="POST" action="#">
                    @csrf
                    <div class="mt-4">
                        <label for="name" class="block text-sm font-medium">Όνομα</label>
                        <input id="name" required type="text" name="name" class="mt-1 w-full rounded border-gray-300">
                    </div>

                    <div class="mt-4">
                        <label for="body" class="block text-sm font-medium">Σχόλιο</label>
                        <textarea id="body" required name="body" class="mt-1 w-full rounded border-gray-300"
                            rows="4"></textarea>
                    </div>

                    <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Υποβολή</button>
                </form>
            </div>
        </div>
    </div>
@endsection