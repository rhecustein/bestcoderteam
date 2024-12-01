@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Section Control')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Section Control')}}</h1>

          </div>


          <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                    <form action="{{ route('admin.update-section-control') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <h5 class="home_border">{{__('admin.Homepage Section Control')}}</h5>
                                <hr>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="33%">{{__('admin.Section')}}</th>
                                            <th width="33%">{{__('admin.Visibility')}}</th>
                                            <th width="33%">{{__('admin.Item Quantity')}}</th>
                                        </tr>
                                    </thead>
                                    @foreach ($homepage as $section)
                                        <tr>
                                            <td>
                                                {{ $section->section_name }}
                                            </td>

                                            <input type="hidden" name="ids[]" value="{{ $section->id }}">
                                            <td>
                                                <select name="status[]" class="form-control">
                                                    <option {{ $section->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Enable')}}</option>
                                                    <option {{ $section->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Disable')}}</option>
                                                </select>
                                            </td>

                                            @if ($section->id == 1 || $section->id == 6 || $section->id == 7 || $section->id == 10 || $section->id == 21 || $section->id == 33 || $section->id == 35 || $section->id == 36 || $section->id == 38 || $section->id == 39)
                                                <td>
                                                    <input class="d-none" type="text" value="{{ $section->qty }}" name="quanities[]" class="form-control">
                                                </td>
                                            @else
                                                <td>
                                                    <input type="text" value="{{ $section->qty }}" name="quanities[]" class="form-control">
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </table>
                                <button class="btn btn-primary" type="submit">{{__('admin.Update')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
          </div>



        </section>
      </div>
@endsection
