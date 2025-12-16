@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">لیست مشتریان</h1>

    <!-- پیام موفقیت -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- دکمه افزودن مشتری جدید -->
    <div class="mb-3">
        <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> افزودن مشتری جدید
        </a>
    </div>

    <!-- جدول مشتریان -->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>تلفن</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->phone ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> ویرایش
                            </a>
                            <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('آیا از حذف این مشتری مطمئن هستید؟')">
                                    <i class="bi bi-trash"></i> حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- صفحه‌بندی -->
    <div class="d-flex justify-content-center">
        {{ $customers->links() }}
    </div>
</div>
@endsection