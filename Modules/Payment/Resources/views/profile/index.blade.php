@extends('layouts.master')

@section('content')
    <div>
        @include('blog::hero.index', ['name' => 'حساب کاربری و پروفایل ', 'string' => 'سبد خرید'])
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mt-4 pt-2">
                        <div class="d-flex align-items-center">
                            <div class="ms-3">
                                <h6 class="text-muted mb-0">خوش آمدی ، </h6>
                                <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                            </div>
                        </div>
                        @include('payment::profile.sidbar')

                    </div>

                    <div class="col-md-8 col-12 mt-4 pt-2">
                        <div class="tab-content" id="pills-tabContent">
                            @include('payment::profile.dashboard')

                            @include('payment::profile.order')

                            @include('payment::profile.address')


                            <div class="tab-pane fade bg-white shadow rounded p-4 {{ activeClassProfile('info') }}"
                                id="account" role="tabpanel" aria-labelledby="account-details">
                                <livewire:payment::profile.profile-info />
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>
    </div>
@endsection
