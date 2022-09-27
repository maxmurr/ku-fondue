@extends('layouts.main')

@section('content')
    <section class="mx-8">
        <h1 class="text-3xl mb-6 mt-6 items-center">
            แก้ไขผู้ใช้งาน
        </h1>

        <form action="{{ route('users.update', ['user' => $user->id]) }}" method="post">
            @csrf
            @method('PUT')

            <div class="relative z-0 mb-6 w-full group">
                <div class="relative z-0 mb-6 w-full group">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                        ชื่อ
                    </label>
                    <input type="text" name="name" id="name"
                           class="bg-white border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                           value="{{ $user->name}}"
                           required autocomplete="off">
                </div>
                <div class="flex-wrap flex space-x-6">
                    <div class="relative z-0 mb-6 group">
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900">
                            Role
                        </label>
                        <select name="role" id="role" class="">
                            <option value="EMPLOYEE" @if($user->role === 'EMPLOYEE') selected="selected" @endif>EMPLOYEE</option>
                            <option value="USER" @if($user->role === 'USER') selected="selected" @endif>USER</option>
                        </select>
                    </div>
                    <div class="relative z-0 mb-6 group">
                        <div class="relative z-0 mb-6 group">
                            <label for="department" class="block mb-2 text-sm font-medium text-gray-900">
                                หน่วยงาน
                            </label>
                            <select name="department" id="department" class="">
                                <option value="">-</option>
                                @foreach(\App\Models\Department::all() as $department)
                                    <option value="{{$department->id}}" @if($user->department_id === $department->id) selected="selected" @endif>{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @if ($errors->any()) <div class="text-sm text-red-600">{{ $errors->first() }}</div> @endif
                <div>
                    <button class="bg-teal-800 hover:bg-teal-900 text-white font-bold py-2 px-4 rounded" type="submit">แก้ไข</button>
                </div>
            </div>
        </form>
    </section>
@endsection
