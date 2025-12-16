@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">ویرایش مشتری</h1>

    <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- فیلد نام -->
        <div class="mb-3">
            <label for="name" class="form-label">نام مشتری</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                   id="name" name="name" value="{{ old('name', $customer->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- فیلد تلفن -->
        <div class="mb-3">
            <label for="phone" class="form-label">تلفن</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                   id="phone" name="phone" value="{{ old('phone', $customer->phone) }}">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- دکمه‌ها -->
        <div class="mb-3">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle"></i> به‌روزرسانی
            </button>
            <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> انصراف
            </a>
        </div>
    </form>
</div>
@endsection