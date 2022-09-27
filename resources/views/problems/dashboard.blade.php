@extends('layouts.main')

@section('content')
    <div class="mt-6 flex flex-wrap place-content-center">
        <div class="mx-8 w-[800px] h-[470px]">
            <h1 class="mt-4 items-center text-3xl">จำนวนของเรื่องร้องเรียนที่ได้รับในช่วง 1 เดือนที่ผ่านมา</h1>
            <canvas id="countType" class="mt-4"></canvas>
            <script>
                const data = {!! json_encode($typeData) !!};
                const ctx = document.getElementById('countType').getContext('2d');
                const countType = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['การเดินทางภายในมหาวิทยาลัย', 'อุบัติเหตุ', 'ภัยพิบัติ', 'กองทุนเงินให้กู้ยืมเพื่อการศึกษา(กยศ.)', 'เหตุขัดข้องภายในมหาวิทยาลัย', 'อื่นๆ'],
                        datasets: [{
                            label: 'จำนวนของเรื่องร้องเรียน',
                            data: data,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        maintainAspectRatio: false
                    }
                });
            </script>
        </div>
        <div>
            <h2 class="float-right">
                <a href="{{url('export-excel-csv-file/xlsx')}}" class="btn btn-success mr-1">
                    Export Excel
                </a>
            </h2>
        </div>
    </div>
@endsection
