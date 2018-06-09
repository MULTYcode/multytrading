@extends('dashboard.layout') @section('header')
<h1>Catalog
    <small>View Product Catalog</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Catalog</li>
</ol>

{{--
<script>
    function getPosisi() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/catalog/item',
            success: function (data) {
                $("#msg").html(data.msg);
            }
        });
    }

    jQuery(document).ready(function () {
        jQuery('#Submit').click(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/catalog') }}",
                method: 'post',
                data: {
                    name: jQuery('#item').val(),
                },
                success: function (result) {
                    console.log(result.item);
                    var hasilHtml = '';
                    $.each(result, function (i, item) {
                        $.each(item, function (_, o) {
                            hasilHtml +=
                                "<tr style='font-weight:normal;'><td>" + o.bkode +
                                "</td><td>" + o.bnama +
                                "</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                        })
                    })
                    $("#hasil").append(hasilHtml);
                }
            });
        });
    });
</script> --}} @endsection() @section('content')
<div class="row">
    <div class="col-xs-12">
        <a href="javascript:history.go(-1)">
            <button class="btn btn-primary">
                <i class="fa fa-arrow-left"></i> Back</button>
        </a>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Product Items</h3>
            </div>
            <div class="box-body">
                <table class="table">
                    <tr>
                        <th>BARCODE</th>
                        <th>DESCRIPTION</th>
                        <th>BRAND</th>
                        <th>CLASS</th>
                        <th>SUBCLASS</th>
                        <th>SIZE</th>
                        <th>COLOUR</th>
                        <th>PRICE</th>
                        <th>STOCK</th>
                    </tr>
                    @foreach($item as $items)
                    <tr style="font-weight: normal;">
                        <td>
                            <a href="{{ route('catalogstore',['kode'=>$items->bkode]) }}">{{ $items->bkode }}</a>
                        </td>
                        <td>{{ $items->bnama }}</td>
                        <td>{{ $items->brand }}</td>
                        <td>{{ $items->class }}</td>
                        <td>{{ $items->subclass }}</td>
                        <td>{{ $items->size }}</td>
                        <td>{{ $items->warna }}</td>
                        <td>{{ number_format($items->harga,0) }}</td>
                        <td>{{ number_format($items->stok,0) }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

{{--
<div class="row">
    <div class="col-md-8">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Product Items</h3>
            </div>
            <div class="box-body">
                <table class="table" id="hasil">
                    <tr>
                        <th>BARCODE</th>
                        <th>DESCRIPTION</th>
                        <th>BRAND</th>
                        <th>CLASS</th>
                        <th>SUBCLASS</th>
                        <th>COLOUR</th>
                        <th>SIZE</th>
                        <th>PRICE</th>
                        <th>STOCK</th>
                    </tr>
                    @foreach($hasil as $items)
                    <tr style="font-weight: normal;">
                        <td>
                            <a href="#">{{ $items->bkode }}</a>
                        </td>
                        <td>{{ $items->bnama }}</td>
                        <td>{{ $items->brand }}</td>
                        <td>{{ $items->class }}</td>
                        <td>{{ $items->subclass }}</td>
                        <td>{{ $items->size }}</td>
                        <td>{{ $items->warna }}</td>
                        <td>{{ $items->harga }}</td>
                        <td>{{ $items->stok }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Available In</h3>
            </div>
            <div class="box-body">
                <table class="table">
                    <tr>
                        <th>Store</th>
                        <th>Stock</th>
                    </tr>
                    <tr style="font-weight:normal;">
                        <td>Depok Margo</td>
                        <td>120</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div> --}} @endsection()