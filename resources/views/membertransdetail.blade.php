@extends('dashboard.layout') @section('header')
<h1>Member
    <small>Transaction</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Member</li>
</ol>
@endsection() @section('content')
<div class="callout callout-info">
    <a href="javascript:history.go(-1)">
        <button class="btn btn-primary">
            <i class="fa fa-arrow-left"></i> Back</button>
    </a>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">Detail Informations</h3>
            </div>
            <div class="box-body no-padding">
                <table id="layout" class="table table-condensed table-hover">
                    <thead>
                        <tr style="font-weight: normal;">
                            <th>INFORMATION</th>
                            <th>RESULT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($res as $rows)
                        <tr style="font-weight: normal;">
                            <td style="width: 30%" bgcolor="#9fc0f2">CODE</td>
                            <td>{{ $rows->kode }}</td>
                        </tr>
                        <tr style="font-weight: normal;">
                            <td style="width: 30%" bgcolor="#9fc0f2">NAME</td>
                            <td>{{ $rows->nama }}</td>
                        </tr>
                        <tr style="font-weight: normal;">
                            <td style="width: 30%" bgcolor="#9fc0f2">DATE BIRTH</td>
                            <td>{{ $rows->date_birth }}</td>
                        </tr>
                        <tr style="font-weight: normal;">
                            <td style="width: 30%" bgcolor="#9fc0f2">AGE</td>
                            <td>{{ $rows->age }}</td>
                        </tr>
                        <tr style="font-weight: normal;">
                            <td style="width: 30%" bgcolor="#9fc0f2">E-MAIL</td>
                            <td></td>
                            <td><a href="http://" style="text-decoration:underline;">Send promo</a></td>
                        </tr>
                        <tr style="font-weight: normal;">
                            <td style="width: 30%" bgcolor="#9fc0f2">INSTAGRAM</td>
                            <td></td>
                        </tr>
                        <tr style="font-weight: normal;">
                            <td style="width: 30%" bgcolor="#9fc0f2">PHONE</td>
                            <td>{{ $rows->nohp }}</td>
                            <td><a href="http://" style="text-decoration:underline;">Send promo</a></td>
                        </tr>
                        <tr style="font-weight: normal;">
                            <td style="width: 30%" bgcolor="#9fc0f2">ACTIVATED STORE</td>
                            <td>{{ $rows->activated_store }}</td>
                        </tr>
                        <tr style="font-weight: normal;">
                            <td style="width: 30%" bgcolor="#9fc0f2">FAVORITE ITEM</td>
                            <td>{{ $rows->favorite_item }}</td>
                        </tr>
                        <tr style="font-weight: normal;">
                            <td style="width: 30%" bgcolor="#9fc0f2">FAVORITE SIZE</td>
                            <td>{{ $rows->favorite_size }}</td>
                        </tr>
                        <tr style="font-weight: normal;">
                            <td style="width: 30%" bgcolor="#9fc0f2">FAVORITE COLOR</td>
                            <td>{{ $rows->favorite_colour }}</td>
                        </tr>
                        <tr style="font-weight: normal;">
                            <td style="width: 30%" bgcolor="#9fc0f2">FAVORITE BRAND</td>
                            <td>{{ $rows->favorite_brand }}</td>
                        </tr>
                        <tr style="font-weight: normal;">
                            <td style="width: 30%" bgcolor="#9fc0f2">FAVORITE CLASS</td>
                            <td>{{ $rows->favorite_class }}</td>
                        </tr>
                        <tr style="font-weight: normal;">
                            <td style="width: 30%" bgcolor="#9fc0f2">FAVORITE STORE</td>
                            <td>{{ $rows->favorite_store }}</td>
                        </tr>
                        <tr style="font-weight: normal;">
                            <td style="width: 30%" bgcolor="#9fc0f2">FAVORITE CHANNEL</td>
                            <td>{{ $rows->favorite_channel }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-solid box-warning">
            <div class="box-header">
                <h3 class="box-title">Member Transaction History</h3>
            </div>
            <div class="box-body no-padding">
                <div class="chart">
                    <div style="height:auto;">
                        {!! $chart->render() !!}
                    </div>
                </div>
                <table id="layout" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>MONTH</th>
                            <th>GROWTH</th>
                            <th>REVENUE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grafik as $key => $item)
                        <tr style="font-weight: normal;">
                            <td>{{$item->namabulan}}</td>
                            <td>{{$item->growth}}</td>
                            <td>{{number_format($item->revenue,0)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>Total</th>
                        <th></th>
                        <th>{{number_format($total,0)}}</th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection()