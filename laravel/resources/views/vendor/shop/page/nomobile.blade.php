@extends('shop::base')

@section('aimeos_header')
    <?= $aiheader['basket/mini'] ?>
@stop

@section('aimeos_head')
    <?= $aibody['basket/mini'] ?>
@stop

@section('aimeos_nav')
@stop

@section('aimeos_stage')
@stop

@section('aimeos_body')
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">File Download</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Filename</th>
                            <th>Expiration Date</th>
                            <th>Downloads Remaining</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $filename }}</td>
                            <td>{{ $expiration }}</td>
                            <td>You have downloaded this file {{ $downloadcount }} of {{ $downloadtotal }} times.</td>
                        </tr>
                    </tbody>
                </table>
                <p>
                    <strong>
                        Downloads are not supported on mobile devices! If you download a file using a mobile device,
                        such as a tablet or a phone, you will not be able to use the file correctly. In addition,
                        you will use up your three (3) downloads. Please switch to a desktop or laptop computer
                        before trying to download files from us. Thank you.
                    </strong>
                </p>
                <p>
                    Downloads are available for {{ config( 'shop.distros.max-time' ) }} days from the date of purchase. You are able to download your
                    purchased file three {{ config( 'shop.distros.max-downloads' ) }} times within that {{ config( 'shop.distros.max-time' ) }} days.
                </p>
            </div>
        </div>
    </div>
</div>
@stop
