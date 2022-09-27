@extends('layouts.main')

@section('content')
    <section class="mx-8">
        <h1 class="text-3xl mb-6 mt-6 items-center">
            แก้ไขหน่วยงาน {{ $department->name }}
        </h1>

        <form action="{{ route('departments.update',['department' => $department->id]) }}" method="post">
            @csrf
            @method('PUT')

            <div class="relative z-0 mb-6 w-full group">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900">
                    ชื่อหน่วยงานของคุณ
                </label>
                <input type="text" name="name" id="name"
                       class="bg-white border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                       required autocomplete="off" value="{{$department->name}}">
                @if ($errors->has('name')) <div class="text-sm text-red-600">ชื่อของหน่วยงานต้องมีความยาว 8-32 ตัวอักษร</div> @endif
            </div>
            <div>
                <button class="bg-teal-800 hover:bg-teal-900 text-white font-bold py-2 px-4 rounded" type="submit">ยืนยัน</button>
            </div>
        </form>
        <br>
        <form action="{{ route('departments.destroy', ['department' => $department]) }}" method="post">
            @csrf
            @method('DELETE')
            <div class="relative z-0 mb-6 w-full group">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900">
                    โปรดกรอกชื่อของหน่วยงานนี้ เพื่อลบออกจากระบบ
                </label>
                <input type="text" name="name" id="name"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                       placeholder="" required autocomplete="off">
                @if ($errors->any()) <div class="text-sm text-red-600">{{ $errors->first() }}</div> @endif
            </div>
            <button class="app-button red" type="submit">ลบ</button>
        </form>
    </section>

@endsection
