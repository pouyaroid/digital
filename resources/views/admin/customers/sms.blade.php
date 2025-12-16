@extends('admin.layouts.app')

@section('content')
<h2 class="mb-4 text-center">ارسال پیامک به مشتریان</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('admin.customers.sendSms') }}">
    @csrf

    <div class="mb-3">
        <label>انتخاب مشتریان:</label><br>
        <input type="checkbox" id="select-all"> <label for="select-all">انتخاب همه</label>
        <select id="customers-select" name="mobiles[]" class="form-control" multiple required style="height: 200px;">
            @foreach($customers as $customer)
                @if($customer->phone)
                    <option value="{{ $customer->phone }}">{{ $customer->name }} - {{ $customer->phone }}</option>
                @endif
            @endforeach
        </select>
        <small>برای انتخاب چند مشتری، Ctrl یا Cmd را نگه دارید.</small>
    </div>

    <div class="mb-3">
        <label>متن پیامک:</label>
        <textarea name="message" class="form-control" rows="3" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">ارسال پیامک</button>
</form>

<script>
    // اسکریپت انتخاب همه
    document.getElementById('select-all').addEventListener('change', function() {
        const options = document.getElementById('customers-select').options;
        for (let i = 0; i < options.length; i++) {
            options[i].selected = this.checked;
        }
    });
</script>
@endsection
