@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>ثبت اطلاعات سونوگرافی</h2>
        <form action="{{ route('ultrasound.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="patient_name">نام بیمار</label>
            <input type="text" name="patient_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="national_id">کد ملی</label>
            <input type="text" name="national_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone_number">شماره تلفن</label>
            <input type="text" name="phone_number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="exam_type">نوع آزمایش</label>
            <input type="text" name="exam_type" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="exam_date">تاریخ آزمایش</label>
            <input type="date" name="exam_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="gestational_age">سن بارداری (هفته)</label>
            <input type="number" name="gestational_age" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fetal_heart_rate">ضربان قلب جنین</label>
            <input type="number" step="0.01" name="fetal_heart_rate" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="amniotic_fluid_index">شاخص مایع آمنیوتیک</label>
            <input type="number" step="0.01" name="amniotic_fluid_index" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="comments">توضیحات</label>
            <textarea name="comments" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">ثبت</button>
    </form>
    </div>
@endsection
