@extends('admin.admin')
@section('title','Dashboard')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Sales Graph</h3>
            </div>
            <div class="card-body">
                <canvas class="chart" id="sales-chart" height="250px"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Latest Transaction</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <th>no</th>
                        <th>Poduct ID</th>
                        <th>Date</th>
                        <th>Price</th>
                        {{-- <th>Create_at</th> --}}
                    </thead>
                    <tbody>
                        @foreach ($trx_date as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->product_id }}</td>
                            <td>{{ date('d-M-y',strtotime($item->trx_date)) }}</td>
                            <td>{{ 'Rp. '.number_format($item->price,2,',','.') }}</td>
                            {{-- <td>{{ $item->created_at }}</td> --}}
                        </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        var chart = document.getElementById('sales-chart').getContext('2d');
        var areaChart = new Chart(chart,{
            type :'pie',
            data:{
                labels : {!! json_encode($chart['months']) !!},
                datasets :[
                    {
                    label : 'Overall Sales',
                    data : {{ json_encode($chart['totals']) }},
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }
                ]

            }
        });
    </script>
@endsection