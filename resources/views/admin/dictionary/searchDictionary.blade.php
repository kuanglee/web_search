@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="container box">
                <h3 align="center">Search Dicionary</h3><br />


                <div class="form-group">
                    <label for="sel1">Select Language : </label>
                    <select class="form-control city" id="selectlanguage">
                        <option value="">Select Dictionary</option>
                        <option value="vn-ja">VN - JA</option>
                        <option value="vn-en">VN - EN</option>
                        <option value="ja-vn">JA - VN</option>
                        <option value="ja-vn">JA - EN</option>
                        <option value="en-vn">EN - VN</option>
                        <option value="en-ja">EN - JA</option>
                    </select>
                    {{ csrf_field() }}
                </div>

                <div class="form-group">
                    <input type="text" name="key_word" id="key_word" class="form-control input-lg" placeholder="Enter key word" />
                    <div id="list_key_word">
                    </div>
                </div>
                @yield('result_search')
                {{ csrf_field() }}
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

<!-- /#page-wrapper -->
@endsection
