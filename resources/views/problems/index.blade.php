@extends('layouts.main')

@section('content')
    <section class="mx-8">
        <h1 class="text-3xl mx-4 mt-6 font-semibold">
            ปัญหาทั้งหมด
        </h1>
        <div class="my-4 mx-4">
            <a href=" {{ route('problems.index') }}"
                class="text-white hover:bg-teal-800 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 @if (Request::url() == route('problems.index')) bg-teal-800 @else bg-teal-700 @endif">เรียงตามเวลาที่แจ้งปัญหา</a>
            <a href=" {{ route('problems.sortCountLike') }}"
                class="text-white hover:bg-teal-800 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 @if (Request::url() == route('problems.sortCountLike')) bg-teal-800 @else bg-teal-700 @endif">เรียงตาม
                Upvote</a>
        </div>
        @if ($message = Session::get('success'))
            <div class="p-4 mb-4 mt-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                <span class="font-medium">{{ $message }}</span>
            </div>
        @endif
        <div class="relative my-1
                px-8 py-2 grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach ($problems as $problem)
                <a href="{{ route('problems.show', ['problem' => $problem->id]) }}"
                    class="relative block p-6 w-full bg-white rounded-lg border border-[#383838] shadow-md hover:bg-[#F2F2F2] ">
                    <div class="relative">
                        <h5 class="mb-2 text-2xl font-medium tracking-tight text-gray-900 ">
                            {{ $problem->title }}
                            <span
                                class="absolute top-0 right-0 rounded-full px-3 py-1 text-sm font-semibold text-white mr-2 mb-2 @if ($problem->status == 'Pending') bg-[#CDBE78] @elseif ($problem->status == 'In Progress') bg-blue-500 @elseif ($problem->status == 'Done') bg-green-500 @else bg-gray-500 @endif">{{ $problem->status }}</span>
                        </h5>
                    </div>
                    <div class="relative grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <img src="{{ asset($problem->picture_path) }}" class="max-w-full w-[370px] h-[270px] rounded-lg"
                                alt="">
                        </div>
                        <p class="text-gray-800 font-medium px-2.5 py-0.5 rounded mr-2 mb-2 mt-2">
                            <b>ประเภท:</b> {{ $problem->type }} <br>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg> {{ $problem->location }} <br>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg> {{ $problem->created_at }} <br>
                        </p>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 absolute bottom-0 right-0 " fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </div>
                    <form action=" {{ route('problems.upvote', ['problem' => $problem]) }} " method="POST">
                        @csrf
                        @method('PUT')
                        <button
                            class="@if ($problem->user_upvotes()->where('user_id', Auth::id())->exists()) bg-green-500 border border-black-300 @else bg-green-100 @endif text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-6 inline mr-1" viewBox="0 0 16 16">
                                <path
                                    d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z" />
                            </svg>
                            @if ($problem->user_upvotes === null)
                                0 vote
                            @else
                                {{ $problem->user_upvotes()->count() }} vote
                            @endif
                        </button>
                    </form>
                </a>
            @endforeach
        </div>
        <div class="my-6">
            {{ $problems->links() }}
        </div>
    </section>
@endsection
