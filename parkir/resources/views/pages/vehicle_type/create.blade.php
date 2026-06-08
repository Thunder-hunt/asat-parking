@extends('layouts.app')

@section('title', 'Vehicle Type')
@section('breadcrumb', 'Vehicle Type')
@section('page-title', 'Vehicle Type')

@section('content')

<div class="row justify-content-center">
  <div class="col-12">
    <div class="card mb-4 shadow-sm border-radius-xl" style="border: none;">
      <div class="card-header pb-0 bg-transparent">
        <h4 class="font-weight-bolder mb-1" style="color: #ec407a;">Vehicle Type <span class="text-secondary font-weight-normal" style="font-size: 1.35rem;">Input Form</span></h4>
      </div>
      <div class="card-body p-4 pt-3">
        <form action="{{ route('vehicle-type.store') }}" method="POST">
          @csrf
          
          <div class="mb-4">
            <label for="jenis" class="form-label text-sm font-weight-bold text-dark ms-1">Vehicle Type</label>
            <div class="input-group input-group-outline bg-white rounded-3" style="border: 1px solid #d2d6da;">
              <select id="jenis" name="jenis" class="form-control border-0 bg-transparent py-2 ps-3 @error('jenis') is-invalid @enderror" required style="height: 43px; box-shadow: none; outline: none; border-radius: 8px;">
                <option value="">-- Select Type --</option>
                <option value="motorcycle" {{ old('jenis') == 'motorcycle' ? 'selected' : '' }}>Motor (Motorcycle)</option>
                <option value="car"        {{ old('jenis') == 'car'        ? 'selected' : '' }}>Mobil (Car)</option>
                <option value="other"      {{ old('jenis') == 'other'      ? 'selected' : '' }}>Lainnya (Other)</option>
              </select>
            </div>
            @error('jenis')<div class="text-danger text-xs mt-1 ms-1">{{ $message }}</div>@enderror
          </div>

          <div class="mb-4">
            <label for="perjam_pertama" class="form-label text-sm font-weight-bold text-dark ms-1">First Hour Charges (Rp)</label>
            <div class="input-group input-group-outline bg-white rounded-3" style="border: 1px solid #d2d6da;">
              <input type="number" id="perjam_pertama" name="perjam_pertama" class="form-control border-0 bg-transparent py-2 ps-3 @error('perjam_pertama') is-invalid @enderror" placeholder="e.g. 2000" min="0" value="{{ old('perjam_pertama') }}" required style="height: 43px; box-shadow: none; outline: none; border-radius: 8px;">
            </div>
            @error('perjam_pertama')<div class="text-danger text-xs mt-1 ms-1">{{ $message }}</div>@enderror
          </div>

          <div class="mb-4">
            <label for="perjam_berikutnya" class="form-label text-sm font-weight-bold text-dark ms-1">Next Hourly Charges (Rp)</label>
            <div class="input-group input-group-outline bg-white rounded-3" style="border: 1px solid #d2d6da;">
              <input type="number" id="perjam_berikutnya" name="perjam_berikutnya" class="form-control border-0 bg-transparent py-2 ps-3 @error('perjam_berikutnya') is-invalid @enderror" placeholder="e.g. 1000" min="0" value="{{ old('perjam_berikutnya') }}" required style="height: 43px; box-shadow: none; outline: none; border-radius: 8px;">
            </div>
            @error('perjam_berikutnya')<div class="text-danger text-xs mt-1 ms-1">{{ $message }}</div>@enderror
          </div>

          <div class="mb-4">
            <label for="max_perhari" class="form-label text-sm font-weight-bold text-dark ms-1">Max Cost Per Day (Rp)</label>
            <div class="input-group input-group-outline bg-white rounded-3" style="border: 1px solid #d2d6da;">
              <input type="number" id="max_perhari" name="max_perhari" class="form-control border-0 bg-transparent py-2 ps-3 @error('max_perhari') is-invalid @enderror" placeholder="e.g. 20000" min="0" value="{{ old('max_perhari') }}" required style="height: 43px; box-shadow: none; outline: none; border-radius: 8px;">
            </div>
            @error('max_perhari')<div class="text-danger text-xs mt-1 ms-1">{{ $message }}</div>@enderror
          </div>

          <div class="row mt-5">
            <div class="col-6 text-start">
              <a href="{{ route('vehicle-type.index') }}" class="btn text-white w-100 font-weight-bold text-sm py-3 mb-0" style="background-color: #1a2530; border-radius: 8px; box-shadow: none; border: none; letter-spacing: 0.5px; height: 46px; display: inline-flex; align-items: center; justify-content: center; text-transform: uppercase;">
                CANCEL
              </a>
            </div>
            <div class="col-6 text-end">
              <button type="submit" class="btn text-white w-100 font-weight-bold text-sm py-3 mb-0" style="background: linear-gradient(90deg, #ec407a 0%, #8e24aa 100%); border-radius: 8px; box-shadow: none; border: none; letter-spacing: 0.5px; height: 46px; text-transform: uppercase;">
                SAVE VEHICLE TYPE
              </button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

@endsection
