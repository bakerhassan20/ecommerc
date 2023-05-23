@extends('website.layout')

@section('title')
    check Out
@endsection

@section('name')
    CheckOut
@endsection

@section('content')
    <section class="py-5">
        @include('website.includes.error-request')
        <!-- BILLING ADDRESS-->
        <h2 class="h5 text-uppercase mb-4">Billing details</h2>
        <div class="row">
            <div class="col-lg-8">
                <form action="{{route('checkout')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <label class="text-small text-uppercase" for="Adress">Adress</label>
                            <input class="form-control form-control-lg" id="Adress" name="adress" type="text">
                        </div>
                        <div class="col-lg-12 form-group">
                            <label class="text-small text-uppercase" for="phone">phone</label>
                            <input type="number" class="form-control form-control-lg" id="phone" name="phone">
                        </div>
                        <div class="col-lg-12 form-group">
                            <button class="btn btn-dark" type="submit">Place order</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection

