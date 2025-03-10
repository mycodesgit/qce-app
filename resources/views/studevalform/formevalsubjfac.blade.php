@extends('layouts.masterlayouts')

@section('body')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Evaluate Faculty</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item breadcrumbactive">Evaluate Faculty</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                {{-- @php
                    $disabledSubjIds = $disabledsubj->pluck('subjidrate')->toArray();
                @endphp --}}
                
                @foreach($mysubj as $datafacsubprogen)
                    @if($disabledsubj->contains('subjidrate', $datafacsubprogen->subjID))
                        @if(Auth::guard('kioskstudent')->user()->role == 'Student') 
                        <a href="#" disabled>
                            <div class="col-lg-3 col-6">
                                <div class="card card-widget widget-user">
                                    <div class="widget-user-header" style="background: url('{{ asset('template/img/img_bookclubdisabled.png') }}')no-repeat; background-position: center; background-size: cover;">
                                        <h5 class="widget-user-username text-light" style="text-align: left; font-weight: bold;">{{ $datafacsubprogen->sub_name }}</h5>
                                        <h6 class="widget-user-desc text-light" style="text-align: left;">{{ $datafacsubprogen->subSec }}</h6>
                                    </div>
                                    <div class="widget-user-image text-light text-bold">
                                        {{ $datafacsubprogen->schlyear }} -
                                        @if ($datafacsubprogen->semester == 1)
                                            1st Sem
                                        @elseif ($datafacsubprogen->semester == 2)
                                            2nd Sem
                                        @elseif ($datafacsubprogen->semester == 3)
                                            Summer
                                        @else
                                            Unknown Semester
                                        @endif

                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <h6 class="widget-user-desc text-dark">
                                            @if(isset($datafacsubprogen->fname) && isset($datafacsubprogen->lname))
                                                <span class="text-muted">{{ substr($datafacsubprogen->fname, 0, 1) }}. {{ $datafacsubprogen->lname }}</span>
                                                <strong> (Done Evaluate) </strong>
                                            @else
                                                No Instructor
                                            @endif
                                        </h6>

                                        @auth('kioskstudent')
                                            @if(Auth::guard('kioskstudent')->user()->role == 'Student') 
                                                <a href="" class="">
                                                    
                                                </a>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endif
                    @else
                    {{-- @auth('kioskstudent') --}}
                        @if(Auth::guard('kioskstudent')->user()->role == 'Student') 
                            <a href="{{ route('evalformStore', ['id' => $datafacsubprogen->subjID, 'qcefacID'  => $datafacsubprogen->id, 'qcefacname'  => $datafacsubprogen->fname . ' ' . $datafacsubprogen->lname]) }}">
                                <div class="col-lg-3 col-6">
                                    <div class="card card-widget widget-user">
                                        <div class="widget-user-header" style="background: url('{{ asset('template/img/img_bookclub.jpg') }}')no-repeat; background-position: center; background-size: cover;">
                                            <h5 class="widget-user-username text-light" style="text-align: left; font-weight: bold;">{{ $datafacsubprogen->sub_name }}</h5>
                                            <h6 class="widget-user-desc text-light" style="text-align: left;">{{ $datafacsubprogen->subSec }}</h6>
                                        </div>
                                        <div class="widget-user-image text-dark text-bold">
                                            {{ $datafacsubprogen->schlyear }} -
                                            @if ($datafacsubprogen->semester == 1)
                                                1st Sem
                                            @elseif ($datafacsubprogen->semester == 2)
                                                2nd Sem
                                            @elseif ($datafacsubprogen->semester == 3)
                                                Summer
                                            @else
                                                Unknown Semester
                                            @endif

                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <h6 class="widget-user-desc text-dark">
                                                @if(isset($datafacsubprogen->fname) && isset($datafacsubprogen->lname))
                                                    {{ substr($datafacsubprogen->fname, 0, 1) }}. {{ $datafacsubprogen->lname }}
                                                @else
                                                    No Instructor
                                                @endif
                                            </h6>

                                            @auth('kioskstudent')
                                                @if(Auth::guard('kioskstudent')->user()->role == 'Student') 
                                                    <a href="" class="">
                                                        
                                                    </a>
                                                @endif
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endif
                    {{-- @endauth --}}
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
        
@endsection