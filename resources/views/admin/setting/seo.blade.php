@extends('layouts.admin')
@section('title','Super Admin')
@section('admin_content')
 <!-- BREADCRUMB-->
 <section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <span class="au-breadcrumb-span">You are here:</span>
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="{{ route('admin.home') }}">Home</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">SEO Setting</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END BREADCRUMB-->

<!-- STATISTIC-->
<section class="statistic">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-10 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">SEO Setting</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('seo.update',$seoData->id) }}" method="POST">
                                @csrf
                                @method("PUT")
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="meta_title" class="form-label">Meta Title</label>
                                            <input type="text" name="meta_title" value="{{ $seoData->meta_title }}" id="meta_title" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="meta_author" class="form-label">Meta Author</label>
                                            <input type="text" name="meta_author" value="{{ $seoData->meta_author }}" id="meta_author" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="meta_tag" class="form-label">Meta Tag</label>
                                            <input type="text" name="meta_tag" value="{{ $seoData->meta_tag }}" id="meta_tag" class="form-control">
                                            <small>online shop, e-shop, e-marketing...</small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="meta_description" class="form-label">Meta Description</label>
                                            <textarea name="meta_description" id="meta_description" class="form-control"> {{ $seoData->meta_description }} </textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="meta_keyword" class="form-label">Meta Keyword</label>
                                            <input type="text" name="meta_keyword" value="{{ $seoData->meta_keyword }}" id="meta_keyword" class="form-control">
                                            <small>online shop, e-shop, e-marketing...</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-primary py-2"> --- Others Option ---</div>
                                        <div class="mb-3">
                                            <label for="google_verification" class="form-label">Google Verification</label>
                                            <input type="text" name="google_verification" value="{{ $seoData->google_verification }}" id="google_verification" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="google_analytics" class="form-label">Google Analytics</label>
                                            <input type="text" name="google_analytics" value="{{ $seoData->google_analytics }}" id="google_analytics" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="alexa_verification" class="form-label">Alexa Verification</label>
                                            <input type="text" name="alexa_verification" value="{{ $seoData->alexa_verification }}" id="alexa_verification" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="google_adsense" class="form-label">Google Adsense</label>
                                            <input type="text" name="google_adsense" value="{{ $seoData->google_adsense }}" id="google_adsense" class="form-control">
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection


