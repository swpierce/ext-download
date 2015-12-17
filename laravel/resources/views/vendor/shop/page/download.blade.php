@extends('shop::base')

@section('aimeos_header')
<?php if( !( $expiration == 'Expired' ) ): ?>
    <meta http-equiv="Refresh" content="5; URL={{ url( '/getfile', $fileid ) }}">
<?php endif; ?>
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
                            <th>Size</th>
                            <th>Expiration Date</th>
                            <th>Downloads Remaining</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $filename }}</td>
                            <td>{{ human_filesize( $filesize ) }}</td>
                            <td>
<?php if( $expiration == 'Expired' ): ?>
                                <strong><span class="expired">Expired</span></strong>
<?php else: ?>
                                <strong>{{ $expiration }}</strong>
<?php endif; ?>
                            </td>
                            <td>You have downloaded this file {{ $downloadcount }} of {{ $downloadtotal }} times.</td>
                        </tr>
                    </tbody>
                </table>
                <p>
                    <strong>
<?php if( !( $expiration == 'Expired' ) ): ?>
                        Your download will start automatically in 5 seconds. If your download does not start automatically,
                        please <a href="{{ url( '/contact' ) }}">Drop us a note and let us know.</a> We will fix the problem
                        as quickly as we can.
<?php else: ?>
                        The download you requested has expired. Downloads are available for {{ config( 'shop.distros.max-time' ) }}
                        days from the date of purchase. You are able to download your purchased file three
                        {{ config( 'shop.distros.max-downloads' ) }} times within that {{ config( 'shop.distros.max-time' ) }} days.
<?php endif; ?>
                    </strong>
                </p>
                <p>
                    Downloads are available for {{ config( 'shop.distros.max-time' ) }} days from the date of purchase. You are
                    able to download your purchased file three {{ config( 'shop.distros.max-downloads' ) }} times within that
                    {{ config( 'shop.distros.max-time' ) }} days.
                </p>
            </div>
        </div>
    </div>
</div>
@stop
