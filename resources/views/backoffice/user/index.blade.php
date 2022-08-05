@extends('backoffice.app')

@section('content')
<div class="mt-5">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                               firstname
                            </th>
                            <th>
                                lastname
                             </th>
                            <th>
                                email
                            </th>
                            
                            <th>
                                username
                            </th>
                            <th>
                                action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)

                                    <td>
                                        {{ $user->firstname }}
                                    </td>
                                    
                                    <td>
                                        {{ $user->lastname }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ $user->username }}
                                    </td>
                                    <td>
                                        <div class="btn-group align-top">
                                            {{--  <a href="{{ route('users.edit', $user) }}" class="btn btn-xs btn-inverse-dark" title="{{ __('confirm.action_update_user') }}">
                                                <span class="iconify" data-icon="mdi-account-edit" data-inline="true"></span>
                                            </a>  --}}
            
                                            <form action="{{ route('user.delete', $user->id) }}"
                                                onclick="return confirm('delete user')" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-xs btn-inverse-danger btn-fw">
                                                    <span class="mdi mdi-account-remove"></span>
                                                </button>
                                            </form>
            
            
            
                                        </div>
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