@extends('frontend.layouts.app'.config('theme_layout'))
@push('after-styles')
    <style>
        .couse-pagination li.active {
            color: #333333!important;
            font-weight: 700;
        }
        .page-link {
            position: relative;
            display: block;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #c7c7c7;
            background-color: white;
            border: none;
        }
        .page-item.active .page-link {
            z-index: 1;
            color: #333333;
            background-color:white;
            border:none;

        }
        ul.pagination{
            display: inline;
            text-align: center;
        }
    </style>
@endpush
@section('content')

    <!-- Start of breadcrumb section
        ============================================= -->
    <section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
        <div class="blakish-overlay"></div>
        <div class="container">
            <div class="page-breadcrumb-content text-center">
                <div class="page-breadcrumb-title">
                    <h2 class="breadcrumb-head black bold">"{{$q}}" <span>Courses</span></h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End of breadcrumb section
        ============================================= -->


    <!-- Start of course section
        ============================================= -->
    <section id="course-page" class="course-page-section">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    @if(session()->has('success'))
                        <div class="alert alert-dismissable alert-success fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{session('success')}}
                        </div>
                    @endif
                    <div class="short-filter-tab">
                        <div class="shorting-filter w-50 d-inline float-left mr-3">
                            <span>@lang('labels.frontend.search_result.sort_by')</span>
                            <select id="sortBy" class="form-control d-inline w-50">
                                <option value="">@lang('labels.frontend.search_result.none')</option>
                                <option value="popular">@lang('labels.frontend.search_result.popular')</option>
                                <option value="trending">@lang('labels.frontend.search_result.trending')</option>
                                <option value="featured">@lang('labels.frontend.search_result.featured')</option>
                            </select>
                        </div>

                        <div class="tab-button blog-button ul-li text-center float-right">
                            <ul class="product-tab">
                                <li class="active" rel="tab1"><i class="fas fa-th"></i></li>
                                <li rel="tab2"><i class="fas fa-list"></i></li>
                            </ul>
                        </div>

                    </div>

                    <div class="genius-post-item">
                        <div class="tab-container">
                            <div id="tab1" class="tab-content-1 pt35">
                                <div class="best-course-area best-course-v2">
                                    <div class="row">
                                        @if(count($courses) > 0)
                                            @foreach($courses as $course)

                                                <div class="col-md-4">
                                                    <div class="best-course-pic-text relative-position">
                                                        <div class="best-course-pic relative-position" @if($course->course_image != "")style="background-image: url('{{asset('storage/uploads/'.$course->course_image)}}')" @endif>

                                                            @if($course->trending == 1)
                                                                <div class="trend-badge-2 text-center text-uppercase">
                                                                    <i class="fas fa-bolt"></i>
                                                                    <span>@lang('labels.frontend.badges.trending')</span>
                                                                </div>
                                                            @endif
                                                                @if($course->free == 1)
                                                                    <div class="trend-badge-3 text-center text-uppercase">
                                                                        <i class="fas fa-bolt"></i>
                                                                        <span>@lang('labels.backend.courses.fields.free')</span>
                                                                    </div>
                                                                @endif
                                                            <div class="course-price text-center gradient-bg">
                                                                @if($course->free == 1)
                                                                    <span> {{trans('labels.backend.courses.fields.free')}}</span>
                                                                @else
                                                                    <span>   {{$appCurrency['symbol'].' '.$course->price}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="course-rate ul-li">
                                                                <ul>
                                                                    @for($i=1; $i<=(int)$course->rating; $i++)
                                                                        <li><i class="fas fa-star"></i></li>
                                                                    @endfor
                                                                </ul>
                                                            </div>
                                                            <div class="course-details-btn">
                                                                <a class="text-uppercase" href="{{ route('courses.show', [$course->slug]) }}">@lang('labels.frontend.search_result.course_detail') <i class="fas fa-arrow-right"></i></a>
                                                            </div>
                                                            <div class="blakish-overlay"></div>
                                                        </div>
                                                        <div class="best-course-text">
                                                            <div class="course-title mb20 headline relative-position">
                                                                <h3>
                                                                    <a href="{{ route('courses.show', [$course->slug]) }}">{{$course->title}}</a>
                                                                </h3>
                                                            </div>
                                                            <div class="course-meta">
                                                                <span class="course-category"><a href="{{route('courses.category',['category'=>$course->category->slug])}}">{{$course->category->name}}</a></span>
                                                                <span class="course-author"><a href="#">{{ $course->students()->count() }}
                                                                        @lang('labels.frontend.search_result.students')</a></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-12">
                                                <h4>@lang('labels.general.no_data_available')</h4>
                                            </div>
                                    @endif


                                    <!-- /course -->


                                    </div>
                                </div>
                            </div><!-- /tab-1 -->

                            <div id="tab2" class="tab-content-1">
                                <div class="course-list-view">
                                    @if(count($courses) > 0)
                                        <table>
                                            <tr class="list-head text-uppercase">
                                                <th>@lang('labels.frontend.search_result.course_name')</th>
                                                <th>@lang('labels.frontend.search_result.course_type')</th>
                                                <th>@lang('labels.frontend.search_result.starts')</th>
                                            </tr>
                                            @foreach($courses as $course)

                                                <tr>
                                                    <td>
                                                        <div class="course-list-img-text">
                                                            <div class="course-list-img" @if($course->course_image != "") style="background-image: url({{asset('storage/uploads/'.$course->course_image)}})" @endif >
                                                            </div>
                                                            <div class="course-list-text">
                                                                <h3>
                                                                    <a href="{{ route('courses.show', [$course->slug]) }}">{{$course->title}}</a>
                                                                </h3>
                                                                <div class="course-meta">
                                                                <span class="course-category bold-font"><a
                                                                            href="{{ route('courses.show', [$course->slug]) }}">@if($course->free == 1)
                                                                            {{trans('labels.backend.courses.fields.free')}}
                                                                        @else
                                                                           {{$appCurrency['symbol'].' '.$course->price}}
                                                                        @endif</a></span>

                                                                    <div class="course-rate ul-li">
                                                                        <ul>
                                                                            @for($i=1; $i<=(int)$course->rating; $i++)
                                                                                <li><i class="fas fa-star"></i></li>
                                                                            @endfor
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="course-type-list">
                                                            <span><a href="{{route('courses.category',['category'=>$course->category->slug])}}">{{$course->category->name}}</a></span>
                                                        </div>
                                                    </td>
                                                    <td>{{\Carbon\Carbon::parse($course->start_date)->format('d M Y')}}</td>
                                                </tr>
                                            @endforeach

                                        </table>

                                    @else
                                        <h4>@lang('labels.general.no_data_available')</h4>
                                    @endif
                                </div>
                            </div><!-- /tab-2 -->
                        </div>
                        <div class="couse-pagination text-center ul-li">
                            {{ $courses->links() }}
                        </div>
                    </div>
                </div>
                @include('frontend.layouts.partials.right-sidebar')

            </div>
        </div>
    </section>
    <!-- End of course section
        ============================================= -->



@endsection

@push('after-scripts')
    <script>
        $(document).ready(function () {
            $(document).on('change','#sortBy',function () {
                if($(this).val() != ""){
                    location.href = '{{url()->current()}}?type='+$(this).val();
                }else{
                    location.href = '{{route('courses.all')}}';
                }
            })

            @if(request('type') != "")
            $('#sortBy').find('option[value="'+"{{request('type')}}"+'"]').attr('selected',true);
            @endif
        });

    </script>
@endpush