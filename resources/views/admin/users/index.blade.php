@extends('layouts.backend.app')

@section('title','Users')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ __('All Users') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.users.create') }}" class="btn-shadow btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-plus-circle fa-w-20"></i>
                        </span>
                        {{ __('Create User') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Joined At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key=>$user)
                            <td>
                            @if ($user->role_id==3)


                                <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
{{--                                                <div class="widget-content-left">--}}
{{--                                                    <img width="40" class="rounded-circle"--}}
{{--                                                         src="{{ $user->getFirstMediaUrl('avatar') != null ? $user->getFirstMediaUrl('avatar','thumb') : config('app.placeholder').'160' }}" alt="User Avatar">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">{{ $user->name }}</div>
                                                <div class="widget-subheading opacity-7">
                                                    @if ($user->role)
                                                        <span class="badge badge-info">{{ $user->role->name }}</span>
                                                    @else
                                                        <span class="badge badge-danger">No role found :(</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">
                                    @if ($user->status)
                                        <div class="badge badge-success">Active</div>
                                    @else
                                        <div class="badge badge-danger">Inactive</div>
                                    @endif
                                </td>
                                <td class="text-center">{{ $user->created_at->diffForHumans() }}</td>
                                <td class="text-center">
                                    <a class="btn btn-secondary btn-sm" href="{{ route('admin.users.show',$user->id) }}"><i
                                            class="fas fa-eye"></i>
                                        <span>Show</span>
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.users.edit',$user->id) }}"><i
                                            class="fas fa-edit"></i>
                                        <span>Edit</span>
                                    </a>
                                </td>
                            <td>
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.destroy',$user->id) }}"><i
                                            class=""></i>
                                        <span>Delete</span>
                                    </a>
{{--                                    <button class="btn btn-danger waves-effect" type="button" onclick="return confirm('Are you sure?') " href="{{ route('admin.users.destroy',$user->id) }}" >--}}
{{--                                        <i class="material-icons">delete</i>--}}
{{--                                    </button>--}}
{{--                                    <form id="delete-form-{{ $user->id }}" action="{{ route('admin.post.destroy',$user->id) }}" method="POST" style="display: none;">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                    </form>--}}
                                @endif
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        function deletePost(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
@endpush
