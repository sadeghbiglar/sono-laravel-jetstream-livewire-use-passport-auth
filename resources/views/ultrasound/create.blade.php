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
    <form id="fetch-data-form">
        <div>
            <label for="category_id">Enter Category ID:</label>
            <input type="text" id="category_id" name="category_id" required>
        </div>
        <button type="button" onclick="fetchData()">Fetch Data</button>
    </form>

    <div id="result"></div>
    

    <!-- فرم جدید برای ارسال درخواست API -->
<form action="{{ route('fetch.data') }}" method="POST">
    @csrf
    <div>
        <label for="id">Enter ID:</label>
        <input type="text" name="id" id="id" required>
    </div>
    <button type="submit">Fetch Data</button>
</form>

<!-- نمایش نتیجه API -->
@if(session('result'))
    <div>
        <h3>Result:</h3>
        <pre>{{ json_encode(session('result'), JSON_PRETTY_PRINT) }}</pre>
    </div>
@endif

<!-- نمایش پیام‌های خطا -->
@if($errors->any())
    <div>
        <p>{{ $errors->first() }}</p>
    </div>
@endif

<!-- api-with auth -->


   <!-- فرم جدید برای ارسال درخواست API -->
   <form action="{{ route('fetch.data_auth') }}" method="POST">
    @csrf
    <div>
        <label for="idd">Enter ID with auth:</label>
        <input type="text" name="idd" id="idd" required>
    </div>
    <button type="submit">Fetch Data</button>
</form>

<!-- نمایش نتیجه API -->
@if(session('result'))
    <div>
        <h3>Result:</h3>
        <pre>{{ json_encode(session('result'), JSON_PRETTY_PRINT) }}</pre>
    </div>
@endif

<!-- نمایش پیام‌های خطا -->
@if($errors->any())
    <div>
        <p>{{ $errors->first() }}</p>
    </div>
@endif



    <!-- JavaScript code -->
<script>
    function fetchData() {
        var categoryId = document.getElementById('category_id').value;

        fetch(`https://apitester.ir/api/Categories/${categoryId}`)
            .then(response => response.json())
            .then(data => {
                // Display the result
                document.getElementById('result').innerHTML = JSON.stringify(data);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                document.getElementById('result').innerHTML = 'Error fetching data.';
            });
    }
</script>
</div>
@endsection