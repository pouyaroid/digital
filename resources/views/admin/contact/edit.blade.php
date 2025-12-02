@extends('admin.layouts.app')

@section('content')

<h3 class="mb-4">ویرایش بخش تماس با ما</h3>

<form action="{{ route('contact.update') }}" method="POST" class="glass-card p-4">
    @csrf
    @method('PUT')

    <div class="row g-3">

        <div class="col-md-6">
            <label>آدرس</label>
            <input type="text" name="address"
                   value="{{ old('address', $contact->address ?? '') }}"
                   class="form-control glass-input">
        </div>

        <div class="col-md-6">
            <label>شماره تماس</label>
            <input type="text" name="phone"
                   value="{{ old('phone', $contact->phone ?? '') }}"
                   class="form-control glass-input">
        </div>

        <div class="col-md-6">
            <label>ساعات کاری</label>
            <input type="text" name="working_hours"
                   value="{{ old('working_hours', $contact->working_hours ?? '') }}"
                   class="form-control glass-input">
        </div>

        <hr class="mt-4">

        <h5>شبکه‌های اجتماعی</h5>

        <div class="col-md-6">
            <label>لینک اینستاگرام</label>
            <input type="text" name="instagram_url"
                   value="{{ old('instagram_url', $contact->instagram_url ?? '') }}"
                   class="form-control glass-input">
        </div>

        <div class="col-md-6">
            <label>متن دکمه اینستاگرام</label>
            <input type="text" name="instagram_label"
                   value="{{ old('instagram_label', $contact->instagram_label ?? '') }}"
                   class="form-control glass-input">
        </div>

        <div class="col-md-6">
            <label>لینک تلگرام</label>
            <input type="text" name="telegram_url"
                   value="{{ old('telegram_url', $contact->telegram_url ?? '') }}"
                   class="form-control glass-input">
        </div>

        <div class="col-md-6">
            <label>متن دکمه تلگرام</label>
            <input type="text" name="telegram_label"
                   value="{{ old('telegram_label', $contact->telegram_label ?? '') }}"
                   class="form-control glass-input">
        </div>

    </div>

    <button class="btn btn-success mt-3">ذخیره</button>
</form>

{{-- استایل شیشه‌ای --}}


@endsection
