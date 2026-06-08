@extends('layouts.app')

@section('title', 'Location')
@section('breadcrumb', 'Location')
@section('page-title', 'Location')

@section('content')

<div class="row justify-content-center">
  <div class="col-12">
    <div class="card mb-4 shadow-sm border-radius-xl" style="border: none;">
      <div class="card-header pb-0 bg-transparent">
        <h4 class="font-weight-bolder mb-1" style="color: #ec407a;">Location <span class="text-secondary font-weight-normal" style="font-size: 1.35rem;">Update Form</span></h4>
      </div>
      <div class="card-body p-4 pt-3">
        <form action="{{ route('location.update', $location->id) }}" method="POST">
          @csrf
          @method('PUT')
          
          <div class="mb-4">
            <label for="location_name" class="form-label text-sm font-weight-bold text-dark ms-1">Location Name</label>
            <div class="input-group input-group-outline bg-white rounded-3" style="border: 1px solid #d2d6da;">
              <input type="text" id="location_name" name="location_name" class="form-control border-0 bg-transparent py-2 ps-3 @error('location_name') is-invalid @enderror" placeholder="Gedung A" value="{{ old('location_name', $location->location_name) }}" required style="height: 43px; box-shadow: none; outline: none; border-radius: 8px;">
            </div>
            @error('location_name')<div class="text-danger text-xs mt-1 ms-1">{{ $message }}</div>@enderror
          </div>

          <div class="mb-4">
            <label for="max_motorcycle" class="form-label text-sm font-weight-bold text-dark ms-1">Max Motorcycle</label>
            <div class="input-group input-group-outline bg-white rounded-3" style="border: 1px solid #d2d6da;">
              <input type="number" id="max_motorcycle" name="max_motorcycle" class="form-control border-0 bg-transparent py-2 ps-3 @error('max_motorcycle') is-invalid @enderror" placeholder="0" min="0" value="{{ old('max_motorcycle', $location->max_motorcycle) }}" required style="height: 43px; box-shadow: none; outline: none; border-radius: 8px;">
            </div>
            @error('max_motorcycle')<div class="text-danger text-xs mt-1 ms-1">{{ $message }}</div>@enderror
          </div>

          <div class="mb-4">
            <label for="max_car" class="form-label text-sm font-weight-bold text-dark ms-1">Max Car</label>
            <div class="input-group input-group-outline bg-white rounded-3" style="border: 1px solid #d2d6da;">
              <input type="number" id="max_car" name="max_car" class="form-control border-0 bg-transparent py-2 ps-3 @error('max_car') is-invalid @enderror" placeholder="0" min="0" value="{{ old('max_car', $location->max_car) }}" required style="height: 43px; box-shadow: none; outline: none; border-radius: 8px;">
            </div>
            @error('max_car')<div class="text-danger text-xs mt-1 ms-1">{{ $message }}</div>@enderror
          </div>

          <div class="mb-4">
            <label for="max_other" class="form-label text-sm font-weight-bold text-dark ms-1">Max Truck/Bus/Other</label>
            <div class="input-group input-group-outline bg-white rounded-3" style="border: 1px solid #d2d6da;">
              <input type="number" id="max_other" name="max_other" class="form-control border-0 bg-transparent py-2 ps-3 @error('max_other') is-invalid @enderror" placeholder="0" min="0" value="{{ old('max_other', $location->max_other) }}" required style="height: 43px; box-shadow: none; outline: none; border-radius: 8px;">
            </div>
            @error('max_other')<div class="text-danger text-xs mt-1 ms-1">{{ $message }}</div>@enderror
          </div>

          <div class="row mt-5">
            <div class="col-6 text-start">
              <a href="{{ route('location.index') }}" class="btn text-white w-100 font-weight-bold text-sm py-3 mb-0" style="background-color: #1a2530; border-radius: 8px; box-shadow: none; border: none; letter-spacing: 0.5px; height: 46px; display: inline-flex; align-items: center; justify-content: center; text-transform: uppercase;">
                CANCEL
              </a>
            </div>
            <div class="col-6 text-end">
              <button type="submit" class="btn text-white w-100 font-weight-bold text-sm py-3 mb-0" style="background: linear-gradient(90deg, #ec407a 0%, #8e24aa 100%); border-radius: 8px; box-shadow: none; border: none; letter-spacing: 0.5px; height: 46px; text-transform: uppercase;">
                UPDATE LOCATION
              </button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

@endsection
