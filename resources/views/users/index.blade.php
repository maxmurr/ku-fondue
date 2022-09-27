@extends('layouts.main')

@section('content')
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <section class="mb-20 text-gray-800">
            <div class="my-2 px-4 py-2 justify-items-center">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-white font-semibold uppercase bg-teal-700">
                        <tr>
                            <th scope="col" class="py-3 px-2">ชื่อ</th>
                            <th scope="col" class="py-3 px-2">E-mail</th>
                            <th scope="col" class="py-3 px-2">Department</th>
                            <th scope="col" class="py-3 px-2">Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @if ($user->role != 'ADMIN')
                                <tr class="bg-white border-b">
                                    <th scope="row"
                                        class="py-4 px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $user->name }}</th>
                                    <th class="py-4 px-2">{{ $user->email }}</th>
                                    <th class="py-4 px-2">
                                        {{ $user->department_id === null ? '-' : $user->department->name }}
                                    </th>
                                    <th class="py-4 px-2">{{ $user->role }}</th>
                                    <td>
                                        <form action=" {{ route('users.edit', ['user' => $user]) }}">
                                            <button
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">แก้ไข</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
