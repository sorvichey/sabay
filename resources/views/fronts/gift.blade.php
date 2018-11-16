
@extends('layouts.front')
@section('content')  
<div class="frame-content container">
    <div class="row">
        <div class="col-md-12">
            <div class="gift text-center mt-80 mb-80">
            @if($gift != null)
                @if($gift->type == 'smart')
                    <p>
                        <img src="{{asset('fronts/img/core-img/smart.png')}}" alt="">
                    </p>
                <?php
                    $khmer_month = ['មករា','កុម្ភៈ',' មីនា','មេសា','ឧសភា','មិថុនា','កក្កដា','សីហា','កញ្ញា','តុលា','វិច្ឆិកា','ធ្នូ'];
                    $months = date( "m", strtotime($gift->dateline));
                    $day = date( "d", strtotime($gift->dateline));
                    $year = date( "Y", strtotime($gift->dateline));
                   
                ?>
                    <p class="text-win text-success">លេខសំណាង :  {{$gift->code}}</p>
                    <p class="text-win text-success"> ឈ្នះកាតទូរស័ព្ទ : {{$gift->amount}} $</p>
                    <p class="text-win text-success"> 
                        *888* <span class="text-dark">{{$gift->top_up_number}}</span> # <i class="fa fa-phone"></i>
                    </p>
                @endif
                @if($gift->type == 'cellcard')
                    <p>
                        <img src="{{asset('fronts/img/core-img/cellcard.png')}}" alt="">
                    </p>
                <?php
                    $khmer_month = ['មករា','កុម្ភៈ',' មីនា','មេសា','ឧសភា','មិថុនា','កក្កដា','សីហា','កញ្ញា','តុលា','វិច្ឆិកា','ធ្នូ'];
                    $months = date( "m", strtotime($gift->dateline));
                    $day = date( "d", strtotime($gift->dateline));
                    $year = date( "Y", strtotime($gift->dateline));
                ?>
                    <p class="text-win text-warning">លេខសំណាង :  {{$gift->code}}</p>
                    <p class="text-win text-warning"> ឈ្នះកាតទូរស័ព្ទ : {{$gift->amount}} $</p>
                    <p class="text-win text-warning"> 
                        *123* <span class="text-dark">{{$gift->top_up_number}}</span> # <i class="fa fa-phone"></i>
                    </p>
                @endif
                @if($gift->type == 'metfone')
                    <p>
                        <img src="{{asset('fronts/img/core-img/metfone.png')}}" alt="">
                    </p>
              
                <?php
                    $khmer_month = ['មករា','កុម្ភៈ',' មីនា','មេសា','ឧសភា','មិថុនា','កក្កដា','សីហា','កញ្ញា','តុលា','វិច្ឆិកា','ធ្នូ'];
                    $months = date( "m", strtotime($gift->dateline));
                    $day = date( "d", strtotime($gift->dateline));
                    $year = date( "Y", strtotime($gift->dateline));
                   
                ?>
                    <p class="text-win text-info">លេខសំណាង :  {{$gift->code}}</p>
                    <p class="text-win text-info"> ឈ្នះកាតទូរស័ព្ទ : {{$gift->amount}} $</p>
                    <p class="text-win text-info"> 
                        *197* <span class="text-dark">{{$gift->top_up_number}}</span> # <i class="fa fa-phone"></i>
                    </p>
                @endif
                    <p>មានសុពលភាពដល់​  ថ្ងៃទី {{$day}} ខែ {{$khmer_month[(int)$months-1]}} ឆ្នាំ {{$year}}</p>
            @else
                <div class="text-win mt-80 mb-80">
                    <p class="text-thank text-danger">សូមព្យាយាមម្តងទៀតនៅពេលក្រោយ សូមអគុណ!</p>
                </div>
            @endif
            </div>
        </div>
    </div>  
</div>
 @endsection
   