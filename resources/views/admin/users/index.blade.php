@extends('layouts.app')
@section('title', __('Add'))

@section('content')
    <section id="admin-users">
        <div class="container">
            <div class="admin-users">
                @include('admin.users._nav')
                <h1>{{ __('AdminUsers') }}</h1>
                <a href="{{ route('admin.users.create') }}" class="btn btn-active ml w-1">{{ __('Add User') }}</a>
                <form action="?" method="GET">
                    <div class="filter">
                        <div class="form-input">
                            <label for="id" class="form-input-label">{{ __('ID') }}</label>
                            <input id="id" class="input" name="id" value="{{ request('id') }}">
                        </div>
                        <div class="form-input">
                            <label for="name" class="form-input-label">{{ __('Name') }}</label>
                            <input id="name" class="input" name="name" value="{{ request('name') }}">
                        </div>
                        <div class="form-input">
                            <label for="email" class="form-input-label">{{ __('Email') }}</label>
                            <input id="email" class="input" name="email" value="{{ request('email') }}">
                        </div>
                        <div class="form-input">
                            <label for="status" class="form-input-label">{{ __('Status') }}</label>
                            <select id="status" class="input" name="status">
                                <option value=""></option>
                                {{--                                        @php /** @var App\Http\Controllers\Admin\Users\UsersController $statuses */ @endphp--}}
                                {{--                                        @foreach ($statuses as $value => $label)--}}
                                {{--                                            <option value="{{ $value }}" {{ ($value === request('status')) ? ' selected' : ''--}}
                                {{--                                    }}>{{ $label }}--}}
                                {{--                                            </option>--}}
                                {{--                                        @endforeach;--}}
                            </select>
                        </div>

                        <div class="form-input">
                            <label for="role" class="form-input-label">{{ __('Role') }}</label>
                            <select id="role" class="input" name="role">
                                <option value=""></option>
{{--                                @foreach ($roles as $role => $label)--}}
{{--                                    <option value="{{ $role }}" @if ($role === request('role')) selected @endif>{{--}}
{{--                                        $label }}--}}
{{--                                    </option>--}}
{{--                                @endforeach;--}}
                            </select>
                        </div>
                    </div>
                    <div class="form-input">
                        <button type="submit" class="btn btn-active ml w-1">{{ __('Search') }}</button>
                    </div>
                </form>

                <table class="table">
                    <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Role') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php /** @var User $user */use App\Models\User; @endphp
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><a href="{{ route('admin.users.show', $user) }}">{{ $user->name }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                {{--                                @if ($user->isWait())--}}
                                {{--                                    <span class="badge badge-secondary">Waiting</span>--}}
                                {{--                                @endif--}}
                                {{--                                @if ($user->isActive())--}}
                                {{--                                    <span class="badge badge-success">Active</span>--}}
                                {{--                                @endif--}}
                            </td>
                            <td>
                                {{--                                @if ($user->isAdmin())--}}
                                {{--                                    <span class="badge badge-danger">Admin</span>--}}
                                {{--                                @else--}}
                                {{--                                    <span class="badge badge-secondary">User</span>--}}
                                {{--                                @endif--}}
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                {{ $users->links() }}
            </div>
        </div>
    </section>
@endsection
