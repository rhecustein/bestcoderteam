@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Menu visibility')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Menu visibility')}}</h1>

          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.update-menu-visibility') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <table class="table table-bordered">
                                <thead>
                                    <th>{{__('admin.Default Name')}}</th>
                                    <th>{{__('admin.Custom Name')}}</th>
                                    <th>{{__('admin.Visibility')}}</th>
                                </thead>
                                <tbody>
                                    @foreach ($menus as $menu)
                                        <tr>
                                            <td width="33%">{{ $menu->menu_name }}</td>
                                            <td width="33%">
                                                <input type="hidden" name="ids[]" value="{{ $menu->id }}">
                                                <input type="text" name="custom_names[]" value="{{ $menu->custom_name }}" class="form-control" required>
                                            </td>
                                            <td width="33%">
                                            <select name="status[]" id="" class="form-control">
                                                    <option {{ $menu->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Active')}}</option>
                                                    <option {{ $menu->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Inactive')}}</option>
                                            </select>


                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button class="btn btn-primary">{{__('admin.Update')}}</button>
                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>
@endsection
