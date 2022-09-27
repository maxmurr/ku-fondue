@extends('layouts.main')

@section('content')
    <section class="mx-8">
        <div class="mt-6 w-full flex justify-between items-center">
            <h1 class="text-3xl">
                ปัญหา
                <span
                    class="inline-flex object-right rounded-full px-3 py-1 text-sm font-semibold text-white mr-2 mb-2 @if ($problem->status == 'Pending') bg-[#CDBE78] @elseif ($problem->status == 'In progress') bg-blue-500 @elseif ($problem->status == 'Done') bg-green-500 @else bg-gray-500 @endif">{{ $problem->status }}</span>
            </h1>
            @if (Auth::id() === $problem->owner_id)
                <a href="{{ route('problems.edit', ['problem' => $problem->id]) }}"
                    class="bg-teal-800 hover:bg-teal-900 text-white font-bold py-2 px-4 rounded">แก้ไข</a>
            @endif
        </div>
        <div class="my-1 px-8 py-2 flex flex-wrap justify-center">
            <a class="block p-6 w-3/4 bg-white rounded-lg border border-[#383838] shadow-md flex flex-col items-center">
                <div class="flex justify-center w-full mb-4">
                    <div class="flex-1"></div>
                    <h3 class="flex-1 text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 ">
                        {{ $problem->title }}
                    </h3>
                    <form action=" {{ route('problems.upvote', ['problem' => $problem]) }} " method="POST"
                        class="flex-1 text-right">
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
                </div>
                <div class="flex flex-col">
                    <div class="mb-4">
                        <img src="{{ asset($problem->picture_path) }}" class="max-w-full w-[670px] h-[470px] rounded-lg">
                    </div>
                    <p class="text-gray-800 font-medium px-2.5 py-0.5 rounded mr-2">
                        <b>ประเภท:</b> {{ $problem->type }} <br>
                        <b>สถานที่:</b> {{ $problem->location }} <br>
                        <b>เวลาที่แจ้งปัญหา:</b> {{ $problem->created_at }} <br>
                        <b>รายระเอียด:</b> {{ $problem->detail }} <br>
                        @auth
                        @if (($problem->phone_number != null and
                            Auth::user()->isEmployee() and
                            Auth::user()->department_id === $problem->department_id)
                            OR Auth::user()->id === $problem->owner_id)
                            <b>เบอร์โทรศัพท์:</b> {{ $problem->phone_number }} <br>
                        @endif
                        @endauth
                        <b>หน่วยงานที่รับผิดชอบ:</b> {{ $problem->department->name }}
                        @if ($problem->status === 'Done')
                            <b>จัดการโดย</b>: {{ $problem->user_id }}
                        @endif
                    </p>
                </div>
            </a>
        </div>
    </section>

    @if (Auth::user() != null and
        Auth::user()->isEmployee() and
        Auth::user()->department_id === $problem->department_id)
        <section class="mx-8">
            <div class="mt-6 w-full items-center inline">
                @if ($problem->status === 'Pending')
                    <form action=" {{ route('problems.ignored', ['problem' => $problem]) }} " method="POST"
                        class="inline content-center">
                        @csrf
                        @method('PUT')
                        <button
                            class="bg-neutral-700 hover:bg-neutral-800 text-white font-bold py-2 px-4 rounded mb-4 mt-4">
                            ไม่รับเรื่อง
                        </button>
                    </form>
                    <form action=" {{ route('problems.accept', ['problem' => $problem]) }} " method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <button class="bg-teal-700 hover:bg-teal-800 text-white font-bold py-2 px-4 rounded mb-4 mt-4">
                            รับเรื่อง
                        </button>
                    </form>
                @elseif($problem->status == 'In Progress')
                    <form action=" {{ route('problems.complete', ['problem' => $problem]) }} " method="POST"
                        class="flex-1 text-center">
                        @csrf
                        @method('PUT')
                        <button
                            class="bg-green-100 text-gray-800 text-xs font-medium inline-flex items-center px-3 h-full rounded mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-6 inline mr-1" viewBox="0 0 16 16">
                                <path
                                    d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z" />
                            </svg>
                            ดำเนินการเสร็จสิ้น
                        </button>
                    </form>
                @endif
            </div>
        </section>
    @endif
    @if (Auth::user() != null and Auth::user()->isAdmin())
        <section class="xl:mx-96 sm:mx-16 mx-8 my-4">
            <hr class="my-4" />
            <div class="relative pb-4">
                <div class="flex items-center bg-[#CDBE78] text-white text-sm font-bold px-4 py-3" role="alert">
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                    </svg>
                    <p class="text-white">Danger Zone</p>
                </div>
            </div>

            <div>
                <h3 class="text-red-600 mb-4 text-2xl">
                    ลบปัญหา
                    <p class="text-gray-800 text-xl">
                        เมื่อลบแล้วจะไม่สามารถกลับมาแก้ไขได้
                    </p>
                </h3>

                <form action="{{ route('problems.destroy', ['problem' => $problem->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="relative z-0 mb-6 w-full group">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">
                            ปัญหาที่ต้องการจะลบ
                        </label>
                        <input type="text" name="title" id="title"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="" required>
                    </div>
                    <button class="app-button red" type="submit">ลบ</button>
                </form>
            </div>
        </section>
    @endif
@endsection
